<header>
    <div class="header-container">
        <!-- Left: Website Name -->
        <div class="logo">
            <a href="/home">MEDIASCOUT</a>
        </div>

        <!-- Right: Login or User Info -->
        <div class="user-info">
            <?php if (isset($_SESSION['logined_in']) && $_SESSION['logined_in'] === true): ?>
                <!-- Display logged-in user's name and profile picture -->
                <a href="/profile" class="user-logged-in">
                    <span class="username"><?php echo htmlspecialchars($_SESSION['displayname']?:$_SESSION['username']); ?></span>
                    <img src="/public/images/pfp/<?php echo htmlspecialchars($_SESSION['profile_pic']);?>.png" alt="Profile Picture" class="header-profile-picture">
                </a>
            <?php else: ?>
                <!-- Show login button for guests -->
                <a href="/login" class="login-btn">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/anime/search">Anime Search</a></li>
            <li><a href="/anime/TopRated">Top Anime</a></li>
            <li class="search-container">
                <input type="text" placeholder="Input anime name..." class="search-bar">
            </li>
        </ul>
    </nav>
</header>
