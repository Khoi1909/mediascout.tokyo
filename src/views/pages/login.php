<!DOCTYPE html>
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
        <form>
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <label><input type="checkbox" id="showPassword"> Show Password</label>
            
            <label><input type="checkbox" id="stayLoggedIn"> Stay logged in?</label>
            
            <button type="submit" class="login-button">Login</button>
        </form>
        <p><a href="../../../index.php" style="text-decoration: none; color: #4A90E2;">Forgot password?</a></p>
        <button class="signup-button" onclick="window.location.href='register'">Sign Up</button>
    </div>
    
    <script src="/assets/scripts/login_signup.js"></script>
</body>
</html>
