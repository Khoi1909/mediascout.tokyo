<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

require_once "src/func/database.php";
$db = new database();
$conn = $db->conn;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);

    // Kiểm tra email và username
    $query = "SELECT * FROM users WHERE email = '$email' AND username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Tạo mật khẩu mới
        $new_password = bin2hex(random_bytes(4)); // Mật khẩu 8 ký tự
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Cập nhật mật khẩu mới
        $update_query = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";
        if ($conn->query($update_query) === TRUE) {
            // Gửi email
            $mail = new PHPMailer(true);
            try {
                // Cấu hình SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // SMTP server (vd: smtp.gmail.com)
                $mail->SMTPAuth = true;
                $mail->Username = 'contact.mediascout@gmail.com'; // Email gửi đi
                $mail->Password = 'Media123scout'; // Mật khẩu ứng dụng
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Mã hóa TLS
                $mail->Port = 587; // Cổng SMTP (TLS thường là 587)

                // Cài đặt email
                $mail->setFrom('contact.mediascout@gmail.com', 'MediaScout');
                $mail->addAddress($email, $username); // Email người nhận

                // Nội dung email
                $mail->isHTML(true);
                $mail->Subject = 'Your New Password';
                $mail->Body = "Hello $username,<br><br>Your new password is: <strong>$new_password</strong><br>Please log in and change your password immediately.";
                $mail->AltBody = "Hello $username,\n\nYour new password is: $new_password\nPlease log in and change your password immediately.";

                $mail->send();
                echo "Your new password has been sent to your email.";
            } catch (Exception $e) {
                echo "Email could not be sent. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error updating the password.";
        }
    } else {
        echo "Invalid email or username.";
    }
}