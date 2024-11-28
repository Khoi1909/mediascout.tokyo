<?php
require_once "src/func/database.php";
$db = new database();
$conn = $db->conn; 

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
}  