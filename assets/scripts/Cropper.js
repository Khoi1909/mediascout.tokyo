var cropper;

document.getElementById("avatar").addEventListener("change", function(event) {
    var file = event.target.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var avatarImg = document.getElementById("avatar-img");
            var avatarPreview = document.getElementById("avatar-preview");

            // Cập nhật ảnh và hiển thị khung ảnh tròn
            avatarImg.src = e.target.result;
            avatarPreview.style.display = "block";

            // Khởi tạo cropper khi ảnh đã được tải lên
            if (cropper) {
                cropper.destroy(); // Hủy cropper cũ (nếu có)
            }

            cropper = new Cropper(avatarImg, {
                aspectRatio: 1,  // Tỷ lệ 1:1 cho ảnh vuông
                viewMode: 1,     // Giới hạn khu vực chọn trong ảnh
                autoCropArea: 0.8, // Diện tích vùng cắt mặc định
                movable: true,
                zoomable: true,
                rotatable: true,
                scalable: true
            });
        };

        reader.readAsDataURL(file);
    }
});

// Lưu lại ảnh cắt và các thông tin
document.getElementById("saveBtn").addEventListener("click", function() {
    if (cropper) {
        var canvas = cropper.getCroppedCanvas(); // Lấy ảnh đã cắt
        var croppedImage = canvas.toDataURL(); // Chuyển ảnh thành chuỗi base64

        // Có thể gửi ảnh cắt đến server hoặc lưu vào localStorage
        console.log(croppedImage); // Dùng trong mục đích phát triển

        // Nếu muốn gửi ảnh đến server
        // Bạn có thể gửi croppedImage qua AJAX hoặc fetch
    }
});
