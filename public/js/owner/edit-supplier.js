$(document).ready(function () {
	$('#formEditSupplier').submit(function (e) {
		e.preventDefault(); // Prevent default form submission

		var formData = $(this).serialize(); // Serialize form data
		console.log('Edit Form Data:', formData); // Debugging line

		$('#btnUpdateSupplier').prop('disabled', true).html('Updating...');

		$.ajax({
			type: 'POST',
			url: 'supplier/update', // Ensure this URL matches your controller method
			data: formData,
			dataType: 'json',
			success: function (response) {
				console.log('Edit Response:', response); // Debugging line

				if (response.status === 'success') {
					$('#btnUpdateSupplier').prop('disabled', false).html('Update');
					Swal.fire({
						icon: 'success',
						title: 'Success!',
						text: response.message
					}).then(() => {
						$('#modalEditSupplier').modal('hide');
						location.reload(); // Reload or update the UI as needed
					});
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: response.message
					});
				}
			},
			error: function (xhr, status, error) {
				console.error('Edit Error:', error); // Debugging line
				$('#btnUpdateSupplier').prop('disabled', false).html('Update');
				Swal.fire({
					icon: 'error',
					title: 'Error!',
					text: 'An error occurred while processing your request.'
				});
			}
		});
	});
});
