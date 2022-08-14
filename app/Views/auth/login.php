<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/assets/img/logo2.png" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.min.css">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <!-- <div class="col-lg-6 d-none d-lg-block "></div> -->
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-3">SIMDALOPS LLAJ </h1>
                                    </div>
                                    <form class="user" id="login_page" autocomplete="off">
                                        <?= csrf_field(); ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Masukan Username ....">
                                            <div class="invalid-feedback" id="error-username"></div>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukan Password ....">
                                            <div class="invalid-feedback" id="error-password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block logedIn">
                                            <i class="fa fa-sign-in"></i> Login
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-user btn-block">
                                            <i class="fa fa-refresh"></i> Reset
                                        </button>
                                        <hr>
                                    </form>
                                    <!-- <hr> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script>
        $('#login_page').submit(function(e) {

            e.preventDefault();

            let username = $('#username').val();
            let password = $('#password').val();


            $.ajax({
                url: 'login/getLogin',
                method: 'post',
                data: {
                    username: username,
                    password: password
                },
                dataType: 'json',
                beforeSend: function() {
                    $(".logedIn").html('<i class="fa fa-spinner fa-spin"> </i>')
                    $(".logedIn").attr('disabled', 'disabled');
                },
                success: function(response) {
                    $(".logedIn").html('<i class="fa fa-sign-in"></i> Login')
                    $(".logedIn").removeAttr('disabled', 'disabled');
                    if (response.error) {
                        if (response.error.username) {
                            $('#username').addClass('is-invalid');
                            $('#error-username').html(response.error.username);
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('#error-username').html('');
                        }
                        if (response.error.password) {
                            $('#password').addClass('is-invalid');
                            $('#error-password').html(response.error.password);
                        } else {
                            $('#password').removeClass('is-invalid');
                            $('#error-password').html('');
                        }
                    } else if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: `${response.success}`
                        });
                        setTimeout(function() {
                            window.location.href = `/${response.url}`;
                        }, 1500);
                    } else if (response.errors) {
                        Swal.fire({
                            icon: 'error',
                            title: `${response.errors}`
                        });
                    }
                },
                error: function() {
                    $(".logedIn").html('<i class="fa fa-sign-in"></i> Login')
                    $(".logedIn").removeAttr('disabled', 'disabled');
                    alert('Gagal Login');
                }
            })
        })
    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.min.js"></script>
</body>

</html>