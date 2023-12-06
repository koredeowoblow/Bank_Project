<?php
include "../funtion/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $principal = isset($_POST["principal"]) ? floatval($_POST["principal"]) : 0;
    $fixedInterestRate = isset($_POST["fixedInterestRate"]) ? floatval($_POST["fixedInterestRate"]) : 0;
    $duration = isset($_POST["duration"]) ? intval($_POST["duration"]) : 0;
    $durationType = isset($_POST["durationType"]) ? $_POST["durationType"] : '';
    $specificDuration = isset($_POST["specificDuration"]) ? intval($_POST["specificDuration"]) : 0;
    $nextOfKin = isset($_POST["nextOfKin"]) ? $_POST["nextOfKin"] : '';
    $nextOfKinPhone = isset($_POST["nextOfKinPhone"]) ? $_POST["nextOfKinPhone"] : '';
    $interest = isset($_POST["interest"]) ? floatval($_POST["interest"]) : 0;

    $user_id = $_SESSION['User_id'];


    // Validate form data (add additional validation as needed)
    if ($principal <= 0 || $fixedInterestRate <= 0 || $duration <= 0 || $nextOfKin === '' || $nextOfKinPhone === '') {
        die("Invalid input. Please enter valid values for all fields.");
    }


    if (($durationType === 'days' || $durationType === 'years') && $specificDuration <= 0) {
        die("Invalid duration input. Please enter a valid duration.");
    }

    // Use specific duration if applicable
    $duration = ($durationType === 'days' || $durationType === 'years') ? $specificDuration : $duration;

    // Calculate simple interest
    $interest = $principal * $fixedInterestRate * $duration;
    $totalAmount = $principal + $interest;

    $check = "SELECT * from loan_data where user_id='$user_id' ";
    $result = mysqli_query($conn, $check);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount < 3) {
        $sql = "INSERT INTO loan_data (principal, user_id, fixed_interest_rate, duration, duration_type, specific_duration, next_of_kin, next_of_kin_phone, `interest`, total_amount) VALUES ('$principal', '$user_id', '$fixedInterestRate', '$duration', '$durationType', '$specificDuration', '$nextOfKin', '$nextOfKinPhone', '$interest', $totalAmount)";

        if ($conn->query($sql) === TRUE) {
            
            $output = 'success';
           
        } else {
          
            $output = 'failed';
           
        }
    } else {
        $output = 'excess';
       
    }

    // Save data to SQL database


    echo $output;
} else {
    // Handle invalid request method
    // http_response_code(405);
    // echo "Method Not Allowed";
    $output = 'failed';
    echo ($output);
}
