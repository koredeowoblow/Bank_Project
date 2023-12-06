<?php
$fat = '3';
include "../funtion/header.php";
?>

<div class="content-wrapper animate__animated animate__fadeInDown  " style="height:fit-content ;">
    <!-- Content Header (Page header) -->
    <section class="content-header p-4">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-weight:500;">loans</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">loan activity</li>
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
                    <?php
                    $check = "SELECT * from loan_data where user_id='$user_id' ";
                    $result = mysqli_query($conn, $check);
                    while ($rows = mysqli_fetch_array($result)) {
                        if ($rows["status"] == "pending") {
                            echo '<div class="card">
                        <div class="card-header" style=" color:white;background-image: linear-gradient(to bottom right, yellow, #FFD700);">
                        <h4 class="card-title" style="font-size:150%;font-weight:600;">loan amount &#8358;' . $rows["principal"] . ' </h4>
                        <h4 class="card-title" style="font-size:150%;float:right;font-weight:600;">' . $rows["status"] . '</h4>
                        </div>
                       <div class="card-body">
                       <p class="ml-auto" style="text-align:left;color:black;font-size:15px;font-weight:500;float:left;">Total Amount to be Paid Back: &#8358;' . $rows['total_amount'] . '</p>
                      
                    </div>

                        </div>';
                        }
                        if ($rows["status"] == "approved") {
                            echo '<div class="card">
                            <div class="card-header" style=" color:white;background-image: linear-gradient(to bottom right, green, forestgreen);">
                            <h4 class="card-title" style="font-size:150%;font-weight:600;">loan amount  &#8358;' . $rows["principal"] . ' </h4>
                            <h4 class="card-title" style="font-size:150%;float:right;font-weight:600;">' . $rows["status"] . '</h4>
                            </div>
                           <div class="card-body">
                           <p class="ml-auto" style="text-align:left;color:black;font-size:15px;font-weight:500;float:left;">Total Amount to be Paid Back:  &#8358;' . $rows['total_amount'] . '</p>
    
                        </div>
    
                            </div>';
                        }
                        if ($rows["status"] == "disapproved") {
                            echo '<div class="card">
                            <div class="card-header" style=" color:white;background-image: linear-gradient(to bottom right, red,tomato );">
                            <h4 class="card-title" style="font-size:150%;font-weight:600;">loan amount  &#8358;' . $rows["principal"] . ' </h4>
                            <h4 class="card-title" style="font-size:150%;float:right;font-weight:600;">' . $rows["status"] . '</h4>
                            </div>
                           <div class="card-body">
                           <p class="ml-auto" style="text-align:left;color:black;font-size:15px;font-weight:500;float:left;">Total Amount to be Paid Back:  &#8358;' . $rows['total_amount'] . '</p>
    
                        </div>
    
                            </div>';
                        }
                    }


                    ?>

                    <div class="card">
                        <div class="card-header" style=" color:white;background-image: linear-gradient(to bottom right,springgreen,forestgreen);">
                            <h4 class="card-title" style="font-size:150%;"> </h4>
                        </div>
                        <?php
                        $check = "SELECT * from loan_data where user_id='$user_id' AND   `status` like 'pending%'  ";
                        $result = mysqli_query($conn, $check);
                        $rowcount = mysqli_num_rows($result);
                        if ($rowcount < 3) {
                            echo '                      <div class="card-body">


                            <h2>Loan Application Form</h2>

                            <form id="loanForm">

                                <div class="form-group">
                                    <label for="principal">Principal Amount:</label>
                                    <input type="number" class="form-control" name="principal" id="principal" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Loan Duration:</label>
                                    <input type="number" placeholder="Note the default duration is in weeks but still choose" class="form-control" name="duration" id="duration" required>
                                    <br>
                                    <select name="durationType" class="suit-select form-control" id="durationType" onchange="showDurationInput()" required>
                                        <option value=""></option>
                                        <option value="days">Days</option>
                                        <option value="weeks">Weeks</option>
                                        <option value="years">Years</option>
                                    </select>
                                    <!-- <label for="duration">Loan Duration:</label>
                                    <input type="number" class="form-control" name="duration" id="duration" required> -->
                                </div>
                                <div class="form-group">
                                    <div id="specificDurationContainer" style="display: none;">
                                        <label for="specificDuration">Specify Duration:</label>
                                        <input type="number" placeholder="put the same value as the first one" class="form-control" name="specificDuration" id="specificDuration" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nextOfKin">Next of Kin name:</label>
                                    <input type="text" class="form-control" name="nextOfKin" id="nextOfKin" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="nextOfKinPhone">Next of Kins Phone Number:</label>
                                    <input type="tel" name="nextOfKinPhone" class="form-control" id="nextOfKinPhone" required pattern="[0-9]{11}" placeholder="Enter 11-digit phone number"><br>
                                </div>

                                <button type="button" class="btn btn-block btn-success btn-tone" onclick="submitForm()">Submit</button>
                            </form>

                            <div id="resultContainer"></div>




                        </div>';
                        } else {
                            echo '<div class="card-body"><h5>cannot apply for another loan for now  </h5></div>';
                        }
                        ?>
                        <!-- <div class="card-body">


                            <h2>Loan Application Form</h2>

                            <form id="loanForm">

                                <div class="form-group">
                                    <label for="principal">Principal Amount:</label>
                                    <input type="number" class="form-control" name="principal" id="principal" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="duration">Loan Duration:</label>
                                    <input type="number" placeholder="Note the default duration is in weeks but still choose" class="form-control" name="duration" id="duration" required>
                                    <br>
                                    <select name="durationType" class="suit-select form-control" id="durationType" onchange="showDurationInput()" required>
                                        <option value=""></option>
                                        <option value="days">Days</option>
                                        <option value="weeks">Weeks</option>
                                        <option value="years">Years</option>
                                    </select>
                                     <label for="duration">Loan Duration:</label>
                                    <input type="number" class="form-control" name="duration" id="duration" required> 
                                </div>
                                <div class="form-group">
                                    <div id="specificDurationContainer" style="display: none;">
                                        <label for="specificDuration">Specify Duration:</label>
                                        <input type="number" placeholder="put the same value as the first one" class="form-control" name="specificDuration" id="specificDuration" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nextOfKin">Next of Kin name:</label>
                                    <input type="text" class="form-control" name="nextOfKin" id="nextOfKin" required><br>
                                </div>
                                <div class="form-group">
                                    <label for="nextOfKinPhone">Next of Kin's Phone Number:</label>
                                    <input type="tel" name="nextOfKinPhone" class="form-control" id="nextOfKinPhone" required pattern="[0-9]{11}" placeholder="Enter 11-digit phone number"><br>
                                </div>

                                <button type="button" class="btn btn-block btn-success btn-tone" onclick="submitForm()">Submit</button>
                            </form>

                            <div id="resultContainer"></div>




                        </div> -->

                    </div>
                </div>
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="loanDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <h5 class="modal-title " id="previewModalLabel">Loan Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="previewModalBody">
                <!-- Loan details will be displayed here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="proceedWithLoan()">Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong style="float: right;">
        &copy;<?php echo date('Y'); ?>
        <a href="#" style="color: forestgreen;">clarity bank </a>.</strong>
</footer>
<script src="../plugins/sweetalert2/sweetalert2.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<script>
    function showDurationInput() {
        var durationType = $('#durationType').val();
        if (durationType === 'days' || durationType === 'years') {
            $('#specificDurationContainer').show();
        } else {
            $('#specificDurationContainer').hide();
        }
    }




    function submitForm() {
        // Get form data
        var principal = $('#principal').val();
        var duration = $('#duration').val();
        var durationType = $('#durationType').val();
        var specificDuration = $('#specificDuration').val();
        var nextOfKin = $('#nextOfKin').val();
        var nextOfKinPhone = $('#nextOfKinPhone').val();

        // Validate form data (add additional validation as needed)
        if (principal <= 0 || duration <= 0 || nextOfKin.trim() === '' || !isValidPhoneNumber(nextOfKinPhone)) {
            alert("Invalid input. Please enter valid values for all fields.");
            return;
        }

        if ((durationType === 'days' || durationType === 'years') && specificDuration <= 0) {
            alert("Invalid duration input. Please enter a valid duration.");
            return;
        }

        // Use specific duration if applicable
        duration = (durationType === 'days' || durationType === 'years') ? specificDuration : duration;

        // Determine fixed interest rate based on duration
        var fixedInterestRate = getFixedInterestRate(durationType);

        // Calculate simple interest
        var interest = principal * fixedInterestRate * duration;
        // Calculate total amount to be paid back (principal + interest)
        var totalAmount = parseFloat(principal) + parseFloat(interest);

        // Display loan details in the preview modal
        showLoanPreview(principal, fixedInterestRate, duration, durationType, nextOfKin, nextOfKinPhone, interest, totalAmount);
    }

    function showLoanPreview(principal, fixedInterestRate, duration, durationType, nextOfKin, nextOfKinPhone, interest, totalAmount) {
        // Display loan details in the preview modal
        var previewModalBody = '<p>Loan Amount: &#8358;' + principal + '</p>';
        previewModalBody += '<p>Fixed Interest Rate: ' + fixedInterestRate * 100 + '%</p>';
        previewModalBody += '<p>Loan Duration: ' + duration + ' ' + durationType + '</p>';
        previewModalBody += '<p>Next of Kin: ' + nextOfKin + '</p>';
        previewModalBody += '<p>Next of Kin\'s Phone Number: ' + nextOfKinPhone + '</p>';
        previewModalBody += '<p>Simple Interest: &#8358;' + interest + '</p>';
        previewModalBody += '<p>Total Amount to be Paid Back: &#8358;' + totalAmount + '</p>';

        // Set modal content
        $('#previewModalBody').html(previewModalBody);

        // Show the preview modal
        $('#previewModal').modal('show');
    }

    function getFixedInterestRate(durationType) {
        // Define fixed interest rates based on duration type
        var interestRates = {
            days: 0.1, // 10%
            weeks: 0.06, // 6%
            years: 0.04 // 4%
        };

        return interestRates[durationType] || 0;
    }

    function proceedWithLoan() {
        // Get data from the form
        var principal = $('#principal').val();
        var fixedInterestRate = getFixedInterestRate($('#durationType').val());
        var duration = $('#duration').val();
        var durationType = $('#durationType').val();
        var specificDuration = $('#specificDuration').val();
        var nextOfKin = $('#nextOfKin').val();
        var nextOfKinPhone = $('#nextOfKinPhone').val();

        // Calculate total amount to be paid back (principal + interest)
        var interest = principal * fixedInterestRate * duration;
        var totalAmount = parseFloat(principal) + parseFloat(interest);

        // Send data to the server for database insertion
        sendToDatabase(principal, fixedInterestRate, duration, durationType, specificDuration, nextOfKin, nextOfKinPhone, interest, totalAmount);

        // Close the preview modal
        $('#previewModal').modal('hide');

        // Clear form fields
        clearForm();
        location.reload();
    }

    function sendToDatabase(principal, fixedInterestRate, duration, durationType, specificDuration, nextOfKin, nextOfKinPhone, interest) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'process_loan.php',
            data: {
                principal: principal,
                fixedInterestRate: fixedInterestRate,
                duration: duration,
                durationType: durationType,
                specificDuration: specificDuration,
                nextOfKin: nextOfKin,
                nextOfKinPhone: nextOfKinPhone,
                interest: interest
            },
            success: function(response) {
                // Display success message
                alert('Loan data saved successfully!');

                // Close the modal
                $('#loanDetailsModal').modal('hide');

                // Clear form fields
                clearForm();
            },

        });

        console.log('After AJAX request');
    }



    function clearForm() {
        // Clear form fields
        $('#principal').val('');
        $('#duration').val('');
        $('#durationType').val('days'); // Assuming default selection is 'days'
        $('#specificDuration').val('');
        $('#nextOfKin').val('');
        $('#nextOfKinPhone').val('');
    }

    function isValidPhoneNumber(phoneNumber) {
        // Validate the phone number format (you can adjust this based on your requirements)
        var phoneRegex = /^[0-9]{11}$/;
        return phoneRegex.test(phoneNumber);
    }
</script>
<!-- jQuery -->
</body>

</html>
<?php
//$path = "C:/xampp/htdocs/otel/back/funtion/footer.php";
//include($path);
?>