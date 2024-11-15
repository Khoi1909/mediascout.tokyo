document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 10;
    let currentPage = 1;
    const currentYear = new Date().getFullYear();
    const totalItems = 500;
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    // Map English season names to Vietnamese
    const seasonMapping = {
        spring: 'Xuân',
        summer: 'Hè',
        fall: 'Thu',
        winter: 'Đông'
    };

    // Function to get the current season in Vietnamese
    function getCurrentSeason() {
        const month = new Date().getMonth();
        if (month >= 2 && month <= 4) return 'Xuân';
        if (month >= 5 && month <= 7) return 'Hè';
        if (month >= 8 && month <= 10) return 'Thu';
        return 'Đông';
    }

    // Function to update the header with the current season
    function updateHeader(season = getCurrentSeason()) {
        const headerElement = document.querySelector('.anime-list-section h2');
        headerElement.textContent = `Danh Sách Anime của mùa ${season}`;
    }

    // Fetch and display anime data
    function fetchAnime(page) {
        if (page > totalPages || page < 1) return;

        const offset = (page - 1) * itemsPerPage;
        fetch(`http://localhost:3000/anime/season?year=${year}&season=${season}&offset=${offset}`)
           .then(response => {
           if (!response.ok) {
              throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => displayAnimeList(data))
        .catch(error => console.error('Error fetching anime recommendations:', error));

    }

    // Display anime list
    function displayAnimeList(data) {
        const animeListContainer = document.querySelector('.anime-list');
        animeListContainer.innerHTML = '';

        if (!data || !Array.isArray(data.data)) {
            animeListContainer.innerHTML = '<p>Không có dữ liệu để hiển thị.</p>';
            return;
        }

        data.data.forEach(anime => {
            const animeImage = anime.node?.main_picture?.large || 'assets/images/default-image.jpg';
            const animeTitle = anime.node?.title || 'Chưa có tiêu đề';

            const animeItem = document.createElement('div');
            animeItem.classList.add('anime-item');
            animeItem.innerHTML = `
                <img src="${animeImage}" alt="${animeTitle}">
                <h3>${animeTitle}</h3>
            `;
            animeListContainer.appendChild(animeItem);
        });
    }

    // Create pagination controls
    function createPagination(page) {
        const paginationContainer = document.getElementById('pagination');
        paginationContainer.innerHTML = '';

        if (page > 1) {  // Show "Previous" button only if page is greater than 1
            const prevButton = document.createElement('button');
            prevButton.textContent = 'Trang trước';
            prevButton.onclick = () => fetchAnime(page - 1);
            paginationContainer.appendChild(prevButton);
        }

        const nextButton = document.createElement('button');
        nextButton.textContent = 'Trang sau';
        if (page < totalPages) {  // Show "Next" button only if page is less than total pages
            nextButton.onclick = () => fetchAnime(page + 1);
        }
        paginationContainer.appendChild(nextButton);
    }

    // Handle search
    document.getElementById('fetchAnimeButton').addEventListener('click', () => {
        const year = document.getElementById('yearInput').value;
        const seasonInput = document.getElementById('seasonInput').value.trim().toLowerCase();

        const season = Object.keys(seasonMapping).find(key => seasonMapping[key].toLowerCase() === seasonInput);
        if (!season || !year) {
            alert('Vui lòng nhập năm và mùa hợp lệ!');
            return;
        }

        updateHeader(seasonMapping[season]);
        fetch(`http://localhost:3000/anime/season?year=${year}&season=${season}&offset=0`)
            .then(response => response.json())
            .then(data => displayAnimeList(data))
            .catch(error => console.error('Error fetching API:', error));
    });

    // Initial setup
    updateHeader();
    fetchAnime(currentPage);
});
