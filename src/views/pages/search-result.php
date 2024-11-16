<?php
// Retrieve query and page from $data (provided by the controller)
$query = $data['animeName'];
$page = $data['page'] ?? 1;

// Ensure page is not less than 1
$page = max(1, (int)$page);
$limit = 20;
$offset = ($page - 1) * $limit;

// Fetch data from the API
$animeApiUrl = "https://data.mediascout.tokyo/anime/search?q=".urlencode($query) ."&limit=$limit&offset=$offset";
$searchJsonData = file_get_contents($animeApiUrl);

if (!$searchJsonData) {
    die("<p>Error: Unable to fetch data from the API.</p>");
}

$searchResponse = json_decode($searchJsonData, true);

if (!$searchResponse) {
    die("<p>Error: Invalid response from the API.</p>");
}

// Extract results
$animeResults = $searchResponse['data'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for "<?= htmlspecialchars($query) ?>"</title>
    <link rel="stylesheet" href="/public/styles/anime-search.css">
</head>
<body>
<div class="search-results-container">
    <!-- Main Search Title -->
    <h1 class="search-results-title">Search Results for "<?= htmlspecialchars($query) ?>"</h1>

    <main class="search-main">
        <!-- Search Results Section -->
        <section class="search-results">
            <?php if (!empty($animeResults)): ?>
                <div class="anime-list">
                    <?php foreach ($animeResults as $animeData): ?>
                        <div class="anime-item">
                            <?php
                            $anime = $animeData['node']; // Get 'node' data
                            $animeId = $anime['id'];
                            $animeTitle = $anime['title'];
                            $animeImage = $anime['main_picture']['medium'] ?? '/public/images/default-anime.png';
                            ?>
                            <a href="/anime/info/<?= urlencode($animeId) ?>" class="anime-link">
                                <img
                                    src="<?= htmlspecialchars($animeImage) ?>"
                                    alt="<?= htmlspecialchars($animeTitle) ?>"
                                    class="anime-image">
                                <h3 class="anime-title"><?= htmlspecialchars($animeTitle) ?></h3>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="no-results-message">No results found for your query.</p>
            <?php endif; ?>
        </section>

        <!-- Pagination Section -->
        <section class="pagination">
            <?php if ($page > 1): ?>
                <a href="/anime/result/<?= urlencode($query) ?>/<?= $page - 1 ?>" class="pagination-button prev-page">Previous</a>
            <?php endif; ?>
            <a href="/anime/result/<?= urlencode($query) ?>/<?= $page + 1 ?>" class="pagination-button next-page">Next</a>
        </section>
    </main>
</div>
</body>
</html>
