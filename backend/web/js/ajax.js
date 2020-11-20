$('.correctness-checkbox').click(function(){
    var data = $(this).val();
    var id = $(this).attr('data-id');

    $.ajax({
        url: '/admin/message/update?id=' + id,
        type: 'post',
        data: {correctness: data, _csrf: yii.getCsrfToken()},
        success: function () {
            location.reload();
        }
    });
});