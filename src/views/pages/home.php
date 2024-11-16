<?php
// Fetch data for upcoming animes
$upcomingApiUrl = 'https://data.mediascout.tokyo/anime/recommendations/upcoming';
$upcomingJsonData = file_get_contents($upcomingApiUrl);
$upcomingResponse = json_decode($upcomingJsonData, true);

// Fetch data for top rated animes
$topRatedApiUrl = 'https://data.mediascout.tokyo/anime/recommendations/bypopularity';
$topRatedJsonData = file_get_contents($topRatedApiUrl);
$topRatedResponse = json_decode($topRatedJsonData, true);

// Use the Season class to fetch current year and season
require_once 'src/models/Season.php';
$seasonInstance = new Season();
$currentYear = $seasonInstance->getCurrentYear();
$currentSeason = $seasonInstance->getCurrentSeason();

// Fetch data for anime of the current season
$seasonApiUrl = "https://data.mediascout.tokyo/anime/season?year={$currentYear}&season={$currentSeason}";
$seasonJsonData = file_get_contents($seasonApiUrl);
$seasonResponse = json_decode($seasonJsonData, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Showcase</title>
    <!-- Link to CSS -->
    <link rel="stylesheet" href="/public/styles/home.css">
</head>
<body>
<!-- Upcoming Animes Section -->
<div class="upcoming-animes">
    <h2> <a href="/anime/upcoming">Upcoming Animes</a></h2>
    <div class="carousel-container">
        <!-- Left arrow -->
        <button class="arrow left-arrow" aria-label="Previous">
            &#10094;
        </button>

        <!-- Carousel -->
        <div class="carousel">
            <?php foreach ($upcomingResponse['data'] as $anime):
                $node = $anime['node']; ?>
                <div class="anime-item" data-id="<?php echo htmlspecialchars($node['id']); ?>">
                    <img src="<?php echo htmlspecialchars($node['main_picture']['medium']); ?>"
                         alt="<?php echo htmlspecialchars($node['title']); ?>"
                         class="anime-image">
                    <h3><?php echo htmlspecialchars($node['title']); ?></h3>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Right arrow -->
        <button class="arrow right-arrow" aria-label="Next">
            &#10095;
        </button>
    </div>
</div>

<!-- Top Rated Animes Section -->
<div class="top-rated-animes">
    <h2> <a href="/anime/TopRated"> Top Rated Animes </a></h2>
    <div class="carousel-container">
        <!-- Left arrow -->
        <button class="arrow left-arrow" aria-label="Previous">
            &#10094;
        </button>

        <!-- Carousel -->
        <div class="carousel">
            <?php foreach ($topRatedResponse['data'] as $anime):
                $node = $anime['node']; ?>
                <div class="anime-item" data-id="<?php echo htmlspecialchars($node['id']); ?>">
                    <img src="<?php echo htmlspecialchars($node['main_picture']['medium']); ?>"
                         alt="<?php echo htmlspecialchars($node['title']); ?>"
                         class="anime-image">
                    <h3><?php echo htmlspecialchars($node['title']); ?></h3>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Right arrow -->
        <button class="arrow right-arrow" aria-label="Next">
            &#10095;
        </button>
    </div>
</div>

<!-- Anime for Current Season Section -->
<div class="anime-season">
    <h2> <a href="/anime/seasonal"> Anime for this <?php echo htmlspecialchars($currentSeason); ?> (<?php echo htmlspecialchars($currentYear); ?>)</a> </h2>
    <div class="carousel-container">
        <!-- Left arrow -->
        <button class="arrow left-arrow" aria-label="Previous">
            &#10094;
        </button>

        <!-- Carousel -->
        <div class="carousel">
            <?php foreach ($seasonResponse['data'] as $anime):
                $node = $anime['node']; ?>
                <div class="anime-item" data-id="<?php echo htmlspecialchars($node['id']); ?>">
                    <img src="<?php echo htmlspecialchars($node['main_picture']['medium']); ?>"
                         alt="<?php echo htmlspecialchars($node['title']); ?>"
                         class="anime-image">
                    <h3><?php echo htmlspecialchars($node['title']); ?></h3>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Right arrow -->
        <button class="arrow right-arrow" aria-label="Next">
            &#10095;
        </button>
    </div>
</div>

<!-- Link to JavaScript -->
<script src="/assets/scripts/getid.js"></script>
<script src="/assets/scripts/home.js"></script>
</body>
</html>
