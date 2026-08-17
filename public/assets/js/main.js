AOS.init();
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
        var url = $(this).attr("action");
        var form_data = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: form_data,
            dataType : 'JSON',
            success: function (data) {
                if(data.type=='success'){
                    Swal.fire({
                        text: "Bạn đã gửi liên hệ thành công.",
                        confirmButtonText: 'Đồng ý'
                    });
                    $('input[name="fullname"]').val('');
                    $('input[name="email"]').val('');
                    $('textarea[name="content"]').val('');
                }
                else {
                    Swal.fire({
                        text: "Lỗi hệ thống. Vui lòng thông báo quản trị.",
                        icon: 'error',
                        confirmButtonText: 'Đồng ý'
                    });
                }
            },
            error:function(xhr, textStatus, thrownError, data)
            {
                console.log("Error: " + thrownError);
                console.log("Error: " + textStatus);
            }
        });

    });
});