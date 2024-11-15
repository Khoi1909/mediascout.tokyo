// Giả định người dùng đã đăng nhập
let isLoggedIn = true; // Đảm bảo chỉ khai báo một lần

// Hàm để hiển thị hoặc ẩn các mục menu
function updateMenu() {
    const loginOption = document.getElementById('loginOption');
    const logoutOption = document.getElementById('logoutOption');
    
    // Only try to update if these elements exist
    if (loginOption && logoutOption) {
        if (isLoggedIn) {
            loginOption.style.display = 'none'; // Hide login option
            logoutOption.style.display = 'block'; // Show logout option
        } else {
            loginOption.style.display = 'block'; // Show login option
            logoutOption.style.display = 'none'; // Hide logout option
        }
    } else {
        console.error("Menu options not found in the DOM");
    }
}


// Gọi hàm updateMenu khi tải trang
document.addEventListener('DOMContentLoaded', () => {
    updateMenu(); // Call updateMenu after DOM is fully loaded
});
