<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Search Anime - MediaScout</title>
    <link rel="icon" href="../../../public/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/public/styles/search.css">
    <script>
        function redirectToResult(event) {
            event.preventDefault(); // Prevent the default form submission
            let query = document.getElementById('search-input').value.trim();

            // Replace spaces with hyphens
            query = query.replace(/\s+/g, '-');

            if (query) {
                window.location.href = `/anime/result/${encodeURIComponent(query)}`;
            }
        }
    </script>
</head>
<body>
<div class="search-page">
    <div class="search-container">
        <form onsubmit="redirectToResult(event)">
            <input type="text" id="search-input" name="query" placeholder="Search for an anime..." required>
            <button type="submit">Search</button>
        </form>
    </div>
</div>
</body>
</html>
