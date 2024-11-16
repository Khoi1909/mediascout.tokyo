<?php include './src/models/getuser.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="/public/styles/userprofile.css">
</head>
<div class="profile-container">
    <div class="profile-card">
        <!-- Profile Picture -->
        <img src="/public/images/pfp/<?php echo htmlspecialchars($profile_pic); ?>.png" alt="Profile Picture" class="profile-picture">


        <!-- User Info -->
        <h1><?php echo htmlspecialchars($displayname); ?></h1>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
        <p><strong>Birthday:</strong> <?php echo htmlspecialchars($birthDate); ?></p>

        <!-- Edit Profile Button -->
        <form action="/profile/edit">
            <button type="submit" class="edit-profile-btn">Edit Profile</button>
        </form>
    </div>

    <!-- Logout Button -->
    <form method="POST" class="logout-form">
        <button type="submit" name="logout" class="logout-btn">Log Out</button>
    </form>
</div>

<?php
// Handle logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: /login");
    exit();
}
?>
