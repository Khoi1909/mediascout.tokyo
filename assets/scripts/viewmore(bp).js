document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 10; // Số lượng anime mỗi trang
    let currentPage = 1; // Trang hiện tại
    const totalItems = 500; // Giới hạn tổng số bản ghi mà API cho phép
    const totalPages = Math.ceil(totalItems / itemsPerPage); // Tính tổng số trang

    // Fetch anime recommendations and display them
    function fetchAnime(page) {
        if (page > totalPages || page < 1) {
            console.warn("No more pages to load.");
            return;
        }

        const offset = (page - 1) * itemsPerPage; // Tính toán offset
        fetch(`https://data.mediascout.tokyo/anime/recommendations/bypopularity?limit=${itemsPerPage}&offset=${offset}`)
            .then(response => response.json())
            .then(data => {
                console.log('Data returned from API:', data);
                if (data.error) {
                    console.error('Error fetching data:', data.error);
                } else {
                    displayAnimeList(data);
                    createPagination(page);
                    // Cập nhật lịch sử trình duyệt
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
            const animeImage = getImageSrc(anime); // Lấy đường dẫn hình ảnh
            const animeTitle = anime.node.title || 'No Title Available';

            // Create anime item element
            const animeItem = document.createElement('div');
            animeItem.classList.add('anime-item');
            animeItem.innerHTML = `
                <img src="${animeImage}" alt="${animeTitle}">
                <h3>${animeTitle}</h3>
            `;
            animeListContainer.appendChild(animeItem);
        });
    }

    // Định nghĩa hàm getImageSrc nếu chưa có
    function getImageSrc(anime) {
        if (anime && anime.node && anime.node.main_picture && anime.node.main_picture.large) {
            return anime.node.main_picture.large;
        }
        return 'assets/images/default-image.jpg'; // Hình ảnh mặc định nếu không có
    }

    // Function to create pagination buttons
   // Function to create pagination buttons
    function createPagination(page) {
    const paginationContainer = document.getElementById('pagination');
    paginationContainer.innerHTML = '';

    // Nút quay lại
    if (page > 1) {
        const prevButton = document.createElement('button');
        prevButton.innerText = 'Previous Page';
        prevButton.onclick = () => loadPage(page - 1);
        paginationContainer.appendChild(prevButton);
    }

    // Hiển thị các nút trang
    const startPage = Math.max(1, page - 1); // Trang bắt đầu
    const endPage = Math.min(totalPages, page + 2); // Trang kết thúc

    // Thêm nút cho các trang
    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement('button');
        pageButton.innerText = i;
        pageButton.onclick = () => loadPage(i);
        if (i === page) {
            pageButton.disabled = true; // Vô hiệu hóa nút cho trang hiện tại
        }
        paginationContainer.appendChild(pageButton);
    }

    // Thêm dấu "..." nếu cần
    if (endPage < totalPages) {
        const ellipsis = document.createElement('span');
        ellipsis.innerText = '...';
        paginationContainer.appendChild(ellipsis);
    }

    // Nút cho trang cuối
    if (endPage < totalPages) {
        const lastButton = document.createElement('button');
        lastButton.innerText = totalPages;
        lastButton.onclick = () => loadPage(totalPages);
        paginationContainer.appendChild(lastButton);
    }

    // Nút tiếp theo
    if (page < totalPages) {
        const nextButton = document.createElement('button');
        nextButton.innerText = 'Next Page';
        nextButton.onclick = () => loadPage(page + 1);
        paginationContainer.appendChild(nextButton);
    }

    // Ô nhập liệu cho số trang
    const pageInput = document.createElement('input');
    pageInput.type = 'number';
    pageInput.min = 1;
    pageInput.max = totalPages;
    pageInput.placeholder = 'Nhập số trang';
    paginationContainer.appendChild(pageInput);

    // Nút "Go" để chuyển đến trang đã nhập
    const goButton = document.createElement('button');
    goButton.innerText = 'Go';
    goButton.onclick = () => {
        const pageNumber = parseInt(pageInput.value);
        if (pageNumber >= 1 && pageNumber <= totalPages) {
            loadPage(pageNumber);
        } else {
            alert('Vui lòng nhập số trang hợp lệ!');
        }
    };
    paginationContainer.appendChild(goButton);
    }
    // Function to load data for pagination
    function loadPage(page) {
        currentPage = page; // Cập nhật trang hiện tại
        fetchAnime(currentPage); // Gọi hàm fetchAnime với trang hiện tại
    }

    // Xử lý sự kiện khi người dùng quay lại trang
    window.onpopstate = function(event) {
        if (event.state) {
            currentPage = event.state.page; // Lấy trang từ state
            fetchAnime(currentPage); // Gọi hàm fetchAnime với trang hiện tại
        }
    };

    // Fetch anime for the first page on load
    fetchAnime(currentPage);
});