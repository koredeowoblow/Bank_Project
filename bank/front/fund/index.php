<?php
include "../funtion/conn.php";

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
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.css">
    <!-- <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.css">-->
    <link rel="stylesheet" href="../plugins/select2/css/select2.css">
    <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">


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
                        <p class="my-3 text-bold text-lg">transfer to clarity bank</p>
                        <a class="font-weight-bold  my-3 ml-auto" style="color:white; text-decoration:underline;font-size:90%;text-align:right;" href=""> history</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="col-9 m-auto">
        <p class="font-weight-bold mx-s text-bold text-lg my-3 p-1" style="font-size: 100%;margin-left: 12%;">fund account</p>
        <form id="paymentForm" class="col-9 m-auto p-3">

            <label for="amount">Amount (NGN):</label>
            <input type="number" id="amount" class="form-control p-2" name="amount" required><br>


            <button type="submit" class="btn btn-block btn-success text-bold text-lg"> fund account </button>
        </form>

    </div> <!-- enter modal start -->

    <!-- enter modal stop -->

    <!-- Add this HTML for the Bootstrap modal -->
    <div class="modal fade" id="paystackModal" tabindex="-1" role="dialog" aria-labelledby="paystackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paystackModalLabel">Paystack Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Iframe to load Paystack payment page -->
                    <iframe src="" width="100%" height="600" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/select2/js/select2.min.js"></script>

    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.js"></script>

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <!-- <script src="../plugins/select2/js/select2.full.min.js"></script>
       AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", (event) => {
            event.preventDefault();
            fetchSecretKeyAndPay();
        }, false);

        function fetchSecretKeyAndPay() {
            fetch("get_secret_key.php", {
                    method: "POST",
                    body: new FormData(paymentForm),
                    cache: "no-store"
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.result === 'success') {
                        payWithPaystack(data.amount, data.email, data.publicKey);
                    }
                })
                .catch(error => {
                    console.error("Error fetching secret key:", error);
                    showSweetAlert("An error occurred during the transaction", false);
                });
        }

        function payWithPaystack(amount, email, publicKey) {
            let handler = PaystackPop.setup({
                key: publicKey,
                email: email,
                amount: amount * 100,
                ref: 'VS' + Math.floor((Math.random() * 1000000000) + 1),
                onClose: () => {
                    alert('Window closed.');
                },
                callback: (response) => {
                    let reference = response.reference;
                   

                    save(reference, amount);
                    clearForm();
                }
            });

            handler.openIframe();
        }

        function showSweetAlert(message, success) {
            if (success) {
                Swal.fire({
                    icon: 'success',
                    title: "Success",
                    text: message,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message,
                });
            }
        }

        function clearForm() {
            paymentForm.reset();
        }

        function home() {
            window.location = "../home/index.php";
        }

        function save(reference) {
            // Make a request to process_payment.php with the reference
            fetch("process_payment.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: "reference=" + encodeURIComponent(reference),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.result === 'success') {
                        showSweetAlert("funding  successful!", true);
                        // Additional logic if needed after successful payment
                    } else {
                        showSweetAlert("funding failed. Please try again.", false);
                    }
                })
                .catch(error => {
                    console.error("Error processing payment:", error);
                    showSweetAlert("An error occurred during the transaction", false);
                });
        }
    </script>

</body>

</html>