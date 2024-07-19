$(document).ready(function() {
    $(document).on('click', '#select', function() {
        var id_item = $(this).data('id');
        var barcode = $(this).data('barcode');
        var name = $(this).data('name');
        var nama_unit = $(this).data('unit');
        var stock = $(this).data('stock');
        $('#id_item').val(id_item);
        $('#barcode').val(barcode);
        $('#nama_produk').val(name);
        $('#nama_unit').val(nama_unit);
        $('#stock').val(stock);
        $('#modal-item').modal('hide');
    });


    $('#createBarangKeluar').submit(function(e) {
        e.preventDefault(); 
    
        var formData = $(this).serialize();

        var barcode = $('#barcode').val().trim();
        var detail = $('#detail').val().trim();
        var qty = $('#qty').val().trim();

        // Check if fields are empty
        if (barcode === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: "<b>Kode Product</b> wajib diisi!</br>",  
                // text: '' + hh + 'Keterangan wajib diisi!<br> Qty wajib diisi!'
            });
            return;
        } else if (detail === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: "<b>Keterangan</b> wajib diisi!</br>",  
                // text: '' + hh + 'Keterangan wajib diisi!<br> Qty wajib diisi!'
            });
            return;
        } else if (qty === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: "<b>Qty</b> wajib diisi!",  
                // text: '' + hh + 'Keterangan wajib diisi!<br> Qty wajib diisi!'
            });
            return;
        }

        $('#btnSaveBarangKeluar').prop('disabled', true).html('Simpan proses....');

        $.ajax({
            type: 'POST',
            url: 'store', 
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    $('#btnSaveBarangKeluar').prop('disabled', false).html('Simpan');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then((result) => {
                        // $('#modalCreateKategori').modal('hide');
                        // location.reload();
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
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


    $('#year').on('keyup', function() {
        var angka = $(this).val();
        // var submitBtn = $('button[type="submit"]');
        // Remove non-numeric characters using regular expression
        var filteredAngka = angka.replace(/\D/g, '');
        
        // Update input field with filtered value
        $(this).val(filteredAngka);
        
        // Show error message if input is not numeric
        if (!(/^\d+$/.test(filteredAngka))) {
            $('#error').text('Harus berupa angka.');
            // submitBtn.prop('disabled', true);
        } else {
            $('#error').text('');
            // submitBtn.prop('disabled', false);
        }
    });


    $('#year').on('input', function() {
        var year = $(this).val();
        var min = parseInt($(this).attr('min'));
        var max = parseInt($(this).attr('max'));
        var submitBtn = $('button[type="submit"]');

        // Check if year is less than min
        if (year < min) {
            $('#amount_error').html('Minimal tahun ' + min);
            submitBtn.prop('disabled', true);
        } else if (year > max) {
            $('#amount_error').html('Maximal tahun ' + max);
            submitBtn.prop('disabled', true);
        } else {
            $('#amount_error').html('');
            submitBtn.prop('disabled', false);
        }
    });


    

    // hide n show
    // $(document).ready(function() {
    //     // Hide the input initially
    //     $('#formFilter').hide();

    //     // Function to toggle input visibility
    //     $('#btnFilter').click(function() {
    //         $('#formFilter').toggle();
    //     });
    // });

});