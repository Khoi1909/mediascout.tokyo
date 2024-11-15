<?php
// Database connection for MySQL
$host = "db.mediascout.tokyo";
$dbname = "mediascout"; // Change to your database name
$username = "mediascout"; // Change if necessary
$password = "media123scout"; // Change if necessary

try {
    // Establish connection with MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // Fetch user details from the database
        $user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session
        $stmt = $pdo->prepare("SELECT username, avatar FROM user WHERE id = :id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="/public/styles/header-footer.css">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="/home">
                <h1> MEDIASCOUT</h1>
            </a>
            <div class="menu"></div>
            <div class="menu-container">
                <!-- Display username and avatar only if the user is logged in -->
                <?php if (isset($user)): ?>
                    <div class="user-info">
                        <span id="username"><?php echo htmlspecialchars($user['username']); ?></span>
                        <?php if ($user['avatar']): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($user['avatar']); ?>" alt="Avatar" id="avatar">
                        <?php endif; ?>
                    </div>
                    <a href="logout.php" id="logoutOption">Đăng xuất</a>
                <?php else: ?>
                    <a href="/login" id="loginOption">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <script src="/assets/scripts/login-status.js"></script>
    <script src="/assets/scripts/menu.js"></script> <!-- Đảm bảo rằng bạn đã liên kết tệp JavaScript -->
</body>
</html>
