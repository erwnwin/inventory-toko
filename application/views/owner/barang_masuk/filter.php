<?php if ($stock) : ?>


    <div class="table-responsive">
        <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> -->

        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Barcode</th>
                    <th>Nama Produk</th>
                    <th>Detail</th>
                    <th>Qty</th>
                    <th>Tanggal</th>
                    <th style="width: 130px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($stock as $item) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $item->barcode ?></td>
                        <td><?= $item->nama_item ?></td>
                        <td><?= $item->detail ?></td>
                        <td><?= $item->qty ?></td>
                        <td><?= tanggal_indonesia_lengkap($item->date) ?></td>
                        <td>

                            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#confirmDeleteModal"> Detail</button>
                            <form action="<?= base_url('barang-masuk/delete') ?>" method="post" class="d-inline delete-form">
                                <input type="hidden" name="id_stock" value="<?= $item->id_stock; ?>">
                                <input type="hidden" name="id_item" value="<?= $item->id_item; ?>">
                                <button class="btn btn-outline-danger btn-sm tombol-delete" type="button" data-id="<?= $item->id_stock ?>">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>

        <!-- <script>
            $(document).ready(function() {
                // Handle click on delete button
                $('.delete-form .tombol-delete').click(function() {
                    var id_stock = $(this).attr('data-id');

                    // Show Sweet Alert confirmation dialog
                    Swal.fire({
                        title: "Konfirmasi",
                        text: "Ingin menghapus data ini?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, Hapus",
                        cancelButtonText: "Tidak",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If user confirms deletion, proceed with AJAX delete request
                            $.ajax({
                                type: 'POST',
                                url: '<?= base_url('barang-masuk/delete') ?>',
                                data: {
                                    id_stock: id_stock
                                },
                                success: function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: 'Data Product Masuk berhasil dihapus'
                                        }).then((result) => {
                                            location.reload();
                                        });
                                    } else {
                                        // Show error message using SweetAlert
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'Data Product Masuk gagal dihapus'
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    // Optionally show an error message
                                    Swal.fire({
                                        title: "Error",
                                        text: "Gagal menghapus data.",
                                        icon: "error",
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script> -->
        <script>
            $(document).ready(function() {
                // Handle click on delete button
                $('.delete-form .tombol-delete').click(function() {
                    var id_stock = $(this).attr('data-id');

                    // Show Sweet Alert confirmation dialog
                    Swal.fire({
                        title: "Konfirmasi",
                        text: "Ingin menghapus data ini?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, Hapus",
                        cancelButtonText: "Tidak",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If user confirms deletion, proceed with AJAX delete request
                            $.ajax({
                                type: 'POST',
                                url: '<?= base_url('barang-masuk/delete') ?>',
                                data: {
                                    id_stock: id_stock
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status == 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: 'berhasil'
                                        }).then((result) => {
                                            location.reload(); // Reload page after successful deletion and update
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'gagal'
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    Swal.fire({
                                        title: "Error",
                                        text: "Gagal menghapus data.",
                                        icon: "error",
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>

    </div>

<?php else : ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Barcode</th>
                    <th>Nama Produk</th>
                    <th>Detail</th>
                    <th>Qty</th>
                    <th>Tanggal</th>
                    <th style="width: 130px">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data disini</td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<!-- <div id="loading" style="display: none;">
    <div class="overlay" id="loading" style="display: none;">
        <i class="fas fa-2x fa-sync fa-spin"></i>
    </div>
</div> -->