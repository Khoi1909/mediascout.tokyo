<header>
    <div class="header-container">
        <!-- Left: Website Name -->
        <div class="logo">
            <a href="/home">MEDIASCOUT</a>
        </div>

        <!-- Right: Login or User Info -->
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

    <!-- Navigation Bar -->
    <nav class="navbar">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/anime/search">Anime Search</a></li>
            <li><a href="/anime/TopRated">Top Anime</a></li>
            <li class="search-container">
                <input 
                    type="text" 
                    id="search-input" 
                    placeholder="Input anime name..." 
                    class="search-bar" 
                    onkeypress="if(event.key === 'Enter') redirectToResult(event)">
            </li>
        </ul>
    </nav>
</header>
<script>
        function redirectToResult(event) {
        event.preventDefault(); // Ngăn chặn hành vi gửi form mặc định
        let query = document.getElementById('search-input').value.trim();

        // Thay thế các khoảng trắng bằng dấu gạch ngang
        query = query.replace(/\s+/g, '-');

        // Kiểm tra nếu có nội dung trong ô tìm kiếm
        if (query) {
            // Chuyển hướng đến URL mới
            window.location.href = `/anime/result/${encodeURIComponent(query)}`;
        }
    }
</script>