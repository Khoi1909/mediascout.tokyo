// Hàm kiểm tra hợp lệ của email và mật khẩu
function validateLoginForm() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const messageDiv = document.getElementById("message");

    // Kiểm tra email có hợp lệ không
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(email)) {
        messageDiv.innerHTML = "<span class='error-message'>Vui lòng nhập địa chỉ email hợp lệ.</span>";
        return false;
    }

    // Kiểm tra mật khẩu có hợp lệ không (ví dụ, ít nhất 6 ký tự)
    if (password.length < 6) {
        messageDiv.innerHTML = "<span class='error-message'>Mật khẩu phải có ít nhất 6 ký tự.</span>";
        return false;
    }

    return true; // Nếu tất cả hợp lệ, cho phép form gửi
}

// Gắn sự kiện submit cho form
document.querySelector("form").addEventListener("submit", function(event) {
    if (!validateLoginForm()) {
        event.preventDefault(); // Ngừng gửi form nếu có lỗi
    }
});
