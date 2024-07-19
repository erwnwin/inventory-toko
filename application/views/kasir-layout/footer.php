<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        Anything you want
    </div>
    Copyright &copy; 2024 <a href="https://winartcode.my.id"> ~ WinArt&code</a>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert -->
<script src="<?= base_url() ?>public/swal/sweetalert2.all.min.js"></script>
<script src="<?= base_url() ?>public/js/myscript.js"></script>


<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url() ?>assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->

<script>
    $(document).ready(function() {
        calculate()
        loadItem()
    });

    $(document).on('click', '#select', function() {
        $('#id_item').val($(this).data('id'))
        $('#barcode').val($(this).data('barcode'))
        $('#price').val($(this).data('price'))
        $('#stock').val($(this).data('stock'))
        $('#modal-item').modal('hide')
    });

    function cek_qty(val) {
        if (val > $('#stock').val()) {
            alert('Stock tidak mencukupi');
            $('#id_item').val('');
            $('#barcode').val('');
            $('#barcode').focus();
            $('#qty').val(1);
        }
    }

    $(document).on('click', '#add_cart', function() {
        var id_item = $('#id_item').val();
        var price = $('#price').val();
        var stock = $('#stock').val();
        var qty = $('#qty').val();
        if (id_item == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Kode Product wajib diisi!'
            }).then((result) => {
                $('#barcode').focus();
            });
        } else if (parseInt(qty) > parseInt(stock)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Stock tidak mencukupi!'
            }).then((result) => {
                $('#id_item').val('');
                $('#barcode').val('');
                $('#barcode').focus();
            });
            // alert('Stock tidak mencukupi');
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('apps-kasir/process') ?>",
                data: {
                    'add_cart': true,
                    'id_item': id_item,
                    'price': price,
                    'qty': qty
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_tabel').load('<?= base_url('apps-kasir/cart-data'); ?>', function() {
                            calculate()
                        });
                        $('#id_item').val('');
                        $('#barcode').val('');
                        $('#qty').val(1);
                        $('#barcode').focus();
                        loadItem()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gagal tambah item cart!'
                        });
                        // alert('Gagal tambah item cart');
                    }
                }
            });
        }
    })

    // $(document).on('click', '#del_cart', function() {
    //     if (confirm('apakah anda yakin?')) {
    //         var id_cart = $(this).data('cartid');
    //         $.ajax({
    //             type: "POST",
    //             url: "<?= base_url('apps-kasir/cart-del') ?>",
    //             data: {
    //                 'id_cart': id_cart
    //             },
    //             dataType: "json",
    //             success: function(result) {
    //                 if (result.success == true) {
    //                     $('#cart_tabel').load('<?= base_url('apps-kasir/cart-data'); ?>', function() {

    //                     });
    //                 } else {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Oops...',
    //                         text: 'Gagal hapus item cart!'
    //                     });
    //                     // alert('Gagal hapus item cart');
    //                 }
    //             }
    //         });

    //     }
    // });

    $(document).on('click', '#del_cart', function() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                var id_cart = $(this).data('cartid');
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('apps-kasir/cart-del') ?>",
                    data: {
                        'id_cart': id_cart
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.success == true) {
                            $('#cart_tabel').load('<?= base_url('apps-kasir/cart-data'); ?>', function() {
                                // Optional: You can add a SweetAlert for success here if needed
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Gagal hapus item cart!'
                            });
                            // alert('Gagal hapus item cart');
                        }
                    }
                });
            }
        });
    });


    $(document).on('click', '#process_payment', function() {
        var subtotal = $('#sub_total').val();
        var customer = $('#id_customer').val();
        var discount = $('#discount').val();
        var grandtotal = $('#grand_total').val();
        var cash = $('#cash').val();
        var change = $('#change').val();
        var note = $('#note').val();
        var date = $('#date').val();

        if (subtotal < 1) {
            // alert('Product belum dipilih');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Product belum dipilih!'
            }).then((result) => {
                $('#barcode').focus();
            });
        } else if (cash < 1) {
            // alert('Masukkan Uang Cash');
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Masukkan Uang Cash!'
            }).then((result) => {
                $('#cash').focus();
            });

        } else {
            // if (confirm(
            //         Swal.fire({
            //             title: "Konfirmasi",
            //             text: "Ingin menghapus data ini?",
            //             icon: "warning",
            //             showCancelButton: true,
            //             confirmButtonColor: "#3085d6",
            //             cancelButtonColor: "#d33",
            //             confirmButtonText: "Ya, Hapus",
            //             cancelButtonText: "Tidak",
            //         })
            //     )) {
            //     $.ajax({
            //         type: "POST",
            //         url: "<?= base_url('apps-kasir/process') ?>",
            //         data: {
            //             'process_payment': true,
            //             'id_customer': customer,
            //             'sub_total': subtotal,
            //             'discount': discount,
            //             'grand_total': grandtotal,
            //             'cash': cash,
            //             'change': change,
            //             'note': note,
            //             'date': date
            //         },
            //         dataType: "json",
            //         success: function(result) {
            //             if (result.success == true) {
            //                 console.log('Print.......')

            //                 alert('Berhasil melakukan transaksi')
            //                 window.open('<?= base_url('apps-kasir/print/') ?>' + result.id_sale,
            //                     '_blank')
            //                 location.reload();
            //             } else {
            //                 alert('gagal melakukan transaksi');
            //             }
            //         }
            //     });
            // }
            confirmAndProcessTransaction(customer, subtotal, discount, grandtotal, cash, change, note, date);
        }
    });

    function confirmAndProcessTransaction(customer, subtotal, discount, grandtotal, cash, change, note, date) {
        Swal.fire({
            title: "Konfirmasi",
            text: "Ingin melanjutkan transaksi?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('apps-kasir/process') ?>",
                    data: {
                        'process_payment': true,
                        'id_customer': customer,
                        'sub_total': subtotal,
                        'discount': discount,
                        'grand_total': grandtotal,
                        'cash': cash,
                        'change': change,
                        'note': note,
                        'date': date
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Berhasil melakukan transaksi',
                                icon: 'success',
                                allowOutsideClick: false,
                                showConfirmButton: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.open('<?= base_url('apps-kasir/print/') ?>' + result.id_sale, '_blank');
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal melakukan transaksi',
                                icon: 'error',
                                allowOutsideClick: false,
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat memproses transaksi',
                            icon: 'error',
                            allowOutsideClick: false,
                            showConfirmButton: true
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Dibatalkan',
                    text: 'Transaksi dibatalkan',
                    icon: 'info'
                });
            }
        });
    }

    $(document).on('click', '#cancel_payment', function() {
        // if (confirm('Ingin membatalkan pesanan?')) {
        //     $.ajax({
        //         type: "POST",
        //         url: "<?= base_url('apps-kasir/reset') ?>",
        //         data: {
        //             'cancel_payment': true
        //         },
        //         dataType: "json",
        //         success: function(result) {
        //             if (result.success == true) {
        //                 console.log('terhapus')
        //                 $('#cart_tabel').load('<?= base_url('apps-kasir/cart-data'); ?>', function() {
        //                     calculate()
        //                 });
        //             }
        //         }
        //     })
        //     $('#discount').val(0)
        //     $('#cash').val(0)
        //     $('#customer').val(0).change()
        //     $('#barcode').val('')
        //     $('#barcode').focus()

        // }
        confirmCancellation();
    });

    function confirmCancellation() {
        Swal.fire({
            title: "Konfirmasi",
            text: "Ingin membatalkan pesanan?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Batalkan",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                // User clicked "Ya, Batalkan"
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('apps-kasir/reset') ?>",
                    data: {
                        'cancel_payment': true
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.success) {
                            console.log('Pesanan dibatalkan');
                            // Reload cart data and recalculate
                            $('#cart_tabel').load('<?= base_url('apps-kasir/cart-data'); ?>', function() {
                                calculate();
                                // window.location.href = '<?= base_url() ?>';
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat membatalkan pesanan',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                        });
                    }
                });

                // Reset input fields
                $('#discount').val(0);
                $('#cash').val(0);
                $('#customer').val(0).change();
                $('#barcode').val('').focus();
            }
        });
    }


    function loadItem() {
        $.ajax({
            url: "<?= base_url('item/get_data') ?>",
            type: "GET",
            dataType: "json",
            success: function(result) {
                console.log(result)
                // var final = JSON.parse(result);
                $("#tblItem").html(result)
            }
        })
    }

    function calculate() {
        var subtotal = 0;
        $('#cart_tabel tr').each(function() {
            subtotal += parseInt($(this).find('#total').text(), 10)
        })
        isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

        var discount = $('#discount').val()
        var grand_total = subtotal - discount
        //console.log(subtotal);
        if (isNaN(grand_total)) {
            $('#grand_total').val(0)
            $('#grand_total2').text(0)
        } else {
            $('#grand_total').val(grand_total)
            $('#grand_total2').text(grand_total)
        }

        //hitung kembalian
        var cash = $('#cash').val();
        cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0);
    }

    $(document).on('keyup mouseup', '#discount, #cash', function() {
        calculate()
    })
</script>

<script>
    $(function() {

        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>