// update
$(document).ready(function() {
    $('#updateBtn').click(function() {

        var id_user = $('#id_user').val().trim();
        var username = $('#username').val().trim();
        var email = $('#email').val().trim();
        var role = $('#role').val().trim();


         // Check if fields are empty
         if (username === '' || email === '' || role === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Semua form wajib diisi!'
            });
            return;
        }

        $(this).prop('disabled', true).html('Update proses....');


        // AJAX request to update encrypted data
        $.ajax({
            url: 'user/update',
            type: 'POST',
            dataType: 'json',
            data: {
                id_user: id_user,
                email: email,
                username: username,
                role: role
            },
            success: function(response) {
                if (response.status == 'success') {
                    $('#updateBtn').prop('disabled', false).html('Update');

                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then((result) => {
                        // Redirect if needed
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    });

                    // alert(response.message); // Optional success message
                    // if (response.redirect) {
                    //     window.location.href = response.redirect;
                    // }
                } else {
                    $('#updateBtn').prop('disabled', false).html('Update');
                    // Show error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                    // alert(response.message); // Optional error message
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error updating data. Please try again later.'
                });
                console.error(xhr.responseText);
            }
        });
    });
});