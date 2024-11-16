<?php
// Retrieve anime ID from the controller
$animeid = $data['animeid'] ?? null;

if (!$animeid) {
    die("<p>Error: Anime ID is missing.</p>");
}

// Fetch data from the API
$animeApiUrl = "https://data.mediascout.tokyo/anime/info?id=" . urlencode($animeid);
$animeJsonData = file_get_contents($animeApiUrl);

if (!$animeJsonData) {
    die("<p>Error: Unable to fetch data from the API.</p>");
}

$animeResponse = json_decode($animeJsonData, true);

if (!$animeResponse) {
    die("<p>Error: Invalid response from the API.</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($animeResponse['title'] ?? 'Anime Details') ?></title>
    <link rel="stylesheet" href="/public/styles/anime-details.css">
</head>
<body>
<div class="container">
    <header>
        <h1><?= htmlspecialchars($animeResponse['title'] ?? 'Unknown Title') ?></h1>
    </header>

    <main>
        <!-- Main picture and details -->
        <section class="anime-info">
            <img
                src="<?= htmlspecialchars($animeResponse['main_picture']['large'] ?? '') ?>"
                alt="<?= htmlspecialchars($animeResponse['title'] ?? 'Anime Image') ?>"
            />
            <div class="details">
                <p><strong>Title (EN):</strong> <?= htmlspecialchars($animeResponse['alternative_titles']['en'] ?? $animeResponse['title']) ?></p>
                <p><strong>Genres:</strong>
                    <?= isset($animeResponse['genres'])
                        ? implode(', ', array_column($animeResponse['genres'], 'name'))
                        : 'N/A' ?>
                </p>
                <p><strong>Start Date:</strong> <?= htmlspecialchars($animeResponse['start_date'] ?? 'Unknown') ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($animeResponse['status'] ?? 'Unknown') ?></p>
                <p><strong>Rating:</strong> <?= htmlspecialchars($animeResponse['rating'] ?? 'Not Rated') ?></p>
                <p><strong>Synopsis:</strong> <?= nl2br(htmlspecialchars($animeResponse['synopsis'] ?? 'No synopsis available.')) ?></p>
                <p><strong>Mean Score:</strong> <?= htmlspecialchars($animeResponse['mean'] ?? 'N/A') ?> / 10</p>
            </div>
        </section>

        <!-- Additional Pictures -->
        <?php if (!empty($animeResponse['pictures'])): ?>
            <section class="additional-pictures">
                <h2>Additional Pictures</h2>
                <div class="pictures">
                    <?php foreach ($animeResponse['pictures'] as $picture): ?>
                        <img
                            src="<?= htmlspecialchars($picture['large'] ?? '') ?>"
                            alt="Additional image"
                        />
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Related Anime -->
        <?php if (!empty($animeResponse['related_anime'])): ?>
            <section class="related-anime">
                <h2>Related Anime</h2>
                <div class="related-list">
                    <?php foreach ($animeResponse['related_anime'] as $related): ?>
                        <a href="/anime/info/<?= urlencode($related['node']['id']) ?>">
                            <img
                                src="<?= htmlspecialchars($related['node']['main_picture']['medium'] ?? '') ?>"
                                alt="<?= htmlspecialchars($related['node']['title'] ?? 'Related Anime') ?>"
                            />
                            <span><?= htmlspecialchars($related['node']['title'] ?? 'Unknown Title') ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </main>
</div>
</body>
</html>
