function edit(ma_phong) {

    $.ajax({
        url: "/phongban/getpb",
        type: 'POST',
        dataType: "json",
        data: {
            ma_phong: ma_phong,
            "_token": csrf
        },
        success: function (data) {
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
        },
        error: function (xhr, status, error) {
            if (xhr.status === 401) {
                swal("Không đủ quyền!", "Tài khoản của bạn không có đủ quyền để thực hiện hành động này.", "error");
            } else {
                swal("Thêm thất bại!", "Lỗi server, thử lại sau!", "error");
            }
        }
    })
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
        },
        error: function (xhr, status, error) {
            if (xhr.status === 401) {
                swal("Không đủ quyền!", "Tài khoản của bạn không có đủ quyền để thực hiện hành động này.", "error");
            } else {
                swal("Thêm thất bại!", "Lỗi server, thử lại sau!", "error");
            }
        }
    })

}

function exit(ma_phong) {
    $.ajax({
        url: "/phongban/getpb",
        type: 'POST',
        dataType: "json",
        data: {
            ma_phong: ma_phong,
            "_token": csrf
        },
        success: function (data) {
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
        },
        error: function (xhr, status, error) {
            if (xhr.status === 401) {
                swal("Không đủ quyền!", "Tài khoản của bạn không có đủ quyền để thực hiện hành động này.", "error");
            } else {
                swal("Thêm thất bại!", "Lỗi server, thử lại sau!", "error");
            }
        }
    })
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


                swal({
                    title: "Đang xử lý...",
                    text: "Vui lòng đợi trong giây lát",
                    icon: "info",
                    buttons: false,
                    closeOnClickOutside: false,
                    allowOutsideClick: false,
                });

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
                        if (response == 0) {
                            var countTr = document.querySelectorAll('#phongban-tbody tr').length;
                            var ctrang = laysotrang();
                            countTr == 1 ? ctrang = ctrang - 1 : ctrang;
                            getData(ctrang);
                            swal.close();
                            swal("Xóa thành công", {
                                icon: "success",
                            });
                        } else {
                            swal.close();
                            swal("Xóa thất bại, còn tồn tại " + response + " nhân viên", {
                                icon: "warning",
                            });
                        }

                    }
                })

            }
        });
}

//PT
var searchdef = "";
$(window).on('hashchange', function () {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            getData(page);
        }
    }
});
//
$(document).ready(function () {
    $(document).on('click', '.pagination a', function (event) {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getData(page);
    });
});
function movePrevious() {
    var currentPage = document.querySelector('.pagination .page-item.active');
    var prevpage = currentPage.previousElementSibling;
    if (!prevpage || prevpage.classList.contains('prev')) {
        return;
    }
    currentPage.classList.remove('active');
    prevpage.classList.add('active');
    var page = prevpage.querySelector('.page-link').innerText;
    getData(page);
};
function moveNext() {
    var currentPage = document.querySelector('.pagination .page-item.active');
    var nextPage = currentPage.nextElementSibling;
    if (!nextPage || nextPage.classList.contains('next')) {
        return;
    }
    currentPage.classList.remove('active');
    nextPage.classList.add('active');
    var page = nextPage.querySelector('.page-link').innerText;
    getData(page);
}
function getData(page) {
    $.ajax({
        url: '/phongban?page=' + page,
        type: "get",
        datatype: "json",
        data:
        {
            search: searchdef
        }
    })
        .done(function (data) {

            $("#data-list").empty().html(data.datalist);
            $("#trang").empty().html(data.trang);
            location.hash = page;
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('Server gặp lỗi!');
        });
}
function phongban_search() {
    var search = document.querySelector('#congviec-search').value;
    $.ajax({
        url: '/phongban',
        type: "get",
        datatype: "json",
        data: {
            search: search
        }
    })
        .done(function (data) {
            searchdef = search;
            $("#data-list").empty().html(data.datalist);
            $("#trang").empty().html(data.trang);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
}
function laysotrang() {
    var currentPage = document.querySelector('.pagination .page-item.active');
    if (!currentPage) {
        return null;
    }
    var link = currentPage.querySelector('.page-link');
    if (!link) {
        return null;
    }
    var pageNumber = link.innerText;
    return parseInt(pageNumber);
}
function reloadPB() {
    var tht = laysotrang();
    getData(tht);
}

// Hàm hiển thị SweetAlert với 2 ô input
function themphongban() {
    swal({
        title: "Nhập thông tin",
        content: {
            element: "div",
            attributes: {
                innerHTML:
                    '<input id="input1" class="swal2-input" placeholder="Tên phòng ban"> </br>' +
                    '<input id="input2" class="swal2-input" placeholder="Mô tả">',
            },
        },
        buttons: {
            cancel: "Thoát",
            confirm: {
                text: "Thêm",
                value: true,
            },
        },
    }).then((value) => {
        if (value) {
            const input1Value = document.getElementById('input1').value;
            const input2Value = document.getElementById('input2').value;
            if (input1Value == "" || input2Value == "") {
                swal("Thiếu thông tin!", "Bạn đã nhập thiếu thông tin!", "info");
                return;
            };
            swal({
                title: "Đang xử lý...",
                text: "Vui lòng đợi trong giây lát",
                icon: "info",
                buttons: false,
                closeOnClickOutside: false,
                allowOutsideClick: false,
            });
            $.ajax({
                url: '/phongban/create',
                type: "POST",
                datatype: "json",
                data:
                {
                    ten_phong_ban: input1Value,
                    mo_ta: input2Value,
                    "_token": csrf
                },
                success: function (response) {
                    getData(laysotrang());
                    swal.close();
                    swal("Thêm thành công!", "Bạn đã thêm thành công!", "success");
                },
                error: function (xhr, status, error) {
                    if (xhr.status === 401) {
                        swal("Không đủ quyền!", "Tài khoản của bạn không có đủ quyền để thực hiện hành động này.", "error");
                    } else {
                        swal("Thêm thất bại!", "Lỗi server, thử lại sau!", "error");
                    }
                }
            })

        }
    });

}

