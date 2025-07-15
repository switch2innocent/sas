$(document).ready(function () {

    // Enter key
    $(document).on('keydown', (e) => {
        if (e.key === 'Enter') {
            $('.submit').trigger('click');
        }
    });

    //Login users
    $('.submit').on('click', (e) => {
        e.preventDefault();

        const username_email = $('#username_email').val();
        const password = $('#password').val();

        if (username_email == '' || password == '') {

            // Swal.fire({
            //     icon: 'warning',
            //     title: 'Missing Fields',
            //     text: 'Please fill in all fields.'
            // });
            // return
            toastr.warning('Please fill in all fields.', 'Missing Fields');

        } else {

            $.ajax({
                type: 'POST',
                url: 'controls/login_users.ctrl.php',
                data: { username_email: username_email, password: password },
                success: (r) => {

                    if (r > 0) {

                        $.ajax({
                            type: 'POST',
                            url: 'controls/check_users_access.ctrl.php',
                            success: (r) => {
                                if (r > 0) {

                                    // Swal.fire({
                                    //     icon: 'success',
                                    //     title: 'Access Granted',
                                    //     text: 'You have successfully logged in.',
                                    //     allowOutsideClick: false,
                                    //     allowEscapeKey: false,
                                    // }).then(function () {
                                    //     window.location.href = 'dashboard.php';
                                    // });
                                    toastr.success('You have successfully logged in.', 'Access Granted');
                                    setTimeout(function () {
                                        window.location.href = 'production/dashboard.php';
                                    }, 2000);

                                } else {

                                    // Swal.fire({
                                    //     icon: 'warning',
                                    //     title: 'Account Not Activated',
                                    //     text: 'Your account is not yet activated. Please contact the administrator for support.'
                                    // });
                                    toastr.warning('Your account is not yet activated. Please contact the administrator for support.', 'Account Not Activated');

                                }
                            }
                        });

                    } else {

                        // Swal.fire({
                        //     icon: 'error',
                        //     title: 'Login Failed',
                        //     text: 'Invalid Username or Password! Please try again.'
                        // });
                        toastr.error('Invalid Username or Password! Please try again.', 'Login Failed');

                    }
                }
            });
        }
    });
});

//Toastr
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}