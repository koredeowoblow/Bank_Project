<?php
$fat = '2';
include "../funtion/header.php";
?>
<div class="content-wrapper animate__animated animate__fadeInDown  " style="height:fit-content ;">
    <!-- Content Header (Page header) -->
    <section class="content-header p-4">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-weight:500;">transactions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transfer activity</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section> <!-- Main content -->
    <section class="content">
        <div class="container ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style=" color:white;background-image: linear-gradient(to bottom right,springgreen,forestgreen);">
                            <h4 class="card-title" style="font-size:150%;">Transaction History</h4>
                        </div>
                        <div class="card-body">
                            <div class="fliud-container p-0 mx-4 row">
                                <div class='filtr-item  col-sm-12 p-1'>
                                    <span style="float:left;">

                                        <i class="nav-icon fas fa-arrow-down text-sm mx-2" style="color:green">Transfer in
                                            <?php
                                            require "../funtion/conn.php";
                                            $tid = $_SESSION['User_id'];
                                            $select = " SELECT sum(amount) as total FROM transactions where user_id='$tid' and transaction_nature='credit' ";
                                            $result = mysqli_query($conn, $select);
                                            $row = $result->fetch_assoc();
                                            $output = '&#8358;' . number_format($row["total"], 2);
                                            echo $output;
                                            ?>
                                        </i>
                                        <i class="nav-icon fas fa-arrow-up text-sm" style="color: darkred;">
                                            Transfer out
                                            <?php
                                            require "../funtion/conn.php";
                                            $tid = $_SESSION['User_id'];
                                            $select = " SELECT sum(amount) as total FROM transactions where user_id='$tid' and transaction_nature='debit' ";
                                            $result = mysqli_query($conn, $select);
                                            $row = $result->fetch_assoc();
                                            $output = '&#8358;' . number_format($row["total"], 2);
                                            echo $output;
                                            ?>
                                        </i>
                                    </span>

                                </div>
                                <div class="col-sm-12" id="sow">


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</div>
<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content ">
            <div class="modal-body" style="font-family: Arial, sans-serif;background-color: #fff;margin: 0;padding: 0;">
                <div class="receipt" style="max-width: 500px;padding: 20px;background-color: #fff;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);border-radius: 5px;">
                    <div class="header" style="text-align: center; margin-bottom: 20px;">
                        <h2 style="color:forestgreen;font-weight:600;">Clarity Bank Receipt</h2>
                        <p style=" color: #555; margin: 8px 0;">Your Trusted Banking Partner</p>
                    </div>

                    <div class="info" style="margin-bottom: 20px;">
                        <p style=" color: #555; margin: 8px 0;"><strong>Date:</strong><span id="receiptDate"></span> </p>
                        <p style=" color: #555; margin: 8px 0;"><strong>Account Number:</strong> <?php echo  $_SESSION['phone_number']; ?></p>
                    </div>

                    <div class="details" style=" border-top: 1px solid #ccc;margin-top: 20px;padding-top: 20px;">
                        <p style=" color: #555; margin: 8px 0;"><strong style="color: #333;">Amount: </strong> &#8358;<span id="transferAmount"></span></p>
                        <p style=" color: #555; margin: 8px 0;"><strong style="color: #333;">Recipient: </strong><span id="recipientName"></span> </p>
                        <p style=" color: #555; margin: 8px 0;"><strong style="color: #333;">Bank: </strong><span id="recipientBank_name"></span> </p>
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
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>
        &copy;<?php echo date('Y'); ?>
        <a href="https://adminlte.io" style="color: forestgreen;">clarity bank </a>.</strong>
</footer>



<script src="../plugins/jquery/jquery.min.js"></script>

<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<script>
    $(document).ready(function() {
        var id = "<?php echo  $_SESSION['User_id']; ?>"
        $.ajax({
            url: "transaction_fetch.php",
            data: {
                id: id
            },
            type: "POST",
            success: function(data) {
                $('#sow').html(data);
            }
        });
    });

    function show_more(y) {
        var id = document.getElementById('total' + y);
        $.ajax({
            url: "transaction_fetchs.php",
            data: {
                y: y,
            },
            type: "GET",
            success: function(data) {
                $('#sow').html(data);
            }
        })
    }

    $(document).on('click', '#editbtn', function(event) {
        var id = $(this).data('id');
        $.ajax({
            url: "transaction_fetch_single.php",
            data: {
                id: id
            },
            type: "GET",
            success: function(data) {
                var json = JSON.parse(data);
                $("#receiptDate").text(new Date().toLocaleString());
                $("#recipientName").text(json.r_details.account_name);
                $("#transferAmount").text(+json.amount);
                $("#recipientBank_name").text(json.r_details.bank_name);
                $("#recipientAccount_number").text(json.r_details.account_number);
                $("#transfer_refence").text(json.reference_number);
                // Display the transaction history in the modal
                $('#receiptModal').modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false
                });

                // // Show recipient bank details in the modal
                // var recipientDetailsHtml = "Recipient Bank: " + json.recipient_bank_details.bank_name +
                //     ", Account Number: " + json.recipient_bank_details.account_number;
                // $('#recipientBankDetails').html(recipientDetailsHtml);

                // // Show recipient bank details in the printable receipt
                // $('#sowPrint').html(recipientDetailsHtml);
            }
        });
    });

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
    // $('#receiptModal').on('hidden.bs.modal', function() {
    //     // Redirect to the home page when the modal is closed without printing

    // })
</script>
<!-- jQuery -->
</body>

</html>
<?php
//$path = "C:/xampp/htdocs/otel/back/funtion/footer.php";
//include($path);
?>