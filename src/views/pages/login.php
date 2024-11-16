<?php 

$server = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Xử lý đăng nhập 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stayLoggedIn = isset($_POST['stayLoggedIn']);
    
    //Xét các điều kiện
    if (empty($username) || empty($password)) {
        echo "<p class='error'> Please fill in all fields. </p>";
    } else {
        //Kiểm tra username trong csdl
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if ($password === $user['password']) {  
                $_SESSION['username'] = $user['username'];
                $_SESSION['logined_in'] = true;

                // Xử lý "Stay logged in?"
                if ($stayLoggedIn) {
                    $token = bin2hex(random_bytes(16));
                    setcookie("login_token", $token, time() + (86400 * 10), "/"); 

                    // Lưu token vào cơ sở dữ liệu
                    $sql = "UPDATE users SET login_token = ? WHERE username = ?";
                    $updateStmt = $conn->prepare($sql);
                    $updateStmt->bind_param("ss", $token, $username);
                    $updateStmt->execute();
                }

                header("Location:/home");
                exit;
            } else {
                echo "<p class='error'>Incorrect username or password.</p>";
            }
        } else {
            echo "<p class='error'>Incorrect username or password.</p>";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/public/styles/login_signup.css">
</head>
<body>
    <div class="container">
        <h2>Login with</h2>
        <button class="google-button" onclick="window.location.href='https://accounts.google.com/o/oauth2/v2/auth?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&response_type=token&scope=email profile'">Google</button>
        <hr>
        <p>Or</p>
        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <label><input type="checkbox" id="showPassword"> Show Password</label>
            
            <label><input type="checkbox" id="stayLoggedIn" name="stayLoggedIn"> Stay logged in?</label>
            
            <button type="submit" class="login-button">Login</button>
        </form>
        <p><a href="/login/forgot_password" style="text-decoration: none; color: #4A90E2;">Forgot password?</a></p>
        <button class="signup-button" onclick="window.location.href='register'">Sign Up</button>
    </div>
    
    <script src="/assets/scripts/login_signup.js"></script>
</body>
</html>
