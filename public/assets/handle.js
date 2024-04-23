function edit(ma_phong) {
    const dataToSend = {
        ma_phong: ma_phong
    };  
    fetch('http://qlyhoso.com/api/findpb', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataToSend)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {

            var trchange = document.getElementById(data.data.ma_phong);
            trchange.innerHTML = `<td>${data.data.ma_phong}</td>
        <td><input id="ten_phong_ban_${data.data.ma_phong}" value="${data.data.ten_phong_ban}" /></td>
        <td><input id="mo_ta_${data.data.ma_phong}" value="${data.data.mo_ta}" size="60" /></td>
        <td>${data.data.soluongnv}</td>
        <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button type="button" class="btn btn-success" onclick="saveForm(${data.data.ma_phong})">Lưu</button>
        <button type="button" class="btn btn-danger" onclick="exit(${data.data.ma_phong})">Thoát</button>
    </div>
        </td>
        `;

        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });

}

function saveForm(ma_phong) {
    var ipTenP = "ten_phong_ban_" + ma_phong;
    var ipMota = "mo_ta_" + ma_phong;
    var ten_phong_ban = document.getElementById(ipTenP).value;
    var mo_ta = document.getElementById(ipMota).value;
    var ma_phong_r = ma_phong;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/phongban/save",
        type: 'POST',
        dataType: "json",
        data: {
            ten_phong_ban: ten_phong_ban,
            mo_ta: mo_ta,
            ma_phong: ma_phong_r,
        },
        success: function (response) {

            var trchange = document.getElementById(response.ma_phong);
            trchange.innerHTML = ` <td>${response.ma_phong}</td>
            <td>${response.ten_phong_ban}</td>
            <td>${response.mo_ta}</td>
            <td>${response.soluongnv}</td>
            <td>
            <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="javascript:void(0)" onclick="edit(${response.ma_phong})"
                ><i class="bx bx-edit-alt me-1"></i> Edit</a
              >
              <a class="dropdown-item" href="javascript:void(0)" onclick="xoa(${response.ma_phong})"
                ><i class="bx bx-trash me-1"></i> Delete</a
              >
            </div>
          </div>
            </td>`;
        }
    })

}

function exit(ma_phong) {
    const dataToSend = {
        ma_phong: ma_phong
    };

    fetch('http://qlyhoso.com/api/findpb', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataToSend)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
                   }
            return response.json();
        })
        .then(data => {

            // console.log(data.data);

            var trchange = document.getElementById(ma_phong);
            trchange.innerHTML = ` <td>${ma_phong}</td>
        <td>${data.data.ten_phong_ban}</td>
        <td>${data.data.mo_ta}</td>
        <td>${data.data.soluongnv}</td>
        <td>
        <div class="dropdown">
        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
          <i class="bx bx-dots-vertical-rounded"></i>
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="javascript:void(0)" onclick="edit(${data.data.ma_phong})"
            ><i class="bx bx-edit-alt me-1"></i> Edit</a
          >
          <a class="dropdown-item" href="javascript:void(0)" onclick="xoa(${data.data.ma_phong})"
            ><i class="bx bx-trash me-1"></i> Delete</a
          >
        </div>
      </div>
        </td>
`;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });

}

function xoa(ma_phong) {
    swal({
        title: "Bạn có chắc không?",
        text: "Bạn có chắc muốn xóa phong ban này?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/phongban/xoa",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        ma_phong: ma_phong,
                    },
                    success: function (response) {  
                        if(response == 0)
                        {
                            var del = document.getElementById(ma_phong);
                            del.remove();
                            swal("Xóa thành công", {
                                icon: "success",
                            });
                        }else{
                            swal("Xóa thất bại, còn tồn tại "+response+" nhân viên", {
                                icon: "warning",
                            });
                        } 
                        
                    }
                })

            }
        });
}


