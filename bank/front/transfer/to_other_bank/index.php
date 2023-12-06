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
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../../assets/vendors/choices.js/choices.min.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../..assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/app.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2/sweetalert2.css">
    <!-- <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.css">-->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2/sweetalert2.min.css">


    <!-- <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.css">-->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.css">
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="shortcut icon" href="../../dist/img/logo1.jpg" type="image/x-icon">
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
                        <a class="font-weight-bold  my-3 ml-auto" style="color:white; text-decoration:underline;font-size:90%;text-align:right;" href=""> history</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="col-9 m-auto">
        <p class="font-weight-bold mx-1  my-3" style="font-size: 100%;">search recipient</p>
        <form action="" id="myform" method="post">
            <div class="form-group">
                <p>select bank name </p>
                <select id="bankCode" required name="bankCode" class="choices form-select">
                    <option value="">Select Bank</option>
                    <?php
                    $sql = "SELECT * from banks";
                    $run = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($run) > 0) {
                        while ($row = mysqli_fetch_array($run)) {
                            $bank_code = $row['bank_code'];
                            $bank_name = $row['bank_name'];
                            echo " <option value=" . $bank_code . ">" . $bank_name . "</option>";
                        }
                    }

                    ?>
                </select>
            </div>
            <div class="form-group">
                <p>enter account number</p>
                <input type="text" class="form-control" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57) ' oninput="search_account_number()" placeholder="Enter Account Number" name="account_number" id="acct_number">
                <!-- Add this div for the loading spinner -->
                <div class="loading-spinner" style="display: none;float:right;color:forestgreen;font-weight:500;">
                    <i class="fas fa-spinner fa-spin"></i> Checking Account...
                </div>
                <p class="acct_name p-1 " style="float:right;color:forestgreen;font-weight:500;"></p>
            </div>
            <div class="form-group">
                <p>reason</p>
                <input type="text" class="form-control reason" placeholder="Enter " name="reason" id="reason">
            </div>
            <div class="form-group">
                <p>enter amount</p>
                <input type="text" hidden class="form-control p-3" name="id">
                <input type="number" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57) ' class="form-control" placeholder="Enter Amount " oninput="amounts()" name="amount" id="accts">
            </div>
            <div class="form-group p-1">
                <p id="msg"></p>
                <button class="btn btn-block bg-green send " style="display:none;font-weight: bold;font-size:large;">Transfer</button>
            </div>

        </form>
    </div>
    <!-- Pin Entry Modal -->
    <div class="modal fade" id="pinEntryModal" tabindex="-1" role="dialog" aria-labelledby="pinEntryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pinEntryModalLabel">Enter Pin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pinInput">Pin:</label>
                        <input type="password" class="form-control" id="pinInput">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmPinBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- enter modal stop -->



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
    <script src="../../plugins/select2/js/select2.min.js"></script>
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <script src="../../assets/vendors/choices.js/choices.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
    <script>
        $(function days() {
            $("input[name='id']").val("<?php echo $_SESSION["User_id"]; ?>");
        });

        function amounts() {
            var amount = document.getElementById("accts").value;
            var id = <?php echo $_SESSION['User_id'] ?>;
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

        function search_account_number() {
            var bankCode = document.getElementById("bankCode").value;
            var acct_number = document.getElementById("acct_number").value;
            $(".loading-spinner").show();
            $(".acct_name").html("");

            // Check if the account number has exactly 11 digits
            if (acct_number.length === 10) {
                fetch("check.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: "bankCode=" + encodeURIComponent(bankCode) +
                            "&acct_number=" + encodeURIComponent(acct_number)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.result === 'success' && data.data.status) {
                            // Accessing the account name from the response
                            const accountName = data.data.data.account_name;

                            // Displaying the account name
                            $(".loading-spinner").hide();
                            $(".acct_name").html(accountName);

                        } else {
                            $(".acct_name").html("account not found");
                        }
                    })
                    .catch(error => {
                        console.error("Error processing payment:", error);
                        $("#msg1").html('<span class="alert alert-danger alert-dismissible fade show">An error occurred during the transaction</span><br><br>');
                        setTimeout(function() {
                            $("#msg1").html('');
                        }, 5000);
                    });
            } else if (acct_number.length < 1) {
                $(".loading-spinner").hide();
                $(".acct_name").html("");
                $(".act_name").html("");
                $(".acct_number").html("");
            } else if (acct_number.length > 10) {
                $(".loading-spinner").hide();
                $(".acct_name").html("Account number must be 10 digits ");
                $(".act_name").html("");
                $(".acct_number").html("");
            }
        }



        function home() {
            window.location = "../";
        }
        $(document).on('click', '.send', function(event) {
            event.preventDefault();
            var amount = document.getElementById("accts").value;
            var bankCode = document.getElementById("bankCode").value;
            var acct_number = document.getElementById("acct_number").value;
            var acct_name = document.getElementsByClassName("acct_name").value;
            var reason = document.getElementsByClassName("reason").value;


            // Proceed with creating recipient code
            fetch("create_reference.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: "bankCode=" + encodeURIComponent(bankCode) +
                        "&acct_number=" + encodeURIComponent(acct_number) +
                        "&acct_name=" + encodeURIComponent(acct_name)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.result === 'success' && data.data.status) {
                        // Accessing the account name from the response
                        const recipient_code = data.data.data.recipient_code;

                        // Displaying the account name
                        $(".acct_name").html(acct_name);
                        $(".acct_numbers").html(acct_number);

                        // Show the pin entry modal
                        $('#pinEntryModal').modal('show');

                        // Handle Confirm button click
                        $('#confirmPinBtn').on('click', function() {
                            // Get the entered pin
                            var pin = $('#pinInput').val();

                            // Check if the pin is empty or not a number
                            if (pin === "" || isNaN(pin)) {
                                alert("Invalid pin. Please enter a valid numeric pin.");
                                return;
                            }

                            // Proceed with sending pin and other details to transfer.php
                            sendToTransferPHP(pin, acct_number, amount, recipient_code);

                            // Hide the pin entry modal
                            $('#pinEntryModal').modal('hide');
                        });
                    } else {
                        $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">Incorrect pin</span><br><br>');
                        setTimeout(function() {
                            $("#msg1").html('');
                        }, 5000);
                    }
                })
                .catch(error => {
                    console.error("Error processing payment:", error);
                    $("#msg1").html('<span class="alert alert-danger alert-dismissible fade show">An error occurred during the transaction</span><br><br>');
                    setTimeout(function() {
                        $("#msg1").html('');
                    }, 5000);
                });
        });

        function sendToTransferPHP(pin, acct_number, amount, recipient_code) {
            var reason = document.querySelector(".reason").value;
            var acct_name = document.querySelector(".acct_name").innerText;
            var bankCode = document.getElementById("bankCode").value;


            // Now you have the pin, proceed with the fetch request to transfer.php
            fetch("transfer.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: "pin=" + encodeURIComponent(pin) +
                        "&acct_name=" + encodeURIComponent(acct_name) +
                        "&acct_number=" + encodeURIComponent(acct_number) +                        
                        "&amount=" + encodeURIComponent(amount) +
                        "&bank_code=" + encodeURIComponent(bankCode) +
                        "&recipient_code=" + encodeURIComponent(recipient_code) +
                        "&reason=" + encodeURIComponent(reason)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.result === 'success') {
                        Swal.fire({
                                icon: 'success',
                                title: 'Transfer Successful!',
                                text: 'The transfer has been completed successfully.',
                            })
                            .then(() => {
                                document.getElementById("myform").reset();
                                document.getElementById("pinInput").reset();
                                $(".acct_name").html("");
                            });
                    } else {
                        $("#msg1").html('<span class="alert alert-warning alert-dismissible fade show">Incorrect pin</span><br><br>');
                        setTimeout(function() {
                            $("#msg1").html('');
                        }, 5000);
                    }
                })
                .catch(error => {
                    console.error("Error processing transfer:", error);
                    $("#msg1").html('<span class="alert alert-danger alert-dismissible fade show">An error occurred during the transfer</span><br><br>');
                    setTimeout(function() {
                        $("#msg1").html('');
                    }, 5000);
                });
        }
        // Add an event listener to the bankCode dropdown
    </script>
</body>

</html>