<?php
require_once "src/func/database.php";

$db = new database();
$conn = $db->conn;

// Fetch current user data
$sql = "SELECT displayname, username, email, gender, Birth_date, profile_pic FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found.");
}
// Set default values for the form
$displayname = $user['displayname'] ?: $user['username'];
$username = $user['username'];
$gender = $user['gender'] ?: 'NOT SET';
$birthDate = $user['Birth_date'] ?: 'NOT SET';
$email = $user['email'] ?: 'NOT SET';
$profile_pic = $user['profile_pic'] ?: '1';