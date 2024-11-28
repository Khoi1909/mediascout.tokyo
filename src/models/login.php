<?php
require_once "src/func/database.php";
$db = new database();
$conn = $db->conn; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stayLoggedIn = isset($_POST['stayLoggedIn']);
    
    //Xét các điều kiện
    if (empty($username) || empty($password)) {
        echo "<p class='error'> Please fill in all fields. </p>";
    } else {
        //Kiểm tra username trong csdl
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if ($password === $user['password']) {
                // Kiểm tra xem người dùng đã xác thực email chưa
                if ($user['is_verified'] == 0) {
                    echo "<p class='error'>Your account has not been verified yet. Please check your email to verify your account.</p>";
                } else {
                    // Nếu đã xác thực, tiến hành đăng nhập
                    $_SESSION['displayname'] = $user['displayname']?: $user['username'] ;
                    $_SESSION['profile_pic'] = $user['profile_pic'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['logined_in'] = true;

                // Xử lý "Stay logged in: ĐANG PHÁT TRIỂN THÊM "
//                if ($stayLoggedIn) {
//                    $token = bin2hex(random_bytes(16));
//                    setcookie("login_token", $token, time() + (86400 * 10), "/");
//
//                    // Lưu token vào cơ sở dữ liệu
//                    $sql = "UPDATE users SET login_token = ? WHERE username = ?";
//                    $updateStmt = $conn->prepare($sql);
//                    $updateStmt->bind_param("ss", $token, $username);
//                    $updateStmt->execute();
//                }

                    header("Location:/home");
                    exit;
                }
            } else {
                echo "<p class='error'>Incorrect username or password.</p>";
            }
        } else {
            echo "<p class='error'>Incorrect username or password.</p>";
        }
        $stmt->close();
    }
}

        
