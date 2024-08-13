$(document).ready(function () {
	$('#editItemProducts').submit(function (e) {
		e.preventDefault();

		var formData = new FormData(this);

		// Check if fields are empty
		var nama_produk = $('#nama_produk').val().trim();
		var id_kategori = $('#id_kategori').val().trim();
		var id_unit = $('#id_unit').val().trim();
		var stock = $('#stock').val().trim();
		var price = $('#price').val().trim();
		var gambar = $('#gambar').val().trim(); // For image validation, but we'll handle it on the server side

		if (nama_produk === '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Nama Product wajib diisi!'
			});
			return;
		} else if (id_kategori === '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Kategori wajib diisi!'
			});
			return;
		} else if (id_unit === '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Unit wajib diisi!'
			});
			return;
		} else if (price === '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Harga wajib diisi!'
			});
			return;
		}

		$('#btnUpdateItem').prop('disabled', true).html('Update proses....');

		$.ajax({
			url: '../update', // URL of the server-side script
			type: 'POST',
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			success: function (response) {
				var data = JSON.parse(response);

				if (data.status === 'success') {
					$('#btnUpdateItem').prop('disabled', false).html('Update');
					Swal.fire({
						icon: 'success',
						title: 'Success!',
						text: data.message,
					}).then(function () {
						if (data.redirect) {
							window.location.href = data.redirect;
						}
					});
				} else {
					$('#btnUpdateItem').prop('disabled', false).html('Update');
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: data.message,
					});
				}
			},
			error: function (xhr, status, error) {
				console.error('Error:', error);
				Swal.fire({
					icon: 'error',
					title: 'Error!',
					text: 'Something went wrong. Please try again later.',
				});
				console.error(xhr.responseText);
			}
		});
	});
});
