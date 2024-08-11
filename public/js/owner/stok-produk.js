$(document).ready(function() {
    $('#produkSelect').change(function() {
        var productId = $(this).val();
        if (productId) {
            $.ajax({
                url: 'stok-produk/filter', // URL endpoint untuk mendapatkan data produk
                type: 'GET',
                data: { id: productId },
                dataType: 'json',
                success: function(response) {
                    var table = $('#produkTable');
                    table.empty(); // Kosongkan tabel sebelum diisi
                    if (response.data.length > 0) {
                        var headers = '<thead><tr><th>Attribute</th><th>Value</th></tr></thead>'; // Header tabel
                        var rows = '<tbody>';
                        $.each(response.data, function(index, item) {
                            rows += 
                                '<tr><td><b>Nama Produk</b></td><td>' + item.nama_produk + '</td></tr>' +
                                '<tr><td><b>Stock</b></td><td>' + item.stock + '</td></tr>' +
                                '<tr><td><b>Kategori</b></td><td>' + item.name_category + '</td></tr>' +
                                '<tr><td><b>Unit</b></td><td>' + item.name_unit + '</td></tr>';
                        });
                        rows += '</tbody>';
                        table.html(headers + rows);
                    } else {
                        table.html('<tbody><tr><td colspan="2">No data available</td></tr></tbody>'); // Pesan jika tidak ada data
                    }
                },
                error: function() {
                    alert('Error retrieving data.');
                }
            });
        } else {
            $('#produkTable').empty(); // Kosongkan tabel jika tidak ada produk yang dipilih
        }
    });

    $('#btnExportPDF22').on('click', function() {
        var productId = $('#produkSelect').val(); // Ambil ID produk yang dipilih
        if (!productId) {
            Swal.fire({
                title: 'Peringatan',
                text: 'Silakan pilih produk terlebih dahulu sebelum mengekspor.',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            return; // Hentikan eksekusi jika produk tidak dipilih
        }

        var form = $('#pilihProdukForm'); // Pastikan ID form sesuai
        var url = form.attr('action') + '/export-pdf';
        var exportUrl = url + '?id=' + encodeURIComponent(productId); // Sertakan ID produk dalam query string

        Swal.fire({
            title: 'Konfirmasi Ekspor',
            text: 'Apakah Anda yakin ingin mengekspor data ke PDF?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ekspor',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(exportUrl, '_blank');
            }
        });
    });

    $('#btnExportExcel22').on('click', function() {
        var productId = $('#produkSelect').val(); // Ambil ID produk yang dipilih
        if (!productId) {
            Swal.fire({
                title: 'Peringatan',
                text: 'Silakan pilih produk terlebih dahulu sebelum mengekspor.',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            return; // Hentikan eksekusi jika produk tidak dipilih
        }

        var form = $('#pilihProdukForm'); // Pastikan ID form sesuai
        var url = form.attr('action') + '/export-excel';
        var exportUrl = url + '?id=' + encodeURIComponent(productId); // Sertakan ID produk dalam query string

        Swal.fire({
            title: 'Konfirmasi Ekspor',
            text: 'Apakah Anda yakin ingin mengekspor data ke Excel?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ekspor',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open(exportUrl, '_blank');
            }
        });
    });
});