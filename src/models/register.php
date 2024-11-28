<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

require_once "src/func/database.php";
$db = new database();
$conn = $db->conn;

// Xác định base URL cho cục bộ và server
$serverHost = $_SERVER['HTTP_HOST'];
$baseUrl = ($serverHost === 'localhost') ? 'http://localhost/register' : 'https://mediascout.tokyo/register';

// Hiển thị thông báo từ session (nếu có)
if (isset($_SESSION['status']) && isset($_SESSION['message'])) {
    $status = $_SESSION['status'];
    $message = $_SESSION['message'];

    if ($status === 'success') {
        echo "<p class='success'>$message</p>";
    } elseif ($status === 'error') {
        echo "<p class='error'>$message</p>";
    } elseif ($status === 'invalid_token') {
        echo "<p class='error'>$message</p>";
    } elseif ($status === 'no_token') {
        echo "<p class='error'>$message</p>";
    }

    // Sau khi hiển thị thông báo, xóa session để tránh bị lặp lại
    unset($_SESSION['status']);
    unset($_SESSION['message']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra là đăng ký hay xác thực
    if (isset($_POST['email'])) {
        // Đăng ký người dùng
        $email = $_POST['email'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm-password'] ?? '';

        // Kiểm tra các điều kiện
        if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
            echo "<p class='error'>Please fill in all fields.</p>";
        } elseif (strlen($password) < 8 || strlen($password) > 20) {
            echo "<p class='error'>Password must be between 8 and 20 characters.</p>";
        } elseif ($password !== $confirm_password) {
            echo "<p class='error'>Passwords do not match.</p>";
        } else {
            // Kiểm tra tên người dùng có trùng không
            $checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($checkUsernameQuery);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<p class='error'>Username is already taken. Please choose a different one.</p>";
            } else {
                $hashed_password = $password;
                $token = bin2hex(random_bytes(16)); // Tạo token ngẫu nhiên
                $created_date = date('Y-m-d');

                $insertQuery = "INSERT INTO users (email, username, password, token, is_verified, created_date) VALUES (?, ?, ?, ?, 0, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("sssss", $email, $username, $hashed_password, $token, $created_date);

                if ($stmt->execute()) {
                    // Gửi email xác thực
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'contact.mediascout@gmail.com';
                        $mail->Password = 'dwhkzybikaytvcxu';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('contact.mediascout@gmail.com', 'MediaScout');
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = 'Confirm Your Registration';
                        $mail->Body = "
                            <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 10px;'>
                                <h2 style='color: #333; text-align: center;'>Welcome to MediaScout, $username!</h2>
                                <p style='color: #555;'>Hi <strong>$username</strong>,</p>
                                <p style='color: #555;'>Thank you for registering on our website. Please click the button below to confirm your email and complete the registration process:</p>
                                <div style='text-align: center;'>
                                    <form action='$baseUrl' method='POST'>
                                        <input type='hidden' name='token' value='$token'>
                                        <button type='submit' style='background-color: #007BFF; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;'>Confirm Registration</button>
                                    </form>
                                </div>
                                <p style='color: #555;'>If you did not request this registration, please ignore this email.</p>
                                <hr style='margin: 20px 0;'>
                                <footer style='text-align: center; color: #999; font-size: 12px;'>
                                    <p>Thank you for choosing MediaScout!</p>
                                </footer>
                            </div>
                        ";
                        $mail->AltBody = "Please click the button below to confirm your registration.";

                        $mail->send();
                        echo "<p class='success'>Please check your email to confirm your registration.</p>";

                    } catch (Exception $e) {
                        echo "<p class='error'>Email could not be sent. Error: {$mail->ErrorInfo}</p>";
                    }
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        }
    } elseif (isset($_POST['token'])) {
        // Xác thực người dùng qua token
        $token = $_POST['token'] ?? '';

        if (!empty($token)) {
            // Kiểm tra token trong cơ sở dữ liệu
            $query = "SELECT * FROM users WHERE token = ? AND is_verified = 0";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Cập nhật trạng thái người dùng thành verified
                $updateQuery = "UPDATE users SET is_verified = 1 WHERE token = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("s", $token);
                if ($stmt->execute()) {
                    $_SESSION['status'] = 'success';
                    $_SESSION['message'] = 'Your account has been successfully verified!';
                    header("Location: $baseUrl"); // Quay lại trang đăng ký
                    exit;
                } else {
                    $_SESSION['status'] = 'error';
                    $_SESSION['message'] = 'An error occurred while verifying your account.';
                    header("Location: $baseUrl"); 
                    exit;
                }
            } else {
                $_SESSION['status'] = 'invalid_token';
                $_SESSION['message'] = 'Invalid or expired token. Please try again.';
                header("Location: $baseUrl"); 
                exit;
            }
        } else {
            $_SESSION['status'] = 'no_token';
            $_SESSION['message'] = 'No token provided. Please check your email again.';
            header("Location: $baseUrl"); 
            exit;
        }
    }
} 

