<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';

    //Kiểm tra các điều kiện
    if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        echo "<p class='error'>Please fill in all fields.</p>";    
    } elseif (strlen($password) < 8 || strlen($password) > 20) {
        echo "<p class='error'>Password must be between 8 and 20 characters.</p>";
    } elseif ($password !== $confirm_password) {
        echo "<p class='error'>Passwords do not match.</p>";
    } else {
        //Kiểm tra tên người dùng có trùng không
        $checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($checkUsernameQuery);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            echo "<p class='error'>Username is already taken. Please choose a different one.</p>";
        } else {
            $hashed_password = $password;

            $created_date = date('Y-m-d');
        
            $insertQuery = "INSERT INTO users (email, username, password, created_date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("ssss", $email, $username, $hashed_password, $created_date);
        
            if ($stmt->execute()) {
                echo "<p class='success'>Successfully.</p>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/public/styles/login_signup.css">
</head>
<body>
    <div class="container">
        <h2>Start Using MediaScout</h2>
        <hr>
        <h2>Sign Up With</h2>
        <button class="google-button" onclick="window.location.href='https://accounts.google.com/o/oauth2/v2/auth?client_id=YOUR_CLIENT_ID&redirect_uri=YOUR_REDIRECT_URI&response_type=token&scope=email profile'">Google</button>
        <hr>
        <p>Or</p>
        <form method="POST" action="">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password">

            <label><input type="checkbox" id="showPassword"> Show Password</label>
            
            <button type="submit" name="submit" class="create-account-button">Create Account</button>
        </form>
        <p>Already have an account? <a href="/login">Login</a></p>
    </div>

    <script src="/assets/scripts/login_signup.js"></script>
</body>
</html>
