<?php
include "conn.php";
session_start();
if (!isset($_SESSION['staff_id'])) {
    header("location:../index.php");
    die();
}

$id = $_SESSION['role_ids'];

// $query = "SELECT * FROM `staff_modules` orderby  ORDER BY id desc  ";
// $run_result = mysqli_query($conn, $query);
// while ($row = mysqli_fetch_assoc($run_result)) {
//     $rid = $row['id'];
//     $names = $row['name'];
//     $link = $row['link'];
//     $icon = $row['icon'];
//     $sql = "SELECT * FROM staff_access where role_id ='$id'  ";
//     $result = mysqli_query($conn, $sql);
//     if ($fat != '') {
//         if (mysqli_num_rows($result) > 0) {
//             while ($row = mysqli_fetch_array($result)) {
//                 $datas = $row['crud'];
//                 $ans = json_decode($datas);
//                 $read = $ans[$fat][2];

//                 if ($read == 0) {
//                     header("location:../index.php");
//                     die();
//                 }
//             }
//         }
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clarity Admin</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="../assets/vendors/dripicons/webfont.css">

    <link rel="stylesheet" href="../assets/vendors/fontawesome/all.min.css">

    <link rel="stylesheet" href="../assets/vendors/sweetalert2/sweetalert2.min.css">
    <link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/x-icon">

    <link rel="shortcut icon" href="../assets/images/logo/logo1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="../plugins/animation/animate.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="text-capitalize layout-footer-fixed layout-fixed">
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="user-name ext-end me-3">
                            <a href="../home/index.php">
                                <i class="fas fa-university fa-1x text-primary " ></i>

                                <span class="display-4 font-weight-bold text-primary">clarirty</span>
                                <!-- <img src="../assets/images/logo/Annotation 2023-10-12 2134387.png" alt="Logo" srcset=""> -->
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <!-- <li class="sidebar-item active ">
                            <a href="../home/index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-users"></i>
                                <span>staff management</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="../staff_management/staff.php" class=''>
                                        <i class="fa fa-genderless"></i>
                                        <span>all staff</span>
                                    </a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="../staff_management/roles.php" class=''>
                                        <i class="fa fa-genderless"></i>
                                        <span> roles</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-users"></i>
                                <span>manage user</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="../manage_user/active.php" class="sidebar-link">
                                        <i class="fa fa-genderless"></i>
                                        <span> Active user</span>
                                    </a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="../manage_user/banned.php" class="sidebar-link">
                                        <i class="fa fa-genderless"></i>
                                        <span>Banned user</span>
                                    </a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="../manage_user/user.php" class="sidebar-link">
                                        <i class="fa fa-genderless"></i>
                                        <span>All Users</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-credit-card"></i>
                                <span>loan management</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="../loan_management/approved.php" class=''>
                                        <i class="fa fa-genderless"></i>
                                        <span>approved loans</span>
                                    </a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="../loan_management/pending.php" class=''>
                                        <i class="fa fa-genderless"></i>
                                        <span>pending loans</span>
                                    </a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="../loan_management/reject.php" class=''>
                                        <i class="fa fa-genderless"></i>
                                        <span>disapproved loans</span>
                                    </a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="../loan_management/all_loans.php" class=''>
                                        <i class="fa fa-genderless"></i>
                                        <span>All loans</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="fa fa-cogs"></i>
                                <span> access management</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="../staff_access/index.php" class=''>
                                        <i class="fa fa-genderless"></i>
                                        <span>staff access</span>
                                    </a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-badge.html" class=''>
                                        <i class="fa fa-genderless"></i>
                                        <span> users access</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="../funtion/logout.php" class='sidebar-link'>
                                <i class="fas fa-power-off" style="color:red;"></i>
                                <span>logout</span>
                            </a>
                        </li> -->
                        <?php

                        $id = $_SESSION['role_ids'];
                        $li = '';
                        $query = "SELECT * FROM `staff_modules`";
                        $run_result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($run_result)) {
                            $rid = $row['id'];
                            $names = $row['name'];
                            $link = $row['link'];
                            $icon = $row['icon'];
                            $parent = $row['parent_id'];
                            $active=$row['active_id'];
                            $has_sub = $row['has_sub'];
                            if ($id != '') {
                                if ($parent == 0) {
                                    $sql = "SELECT * FROM staff_access where role_id ='$id' ";
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
                                <li class="sidebar-item  ' . $has_sub . ' " id="'.$active.'" >
                                    <a href="' . $link . '"   class="sidebar-link ">
                                        <i class="' . $icon . '  text-black"  ></i>
                                        <span class="font-weight-bold">
                                        ' . $names . '                                                                    
                                        </span>
                                    </a>';
                                                    }
                                                }
                                            }
                                            echo $ch;
                                        }
                                    }
                                    $sql =  "SELECT * FROM `staff_modules` where parent_id ='$rid'";
                                    $run = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($run) > 0) {
                                        echo ' <ul class="submenu ">';
                                        while ($row = mysqli_fetch_array($run)) {
                                            $ridd = $row['id'];
                                            $named = $row['name'];
                                            $link = $row['link'];
                                            $icon = $row['icon'];

                                            $parents = $row['parent_id'];
                                            if ($rid  == $parents) {
                                                $sql = "SELECT * FROM staff_access where role_id ='$id' ";
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
                                                <li class="submenu-item  " id="'.$active.'">
                                                    <a href="' . $link . '"   class="nav-link ">
                                                        <i class="' . $icon . '"  ></i>
                                                        <span class="font-weight-bold">
                                                            ' . $named . '                                                                                    
                                                        </span>
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
                        <li class="sidebar-item  ">
                            <a href="../funtion/logout.php" class='sidebar-link'>
                                <i class="fas fa-power-off" style="color:red;"></i>
                                <span>logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>