<header>
    <div class="header-container">
        <div class="logo">
            <a href="/home">MEDIASCOUT</a>
        </div>
        <div class="user-info">
            <?php if (isset($_SESSION['logined_in']) && $_SESSION['logined_in'] === true): ?>
                <a href="/profile" class="user-logged-in">
                    <span class="username"><?php echo htmlspecialchars($_SESSION['displayname'] ?: $_SESSION['username']); ?></span>
                    <img src="/public/images/pfp/<?php echo htmlspecialchars($_SESSION['profile_pic']); ?>.png" alt="Profile Picture" class="header-profile-picture">
                </a>
            <?php else: ?>
                <a href="/login" class="login-btn">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <nav class="navbar">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/anime/search">Anime Search</a></li>
            <li><a href="/anime/TopRated">Top Anime</a></li>
            <li class="search-container">
                <input
                        type="text"
                        id="search-header-input"
                        placeholder="Input anime name..."
                        class="search-bar"
                        onkeypress="if(event.key === 'Enter') redirectSearchHeader(event)">
            </li>
        </ul>
    </nav>
</header>

<script>
    function redirectSearchHeader(event) {
        event.preventDefault(); // Prevent the default form submission
        let query = document.getElementById('search-header-input').value.trim();

        // Replace spaces with hyphens
        query = query.replace(/\s+/g, '-');

        if (query) {
            window.location.href = `/anime/result/${encodeURIComponent(query)}`;
        }
    }
</script>
