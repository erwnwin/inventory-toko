$(document).ready(function () {
	$('#loginForm').on('submit', function (e) {
		e.preventDefault();
		var formData = $(this).serialize();

		// Disable the login button and show spinner
		$('#btnLogin').prop('disabled', true);
		$('#spinner').show();
		$('#btnText').hide(); // Hide button text

		$.ajax({
			url: 'login/validate', // Ganti dengan URL controller Anda
			type: 'POST',
			data: formData,
			dataType: 'json',
			success: function (response) {
				if (response.success) {
					// Optionally use user data
					var user = response.user;
					console.log('User ID:', user.id_user);
					console.log('Name:', user.nama_user);
					console.log('Email:', user.email);
					console.log('Role:', user.role);
					console.log('Hak Akses:', user.hak_akses);

					Swal.fire({
						title: 'Success!',
						text: 'Login successful!',
						icon: 'success',
						timer: 1500, // Time in milliseconds before redirect
						showConfirmButton: false, // Hide the confirm button
					}).then(function () {
						window.location.href = response.redirect_url; // Redirect after success
					});
				} else {
					Swal.fire({
						title: 'Error!',
						text: response.message,
						icon: 'error',
						confirmButtonText: 'Try Again'
					});
				}
			},
			error: function () {
				Swal.fire({
					title: 'Error!',
					text: 'An error occurred. Please try again.',
					icon: 'error',
					confirmButtonText: 'OK'
				});
			},
			complete: function () {
				// Re-enable the login button and hide spinner
				$('#btnLogin').prop('disabled', false);
				$('#spinner').hide();
				$('#btnText').show(); // Show button text
			}
		});
	});
});
