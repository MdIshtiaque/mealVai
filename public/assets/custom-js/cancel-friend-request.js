$(document).on('click', '.cancel-friend-request', function () {
    var userId = $(this).data('user-id');
    var button = $(this);

    $.ajax({
        url: '/cancel-friend-request',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            user_id: userId,
        },
        success: function (data) {
            if (data.success) {
                button.html('<i class="fa fa-user-plus"></i>Add');
                button.removeClass('cancel-friend-request').addClass('add-friend');
            }
        }
    });
});
