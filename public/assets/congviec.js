function checkCV(maCV, stt)
{
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
           ma_cong_viec:maCV,
           stt: stt,
        },
        success: function (response) {
            console.log(response)
        }
    });
}