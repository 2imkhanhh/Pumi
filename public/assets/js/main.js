AOS.init({
    duration: 1000,
    easing: 'ease-out-cubic',
    once: true,
    offset: 100,
});
window.addEventListener("load", function () {
    // Ảnh tải xong làm thay đổi chiều cao trang → offset AOS tính lúc init
    // (trước khi ảnh load) có thể bị lệch. Tính lại một lần sau khi trang
    // load xong để các mốc trigger khớp đúng vị trí cuộn.
    AOS.refreshHard();
});
$(document).ready(function(){
    $(document).on("submit",".ajaxform", function (e){
        e.preventDefault();
    });

    $(document).on("submit","#frmContact", function (e){
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr("action");
        var form_data = $form.serialize();
        var $btn = $form.find('button[type="submit"]');
        var originalBtnText = $btn.text();

        // Show loading state
        $btn.prop('disabled', true).text('Đang gửi...');

        // Setup SweetAlert2 Toast
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            data: form_data,
            dataType : 'JSON',
            success: function (data) {
                if(data.type == 'success'){
                    Toast.fire({
                        icon: 'success',
                        title: data.message || "Bạn đã gửi liên hệ thành công."
                    });
                    // Reset the entire form
                    $form[0].reset();
                }
                else {
                    Toast.fire({
                        icon: 'error',
                        title: data.message || "Lỗi hệ thống. Vui lòng thông báo quản trị."
                    });
                }
            },
            error:function(xhr, textStatus, thrownError, data)
            {
                console.log("Error: " + thrownError);
                console.log("Error: " + textStatus);
                Toast.fire({
                    icon: 'error',
                    title: "Có lỗi xảy ra, vui lòng thử lại sau."
                });
            },
            complete: function() {
                // Restore button state
                $btn.prop('disabled', false).text(originalBtnText);
            }
        });
    });
});