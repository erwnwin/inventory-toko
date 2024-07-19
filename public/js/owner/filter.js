$(document).ready(function() {
    $('#filterForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'barang-masuk/filter',
            data: formData,
            success: function(response) {
                $('#filteredData').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

  
});