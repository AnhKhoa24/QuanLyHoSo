$(document).ready(function () {
    $('#upload').change(function () {
        var formData = new FormData();
        var inputValue = document.getElementById("idnv").value;
        formData.append('file', $(this)[0].files[0]);
        formData.append('ma_nhan_vien', inputValue);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/nhanvien/avtchange', // Đường dẫn tới controller Laravel
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);
                var img = document.getElementById('uploadedAvatar');
                img.src = "/uploads/"+response;
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                // Xử lý lỗi nếu có
            }
        });
    });
});


//Xử xác nhận submit
function confirmDelete(event) {
    event.preventDefault(); 
    
    swal({
        title: "Bạn có muốn xóa nhân viên này?",
        text: "Các công việc trên sẽ không còn giao cho nhân viên này!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            
            event.target.submit();
        } else {
            
            return false;
        }
    });
}
//Xử xác nhận submit hồ sơ
function deleteHoso(event) {
    event.preventDefault(); 
    
    swal({
        title: "Bạn có chắc muốn xóa hồ sơ này?",
        text: "Các công việc trên sẽ không còn nằm trong hồ sơ này!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            
            event.target.submit();
        } else {
            
            return false;
        }
    });
}
//Xử xác nhận submit hồ sơ
function deleteCv(event) {
    event.preventDefault(); 
    
    swal({
        title: "Bạn có chắc muốn xóa công việc này không?",
        text: "Các công việc thuộc hồ sơ và phân công nhân viên trên sẽ biến mất!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            
            event.target.submit();
        } else {
            
            return false;
        }
    });
}
