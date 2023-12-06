<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Forgot Password</h1>
                    <p class="auth-subtitle mb-5">Input your email and we will send you reset password link.</p>

                    <form action="index.html">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Remember your account? <a href="auth-login.html" class="font-bold">Log
                                in</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>
<script>
        $('#check').on('click', function () {          
            $('#myform').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: "see.php",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (data) {
                        if (data == 'pass') {                          
                            $('.form-group').show();
                            $('#confirmPassword').attr("disabled", false);
                            $('#password').attr("disabled", false);
                            $('#ban').show();
                            $('#check').hide();
                        } if (data == 'fail') {
                            setTimeout(function () { $("#check").removeClass("is-loading"); }, 100);
                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">account doesnt exist </span><br><br>');
                            setTimeout(function () {
                                $("#msg1").html('');
                            }, 5000);
                        }
                        else {

                        }
                    }
                });

            })
        });
        $('#ban').on('click', function () {
            $('#myform').on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: "dad.php",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (data) {
                        if (data == 'success') {
                            // $("#myform")[0].reset();
                            window.location = "../";
                            setTimeout(function () {
                                $("#msg").html('');
                            }, 5000);
                        } if (data == 'fails') {
                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">email already exist </span><br><br>');
                            setTimeout(function () {
                                $("#msg1").html('');
                            }, 5000);
                        }
                        if (data == 'failed') {
                            $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">passord doesnt match confirm Password </span><br><br>');
                            setTimeout(function () {
                                $("#msg1").html('');
                            }, 5000);
                        }
                        else {

                        }
                    }
                });

            })
        })
</script>
</html>   
