<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <link rel="stylesheet" href="/public/styles/MainLayout.css">-->
<!--    <link rel="stylesheet" href="/public/styles/styles.css">-->
    <script src="/assets/scripts/search.js"></script>
    <title>Home</title>
</head>
<body>
<!-- Layout chung -->
<div class="layout">
<?php //include 'navbar.php'; ?>
<!-- --><?php //include 'leftSide.php'; ?>

    <div class="body">
        <div class="AnimeDisplay">
            <h2>Anime sắp ra mắt</h2>
            <div class="anime-slider-container">
                <button class="arrow-left">&lt;</button>
                <div id="slider1" class="anime-slider"></div>
                <button class="arrow-right">&gt;</button>
            </div>

            <!-- Section for 'See More' -->
            <div id="anime-view-more">
                <a href="/anime/upcoming" id="seeMoreBtn">Xem Thêm Anime</a>
                <div id="anime-list1">
                    <!-- Danh sách anime sẽ được thêm vào qua JavaScript -->
                </div>
                <div id="pagination">
                    <!-- Các nút phân trang sẽ được thêm tự động qua JavaScript -->
                </div>
            </div>
        </div>


        <div class="AnimeDisplay">
            <h2>Top Anime Hay được người dùng đánh giá </h2>
            <div class="anime-slider-container">
                <button class="arrow-left">&lt;</button>
                <div id="slider2" class="anime-slider"></div>
                <button class="arrow-right">&gt;</button>
            </div>

            <!-- Section for 'See More' -->
            <div id="anime-view-more">
                <a href="/anime/popular" id="seeMoreBtn">Xem Thêm Anime</a> <!--khác-->
                <div id="anime-list2"> <!--khác-->
                    <!-- Danh sách anime sẽ được thêm vào qua JavaScript -->
                </div>
                <div id="pagination">
                    <!-- Các nút phân trang sẽ được thêm tự động qua JavaScript -->
                </div>
            </div>
        </div>
        <div class="AnimeDisplay">
            <h2>Các Bộ Anime Hiện Tại </h2>
            <div class="anime-slider-container">
                <button class="arrow-left">&lt;</button>
                <div id="slider3" class="anime-slider"></div>
                <button class="arrow-right">&gt;</button>
            </div>

            <!-- Section for 'See More' -->
            <div id="anime-view-more">
                <a href="/anime/seasonal" id="seeMoreBtn">Xem Thêm Anime</a> <!--khác-->
                <div id="anime-list3"> <!--khác-->
                    <!-- Danh sách anime sẽ được thêm vào qua JavaScript -->
                </div>
                <div id="pagination">
                    <!-- Các nút phân trang sẽ được thêm tự động qua JavaScript -->
                </div>

            </div>
        </div>
    </div>
<!--    --><?php //include 'rightSide.php'; ?>
<!--    --><?php // include 'footer.php'; ?>
    <!-- Include the footer -->
</div>
<script src="/assets/scripts/index.js"></script>
<script src="/assets/scripts/login-status.js"></script>
</body>
</html>