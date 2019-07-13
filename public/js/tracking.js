$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.track_number_button').on('click', function () {
        var url = $(this).parent().attr('action');
        var container = $('#track-result');
        var number = $(this).prev().find('input[type="text"]').val();
        $.ajax({
            url: url,
            type: "POST",
            data: {
                number:number
            },
            success:function (data) {
                console.log(data);
                var elementResult = '<div>'+ data + '</div>'
            }
        })
    });
});