<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb: Ratings, Reviews, and Where to Watch the Best Anime</title>
    <link rel="stylesheet" href="assets/CSS/styles.css">
</head>
<body>

    <!-- Thanh điều hướng -->
    <div class="navbar">
        <a href="#">Trang chủ</a>
        <a href="#">Đánh giá phim</a>
        <a href="#">Thể loại phim</a>
        <a href="login.html">Đăng nhập</a> <!-- Liên kết tới trang đăng nhập -->
        <span class="menu-icon" onclick="toggleMenu()">&#9776;</span> <!-- Biểu tượng menu -->
    </div>

    <header>
        <h1>IMDb: Ratings, Reviews, and Where to Watch the Best Anime</h1>
    </header>
    <div class="high-score-section">
        <h2>The Anime has a high score</h2>
        <div class="anime-slider">
            <!-- Các mục phim sẽ được thêm vào đây bằng JavaScript -->
        </div>
    </div>
    <div class="container">

        <!-- Danh sách phim -->
        <div class="movie">
            <img src="https://m.media-amazon.com/images/M/MV5BNTI3MDkzNjctOTY2Ni00ZTJiLWI5N2ItNDI2MzI4MWJlMTMyXkEyXkFqcGc@._V1_QL75_UX140_CR0,0,140,207_.jpg" alt="Saturday Night">
            <div class="movie-info">
                <div class="movie-title">Understanding Dan Aykroyd and Improvising as Chevy Chase</div>
                <div class="movie-duration">5:43</div>
                <p>The 'Saturday Night' Cast on "SNL" Icons</p>
            </div>
        </div>

        <div class="movie">
            <img src="https://m.media-amazon.com/images/M/MV5BYjgxMDI5NmMtNTU3OS00ZDQxLTgxZmEtNzY1ZTBmMDY4NDRkXkEyXkFqcGc@._V1_QL75_UX140_CR0,0,140,207_.jpg" alt="Conclave">
            <div class="movie-info">
                <div class="movie-title">Ralph Fiennes and Stanley Tucci Star in 'Conclave'</div>
                <div class="movie-duration">1:52</div>
                <p>Watch the New Trailer</p>
            </div>
        </div>

        <div class="movie">
            <img src="https://m.media-amazon.com/images/M/MV5BYWZlZWM0MzMtNWE2MC00Mzc0LWFkMDMtYWE0Y2RjOTZiM2VkXkEyXkFqcGc@._V1_QL75_UX140_CR0,0,140,207_.jpg" alt="Outer Banks">
            <div class="movie-info">
                <div class="movie-title">"Outer Banks" Stars Quiz Each Other on Their Best Lines</div>
                <div class="movie-duration">5:32</div>
                <p>Hear Their Peak Moments From the Series</p>
            </div>
        </div>

    </div>

    <script src="assets/JS/index.js"></script>

    <footer>
        <p>&copy; 2024 IMDb. All rights reserved.</p>
    </footer>

    
<!-- Cửa sổ menu -->
    <div class="side-menu" id="sideMenu">
    <span class="close-menu" onclick="toggleMenu()">×</span>
    <h2>Menu</h2>
    <ul>
        <li><a href="advanced-search.html">Tìm kiếm nâng cao</a></li> <!-- Link to advanced search page -->
        <li><a href="rated-movies.html">Danh sách bộ phim đã đánh giá</a></li> <!-- Link to rated movies page -->
        <li><a href="search-history.html">Lịch sử tìm kiếm</a></li> <!-- Link to search history page -->
        <li><a href="account-info.html">Thông tin tài khoản</a></li> <!-- Link to account info page -->
    </ul>
    </div>
    <script src="assets/JS/index.js"></script>

</body>
</html>
