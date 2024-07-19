$(document).ready(function() {
    // Function to preview image before upload
    $("#gambar").change(function(){
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreviewContainer').show();
                $('#removeImage').show(); // Show remove option
            }

            reader.readAsDataURL(input.files[0]);
        }
    });

    // Function to remove image preview
    $('#removeImage').click(function() {
        $('#gambar').val(''); // Clear input file
        $('#imagePreview').attr('src', '');
        $('#imagePreviewContainer').hide();
        $('#removeImage').hide(); // Hide remove option again
    });

     // Submit form using Ajax
     $('#createItemProducts').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        var gambar = $('#gambar').val().trim();
        // var barcode = $('#barcode').val().trim();
        var nama_produk = $('#nama_produk').val().trim();
        var id_kategori = $('#id_kategori').val().trim();
        var id_unit = $('#id_unit').val().trim();
        var price = $('#price').val().trim();

        // Check if fields are empty
        if (nama_produk === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nama Product wajib diisi!'
            });
            return;
        } else if (id_kategori === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kategori wajib diisi!'
            });
            return;
        } else if (id_unit === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Unit wajib diisi!'
            });
            return;
        } else if (price === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Harga wajib diisi!'
            });
            return;
        } else if (gambar === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gambar wajib diisi!'
            });
            return;
        } 

        $('#btnSaveItem').prop('disabled', true).html('Simpan proses....');

        // $(this).prop('disabled', true).html('Simpan proses....');

        $.ajax({
            url: 'store',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            // dataType: 'json',
            success: function(response) {
                var data = JSON.parse(response);
                // if (response.status == 'success') {
            // dataType: 'json',
            // success: function(response) {
            //     if (response.status == 'success') {
                if (data.status == 'success') {
                    $('#btnSaveItem').prop('disabled', false).html('Simpan');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                    }).then(function() {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    });
                } else {
                    $('#btnSaveItem').prop('disabled', false).html('Simpan');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something Error Here! Sorry',
                });
                console.error(xhr.responseText);
               
            }
        });
    });

    

});