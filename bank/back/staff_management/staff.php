<?php
$fat = "2";
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
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last" style="color:#607080;">
                    <h3 style="color:#607080;">staff</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end" style="color:#607080;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" style="color:#607080;" aria-current="page">staff</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 table  " style="justify-self:center;color:dodgerblue">

                <?php

                $id = $_SESSION['role_ids'];

                $sql = "SELECT * FROM access where role_id ='$id'  ";
                $result = mysqli_query($conn, $sql);
                if ($fat != '') {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $datas = $row['crud'];
                            $ans = json_decode($datas);
                            $create = $ans[$fat][1];

                            if ($create == 1) {
                                echo '<button class="btn m-3 btn-block btn-primary float-right m-t-35" data-toggle="modal" data-target="#addnew">Add staff</button>';
                            }
                        }
                    }
                }

                ?>
                <!-- /.card-header -->

                <div id="msg"></div>
                <table id="example1" class="table m-3 table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>staff name</th>
                            <th>email</th>
                            <th>role</th>
                            <?php

                            $id = $_SESSION['role_ids'];

                            $sql = "SELECT * FROM staff_access where role_id ='$id'  ";
                            $result = mysqli_query($conn, $sql);
                            if ($fat != '') {
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        $datas = $row['crud'];
                                        $ans = json_decode($datas);
                                        $delete = $ans[$fat][4];
                                        $update = $ans[$fat][3];;

                                        if ($delete || $update == 1) {
                                            echo ' <th style="text-align:right;">option:</th>';
                                        }
                                    }
                                }
                            }

                            ?>


                        </tr>
                    </thead>

                </table>

            </div>

        </section>
    </div>
</div>
</div><!-- add modal start -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="p1 modal-title">add new staff info </h5>

                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="msg1"></div>
                <form id="myform">
                    <div class="form-group">
                        <p>staff name:</p>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <p>email</p>
                        <input type="email" class="form-control" name="emails" id="email">
                    </div>
                    <div class="form-group">
                        <p>password</p>
                        <input type="password" class="form-control" autocomplete="off" name="passwords" id="password">
                    </div>
                    <div class="form-group">
                        <p>role:</p>
                        <select name="role" class="suit-select form-control">
                            <?php
                            $sql = "SELECT * FROM `staff_roles`";
                            echo "<option></option>";
                            if ($result = mysqli_query($conn, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    //print_r($result);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <button type="submit" id="ban" class="btn btn-block btn-primary btn-tone">add staff</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-tone  m-r-10" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- add modal stop -->
<!-- update modal start -->
<div class="modal fade" id="updatenew">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mods">update staff info</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="msg2"></div>
                <form id="myforms">

                    <div id="msg1"></div>
                    <input type="text" name="pid" hidden class="form-control">
                    <div class="form-group">
                        <p>full name:</p>
                        <input type="text" class="form-control" required name="name" id="names">
                    </div>
                    <div class="form-group">
                        <p>email</p>
                        <input type="eamil" class="form-control" required name="email" id="emails">
                    </div>
                    <div class="form-group">
                        <p>role:</p>
                        <select name="role" id="role" required class="suit-select form-control">
                            <?php
                            $sql = "SELECT * FROM `staff_roles`";
                            echo "<option></option>";
                            if ($result = mysqli_query($conn, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    //print_r($result);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-block btn-primary btn-tone">add staff</button>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-tone m-r-10" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- update modal stop -->
<!-- delete modal start -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete staff info</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="anticon anticon-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure <button type="button" class="btn btn-danger btn-tone Delete " style="float:right;"> <i class="anticon anticon-delete"></i>delete</button></p>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- delete modal stop -->
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
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

            "ajax": {
                url: "staff/fetch.php",
                method: "POST"
            },
            "fnCreate": function(nRow, aData, iDataIndex) {
                $(nRow).attr("name", aData[0]);
            },
            "columnDefs": [{
                "targets": [], //not sort
                "orderable": false
            }],

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });


    $('#ban').on('click', function() {
        $('#myform').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: "staff/add_staff.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    if (data == 'success') {
                        $("#myform")[0].reset();
                        $('#example1').DataTable().ajax.reload();
                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "staff added successfully"
                        })

                        // $("#msg").html('<span class=" alert alert-success">staff booked successfully</span>');
                        // setTimeout(function() {
                        //     $("#msg").html('');
                        // }, 5000);

                    } else {
                        $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">error occured</span><br><br>');
                        setTimeout(function() {
                            $("#msg1").html('');
                        }, 5000);
                    }

                }
            });

        })
        return;
    });
    $(document).on('click', '#editbtn', function(event) {
        var id = $(this).data('id');
        $.ajax({
            url: "staff/get_single_staff.php",
            data: {
                id: id
            },
            type: "GET",
            success: function(data) {
                var json = JSON.parse(data);
                $('#updatenew').modal('show');
                $("input[name='pid']").val(json.id);
                $("input[name='name']").val(json.name);
                $("input[name='email']").val(json.email);
                $('#role option[value="' + json.role_ids + '"]').prop('selected', true);

            }
        })
    });
    $(document).ready(function() {
        $('#myforms').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                type: 'post',
                url: "staff/staff_update.php",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    if (data == 'success') {
                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });
                        $('#example1').DataTable().ajax.reload();
                        $('#dtable').DataTable().ajax.reload();
                        $("#msg").html('<span class="alert alert-success">staff is updated Successfully</span><br><br>');
                        setTimeout(function() {
                            $("#msg").html('');
                        }, 5000);

                    } else {
                        $("#msg2").html('<span class="alert alert-warning alert-dismissible fade show">staff is already exist</span><br><br>');
                        setTimeout(function() {
                            $("#msg2").html('');
                        }, 5000);
                    }
                }
            });
        })
    });
    $(document).on('click', '.btnDelete', function(event) {
        $('#delete').modal('show');
        var id = $(this).data('id');
        $(document).on('click', '.Delete', function(event) {
            event.preventDefault();
            $.ajax({
                url: "staff/staff_delete.php",
                data: {
                    id: id
                },
                type: "post",
                success: function(data) {
                    var d = JSON.parse(data);
                    if (d.result == 'success') {
                        $('#example1').DataTable().ajax.reload();
                        $('.modal').each(function() {
                            $(this).modal('hide');
                        });
                        $("#msg").html('<span class="alert alert-success">staff deleted Successfully</span><br><br>');
                        setTimeout(function() {
                            $("#msg").html('');
                        }, 5000);
                    } else {
                        $('#dtable').DataTable().ajax.reload();
                        $("#msg").html('<span class="alert alert-warning">staff not deleted</span><br><br>');
                        setTimeout(function() {
                            $("#msg").html('');
                        }, 5000);
                    }
                }
            })
        });
    });
</script>

</body>

</html>