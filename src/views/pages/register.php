<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/public/styles/register.css">
    <link rel="icon" href="../../../public/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">      
        <h2>Start Using MediaScout</h2>
        <hr>
        <form method="POST" action="/register">
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
