document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện click vào các anime item
    const animeItems = document.querySelectorAll('.anime-item');

    animeItems.forEach(item => {
        item.addEventListener('click', function() {
            // Lấy id từ data-id
            const animeId = this.getAttribute('data-id');

            // Tạo URL mới và chuyển hướng
            window.location.href = `/anime/info/${animeId}`;
        });
    });
});
