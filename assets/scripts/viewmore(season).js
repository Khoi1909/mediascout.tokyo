document.addEventListener("DOMContentLoaded", function () {
    // Define constants for year and season
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear(); // Get current year
    const currentMonth = currentDate.getMonth(); // Get current month (0-11)

    // Calculate the season based on the current month
    const seasons = ['WINTER', 'SPRING', 'SUMMER', 'FALL']; // Define the seasons in order
    let currentSeason;

    if (currentMonth >= 0 && currentMonth <= 2) {
        currentSeason = 'WINTER';
    } else if (currentMonth >= 3 && currentMonth <= 5) {
        currentSeason = 'SPRING';
    } else if (currentMonth >= 6 && currentMonth <= 8) {
        currentSeason = 'SUMMER';
    } else if (currentMonth >= 9 && currentMonth <= 11) {
        currentSeason = 'FALL';
    }

    // Update the page title and section header
    const titleElement = document.querySelector("title");
    const headingElement = document.querySelector(".anime-list-section h2");

    titleElement.textContent = `BEST ANIME FOR ${currentSeason} ${currentYear}`;
    headingElement.textContent = `BEST ANIME FOR ${currentSeason} ${currentYear}`;

    // Set year and season constants
    const itemsPerPage = 10; // Number of anime per page
    let currentPage = 1; // Current page
    const totalItems = 500; // Maximum total records allowed by the API
    const totalPages = Math.ceil(totalItems / itemsPerPage); // Total number of pages

    // Fetch anime recommendations and display them
    function fetchAnime(page) {
        if (page > totalPages || page < 1) {
            console.warn("No more pages to load.");
            return;
        }
        const year = currentYear;
        const season = currentSeason.toLowerCase();
        const offset = (page - 1) * itemsPerPage; // Calculate offset
        fetch(`https://data.mediascout.tokyo/anime/season/?year=${year}&season=${season}&limit=${itemsPerPage}&offset=${offset}`)
            .then(response => response.json())
            .then(data => {
                console.log('Data returned from API:', data);
                if (data.error) {
                    console.error('Error fetching data:', data.error);
                } else {
                    displayAnimeList(data);
                    createPagination(page);
                    // Update browser history
                    history.pushState({ page: page }, `Page ${page}`, `?page=${page}`);
                }
            })
            .catch(error => {
                console.error('Error fetching API:', error);
            });
    }

    // Function to display anime list
    function displayAnimeList(data) {
        const animeListContainer = document.querySelector('.anime-list');
        animeListContainer.innerHTML = ''; // Clear old content

        console.log('Full data received:', data); // Log the data to examine structure

        // Check if data.data is an array
        if (!data || !Array.isArray(data.data)) {
            console.error('Data is not an array or data is undefined:', data.data);
            return;
        }

        // Iterate over anime items
        data.data.forEach(anime => {
            const animeImage = getImageSrc(anime); // Get image URL
            const animeTitle = anime.node.title || 'No Title Available';
            const animeId = anime.node.id; // Assuming 'id' exists in the response

            // Create anime item element
            const animeItem = document.createElement('div');
            animeItem.classList.add('anime-item');
            animeItem.setAttribute('data-id', animeId); // Set the data-id

            animeItem.innerHTML = `
                <img src="${animeImage}" alt="${animeTitle}">
                <h3>${animeTitle}</h3>
            `;
            animeListContainer.appendChild(animeItem);
        });

        // Add event listeners for click handling
        document.querySelectorAll('.anime-item').forEach(item => {
            item.addEventListener('click', function() {
                const animeId = this.getAttribute('data-id'); // Get animeId
                window.location.href = `/anime/info/${animeId}`; // Redirect to anime info page
            });
        });
    }

    // Define the getImageSrc function
    function getImageSrc(anime) {
        if (anime && anime.node && anime.node.main_picture && anime.node.main_picture.large) {
            return anime.node.main_picture.large;
        }
        return 'assets/images/default-image.jpg'; // Default image if not available
    }

    // Function to create pagination buttons
    function createPagination(page) {
        const paginationContainer = document.getElementById('pagination');
        paginationContainer.innerHTML = '';

        // Previous button
        if (page > 1) {
            const prevButton = document.createElement('button');
            prevButton.innerText = 'Previous Page';
            prevButton.onclick = () => loadPage(page - 1);
            paginationContainer.appendChild(prevButton);
        }

        // Page buttons
        const startPage = Math.max(1, page - 1); // Start page
        const endPage = Math.min(totalPages, page + 2); // End page

        // Add page buttons
        for (let i = startPage; i <= endPage; i++) {
            const pageButton = document.createElement('button');
            pageButton.innerText = i;
            pageButton.onclick = () => loadPage(i);
            if (i === page) {
                pageButton.disabled = true; // Disable current page button
            }
            paginationContainer.appendChild(pageButton);
        }

        // Add ellipsis if needed
        if (endPage < totalPages) {
            const ellipsis = document.createElement('span');
            ellipsis.innerText = '...';
            paginationContainer.appendChild(ellipsis);
        }

        // Last page button
        if (endPage < totalPages) {
            const lastButton = document.createElement('button');
            lastButton.innerText = totalPages;
            lastButton.onclick = () => loadPage(totalPages);
            paginationContainer.appendChild(lastButton);
        }

        // Next button
        if (page < totalPages) {
            const nextButton = document.createElement('button');
            nextButton.innerText = 'Next Page';
            nextButton.onclick = () => loadPage(page + 1);
            paginationContainer.appendChild(nextButton);
        }

        // Input box for page number
        const pageInput = document.createElement('input');
        pageInput.type = 'number';
        pageInput.min = 1;
        pageInput.max = totalPages;
        pageInput.placeholder = 'Enter page number';
        paginationContainer.appendChild(pageInput);

        // "Go" button to navigate to the entered page
        const goButton = document.createElement('button');
        goButton.innerText = 'Go';
        goButton.onclick = () => {
            const pageNumber = parseInt(pageInput.value);
            if (pageNumber >= 1 && pageNumber <= totalPages) {
                loadPage(pageNumber);
            } else {
                alert('Please enter a valid page number!');
            }
        };
        paginationContainer.appendChild(goButton);
    }

    // Function to load data for pagination
    function loadPage(page) {
        currentPage = page; // Update current page
        fetchAnime(currentPage); // Fetch anime for the current page
    }

    // Handle when the user goes back to a previous page
    window.onpopstate = function(event) {
        if (event.state) {
            currentPage = event.state.page; // Get the page from state
            fetchAnime(currentPage); // Fetch anime for the current page
        }
    };

    // Fetch anime for the first page on load
    fetchAnime(currentPage);
});
