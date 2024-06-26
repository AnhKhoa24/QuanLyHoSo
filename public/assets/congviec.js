var isRunning = true;
function checkCV(maCV) {
    if (isRunning) {
        isRunning = false;
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
            url: "/congviec/changestt",
            type: 'POST',
            dataType: "json",
            data: {
                ma_cong_viec: maCV,
            },
            success: function (response) {
                swal.close();
                swal({
                    title: "Thành công!",
                    text: "Đã thay đổi thành công trạng thái công việc",
                    icon: "success"
                });
            },
            error: function () {
                swal.close();
                swal({
                    title: "Lỗi",
                    text: "Máy chủ đang gặp lỗi, vui lòng thực hiện lại sau!",
                    icon: "error",
                })
            }
        });
        setTimeout(function () {
            isRunning = true;
        }, 1000);
    }
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
        url: '/congviec?page=' + page,
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
function congviec_search() {
    var search = document.querySelector('#congviec-search').value;
    $.ajax({
        url: '/congviec',
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
function reloadCV() {
    var tht = laysotrang();
    getData(tht);
}