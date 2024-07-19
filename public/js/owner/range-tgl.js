$(document).ready(function() {
    var base_url = '<?= base_url(); ?>'; // Define base URL
    
    // Function to fetch and display all data initially
    function fetchAllData() {
        // $('#loading').show();

        $.ajax({
            url: 'barang-masuk', // Adjust URL as per your controller method
            type: 'GET', // Assuming GET method to fetch all data
            dataType: 'json',
            success: function(data){
                $('#loading').hide();

                // Bersihkan tabel sebelum menambahkan data baru
                $('#filteredData').empty();
                
                if (data.length === 0) {
                    $('#filteredData').append('<tr><td colspan="7" class="text-center">Tidak ada data yang tersedia....</td></tr>');
                } else {
                    // Tambahkan data ke dalam tabel
                    $.each(data, function(index, item) {
                        var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + item.barcode + '</td>' +
                                '<td>' + item.nama_item + '</td>' +
                                '<td>' + item.detail + '</td>' +
                                '<td>' + item.qty + '</td>' +
                                '<td>' + item.date + '</td>' +
                                '<td>' +
                                    '<button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#confirmDeleteModal"> Detail</button>' +
                                    '<form action="barang-masuk/delete" method="post" class="d-inline">' +
                                        '<input type="hidden" name="id_stock" value="' + item.id_stock + '">' +
                                        '<input type="hidden" name="id_item" value="' + item.id_item + '">' +
                                        '<button class="btn btn-outline-danger btn-sm tombol-hapus" type="submit">Delete</button>' +
                                    '</form>' +
                                    '</td>' +
                                '</tr>';
                        $('#filteredData').append(row);
                    });
                }
            },
            // error: function(xhr, status, error) {
                // $('#loading').hide();
            //     alert('Terjadi kesalahan saat memuat data.');
            //     console.error(error);
            // }
        });
    }

    // Panggil fungsi untuk fetch dan display semua data saat dokumen siap
    fetchAllData();

    // Tangani submit form filter
    $('#filterForm').submit(function(e) {
        e.preventDefault(); // Mencegah form submit default
        
        // Ambil nilai tanggal mulai dan tanggal selesai dari form
        var tanggal_mulai = $('#tanggal_mulai').val();
        var tanggal_selesai = $('#tanggal_selesai').val();

        // var nama_produk = $('#nama_produk').val().trim();
        // var id_kategori = $('#id_kategori').val().trim();

        // Check if fields are empty
        if (tanggal_mulai === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tanggal mulai wajib diisi!'
            });
            return;
        } else if (tanggal_selesai === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tanggal selesai wajib diisi!'
            });
            return;
        }

        $('#loading').show();
        
        // Lakukan AJAX request ke method di controller untuk filter data
        $.ajax({
            url: 'filter/get', // Ganti sesuai dengan URL controller dan method di CodeIgniter
            type: 'POST',
            dataType: 'json',
            data: {
                tanggal_mulai: tanggal_mulai,
                tanggal_selesai: tanggal_selesai
            },
            success: function(data) {
                $('#loading').hide();

                // Bersihkan tabel sebelum menambahkan data baru
                $('#filteredData').empty();
                
                if (data.length === 0) {
                    $('#filteredData').append('<tr><td colspan="7" class="text-center">Tidak ada data yang tersedia....</td></tr>');
                } else {
                    // Tambahkan data hasil filter ke dalam tabel
                    $.each(data, function(index, item) {
                        var row = '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + item.barcode + '</td>' +
                                '<td>' + item.nama_item + '</td>' +
                                '<td>' + item.detail + '</td>' +
                                '<td>' + item.qty + '</td>' +
                                '<td>' + item.date + '</td>' +
                                '<td>' +
                                    '<button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#confirmDeleteModal"> Detail</button>' +
                                    '<form action="barang-masuk/delete" method="post" class="d-inline">' +
                                        '<input type="hidden" name="id_stock" value="' + item.id_stock + '">' +
                                        '<input type="hidden" name="id_item" value="' + item.id_item + '">' +
                                        '<button class="btn btn-outline-danger btn-sm tombol-hapus" type="submit">Delete</button>' +
                                    '</form>' +
                                    '</td>' +
                                '</tr>';
                        $('#filteredData').append(row);
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#loading').hide();

                alert('Terjadi kesalahan saat melakukan filter data.');
                console.error(error);
            }
        });
    });
});