$(document).ready(function() {
    // Submit form using Ajax
    $('#formUnits').submit(function(e) {
        e.preventDefault(); 
    
        var formData = $(this).serialize();

        $('#btnSaveUnits').prop('disabled', true).html('Simpan proses....');

        $.ajax({
            type: 'POST',
            url: 'units/store',
            data: formData,
            dataType: 'json',
            success: function(response) {
               
                if (response.status == 'success') {
                    $('#btnSaveUnits').prop('disabled', false).html('Simpan');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then((result) => {
                        $('#modalCreateUnits').modal('hide');
                        location.reload();
                    });
                } else {
                    // Show error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.message
                    });
                }
            }
        });
    });
});