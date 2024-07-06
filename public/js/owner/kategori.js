$(document).ready(function() {
    // Submit form using Ajax
    $('#formKategori').submit(function(e) {
        e.preventDefault(); 
    
        var formData = $(this).serialize();

        $('#btnSaveKategori').prop('disabled', true).html('Simpan proses....');

        $.ajax({
            type: 'POST',
            url: 'kategori/store', 
            data: formData,
            dataType: 'json',
            success: function(response) {
               
                if (response.status == 'success') {
                    $('#btnSaveKategori').prop('disabled', false).html('Simpan');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then((result) => {
                        $('#modalCreateKategori').modal('hide');
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