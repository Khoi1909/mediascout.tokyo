document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");

    form.addEventListener("submit", function (event) {
        let valid = true;
        let errors = [];

        // Kiểm tra tên người dùng
        if (username.value.trim() === "") {
            errors.push("Username không được để trống.");
            valid = false;
        }

        // Kiểm tra định dạng email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value)) {
            errors.push("Email không hợp lệ.");
            valid = false;
        }

        // Kiểm tra độ mạnh của mật khẩu
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;
        if (!passwordPattern.test(password.value)) {
            errors.push("Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường và số.");
            valid = false;
        }

        // Kiểm tra mật khẩu nhập lại
        if (password.value !== confirmPassword.value) {
            errors.push("Mật khẩu không khớp.");
            valid = false;
        }

        // Hiển thị lỗi nếu có
        if (!valid) {
            event.preventDefault(); // Ngăn chặn form submit nếu có lỗi
            alert(errors.join("\n")); // Hiển thị lỗi dưới dạng cảnh báo
        }
    });
});
