$(document).ready(function() {
    $('#btnExportPDF').on('click', function() {
        var form = $('#filterForm');
        var url = form.attr('action') + '/export-pdf';
        var queryString = form.serialize();
        var exportUrl = url + '?' + queryString;

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

    $('#btnExportExcel').on('click', function() {
        var form = $('#filterForm');
        var url = form.attr('action') + '/export-excel';
        var queryString = form.serialize();
        var exportUrl = url + '?' + queryString;

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