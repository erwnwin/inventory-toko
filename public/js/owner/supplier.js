$(document).ready(function() {
    // Validate input on keyup event
    $('#no_hp_wa').on('keyup', function() {
        var angka = $(this).val();
        
        // Remove non-numeric characters using regular expression
        var filteredAngka = angka.replace(/\D/g, '');
        
        // Update input field with filtered value
        $(this).val(filteredAngka);
        
        // Show error message if input is not numeric
        if (!(/^\d+$/.test(filteredAngka))) {
            $('#error').text('* Input harus berupa angka.');
        } else {
            $('#error').text('');
        }
    });

    $('#formSupplier').submit(function(e) {
        e.preventDefault(); 
    
        var formData = $(this).serialize();

        $('#btnSaveSupplier').prop('disabled', true).html('Simpan proses....');

        $.ajax({
            type: 'POST',
            url: 'supplier/store',
            data: formData,
            dataType: 'json',
            success: function(response) {
               
                if (response.status == 'success') {
                    $('#btnSaveSupplier').prop('disabled', false).html('Simpan');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then((result) => {
                        $('#modalCreateSupplier').modal('hide');
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