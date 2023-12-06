<?php
include "../../funtion/conn.php";
session_start();
if (!isset($_SESSION['User_id'])) {
    header("location:../index.php");
    die();
}
$fat = '1';
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
    <title>Document</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/animation/animate.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="shortcut icon" href="../../dist/img/logo1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.css">

</head>

<body class=" layout-fixed    text-capitalize  layout-footer-fixed" style="background-color:white;">
    <header class="navbar-light  col-sm-12 " style="background-image: linear-gradient(to bottom right,springgreen,forestgreen);overflow: hidden;">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="row d-flex ">
                    <div class="col-sm-12 d-flex">
                        <button class="btn btn-transparent" onclick="home()" style="color:black;">
                            <i class="fas fa-less-than "></i>
                        </button>
                        <p class="my-3" style="font-size:119%; color:white;font-weight:500;">transfer to clarity bank</p>
                        <a class="font-weight-bold  my-3 ml-auto" style="color:white; text-decoration:underline;font-size:90%;text-align:right;" href="../../transactions/index.php"> history</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="col-9 m-auto">
        <p class="font-weight-bold mx-1  my-3" style="font-size: 100%;">search recipient</p>
        <form action="" id="myform" method="post">
            <div class="form-group p-1">
                <input type="text" class="form-control" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57) ' oninput="search_account_number()" placeholder="Enter Account Number" name="account_number" id="acct">
                <div class="loading-spinner" style="display: none;float:right;color:forestgreen;font-weight:500;">
                    <i class="fas fa-spinner fa-spin"></i> Checking Account...
                </div>
                <p class="acct_name p-1 " style="float:right;color:forestgreen;font-weight:500;"></p>
            </div>
            <div class="form-group p-1">
                <input type="text" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57) ' class="form-control" hidden class="p-2 " name="id" id="id">
                <input type="number" class="form-control" placeholder="Enter Amount " oninput="amounts()" name="amount" id="accts">
            </div>
            <div class="form-group p-1">
                <p id="msg"></p>
                <button class="btn btn-block bg-green send " style="display:none;font-weight: bold;font-size:large;">Transfer</button>
            </div>

        </form>
    </div>
    <!-- enter modal start -->
    <div class="modal  fade" id="enterrpin">
        <div class="modal-dialog">
            <div class="modal-content enter_head">
                <div class="modal-header bg-green">
                    <h5 class="modal-title " id="exampleModalLabel">Detailed review</h5>

                    <button type="button" class="close bg-red" data-dismiss="modal">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="msg1"></div>
                    <div class="col-10 p- mx-4 info">

                        <div class="col-10 d-flex">

                            <p class="mr-auto" style="font-weight: 600; font-size:large; ">
                                Account Name:
                            </p>

                            <p class=" act_name ml-5" style="font-weight: 600;">

                            </p>
                        </div>

                        <div class="col-10 d-flex">
                            <p class="mr-auto" style="font-weight: 600; font-size:large; ">
                                Account Number:
                            </p>
                            <p class="acct_number ml-5" style="font-weight: 600;">
                            </p>
                        </div>

                        <div class="col-10 d-flex">
                            <p class="mr-auto" style="font-weight: 600; font-size:large; ">
                                Amount:
                            </p>
                            <p class="amounts ml-5" style="font-weight: 600;">
                            </p>
                        </div>
                    </div>
                    <button class="btn  btn-block bg-green proceed ">proceed</button>
                    <form action="" id="myforms" method="post">
                        <div class="form-group">
                            <input type="number" class="form-control" hidden placeholder="Enter Account Number" name="account_numbered" id="accted">
                            <p class="acct_name p-1 " hidden style="float:right;color:forestgreen;font-weight:500;"></p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" hidden class="p-2" name="ids" id="id">
                            <input type="number" class="form-control" hidden placeholder="Enter Amount " name="amounted" id="accteds">
                        </div>


                        <div class="form-group pin">
                            <input type="password" class="form-control" required autocomplete="of" placeholder="Enter Transaction Pin  " name="pin" id="pin">
                        </div>

                        <button type="submit" class=" btn btn-block bg-green  Confirm " id="ban" style="float:right;">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- enter modal stop -->
    <!-- receipt modal start -->
    <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-body" style="font-family: Arial, sans-serif;background-color: #fff;margin: 0;padding: 0;">
                    <div class="receipt" style="max-width: 500px;padding: 20px;background-color: #fff;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);border-radius: 5px;">
                        <div class="header" style="text-align: center; margin-bottom: 20px;">
                            <h2 style="color:forestgreen;font-weight:600;">Clarity Bank Receipt</h2>
                            <p style=" color: #555; margin: 8px 0;">Your Trusted Banking Partner</p>
                        </div>

                        <div class="infos" style="margin-bottom: 20px;">
                            <p style=" color: #555; margin: 8px 0;"><strong>Date:</strong><span id="receiptDate"></span> </p>
                            <p style=" color: #555; margin: 8px 0;"><strong>Account Number:</strong> <?php echo  $_SESSION['phone_number']; ?></p>
                        </div>

                        <div class="details" style=" border-top: 1px solid #ccc;margin-top: 20px;padding-top: 20px;">
                            <p style=" color: #555; margin: 8px 0;"><strong style="color: #333;">Amount: </strong> &#8358;<span id="transferAmount"></span></p>
                            <p style=" color: #555; margin: 8px 0;"><strong style="color: #333;">Recipient: </strong><span id="recipientName"></span> </p>
                            <p style=" color: #555; margin: 8px 0;"><strong style="color: #333;">Bank: clarity bank</span> </p>
                            <p style=" color: #555; margin: 8px 0;"><strong style="color: #333;">Recipient Account number: </strong> <span id="recipientAccount_number"></span> </p>
                            <p style=" color: #555; margin: 8px 0;"><strong style="color: #333;">Reference: </strong><span id="transfer_refence"></span></p>
                        </div>

                        <div class="footer" style=" margin-top: 20px;text-align: center;">
                            <p style=" color: #555; margin: 8px 0;">Thank you for banking with Clarity Bank!</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <!-- Add a button to trigger the print -->
                        <button class="btn btn-success" onclick="printReceipt()">Print Receipt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- receipt modal stop -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <script>
        function search_account_number() {
            var account_number = document.getElementById("acct").value;
            $(".loading-spinner").show();
            $(".acct_name").html("");
            $(".act_name").html("");
            $(".acct_number").html("");
            if (account_number.length === 10 || account_number.length === 11) {
                $.ajax({
                    url: "find_acct.php",
                    data: {
                        account_number: account_number,

                    },
                    type: "GET",
                    success: function(data) {
                        var json = JSON.parse(data);
                        if (json.result == 'false') {
                            $(".loading-spinner").hide();
                            $(".acct_name").html("account not found");
                            $(".act_name").html("");
                            $(".acct_number").html("");
                        } else {
                            var json = JSON.parse(data);
                            $(".loading-spinner").hide();
                            $(".acct_name").html(json.fullname);
                            $(".act_name").html(json.fullname);
                            $(".acct_number").html(json.phone_number);
                            $("input[name='id']").val("<?php echo $_SESSION["User_id"]; ?>");
                        }
                    }
                });
            } else if (account_number.length < 1) {
                $(".loading-spinner").hide();
                $(".acct_name").html("");
                $(".act_name").html("");
                $(".acct_number").html("");
            } else if (account_number.length > 11) {
                $(".loading-spinner").hide();
                $(".acct_name").html("Account number must be 10 digits or 11 digit");
                $(".act_name").html("");
                $(".acct_number").html("");
            }
        }

        function amounts() {
            var amount = document.getElementById("accts").value;
            var id = document.getElementById("id").value;
            $.ajax({
                url: "check-amount.php",
                data: {
                    amount: amount,
                    id: id
                },
                type: "GET",
                success: function(data) {
                    var d = JSON.parse(data);
                    if (d.result == 'true') {
                        $('.send').show();

                        $("#msg").html('');

                    }
                    if (d.result == 'false') {
                        $('.send').hide();
                        $("#msg").html('<span class="alert alert-danger">Account balance is less than amount inputed</span><br><br>');
                        setTimeout(function() {
                            $("#msg").html('');
                        }, 5000);

                    }
                    if (d.result == 'fail') {
                        $('.send').hide();
                        $("#msg").html('<span class="alert alert-danger">Please input Account Number </span><br><br>');
                        setTimeout(function() {
                            $("#msg").html('');
                        }, 5000);

                    }
                }
            });


        }

        function home() {
            window.location = "../";
        }
        $(document).on('click', '.send', function(event) {
            event.preventDefault();
            var ramount = document.getElementById("accts").value;
            var racct = document.getElementById("acct").value;
            $("input[name='ids']").val("<?php echo $_SESSION["User_id"]; ?>");
            $("input[name='account_numbered']").val(racct);
            $("input[name='amounted']").val(ramount);
            $('#enterrpin').modal('show');
            $('.pin').hide();
            $('.Confirm').hide();
            $('.amounts').html("&#8358;" + ramount);

            $(document).on('click', '.proceed', function(event) {
                event.preventDefault();
                $('.info').hide();
                $('.proceed').hide();
                $('.pin').show();
                $('.modal-title').html("");
                $('.Confirm').show();
                $('.modal-title').html("enter pin");

            });
        });


        $(document).on('click', '.Confirm', function(event) {
            event.preventDefault();
            $.ajax({
                url: "transfer.php",
                data: new FormData($('#myforms')[0]),
                type: "post",
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {

                    if (data.result == "success") {
                        $('#enterrpin').modal('hide');
                        $('.modal-title').html("");
                        $('.enter_head').html("");
                        // Transfer successful, set values in the printable receipt
                        var ramount = document.getElementById("accts").value;
                        var racct = document.getElementById("acct").value;
                        var recipientName = $(".acct_name").text();


                        // Set values in the printable receipt
                        $("#receiptDate").text(new Date().toLocaleString());
                        $("#recipientName").text(recipientName);
                        $("#recipientAccount_number").text(data.acct_number);
                        $("#transferAmount").text(+ramount);
                        $("#transfer_refence").text(data.reference);
                        $("#receiptDate").text(data.date);


                        // Show the receipt modal with a fade-in animation
                        $('#receiptModal').modal({
                            show: true,
                            backdrop: 'static',
                            keyboard: false
                        });

                        // Clear the form
                        $('#myform')[0].reset();
                    } else {
                        $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">Incorrect pin</span><br><br>');
                        setTimeout(function() {
                            $("#msg1").html('');
                        }, 5000);
                    }
                }
            });
        });

        // Function to print the receipt modal
        function printReceipt() {
            // Clone the content of the receipt modal
            var printableContent = $('#receiptModal .modal-content').clone();

            // Create a new window and append the cloned content
            var printWindow = window.open('', '_blank');
            printWindow.document.body.innerHTML = printableContent.html();

            // Add print styles
            var printStyles = `
            body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .receipt {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 20px;
        }
        .modal-footer {
                display: none;
        }
        .details {
            border-top: 1px solid #ccc;
            margin-top: 20px;
            padding-top: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        h2 {
            color: forestgreen;
        }
        strong {
            color: #333;
        }
        p {
            color: #555;
            margin: 8px 0;
        }
        `;
            var styleSheet = printWindow.document.createElement("style");
            styleSheet.type = "text/css";
            styleSheet.innerText = printStyles;
            printWindow.document.head.appendChild(styleSheet);

            // Trigger the print functionality for the new window
            printWindow.print();

            // Close the new window after printing
            printWindow.onafterprint = function() {
                printWindow.close();

            };
        }
    </script>
</body>

</html>