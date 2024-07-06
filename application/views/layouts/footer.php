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

<!-- ajax supplier -->
<script src="<?= base_url() ?>public/js/owner/supplier.js"></script>

<!-- ajax barang-masuk -->
<script src="<?= base_url() ?>public/js/owner/barang-masuk.js"></script>

<script src="<?= base_url() ?>public/js/sweetalert2@11.js"></script>

<script>
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
</script>




</body>

</html>