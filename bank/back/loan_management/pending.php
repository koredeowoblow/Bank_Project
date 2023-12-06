<?php
$fat = '7';
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
                    <h3 style="color:#607080;">pending loan</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end" style="color:#607080;">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" style="color:#607080;" aria-current="page">pending loans</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 table  " style="justify-self:center;color:dodgerblue">


                <!-- /.card-header -->

                <div id="msg"></div>
                <table id="example1" class="table m-3 table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>fullname</th>
                            <th>loan amount</th>
                            <th> loan duaration</th>
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
</div>


<!-- update modal start -->
<div class="modal fade" id="updatenew">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content" style="color:black;">
            <div class="modal-header bg-primary" style="color:white;font-weight:600;">
                <h5 class="modal-title" style="color:white" id="mods">loan info</h5>

            </div>
            <div class="modal-body" id="updatenewbody">
                <div id="msg2"></div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-tone m-r-10" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- update modal stop -->

<footer class="main-footer">
    <div class="footer clearfix text-muted">
        <div class="float-end">
            <p>2021 &copy; clarity</p>
        </div>

    </div>
</footer>



<script src="../assets/js/pages/dashboard.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/vendors/fontawesome/all.min.js"></script>=
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

            "ajax": {
                url: "loan/p_fetch.php",
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



    $(document).on('click', '#editbtn', function(event) {
        var id = $(this).data('id');
        $.ajax({
            url: "loan/get_single_loan.php",
            data: {
                id: id
            },
            type: "GET",
            success: function(data) {
                var json = JSON.parse(data);
                var previewModalBody = '<p>Loan Amount: &#8358;' + json.principal + '</p>';
                previewModalBody += '<p>Fixed Interest Rate: ' + json.fixed_interest_rate * 100 + '%</p>';
                previewModalBody += '<p>Loan Duration: ' + json.duration + ' ' + json.duration_type + '</p>';
                previewModalBody += '<p>Next of Kin: ' + json.next_of_kin + '</p>';
                previewModalBody += '<p>Next of Kin\'s Phone Number: ' + json.next_of_kin_phone + '</p>';
                previewModalBody += '<p>Simple Interest: &#8358;' + json.interest + '</p>';
                previewModalBody += '<p>Total Amount to be Paid Back: &#8358;' + json.total_amount + '</p>';
                $('#updatenewbody').html(previewModalBody);
                $('#updatenew').modal('show');
            }
        })
    });
    $(document).on('click', '#approvebtn', function(event) {
        var id = $(this).data('id');
        $.ajax({
            url: "loan/get_single_loan.php",
            data: {
                id: id
            },
            type: "GET",
            success: function(data) {
                var json = JSON.parse(data);
                var previewModalBody = '<p>Loan Amount: &#8358;' + json.principal + '</p>';
                previewModalBody += '<p>Fixed Interest Rate: ' + json.fixed_interest_rate * 100 + '%</p>';
                previewModalBody += '<p>Loan Duration: ' + json.duration + ' ' + json.duration_type + '</p>';
                previewModalBody += '<p>Next of Kin: ' + json.next_of_kin + '</p>';
                previewModalBody += '<p>Next of Kin\'s Phone Number: ' + json.next_of_kin_phone + '</p>';
                previewModalBody += '<p>Simple Interest: &#8358;' + json.interest + '</p>';
                previewModalBody += '<p>Total Amount to be Paid Back: &#8358;' + json.total_amount + '</p>';
                previewModalBody += ' <a  id="approvedbtn" class="btn btn-block btn-success btn-tone " data-id=' + json.id + ' value="Submit">approve loan</a>'
                $('#updatenewbody').html(previewModalBody);
                $('#updatenew').modal('show');
            }
        })
    });

    $(document).on('click', '#rejectbtn', function(event) {
        var id = $(this).data('id');
        $.ajax({
            url: "loan/get_single_loan.php",
            data: {
                id: id
            },
            type: "GET",
            success: function(data) {
                var json = JSON.parse(data);
                var previewModalBody = '<p>Loan Amount: &#8358;' + json.principal + '</p>';
                previewModalBody += '<p>Fixed Interest Rate: ' + json.fixed_interest_rate * 100 + '%</p>';
                previewModalBody += '<p>Loan Duration: ' + json.duration + ' ' + json.duration_type + '</p>';
                previewModalBody += '<p>Next of Kin: ' + json.next_of_kin + '</p>';
                previewModalBody += '<p>Next of Kin\'s Phone Number: ' + json.next_of_kin_phone + '</p>';
                previewModalBody += '<p>Simple Interest: &#8358;' + json.interest + '</p>';
                previewModalBody += '<p>Total Amount to be Paid Back: &#8358;' + json.total_amount + '</p>';
                previewModalBody += ' <button id="rejectedbtn" class="btn btn-block btn-danger btn-tone " data-id=' + json.id + ' value="Submit">reject  loan</button>'
                $('#updatenewbody').html(previewModalBody);
                $('#updatenew').modal('show');
            }
        })
    });
    $(document).on('click', '#approvedbtn', function(event) {
        var id = $(this).data('id');
        $.ajax({
            url: "loan/approve.php",
            data: {
                id: id
            },
            type: "POST",

            success: function(data) {
                var d = JSON.parse(data);
                if (d.result == 'success') {
                    $('#example1').DataTable().ajax.reload();
                    $('.modal').each(function() {
                        $(this).modal('hide');
                    });
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "loan approved successfully"
                    })
                } else {
                    $("#msg2").html('<span class="alert alert-warning alert-dismissible fade show">error occurred</span><br><br>');
                    setTimeout(function() {
                        $("#msg2").html('');
                    }, 5000);

                }
            }
        })


    });
    $(document).on('click', '#rejectedbtn', function(event) {
        var id = $(this).data('id');
        $.ajax({
            url: "loan/disapproved.php",
            data: {
                id: id
            },
            type: "POST",
            success: function(data) {
                var d = JSON.parse(data);
                if (d.result == 'success') {
                    $('#example1').DataTable().ajax.reload();
                    $('.modal').each(function() {
                        $(this).modal('hide');
                    });
                    F
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "loan disapproved "
                    })
                } else {
                    $("#msg2").html('<span class="alert alert-warning alert-dismissible fade show">error occured </span><br><br>');
                    setTimeout(function() {
                        $("#msg2").html('');
                    }, 5000);

                }
            }
        })


    });
</script>

</body>

</html>