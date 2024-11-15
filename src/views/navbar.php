<div class="navbar">
    <a href="/home">Trang chủ</a>
    <a href="rated-movies.php">Danh sách bộ phim đã đánh giá</a>
    <a href="search-history.php">Lịch sử tìm kiếm</a>
</div>

<!-- Search Bar (Initially hidden) -->
<div id="searchBarContainer" class="search-bar-container hidden">
    <div class="search-wrapper">
        <input type="text" id="searchInput" class="search-input" placeholder="Nhập tên anime cần tìm...">
        <button id="searchButton" class="search-button">Tìm kiếm</button>
        <div id="suggestionsContainer" class="suggestions"></div> <!-- Gợi ý -->
    </div>

    <div id="resultContainer" class="results"></div> <!-- Kết quả tìm kiếm -->
</div>