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
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<!-- Page specific script -->
<!-- <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
</script> -->
<script>
    $(document).ready(function() {
        calculate()
        loadItem()
    });

    $(document).on('click', '#select', function() {
        $('#item_id').val($(this).data('id'))
        $('#barcode').val($(this).data('barcode'))
        $('#price').val($(this).data('price'))
        $('#stock').val($(this).data('stock'))
        $('#modal-item').modal('hide')
    });

    function cek_qty(val) {
        if (val > $('#stock').val()) {
            alert('Stock tidak mencukupi');
            $('#item_id').val('');
            $('#barcode').val('');
            $('#barcode').focus();
            $('#qty').val(1);
        }
    }

    $(document).on('click', '#add_cart', function() {
        var item_id = $('#item_id').val();
        var price = $('#price').val();
        var stock = $('#stock').val();
        var qty = $('#qty').val();
        if (item_id == '') {
            alert('Product belum dipilih');
            $('#barcode').focus();
        } else if (parseInt(qty) > parseInt(stock)) {
            alert('Stock tidak mencukupi');
            $('#item_id').val('');
            $('#barcode').val('');
            $('#barcode').focus();
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('apps-kasir/process') ?>",
                data: {
                    'add_cart': true,
                    'item_id': item_id,
                    'price': price,
                    'qty': qty
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_tabel').load('<?= base_url('apps-kasir/cart-data'); ?>', function() {
                            calculate()
                        });
                        $('#item_id').val('');
                        $('#barcode').val('');
                        $('#qty').val(1);
                        $('#barcode').focus();
                        loadItem()
                    } else {
                        alert('Gagal tambah item cart');
                    }
                }
            });
        }
    })

    $(document).on('click', '#del_cart', function() {
        if (confirm('apakah anda yakin?')) {
            var cart_id = $(this).data('cartid');
            $.ajax({
                type: "POST",
                url: "<?= base_url('apps-kasir/cart-del') ?>",
                data: {
                    'cart_id': cart_id
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_tabel').load('<?= base_url('apps-kasir/cart-data'); ?>', function() {

                        });
                    } else {
                        alert('Gagal hapus item cart');
                    }
                }
            });

        }
    });

    $(document).on('click', '#process_payment', function() {
        var subtotal = $('#sub_total').val();
        var customer = $('#customer_id').val();
        var discount = $('#discount').val();
        var grandtotal = $('#grand_total').val();
        var cash = $('#cash').val();
        var change = $('#change').val();
        var note = $('#note').val();
        var date = $('#date').val();

        if (subtotal < 1) {
            alert('Product belum dipilih');
            $('#barcode').focus();
        } else if (cash < 1) {
            alert('Masukkan Uang Cash');
            $('#cash').focus();
        } else {
            if (confirm('Ingin memproses transaksi ini?')) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('apps-kasir/process') ?>",
                    data: {
                        'process_payment': true,
                        'customer_id': customer,
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
                        if (result.success == true) {
                            console.log('Print.......')

                            alert('Berhasil melakukan transaksi')
                            window.open('<?= base_url('apps-kasir/cetak/') ?>' + result.sale_id,
                                '_blank')
                            location.reload();
                        } else {
                            alert('gagal melakukan transaksi');
                        }
                    }
                });
            }
        }
    });

    $(document).on('click', '#cancel_payment', function() {
        if (confirm('Ingin membatalkan pesanan?')) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('apps-kasir/reset') ?>",
                data: {
                    'cancel_payment': true
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        console.log('terhapus')
                        $('#cart_tabel').load('<?= base_url('apps-kasir/cart-data'); ?>', function() {
                            calculate()
                        });
                    }
                }
            })
            $('#discount').val(0)
            $('#cash').val(0)
            $('#customer').val(0).change()
            $('#barcode').val('')
            $('#barcode').focus()

        }
    });

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