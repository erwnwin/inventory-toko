$(document).ready(function () {
	function fetchData() {
		let type = $('#type').val();
		let startDate = $('#tanggal_mulai').val();
		let endDate = $('#tanggal_selesai').val();

		if (!type) {
			$('#produkTable tbody').empty();
			$('#produkTable tbody').append($('<tr>').append($('<td colspan="5" class="text-center">').text('Pilih type terlebih dahulu.')));
			return;
		}

		$.ajax({
			url: 'filter-laporan/filtered',
			type: 'GET',
			dataType: 'json',
			data: {
				type: type,
				tanggal_mulai: startDate,
				tanggal_selesai: endDate
			},
			success: function (data) {
				let tbody = $('#produkTable tbody');
				tbody.empty();

				if (data.length > 0) {
					$.each(data, function (index, item) {
						let row = $('<tr>');
						row.append($('<td>').text(item.nama_produk));
						row.append($('<td>').text(item.type));
						row.append($('<td>').text(item.nama_supplier));
						row.append($('<td>').text(item.qty));
						row.append($('<td>').text(item.date));
						tbody.append(row);
					});
				} else {
					tbody.append($('<tr>').append($('<td colspan="5" class="text-center">').text('Belum ada data')));
				}
			},
			error: function (xhr, status, error) {
				console.error('AJAX Error:', status, error);
			}
		});
	}

	$('#filterMasukKeluar').on('change', fetchData);
	fetchData(); // Load initial data

	$('#btnExportPDFInOut').click(function () {
		let type = $('#type').val();
		let startDate = $('#tanggal_mulai').val();
		let endDate = $('#tanggal_selesai').val();

		if (!type) {
			Swal.fire({
				icon: 'warning',
				title: 'Peringatan',
				text: 'Pilih type terlebih dahulu.',
			});
			return;
		}

		Swal.fire({
			title: 'Konfirmasi',
			text: 'Apakah Anda yakin ingin mengekspor data ke PDF?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.isConfirmed) {
				window.open('filter-laporan/export-pdf?type=' + type + '&tanggal_mulai=' + startDate + '&tanggal_selesai=' + endDate, '_blank');
			}
		});
	});

	$('#btnExportExcelInOut').click(function () {
		let type = $('#type').val();
		let startDate = $('#tanggal_mulai').val();
		let endDate = $('#tanggal_selesai').val();

		if (!type) {
			Swal.fire({
				icon: 'warning',
				title: 'Peringatan',
				text: 'Pilih type terlebih dahulu.',
			});
			return;
		}

		Swal.fire({
			title: 'Konfirmasi',
			text: 'Apakah Anda yakin ingin mengekspor data ke Excel?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.isConfirmed) {
				// Redirect to the export endpoint
				window.location.href = 'filter-laporan/export-excel?type=' + type + '&tanggal_mulai=' + startDate + '&tanggal_selesai=' + endDate;
			}
		});
	});

});
