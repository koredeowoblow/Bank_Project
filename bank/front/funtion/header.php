<?php
include "conn.php";
session_start();
if (!isset($_SESSION['User_id'])) {
    header("location:../index.php");
    die();
}

$id = $_SESSION['role_id'];
$user_id = $_SESSION['User_id'];

$query = "SELECT * FROM `access modules` orderby  ORDER BY id desc  ";
$run_result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($run_result)) {
    $rid = $row['id'];
    $names = $row['name'];
    $link = $row['link'];
    $icon = $row['icon'];
    $sql = "SELECT * FROM access where role_id ='$id'  ";
    $result = mysqli_query($conn, $sql);
    if ($fat != '') {
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
}

?>



<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clarity Bank </title>

    <!-- Google Font: Source Sans Pro -->

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
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/animation/animate.min.css">
    <script rel="stylesheet" src="../plugins/sweetalert2/sweetalert2.min.css"></script>

    <link rel="shortcut icon" href="../dist/img/logo1.jpg" type="image/x-icon">


</head>

<body class="sidebar-mini layout-fixed sidebar-mini accent-success text-capitalize layout-footer-fixed sidebar-closed sidebar-collapse">
    <div class="wrapper " style="overflow: hidden;">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../dist/img/1626243720_bank.jpg" alt="AdminLTELogo" height="60" width="60">
        </div>
        <!-- C:\xampp\htdocs\bank\dist\img\1626243720_bank.jpg -->
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand layout-fixed navbar-light  animate__animated animate__backInLeft " style="background-image: linear-gradient(to bottom right,springgreen,forestgreen);">
            <!-- Left navbar links -->
            <ul class="navbar-nav  animate__animated animate__fadeInDown ">
                <li class="nav-item ">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars font-weight-bold"></i></a>
                </li>
                <li class="nav-item ">
                    <div class="user-panel   d-flex">
                        <div class="image">
                            <img src="<?php echo $_SESSION['image'];?>" class="img-circle elevation-2  animate__animated animate__slideIn" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" style="color:black;font-size: 90%;" class=" animate__animated animate__rotateIn">
                                <?php
                                $name = $_SESSION['Username'];
                                echo '  <p class=" font-weight-bold" style="color:white;font-size: 98%;">welcome ' . $name . '  </p>';
                                ?>
                            </a>
                        </div>
                    </div>
                </li>

            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class=" main-sidebar elevation-4   sidebar-light-green animate__animated animate__backInRight " style="background-color:pale;">
            <!-- Brand Logo -->
            <a href="#" style="color:white ;background-image: linear-gradient(to bottom right,green,springgreen,forestgreen);" class="brand-link ">
                <img src="../dist/img/mylogo1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity:3;">
                <span class="brand-text font-weight-bold mx-1">Clarity Bank </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar  os-theme-dark">
                <nav class="p-1 ">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <?php

                        $id = $_SESSION['role_id'];
                        $li = '';
                        $query = "SELECT * FROM `access modules`";
                        $run_result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($run_result)) {
                            $rid = $row['id'];
                            $names = $row['name'];
                            $link = $row['link'];
                            $icon = $row['icon'];
                            $parent = $row['parent_id'];
                            $style = $row['style'];

                            if ($id != '') {
                                if ($parent == 0) {
                                    $sql = "SELECT * FROM access where role_id ='$id' ";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            $datas = $row['crud'];
                                            $ans = json_decode($datas);
                                            //print_r($ans);
                                            $rs = count($ans);
                                            $ch = '';
                                            for ($row = 0; $row < $rs; $row++) {
                                                $name = $ans[$row][0];
                                                if ($name == $rid) {
                                                    $read = $ans[$row][2];
                                                    if ($read == 1) {
                                                        $ch = '
                                                        <li class="nav-item  "  >
                                                            <a href="' . $link . '"   class="nav-link  ">
                                                                <i class="' . $icon . '  text-black"  style="' . $style . '" ></i>
                                                                <p class="font-weight-bold">
                                                                ' . $names . '                                                                    
                                                                </p>
                                                            </a>';
                                                    }
                                                }
                                            }
                                            echo $ch;
                                        }
                                    }
                                    $sql =  "SELECT * FROM `access modules` where parent_id ='$rid'";
                                    $run = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($run) > 0) {
                                        echo ' <ul class="nav nav-treeview">';
                                        while ($row = mysqli_fetch_array($run)) {
                                            $ridd = $row['id'];
                                            $named = $row['name'];
                                            $link = $row['link'];
                                            $icon = $row['icon'];
                                            $style = $row['style'];
                                            $parents = $row['parent_id'];
                                            if ($rid  == $parents) {
                                                $sql = "SELECT * FROM access where role_id ='$id' ";
                                                $result = mysqli_query($conn, $sql);
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $datas = $row['crud'];
                                                        $ans = json_decode($datas);
                                                        $rs = count($ans);
                                                        $sa = '';
                                                        for ($row = 0; $row < $rs; $row++) {
                                                            $name = $ans[$row][0];
                                                            if ($name == $rid) {
                                                                $read = $ans[$row][2];
                                                                if ($read == 1) {
                                                                    $sa = '
                                                                        <li class="nav-item  ">
                                                                            <a href="' . $link . '"   class="nav-link ">
                                                                                <i class="' . $icon . '"  style="' . $style . '"></i>
                                                                                <p class="font-weight-bold">
                                                                                    ' . $named . '                                                                                    
                                                                                </p>
                                                                            </a>
                                                                    </li>';
                                                                }
                                                            }
                                                        }
                                                        echo $sa;
                                                    }
                                                }
                                            }
                                        }
                                        echo '</ul>';
                                    }
                                    echo ' </li>';
                                }
                            }
                        }


                        ?>

                    </ul>
                </nav>

            </div>
            <!-- /.sidebar -->
        </aside>