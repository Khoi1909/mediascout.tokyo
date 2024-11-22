<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="/public/styles/forgot_password.css"> 
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <p>Please enter your username and email to receive your username and a new password.</p>
        <form method="POST"  action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <button type="submit" class="login-button">Request Password</button>
        </form>
        <p><a href="login" style="text-decoration: none; color: #4A90E2;">Back to Login</a></p>
    </div>
</body>
</html>
