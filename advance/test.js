$(document).ready(function() {
    var inputField = $('#searchInput');
    var suggestionsContainer = $('#suggestionsContainer');

    inputField.on('input', function() {
        var keyword = $(this).val().trim();

        if (keyword.length >= 3) {
            // Fetch suggestions from the server
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: { keyword: keyword },
                success: function(response) {
                    suggestionsContainer.html(response).show();
                }
            });
        } else {
            suggestionsContainer.hide();
        }
    });

    // Handle suggestion click
    suggestionsContainer.on('click', '.suggestion', function() {
        inputField.val($(this).text());
        suggestionsContainer.hide();
    });

    // Hide suggestions on document click
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.search-container').length) {
            suggestionsContainer.hide();
        }
    });
});