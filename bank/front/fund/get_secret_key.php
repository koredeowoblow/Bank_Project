<?php
session_start();
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
$amount = isset($_POST['amount']) ? $_POST['amount'] : null;

$output = array();

if ($amount) {
    // Set this environment variable in your server configuration
    $publicKey = '';

    // Process further or add values to the output array
    $output['result'] = 'success';
    $output['email'] = $email;
    $output['amount'] = $amount;
    $output['publicKey'] = $publicKey;
} else {
    // Handle the case where either $email or $amount is not set.
    $output['result'] = 'error';
    $output['message'] = 'Invalid email or amount.';
}

// Convert the array to JSON and echo it
echo json_encode($output);
