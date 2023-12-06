<?php
include "../funtion/conn.php";
$fat = '4';
include "../funtion/header.php";
?>
<style>
    .cards {
        height: 310px;
        width: inherit;
        background-image: linear-gradient(springgreen, forestgreen);
        border-radius: 20px;
        color: white;
        margin: 20px;
        font-size: 16px;
        box-shadow: 2px 2px 20px #707070;
    }

    .top-block {
        display: inline-block;
        width: inherit;
        height: 155px;
    }

    .bottom-block {
        display: inline-block;
        width: inherit;
        height: 155px;
    }

    .cards-chip {
        float: left;
        margin: 20px;
    }

    .cards-name {
        float: right;
        margin-right: -80%;
        position: relative;
        font-size: 28px;
        font-weight: 700;
    }

    .balance {
        float: left;
        margin: 20px;
        position: relative;
        top: -5px;
    }

    .cards-balance {
        font-weight: 700;
        font-size: 20px;
        margin-top: -10%;
    }

    .cards-icon {
        float: right;
        margin: 0 20px 0 0;
        margin-top: 75px;
    }

    .circle-left {
        margin-right: -15px;
        opacity: 0.7;
    }

    .cards-number {
        font-size: 28px;
        margin: -15px 0 0 0;
        text-align-last: center;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper  animate__animated animate__fadeInDown ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold p-3">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card  card-outline" style="background-image: linear-gradient(to bottom right,springgreen,forestgreen);">
                        <div class="card-body box-profile">
                            <div class="text-center  text-warning">
                                <figure> <img id="ima" class="profile-user-img img-fluid img-circle" alt="m"></figure>

                            </div>

                            <h3 id="name" class="profile-username text-center"></h3>

                            <p id="role" class="text-muted text-center"></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->

                </div>
                <!-- /.col -->
                <div class="col-md-9" style="padding: auto;">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active font-weight-bold bg-success mx-2" style="color:white;" href="#settings" data-toggle="tab">Settings</a></li>
                                <li class="nav-item"><a class="nav-link bg-success font-weight-bold mx-2" href="#password-reset" data-toggle="tab">pin Reset</a></li>
                                <li class="nav-item"><a class="nav-link bg-success font-weight-bold mx-2" href="#profile-picture" data-toggle="tab">Profile Picture</a></li>
                                <li class="nav-item"><a class="nav-link bg-success font-weight-bold mx-2" href="#about" data-toggle="tab">Bank Card</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="tab-content">
                            <!-- Existing "Settings" Tab -->
                            <div class="tab-pane active" id="settings">
                                <div id="msg1"></div>
                                <form class="form-horizontal p-3" id="updateForm">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="fullname" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputpassword" class="col-sm-2 col-form-label">new password</label>
                                        <div class="col-sm-10">
                                            <input type="password" autocomplete="off" class="form-control" name="password" id="inputpassword" placeholder="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Confirm password</label>
                                        <div class="col-sm-10">
                                            <input type="password" autocomplete="off" class="form-control" name="PasswordConfirm" id="inputconfirmpassword">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn p-2 btn-block btn-success">Submit</button>
                                </form>


                                <!-- Existing Settings Form -->
                            </div>

                            <!-- New "Password Reset" Tab -->
                            <div class="tab-pane" id="password-reset">
                                <div id="msg2"></div>
                                <form class="form-horizontal p-3" id="updateForms">

                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">enter new pin</label>
                                        <div class="col-sm-10">
                                            <input type="password" autocomplete="off" class="form-control" name="pin" id="pin">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Confirm pin</label>
                                        <div class="col-sm-10">
                                            <input type="password" autocomplete="off" class="form-control" name="PinConfirm" id="inputconfirmpin">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn p-2 btn-block btn-success">Submit</button>
                                </form>
                            </div>

                            <!-- New "Profile Picture" Tab -->
                            <div class="tab-pane" id="profile-picture">
                                <form id="updateFormed" class="form-horizontal p-3" enctype="multipart/form-data"><!-- Profile picture change content -->
                                    <div class="form-group row p-3">
                                        <figure>
                                            <img id="previewImage" name="myimages" style="width:auto; display: block;position:relative; max-width: 10%;margin:auto; object-fit:cover;object-position: top;">
                                        </figure>
                                        <div class="custom-file">
                                            <p style=" font-weight: 500;">image:</p>
                                            <input type="file" id="profilePic" onchange="see()" name="profilePic" accept="image/*" class="custom-file-input im1">
                                            <label class="custom-file-label" for="profilePic">Choose image</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn p-2 btn-block btn-success">Submit</button>
                                </form>
                            </div>

                            <!-- Existing "Bank Card" Tab -->
                            <div class="tab-pane" id="about">
                                <div class="card-body m-auto ">
                                    <div class='cards p-3'>
                                        <div class='top-block'>
                                            <div class='cards-chip'>
                                                <i class="fas fa-credit-card "></i>
                                            </div>
                                            <span class='cards-name p-2'>
                                                clarity pay
                                            </span>
                                        </div>
                                        <div class='cards-number'>
                                            <p>5459 xxxx xxxx 7203</p>
                                        </div>
                                        <div class='bottom-block'>
                                            <div class='balance'>
                                                <div>
                                                    <p class="p-1"> Balance </p>
                                                </div>
                                                <div class='cards-balance mb-auto'>
                                                    <p>
                                                        <?php
                                                        include "../funtion/conn.php";
                                                        $id = $_SESSION["User_id"];
                                                        // $query = "SELECT * FROM user where id=$id";
                                                        // $results = mysqli_query($conn, $query);
                                                        // $row = mysqli_fetch_assoc($results);
                                                        // $acct = $row['account_balance'];
                                                        // $output = '&#8358;' . number_format($acct, 2);
                                                        $check = "SELECT * from loan_data where user_id=$id";
                                                        $check_run = mysqli_query($conn, $check);
                                                        if ($check_run == true) {
                                                            $rows = mysqli_fetch_assoc($check_run);

                                                            if ($rows != '') {
                                                                $date = date('Y,m,d');
                                                                $due = $rows['due_date'];
                                                                if ($due >= $date) {
                                                                    $query = "SELECT * FROM user where id=$id";
                                                                    $results = mysqli_query($conn, $query);
                                                                    $row = mysqli_fetch_assoc($results);
                                                                    $update = "UPDATE  loan_data set `status`='due'  WHERE user_id='$id'";
                                                                    $sat = mysqli_query($conn, $update);
                                                                    if ($sat == true) {
                                                                        if ($row > 0) {
                                                                            $acct = $row['account_balance'];
                                                                            $loan = $row['loan_amount'];
                                                                            $accts = $acct - $loan;

                                                                            $output = '&#8358;' . number_format($accts, 2);
                                                                            # code...
                                                                        }  # code...
                                                                    }
                                                                } else {
                                                                    $query = "SELECT * FROM user where id=$id";
                                                                    $results = mysqli_query($conn, $query);
                                                                    $row = mysqli_fetch_assoc($results);
                                                                    if ($row > 0) {
                                                                        $acct = $row['account_balance'];
                                                                        $loan = $row['loan_amount'];
                                                                        $accts = $acct + $loan;

                                                                        $output = '&#8358;' . number_format($accts, 2);
                                                                        # code...
                                                                    }
                                                                }
                                                            } else {
                                                                $query = "SELECT * FROM user where id=$id";
                                                                $results = mysqli_query($conn, $query);
                                                                $row = mysqli_fetch_assoc($results);
                                                                if ($row > 0) {
                                                                    $acct = $row['account_balance'];
                                                                    $loan = $row['loan_amount'];
                                                                    $accts = $acct + $loan;

                                                                    $output = '&#8358;' . number_format($accts, 2);
                                                                    # code...
                                                                }
                                                            }
                                                        } else {
                                                            $output = 'error';
                                                        }
                                                        echo $output;
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class='cards-icon'>
                                                <span class='circle-left'>
                                                    <i class="icon-circle icon-3x "></i>
                                                </span>
                                                <i class="icon-circle icon-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div><!-- /.container-fluid -->

<!-- /.control-sidebar -->
</div>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>
<!-- ./wrapper -->

<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    let myimage = document.getElementById("previewImage");
    let image = document.getElementById("ima");

    $(function() {
        $.ajax({
            url: "profile_fetch.php",
            method: "post",
            success: function(data) {
                var json = JSON.parse(data);
                $("#name").html(json.fullname);
                $("#role").html(json.role_name);
                // $("#ima").setAttribute("src", json.image);
                $("input[name='fullname']").val(json.fullname);
                $("input[name='email']").val(json.email);
                myimage.setAttribute("src", json.profile_pic);
                image.setAttribute("src", json.profile_pic);
            }
        })
    });

    function see() {

        let uploadbtn = document.getElementById("profilePic");
        let myimage = document.getElementById("previewImage");
        myimage.src = "";
        uploadbtn.onchange = () => {
            let reader = new FileReader();
            reader.readAsDataURL(uploadbtn.files[0]);
            reader.onload = () => {
                myimage.setAttribute("src", reader.result);
            }
        }

        // If you want to clear the image source in some condition, you can do this:
        // myimage.src = "";
    }
    $("#updateForm").submit(function(e) {
        e.preventDefault();

        // Create FormData object to send form data
        var formData = new FormData(this);

        // Make an AJAX request
        $.ajax({
            url: "create.php", // Update with the correct path to your PHP script
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle the response from the server
                if (response === 'success') {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "username and email updated successfully"
                    })

                } else {
                    $("#msg1").html('<span class="alert alert-danger alert-dismissible fade show">phone  number or email already in use</span><br><br>');
                    setTimeout(function() {
                        $("#msg1").html('');
                    }, 5000);
                }
            },
           
        });

    });


    $("#updateForms").submit(function(e) {
        e.preventDefault();

        // Create FormData object to send form data
        var formData = new FormData(this);

        // Make an AJAX request
        $.ajax({
            url: "create.php", // Update with the correct path to your PHP script
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle the response from the server
                if (response === 'success') {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "pin upadte successfully"
                    })
                } else {

                    $("#msg2").html('<span class="alert alert-danger alert-dismissible fade show">phone  number or email already in use</span><br><br>');
                    setTimeout(function() {
                        $("#msg1").html('');
                    }, 5000);

                    // Optionally, you can handle the failure scenario here
                }
            },
           
        });
    });


    $("#updateFormed").submit(function(e) {
        e.preventDefault();
        // Create FormData object to send form data
        var formData = new FormData(this);
        // Make an AJAX request
        $.ajax({
            url: "create.php", // Update with the correct path to your PHP script
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle the response from the server
                if (response === 'success') {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "profile picture upadte successfully"
                    })
                } else {
                    $("#msg3").html('<span class="alert alert-danger alert-dismissible fade show">phone  number or email already in use</span><br><br>');
                    setTimeout(function() {
                        $("#msg1").html('');
                    }, 5000);

                }
            },
            
        });
    });
</script>


</body>

</html>