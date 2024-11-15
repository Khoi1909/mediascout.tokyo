document.addEventListener("DOMContentLoaded", function () {
    const searchButton = document.getElementById("searchButton");
    const searchInput = document.getElementById("searchInput");
    const resultContainer = document.getElementById("resultContainer");
    const suggestionsContainer = document.getElementById("suggestionsContainer");

    // Handle search action khi nhấn nút tìm kiếm
    searchButton.addEventListener("click", function () {
        const searchText = searchInput.value.trim();
        if (searchText) {
            console.log("Searching for:", searchText);

            // Gọi API tìm kiếm anime từ server của bạn
            fetch(`https://data.mediascout.tokyo/anime/search?q=${encodeURIComponent(searchText)}&offset=0`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Hiển thị kết quả tìm kiếm
                    if (data && data.data && data.data.length > 0) {
                        resultContainer.innerHTML = ''; // Xóa kết quả trước đó
                        data.data.forEach(anime => {
                            const animeElement = document.createElement('div');
                            animeElement.classList.add('anime-item');
                            animeElement.innerHTML = `
                                <img src="${anime.main_picture ? anime.main_picture.medium : ''}" alt="${anime.title}">
                                <h3>${anime.title}</h3>
                            `;
                            resultContainer.appendChild(animeElement);
                        });
                    } else {
                        resultContainer.innerHTML = '<p>Không tìm thấy kết quả nào!</p>';
                    }
                })
                .catch(error => {
                    console.error('Error searching for anime:', error);
                    resultContainer.innerHTML = '<p>Lỗi khi tìm kiếm anime. Vui lòng thử lại sau!</p>';
                });
        } else {
            alert("Vui lòng nhập tên anime để tìm kiếm!");
        }
    });

    // Gợi ý anime khi người dùng nhập
    searchInput.addEventListener("input", function () {
        const searchText = searchInput.value.trim();
        const limit = 10; // Số lượng gợi ý hiển thị
        const fields = 'id,title,main_picture'; // Các trường dữ liệu cần lấy
        
        if (searchText.length > 0) {
            // Gọi API gợi ý anime từ server của bạn
            fetch(`https://data.mediascout.tokyo/anime/suggest?q=${encodeURIComponent(searchText)}&limit=${limit}&fields=${fields}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Hiển thị gợi ý anime
                    suggestionsContainer.innerHTML = ''; // Xóa các gợi ý cũ
                    if (data && data.data && data.data.length > 0) {
                        data.data.forEach(anime => {
                            const suggestionItem = document.createElement('div');
                            suggestionItem.classList.add('suggestion-item');
                            suggestionItem.innerHTML = `
                                <img src="${anime.main_picture ? anime.main_picture.medium : ''}" alt="${anime.title}">
                                <span>${anime.title}</span>
                            `;
                            suggestionItem.addEventListener("click", function () {
                                searchInput.value = anime.title;  // Chọn gợi ý và điền vào ô tìm kiếm
                                suggestionsContainer.innerHTML = ''; // Ẩn gợi ý
                            });
                            suggestionsContainer.appendChild(suggestionItem);
                        });
                    } else {
                        suggestionsContainer.innerHTML = '<p>Không có gợi ý nào!</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching suggestions:', error);
                    suggestionsContainer.innerHTML = '<p>Lỗi khi lấy gợi ý. Vui lòng thử lại sau!</p>';
                });
        } else {
            suggestionsContainer.innerHTML = '';  // Ẩn gợi ý nếu ô tìm kiếm trống
        }
    });
});
