<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Search Anime - MediaScout</title>
    <link rel="icon" href="../../../public/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/public/styles/search.css">
</head>
<body>
<div class="search-page">
    <div class="search-container">
        <form onsubmit="redirectSearchPage(event)">
            <input type="text" id="search-page-input" name="query" placeholder="Search for an anime..." required>
            <button type="submit">Search</button>
        </form>
    </div>
</div>

<script>
    function redirectSearchPage(event) {
        event.preventDefault(); // Prevent the default form submission
        let query = document.getElementById('search-page-input').value.trim();

        // Replace spaces with hyphens
        query = query.replace(/\s+/g, '-');

        if (query) {
            window.location.href = `/anime/result/${encodeURIComponent(query)}`;
        }
    }
</script>

</body>
</html>
