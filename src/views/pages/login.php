<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/public/styles/login.css">
    <link rel="icon" href="../../../public/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h2>Login to MediaScout</h2>
        <hr>
        <form method="POST" action="/login">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <label><input type="checkbox" id="showPassword"> Show Password</label>
            <button type="submit" class="login-button">Login</button>
        </form>
        <p><a href="/login/forgot_password" style="text-decoration: none; color: #4A90E2;">Forgot password?</a></p>
        <button class="signup-button" onclick="window.location.href='/register'">Sign Up</button>
    </div>
    
    <script src="/assets/scripts/login_signup.js"></script>
</body>
</html>
