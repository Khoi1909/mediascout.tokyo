<?php include "src/models/getuser.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/public/styles/useredit.css">
</head>
<body>
<div class="edit-profile-container">
    <!-- Sidebar: Profile Picture -->
    <div class="profile-sidebar">
        <!-- Display current profile picture -->
        <img src="/public/images/pfp/<?php echo $profile_pic; ?>.png" alt="Profile Picture" class="profile-picture">
    </div>

    <!-- Main Content: Profile Editing Form -->
    <div class="profile-main-content">
        <form action="/profile/update" method="POST" class="edit-profile-form">
            <div>
                <label for="displayname">Display Name:</label>
                <input type="text" id="displayname" name="displayname" value="<?php echo htmlspecialchars($displayname); ?>" required>
            </div>
            <div>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male" <?php echo $gender === 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $gender === 'Female' ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo $gender === 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div>
                <label for="birthdate">Birth Date:</label>
                <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($birthDate); ?>" required>
            </div>
            <div>
                <label for="profile_pic">Profile Picture:</label>
                <select id="profile_pic" name="profile_pic" required>
                    <?php
                    // Predefined profile pictures (1 to 5)
                    $profilePictures = [1, 2, 3, 4, 5];
                    foreach ($profilePictures as $pic) {
                        $selected = $pic == $user['profile_pic'] ? 'selected' : '';
                        echo "<option value='$pic' $selected>Profile $pic</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="save-btn">Save</button>
        </form>
    </div>
</div>
</body>
</html>
