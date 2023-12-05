$(document).ready(function () {
    $('#search').on('keyup', function () {
        var query = $(this).val();
        if (query.trim() === '') {
            // Clear the search results if the query is empty
            $('#search-results').html('');
            return;
        }
        $.ajax({
            url: '/search', // Your Laravel route
            method: 'GET',
            data: {query: query},
            success: function (data) {
                // Update the search results section with the data received from the server
                $('#search-results').html(data);
            }
        });
    });
});
