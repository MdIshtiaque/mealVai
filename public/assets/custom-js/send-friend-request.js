$(document).on('click', '.add-friend', function() {
    var userId = $(this).data('user-id');
    var button = $(this);

    $.ajax({
        url: '/send-friend-request',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            user_id: userId,
        },
        success: function(data) {
            if(data.success) {
                button.html('<i class="fa fa-arrow-right"></i> Cancel');
                button.removeClass('add-friend').addClass('cancel-friend-request');
            }
        }
    });
});
