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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url() ?>assets/dist/js/demo.js"></script> -->
<!-- Page specific script -->

<!-- ajax users -->
<script src="<?= base_url() ?>public/js/owner/user.js"></script>
<!-- <script src="<?= base_url() ?>public/js/owner/update-user.js"></script> -->

<!-- ajax kategori -->
<script src="<?= base_url() ?>public/js/owner/kategori.js"></script>

<!-- ajax unit -->
<script src="<?= base_url() ?>public/js/owner/units.js"></script>

<!-- ajax items -->
<script src="<?= base_url() ?>public/js/owner/items.js"></script>
<script src="<?= base_url() ?>public/js/owner/update-items.js"></script>
<script src="<?= base_url() ?>public/js/owner/info-update.js"></script>

<!-- ajax supplier -->
<script src="<?= base_url() ?>public/js/owner/supplier.js"></script>
<!-- <script src="<?= base_url() ?>public/js/owner/edit-supplier.js"></script> -->
<script src="<?= base_url() ?>public/js/owner/exportku.js"></script>
<script src="<?= base_url() ?>public/js/owner/filter-in-out.js"></script>
<script src="<?= base_url() ?>public/js/owner/stok-produk.js"></script>


<!-- ajax barang-masuk -->
<script src="<?= base_url() ?>public/js/owner/barang-masuk.js"></script>
<script src="<?= base_url() ?>public/js/owner/barang-keluar.js"></script>
<!-- <script src="<?= base_url() ?>public/js/owner/filter.js"></script> -->
<script src="<?= base_url() ?>public/js/owner/range-tgl.js"></script>
<script src="<?= base_url() ?>public/js/owner/range-out.js"></script>

<script src="<?= base_url() ?>public/js/sweetalert2@11.js"></script>
<script src="<?= base_url() ?>public/js/myscript.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,

            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesData = <?php echo json_encode($sales); ?>;
        var labels = salesData.map(function(item) {
            return item.nama_produk;
        });
        var totalPenjualan = salesData.map(function(item) {
            return item.total_penjualan;
        });
        var totalQty = salesData.map(function(item) {
            return item.total_qty;
        });

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Total Penjualan',
                        data: totalPenjualan,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'y-axis-1'
                    },
                    {
                        label: 'Total Quantity Terjual',
                        data: totalQty,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1,
                        yAxisID: 'y-axis-2'
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        // Define multiple y-axes
                        position: 'left'
                    },
                    'y-axis-1': {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Total Penjualan'
                        }
                    },
                    'y-axis-2': {
                        type: 'linear',
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Total Quantity Terjual'
                        },
                        // Grid lines settings
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('stockChart').getContext('2d');
        var statsData = <?php echo json_encode($stats); ?>;
        var labels = statsData.map(function(item) {
            return item.nama_produk;
        });
        var totalIn = statsData.map(function(item) {
            return item.total_in;
        });
        var totalOut = statsData.map(function(item) {
            return item.total_out;
        });

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Total Barang Masuk',
                        data: totalIn,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Barang Keluar',
                        data: totalOut,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

</body>

</html>