<?php
$fat = "10";
include "../funtion/header.php";
?>
<div id="main">
    <header class="">
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
                                        $fid=$rows['id'];
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
            <div class="col-12 table  " style="justify-self:center;color:black;">



                <div id="msg"></div>
                <div class="form-group">
                    <p style="color: black;font-weight:800;">role:</p>
                    <select name="role" id="role" class="suit-select form-control">
                        <?php
                        $sql = "SELECT * FROM `staff_roles` ";
                        echo "<option></option>";
                        if ($result = mysqli_query($conn, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                //print_r($result);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['id'] != $fid) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <table class="table table-hover table-lg table-responsive  ">
                    <thead style="color:black;">
                        <tr>
                            <th>view name</th>
                            <th>create permisson</th>
                            <th>read permisson</th>
                            <th>update permisson</th>
                            <th>delete permisson</th>
                        </tr>
                    </thead>
                    <tbody id="access_resp"></tbody>
                </table>
            </div>


        </section>
    </div>
</div>

<footer class="main-footer">
    <div class="footer clearfix text-muted">
        <div class="float-end">
            <p>2021 &copy; clarity</p>
        </div>

    </div>
</footer>
<script src="../assets/js/pages/dashboard.js"></script>

<script src="../assets/js/main.js"></script>
<script src="../assets/vendors/fontawesome/all.min.js"></script>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../assets/js/extensions/sweetalert2.js"></script>
<script src="../assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#role').on('change', function() {
            var id = document.getElementById('role').value;
            $.ajax({
                url: "access_modules/access_fetch.php",
                data: {
                    id: id
                },
                type: "POST",
                success: function(data) {
                    $('#access_resp').html(data);

                }
            });


        })
    });

    function dat(x, y, z, w) {
        let yep = document.getElementById('checkboxPrimary' + x + z);


        if (yep.checked == true) {
            y = 1;
        }
        if (yep.checked == false) {
            y = 0;

        }
        $.ajax({
            url: "access_modules/access_update.php",
            data: {
                x,
                y,
                z,
                w
            },
            type: "POST",
            success: function(data) {

            }
        });


    }
</script>

</body>

</html>