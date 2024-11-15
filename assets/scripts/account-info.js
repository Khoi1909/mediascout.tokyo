// Lắng nghe sự kiện thay đổi khi người dùng chọn ảnh
document.getElementById("avatar").addEventListener("change", function(event) {
    var file = event.target.files[0];
    
    // Kiểm tra nếu người dùng đã chọn một tệp
    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var avatarImg = document.getElementById("avatar-img");
            var avatarPreview = document.getElementById("avatar-preview");

            // Cập nhật ảnh đại diện và hiển thị khung ảnh tròn
            avatarImg.src = e.target.result;
            avatarPreview.style.display = "block";
        };

        reader.readAsDataURL(file);
    }
});

// Để di chuột vào vị trí chọn ảnh (cắt ảnh), bạn có thể thêm một sự kiện sau khi ảnh được tải lên
// Ví dụ: thêm một sự kiện khi người dùng kéo và thay đổi vị trí ảnh, hoặc sử dụng thư viện như Cropper.js
