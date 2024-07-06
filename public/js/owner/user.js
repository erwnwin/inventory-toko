$(document).ready(function() {
    $('#saveBtn').click(function() {
        var nama_user = $('#nama_user').val().trim();
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
        var role = $('#role').val().trim();


        if (!isValidEmail(email)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Email',
                text: 'Masukkan alamat email yang valid!'
            });
            return;
        }

        // Check if fields are empty
        if (nama_user === '' || email === '' || password === '' || role === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Semua form wajib diisi!'
            });
            return;
        }

        $(this).prop('disabled', true).html('Simpan proses....');

        // Check for duplicates (example: check if username already exists)
        $.ajax({
            url: 'check',
            type: 'post',
            data: {
                email: email
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Email ini telah digunakan'
                    });
                    // alert('Username already exists. Please choose a different username.');
                    location.reload(true);
                } else {
                    // No duplicate found, proceed with saving
                    saveData(nama_user, email, password, role);
                    // window.location.href = response.redirect;
                }
            },
            error: function(xhr, status, error) {
                alert('Error checking duplicate. Please try again later.');
                console.error(xhr.responseText);
            }
        });
    });

    // Function to save data using AJAX
    function saveData(nama_user, email, password, role) {

        // Disable the button to prevent multiple clicks
        $(this).prop('disabled', true).html('Simpan proses....');

        // AJAX request
        $.ajax({
            url: 'store',
            type: 'post',
            data: {
                nama_user: nama_user,
                email: email,
                password: password,
                role: role,
            },
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.status == 'success') {
                    $('#saveBtn').prop('disabled', false).html('Simpan');

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
                    $('#saveBtn').prop('disabled', false).html('Simpan');
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
                // alert('Error saving data.'); // Optional generic error message
                // Show generic error message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error saving data. Please try again later.'
                });
                console.error(xhr.responseText);
            }
        });
    }


    function isValidEmail(email) {
        // Simple email validation using regex
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }


    $('#updateBtn').click(function() {
        var id_user = $('#id_user').val().trim();
        var nama_user = $('#nama_user').val().trim();
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
        var role = $('#role').val().trim();

          // Check if fields are empty
          if (nama_user === '' || email === '' || password === '' || role === '') {
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
            url: '../update',
            type: 'POST',
            dataType: 'json',
            data: {
                id_user: id_user,
                email: email,
                nama_user: nama_user,
                password: password,
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


// delete
var id_user;
    $('.delete-btn').click(function() {
        id_user = $(this).data('item-id');
    });

    $('#confirmDeleteBtn').click(function() {
        $.ajax({
            url: 'users/delete',
            type: 'POST',
            dataType: 'json',
            data: {
                id_user: id_user
            },
            success: function(response) {
                // Handle the response
                if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message
                    }).then((result) => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error deleting data. Please try again later.'
                });
                console.error(xhr.responseText);
            }
        });
    });



    
});


    