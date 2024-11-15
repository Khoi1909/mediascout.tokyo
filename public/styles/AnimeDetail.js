// anime_detail.js
document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const animeId = urlParams.get('id');

    if (animeId) {
        // Gọi API để lấy thông tin anime
        fetch(`http://localhost:3000/anime/info?id=${encodeURIComponent(animeId)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(anime => {
                // Cập nhật giao diện với thông tin anime
                document.getElementById('anime-title').textContent = anime.title;
                document.getElementById('anime-image').src = anime.main_picture.medium;
                document.getElementById('anime-synopsis').textContent = anime.synopsis;

                const genres = anime.genres.map(genre => genre.name).join(', ');
                document.getElementById('anime-genres').textContent = genres;
            })
            .catch(error => {
                console.error('Error fetching anime info:', error);
                document.getElementById('anime-synopsis').textContent = 'Không thể lấy thông tin anime.';
            });
    } else {
        document.getElementById('anime-synopsis').textContent = 'ID anime không hợp lệ.';
    }
});