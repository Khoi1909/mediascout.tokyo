<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .anime-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .anime-container img {
            width: 100%;
            height: auto;
        }
        .anime-content {
            padding: 20px;
        }
        .anime-title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .anime-synopsis {
            margin-bottom: 20px;
        }
        .anime-genres {
            list-style-type: none;
            padding: 0;
        }
        .anime-genres li {
            display: inline-block;
            background-color: #ddd;
            padding: 5px 10px;
            margin: 5px 2px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<?php
// Sample data as an associative array
$animeData = [
    "id" => 1,
    "title" => "Cowboy Bebop",
    "main_picture" => [
        "medium" => "https://cdn.myanimelist.net/images/anime/4/19644.jpg",
        "large" => "https://cdn.myanimelist.net/images/anime/4/19644l.jpg"
    ],
    "synopsis" => "Crime is timeless. By the year 2071, humanity has expanded across the galaxy, filling the surface of other planets with settlements like those on Earth. These new societies are plagued by murder, drug use, and theft, and intergalactic outlaws are hunted by a growing number of tough bounty hunters.\n\nSpike Spiegel and Jet Black pursue criminals throughout space to make a humble living. Beneath his goofy and aloof demeanor, Spike is haunted by the weight of his violent past...",
    "genres" => [
        ["id" => 1, "name" => "Action"],
        ["id" => 50, "name" => "Adult Cast"],
        ["id" => 46, "name" => "Award Winning"],
        ["id" => 24, "name" => "Sci-Fi"],
        ["id" => 29, "name" => "Space"]
    ]
];
?>

<div class="anime-container">
    <img src="<?php echo $animeData['main_picture']['large']; ?>" alt="<?php echo $animeData['title']; ?>">
    <div class="anime-content">
        <h1 class="anime-title"><?php echo $animeData['title']; ?></h1>
        <p class="anime-synopsis"><?php echo nl2br($animeData['synopsis']); ?></p>
        <h3>Genres:</h3>
        <ul class="anime-genres">
            <?php foreach ($animeData['genres'] as $genre): ?>
                <li><?php echo $genre['name']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</body>
</html>
