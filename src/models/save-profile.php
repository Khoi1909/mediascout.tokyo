<?php
// Start the session if not already started
require_once 'src/func/database.php'; // Assuming your database connection class is in Database.php
$db = new Database();
$conn = $db->conn;
// Ensure the user is logged in
if (!isset($_SESSION['logined_in']) || $_SESSION['logined_in'] !== true) {
    header("Location: /login");
    exit;
}

// Fetch the form data safely
$displayname = htmlspecialchars($_POST['displayname']);
$gender = htmlspecialchars($_POST['gender']);
$birthdate = htmlspecialchars($_POST['birthdate']);
$profilePic = htmlspecialchars($_POST['profile_pic']);

// Check if all required fields are provided
if (empty($displayname) || empty($gender) || empty($birthdate) || empty($profilePic)) {
    die("Error: All fields are required.");
}

// Update the database


// Prepare the update query
$sql = "UPDATE users SET displayname = ?, gender = ?, Birth_date = ?, profile_pic = ? WHERE username = ?";
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param('sssss', $displayname, $gender, $birthdate, $profilePic, $_SESSION['username']);

// Execute the query and check for success
if ($stmt->execute()) {
    // Redirect to the profile page after saving
    header("Location: /profile");
    exit;
} else {
    // Handle the error gracefully
    die("Error updating profile: " . $conn->error);
}

