<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>sign up</a>
            </div>
            <div class="card-body">
                <form action="" method="post" id="myform">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="fullname" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="tel" class="form-control" name="phone_number" placeholder="Phone number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="PasswordConfirm" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="pin" placeholder="enter transaction pin">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="PinConfirm" placeholder="Retype pin">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="../index.php" class="text-center">I already have a account</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        // $("#myform").validate({
        //     ignore: ':hidden:not(:checkbox)',
        //     errorElement: 'label',
        //     errorClass: 'is-invalid',
        //     validClass: 'is-valid',
        //     rules: {
        //         password: {
        //             required: true
        //         },
        //         pin: {
        //             required: true
        //         },
        //         PasswordConfirm: {
        //             required: true,
        //             equalTo: '#password'
        //         },
        //         PinConfirm: {
        //             required: true,
        //             equalTo: '#pin '
        //         },

        //     }
        // });
        $(document).ready(function() {
            $('#myform').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: "create.php",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data) {
                        if (data == 'success') {
                            $("#myform")[0].reset();
                            window.location = "../index.php";
                            setTimeout(function() {
                                $("#msg").html('');
                            }, 5000);
                        }
                        if (data == 'fails') {
                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">email already exist </span><br><br>');
                            setTimeout(function() {
                                $("#msg1").html('');
                            }, 5000);
                        }
                        if (data == 'failed') {
                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">passord doesnt match confirm Password </span><br><br>');
                            setTimeout(function() {
                                $("#msg1").html('');
                            }, 5000);
                        } else {

                        }
                    }
                });

            })
        })
    </script>

</body>

</html>