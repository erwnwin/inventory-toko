$(document).ready(function () {
	$('#saveBtnInfo').click(function () {
		// Nonaktifkan tombol dan ubah teks
		$(this).prop('disabled', true).html('Simpan proses....');

		// Ambil data dari form
		var formData = $('#myFormInfo').serialize();

		$.ajax({
			url: 'info-apps/update', // Gantilah dengan URL endpoint yang sesuai
			type: 'POST',
			data: formData,
			dataType: 'json',
			success: function (response) {
				// Tampilkan SweetAlert sesuai hasil dari server
				if (response.status === 'success') {
					Swal.fire({
						icon: 'success',
						title: 'Berhasil!',
						text: 'Data berhasil disimpan.',
						confirmButtonText: 'OK'
					}).then(() => {
						// Setelah menutup SweetAlert, aktifkan kembali tombol dan ubah teks
						$('#saveBtnInfo').prop('disabled', false).html('Simpan');
					});
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Gagal!',
						text: response.message || 'Terjadi kesalahan saat menyimpan data.',
						confirmButtonText: 'OK'
					}).then(() => {
						// Setelah menutup SweetAlert, aktifkan kembali tombol dan ubah teks
						$('#saveBtnInfo').prop('disabled', false).html('Simpan');
					});
				}
			},
			error: function (xhr, status, error) {
				console.error('AJAX Error:', status, error);
				Swal.fire({
					icon: 'error',
					title: 'Gagal!',
					text: 'Terjadi kesalahan pada server.',
					confirmButtonText: 'OK'
				}).then(() => {
					// Setelah menutup SweetAlert, aktifkan kembali tombol dan ubah teks
					$('#saveBtnInfo').prop('disabled', false).html('Simpan');
				});
			}
		});
	});
});
