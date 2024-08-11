<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        Anything you want
    </div>
    Copyright &copy; 2024 <a href="#"> ~ Titik Balik Teknologi</a>
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

<!-- <script>
    $(document).ready(function() {
        // Initialize date and time fields
        $('#date').val(new Date().toISOString().split('T')[0]);
        $('#jam_penjualan').val(new Date().toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
        }));

        $('#nama_barang').on('change', function() {
            const namaProduk = $(this).val();
            if (namaProduk) {
                $.ajax({
                    url: 'apps-kasir/get-all-barang',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        nama_barang: namaProduk
                    },
                    success: function(data) {
                        if (data) {
                            $('#barcode').val(data.barcode);
                            $('#price').val(data.price);
                            $('#max_hidden').val(data.stock);
                            $('#jumlah').val(1).prop('readonly', false);
                            $('#sub_total').val((data.price * 1).toFixed(2));
                            $('#tambah').prop('disabled', false);
                        }
                    }
                });
            } else {
                resetForm();
            }
        });

        $('#jumlah').on('input', function() {
            const price = parseFloat($('#price').val());
            const jumlah = parseInt($(this).val());
            const subTotal = price * jumlah;
            $('#sub_total').val(subTotal.toFixed(2));
        });

        $('#tambah').on('click', function() {
            const namaProduk = $('#nama_barang').val();
            const price = parseFloat($('#price').val());
            const jumlah = parseInt($('#jumlah').val());
            const maxStock = parseInt($('#max_hidden').val());
            const subTotal = parseFloat($('#sub_total').val());

            if (jumlah > maxStock) {
                Swal.fire('Error', 'Stok tidak mencukupi.', 'error');
                return;
            }

            let productExists = false;

            $('#keranjang tbody tr').each(function() {
                const rowNamaProduk = $(this).find('.nama_barang').text().trim();
                if (rowNamaProduk === namaProduk) {
                    const currentJumlah = parseInt($(this).find('.jumlah').text().trim());
                    $(this).find('.jumlah').text(currentJumlah + jumlah);
                    $(this).find('input[name="jumlah_hidden[]"]').val(currentJumlah + jumlah);
                    $(this).find('.sub_total').text((price * (currentJumlah + jumlah)).toFixed(2));
                    $(this).find('input[name="sub_total_hidden[]"]').val((price * (currentJumlah + jumlah)).toFixed(2));
                    productExists = true;
                    return false; // Exit the each loop
                }
            });

            if (!productExists) {
                $('#keranjang tbody').append(`
                <tr class="row-keranjang">
                    <td class="nama_barang">${namaProduk}
                        <input type="hidden" name="nama_barang_hidden[]" value="${namaProduk}">
                    </td>
                    <td class="harga_barang">${price}
                        <input type="hidden" name="harga_barang_hidden[]" value="${price}">
                    </td>
                    <td class="jumlah">${jumlah}
                        <input type="hidden" name="jumlah_hidden[]" value="${jumlah}">
                    </td>
                    <td class="sub_total">${subTotal}
                        <input type="hidden" name="sub_total_hidden[]" value="${subTotal}">
                    </td>
                    <td class="aksi">
                        <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="${namaProduk}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
            }

            updateTotal();
            resetForm();
        });

        $(document).on('click', '#tombol-hapus', function() {
            $(this).closest('tr').remove();
            updateTotal();
        });

        $('input[name="cash"]').on('input', function() {
            const grandTotal = parseFloat($('#grand_total_display').val());
            const cash = parseFloat($(this).val());
            if (!isNaN(cash)) {
                $('#kembalian').val((cash - grandTotal).toFixed(2));
            }
        });

        $('#form-tambah').on('submit', function(e) {
            e.preventDefault();
            const grandTotal = parseFloat($('#grand_total_display').val());
            const cash = parseFloat($('input[name="cash"]').val());

            if ($('#keranjang tbody tr').length === 0) {
                Swal.fire('Error', 'Harap pilih barang terlebih dahulu.', 'error');
                return;
            }

            if (isNaN(cash) || cash <= 0) {
                Swal.fire('Warning', 'Harap isi jumlah uang tunai.', 'warning');
                return;
            }

            if (cash < grandTotal) {
                Swal.fire('Warning', 'Uang tunai tidak mencukupi. Harap cek kembali jumlah uang tunai Anda.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Pembayaran',
                text: `Total pembayaran adalah ${grandTotal.toFixed(2)}. Apakah Anda yakin?`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya, bayar',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm();
                }
            });
        });

        function submitForm() {
            updateDetailsHidden();
            $.ajax({
                url: 'apps-kasir/store',
                type: 'POST',
                data: $('#form-tambah').serialize(),
                dataType: 'json', // Ensure response is in JSON format
                success: function(response) {
                    Swal.fire(response.message, '', response.success ? 'success' : 'error');
                    if (response.success) {
                        location.reload();
                    }
                }
            });
        }

        function updateTotal() {
            let total = 0;
            $('#keranjang tbody tr').each(function() {
                const subTotal = parseFloat($(this).find('.sub_total').text());
                total += subTotal;
            });
            $('#total').text(total.toFixed(2));
            $('#grand_total_display').val(total.toFixed(2));
            $('#kembalian').val((parseFloat($('input[name="cash"]').val()) - total).toFixed(2));

            if (total > 0) {
                $('#form-tambah').find('button[type="submit"]').show();
            } else {
                $('#form-tambah').find('button[type="submit"]').hide();
            }
        }

        function updateDetailsHidden() {
            const details = [];
            $('#keranjang tbody tr').each(function() {
                details.push({
                    nama_barang: $(this).find('.nama_barang').text(),
                    harga_barang: $(this).find('.harga_barang').text(),
                    jumlah: $(this).find('.jumlah').text(),
                    sub_total: $(this).find('.sub_total').text()
                });
            });
            $('#details_hidden').val(JSON.stringify(details));
        }

        function resetForm() {
            $('#nama_barang').val('');
            $('#barcode').val('');
            $('#price').val('');
            $('#jumlah').val('');
            $('#sub_total').val('');
            $('#jumlah').prop('readonly', true);
            $('#tambah').prop('disabled', true);
        }
    });
</script> -->

</body>

</html>