document.addEventListener("DOMContentLoaded", function () {
    let currentIndex = [0, 0, 0]; // Indexes for each fetch
    let animeData = [[], [], []]; // Data for each fetch
    let displayQueue = [[], [], []]; // Display queue for each fetch
    let autoSlideInterval = [null, null, null]; // Auto-slide intervals for each fetch

    // Get current year and season
    const currentYear = new Date().getFullYear();
    const currentSeason = getCurrentSeason();

    function getCurrentSeason() {
        const month = new Date().getMonth();
        if (month >= 2 && month <= 4) return 'spring';
        else if (month >= 5 && month <= 7) return 'summer';
        else if (month >= 8 && month <= 10) return 'fall';
        else return 'winter';
    }

    // Fetch anime data for each section
    fetchAnimeData('http://localhost:3000/anime/recommendations/upcoming', 0);
    fetchAnimeData('http://localhost:3000/anime/recommendations/bypopularity', 1);
    fetchAnimeData(`http://localhost:3000/anime/season?year=${currentYear}&season=${currentSeason}`, 2);

    // Function to fetch anime data
    function fetchAnimeData(url, index) {
        window.fetch(url)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                const animeList = data.data.slice(0, 20); // Get the first 20 items
                animeData[index] = animeList;
                displayQueue[index] = animeData[index].slice(0, 4); // Set the initial display queue
                displaySlide(displayQueue[index], `slider${index + 1}`);
                startAutoSlide(index);
            })
            .catch(error => console.error('Error fetching anime data:', error));
    }

    // Display anime in the queue
    function displaySlide(queue, sliderId) {
        const animeSlider = document.getElementById(sliderId);
        animeSlider.innerHTML = queue.map(animeItem => {
            const anime = animeItem.node;
            return `
                <div class="anime-item">
                    <img src="${anime.main_picture.large}" alt="${anime.title}">
                    <div class="anime-info">
                        <h3>${anime.title}</h3>
                    </div>
                </div>
            `;
        }).join('');
    }

    // Rotate the queue
    function rotateQueue(queue, currentIndex) {
        return queue.slice(currentIndex, currentIndex + 4);
    }

    // Start auto-slide
    function startAutoSlide(index) {
        autoSlideInterval[index] = setInterval(() => {
            currentIndex[index] = (currentIndex[index] + 1) % animeData[index].length;
            displayQueue[index] = rotateQueue(animeData[index], currentIndex[index]);
            displaySlide(displayQueue[index], `slider${index + 1}`);
        }, 3000);
    }

    // Event listeners for left and right arrows
    document.querySelectorAll('.arrow-left').forEach((button, index) => {
        button.addEventListener('click', () => {
            clearInterval(autoSlideInterval[index]);
            currentIndex[index] = (currentIndex[index] - 1 + animeData[index].length) % animeData[index].length;
            displayQueue[index] = rotateQueue(animeData[index], currentIndex[index]);
            displaySlide(displayQueue[index], `slider${index + 1}`);
        });
    });

    document.querySelectorAll('.arrow-right').forEach((button, index) => {
        button.addEventListener('click', () => {
            clearInterval(autoSlideInterval[index]);
            currentIndex[index] = (currentIndex[index] + 1) % animeData[index].length;
            displayQueue[index] = rotateQueue(animeData[index], currentIndex[index]);
            displaySlide(displayQueue[index], `slider${index + 1}`);
        });
    });

    // Function to populate anime list dynamically (for static lists)
    const animeList1 = document.getElementById('anime-list1');
    const animeList2 = document.getElementById('anime-list2');
    const animeList3 = document.getElementById('anime-list3');

    // Example of populating anime list with data fetched from a server
    fetchAnimeDataForList().then(animeData => {
        animeData.forEach(anime => {
            const animeItem = document.createElement('div');
            animeItem.classList.add('anime-item');

            // Create link for image
            const animeLink = document.createElement('a');
            animeLink.href = `anime_detail.php?id=${anime.id}`;
            const animeImage = document.createElement('img');
            animeImage.src = anime.image_url;
            animeImage.alt = anime.title;
            animeLink.appendChild(animeImage);

            // Create link for title
            const animeTitleLink = document.createElement('a');
            animeTitleLink.href = `anime_detail.php?id=${anime.id}`;
            animeTitleLink.textContent = anime.title;

            // Add image and title to item
            animeItem.appendChild(animeLink);
            animeItem.appendChild(animeTitleLink);
            animeList1.appendChild(animeItem); // Append to the first list (adjust list as needed)
        });
    });

    // Fetch anime data for static lists (replace with actual API call)
    function fetchAnimeDataForList() {
        return Promise.resolve([
            {
                id: 1,
                title: 'Example Anime 1',
                image_url: 'https://via.placeholder.com/150'
            },
            {
                id: 2,
                title: 'Example Anime 2',
                image_url: 'https://via.placeholder.com/150'
            }
            // More anime items...
        ]);
    }
});
