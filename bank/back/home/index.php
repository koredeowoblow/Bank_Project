<?php
$fat = "0";
include "../funtion/header.php";
?>

<div id="main">
<header class="home">
        <nav class="navbar navbar-expand navbar-light ">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown me-1">
                            <a class="sidebar-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-envelope bi-sub fs-4 text-gray-600"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <h6 class="dropdown-header">Mail</h6>
                                </li>
                                <li><a class="dropdown-item" href="#">No new mail</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown me-3">
                            <a class="sidebar-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell bi-sub fs-4 text-gray-600"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <h6 class="dropdown-header">Notifications</h6>
                                </li>
                                <li><a class="dropdown-item">No notification available</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600">
                                        <?php
                                        echo ($_SESSION['name']);
                                        ?>
                                    </h6>
                                    <p class="mb-0 text-sm text-gray-600">
                                        <?php
                                        $id = $_SESSION['role_ids'];
                                        $sql = "SELECT * FROM staff_roles where id = '$id'";
                                        $result = mysqli_query($conn, $sql);
                                        $rows = mysqli_fetch_assoc($result);
                                        echo $rows['name'];
                                        ?>
                                    </p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="../assets/images/faces/1.jpg">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Hello, John!</h6>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                    Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                    Settings</a></li>
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-wallet me-2"></i>
                                    Wallet</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>


    <div class="page-heading">
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 mx-5 col-lg-9">
                <div class="row justifly-content-center">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card" style="justify-content: center;">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h6 class="text-muted font-semibold">Total users</h6>
                                        <h6 class="font-extrabold mb-2" style="font-size: large;">
                                            <?php
                                            $select = " SELECT count(id) as total FROM user ";
                                            $result = mysqli_query($conn, $select);
                                            $row = $result->fetch_assoc();
                                            $output = $row["total"];
                                            echo $output;
                                            ?>

                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="stats-icon green ">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h6 class="text-muted font-semibold"></h6>Verified users
                                        <h6 class="font-extrabold mb-0">
                                            <?php
                                            $select = " SELECT count(id) as total FROM user  where `status`='active'";
                                            $result = mysqli_query($conn, $select);
                                            $row = $result->fetch_assoc();
                                            $output = $row["total"];
                                            echo $output;
                                            ?>
                                        </h6>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="stats-icon red ">
                                            <i class="iconly-boldAdd-User "></i>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h6 class="text-muted font-semibold">banned users</h6>
                                        <h6 class="font-extrabold mb-0">
                                            <?php
                                            $select = " SELECT count(id) as total FROM user where `status`='disable' ";
                                            $result = mysqli_query($conn, $select);
                                            $row = $result->fetch_assoc();
                                            $output = $row["total"];
                                            echo $output;
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h6 class="text-muted font-semibold  ">total staff</h6>
                                        <h6 class="font-extrabold mb-0">
                                            <?php
                                            $select = " SELECT count(id) as total FROM staffs";
                                            $result = mysqli_query($conn, $select);
                                            $row = $result->fetch_assoc();
                                            $output = $row["total"];
                                            echo $output;
                                            ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </section>
    </div>



    <?php
    include "../funtion/footer.php";
    ?>