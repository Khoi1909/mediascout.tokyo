<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem Thêm Anime</title>
    <link rel="stylesheet" href="/public/styles/view-more-anime.css">
</head>
<body>
    <div class="layout">
        <div class="body">
            <div class="container" id="contentContainer">
                <div class="anime-list-section">
                    <h2>Danh Sách Anime của mùa</h2>
                    <div class="anime-list"></div>
                    <!-- Pagination Section -->
                    <div id="pagination"></div>
                </div>
                <!-- Thêm phần nhập liệu cho năm và mùa -->
                <div>
                    <input type="text" id="yearInput" placeholder="Enter Year (e.g., 2023)">
                    <input type="text" id="seasonInput" placeholder="Enter Season (e.g., spring, summer, fall, winter)">
                    <button id="fetchAnimeButton">Fetch Anime</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/scripts/viewmore(season).js"></script>
</body>
</html>