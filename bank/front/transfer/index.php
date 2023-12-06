<?php
include "../funtion/conn.php";
session_start();
if (!isset($_SESSION['User_id'])) {
    header("location:../index.php");
    die();
}
$fat='1';

$id = $_SESSION['role_id'];

$query = "SELECT * FROM `access modules` orderby  ORDER BY id desc  ";
$run_result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($run_result)) {
    $rid = $row['id'];
    $names = $row['name'];
    $link = $row['link'];
    $icon = $row['icon'];
    $sql = "SELECT * FROM access where role_id ='$id'  ";
    $result = mysqli_query($conn, $sql);
    // if ($fat != '') {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $datas = $row['crud'];
            $ans = json_decode($datas);
            $read = $ans[$fat][2];

            if ($read == 0) {
                header("location:../index.php");
                die();
            }
        }
    }
}
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>transfer</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <link rel="shortcut icon" href="../dist/img/logo1.jpg" type="image/x-icon">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/animation/animate.min.css">
</head>

<body class=" layout-fixed  text-capitalize  layout-footer-fixed" style="background-color:honeydew;">

    <header class="navbar-light" style="background-image: linear-gradient(to bottom right,springgreen,forestgreen);">

        <div class="user-panel d-flex">
            <button class="btn btn-transparent" onclick="home()" style="color:black;"> <i class="fas fa-less-than w-70 p-2"></i></button>
            <h4 class="font-weight-bold my-3" style="font-size:2vmax,1.4vmin;text-align:start;">transfer</h4>
        </div>

        <!-- Right navbar links -->
    </header>
    <div class="container p-3 my-4" style="justify-self: center;margin-bottom:20%;">
        <div class="row" style="background-color:white;height:90px;width:800vmax,300vmin;" onclick="same()">
            <div class="col-1">
                <i class=" fas fa-send " style="color: forestgreen;"></i>
            </div>
            <div class="col-7 col-sm-7  ">
                <p class="font-weight-bold my-2  mx-4" style="font-size:2vmax,1.4vmin;text-align:start;">
                    To clarity account
                </p>
                <p class="mx-4 my-auto" style="color:lightgrey;font-size:1.6vmax,0.6vmin;;margin-top:-10px">free instant transfer with zero issues</p>
            </div>
            <div class="col-2">
                <i class="fas fa-greater-than p-4 my-2" style="color:green;float:right;margin-right:-100%;"></i>
            </div>
        </div>
        <div class="row my-4 " style="background-color:white;"onclick="other()">
            <div class="col-1">
                <i cl></i>
            </div>
            <div class="col-7 col-sm-7">
                <p class="font-weight-bold my-3  mx-4" style="font-size:2vmax,1.4vmin;text-align:start;">
                    To other bank account
                </p>
                <p class="mx-4" style="color:lightgrey;font-size:1.6vmax,0.6vmin;;margin-top:-15px">free instant transfer with zero issues</p>
            </div>
            <div class="col-2">
                <i class="fas fa-greater-than p-4 my-2" style="color:green;float:right;margin-right:-100%;"></i>
            </div>
        </div>
    </div>




    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- <script src="../plugins/jquery-3.6.3.js"></script> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <script>
        function same() {
            window.location = "to-c-bank/index.php";
        }

        function home() {
            window.location = "../home/index.php";
        }
        function other() {
            window.location = "to_other_bank/index.php";
        }
    </script>
</body>

</html>