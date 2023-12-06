<?php
$bankCode = isset($_POST['bankCode']) ? $_POST['bankCode'] : null;
$acct_number = isset($_POST['acct_number']) ? $_POST['acct_number'] : null;
$acct_name = isset($_POST['acct_name']) ? $_POST['acct_name'] : null;

if ($bankCode === "" || $acct_number === "" || $acct_name === "") {
    $output = array("result" => 'fail', "error" => "Invalid input parameters.");
    header('Content-Type: application/json');
    echo json_encode($output);
    exit();
} else {
    $secretKey = 'sk_test_c8f05824e8480423710a00338bc1d6f603cc4bde';

    $url = "https://api.paystack.co/transferrecipient";

    $fields = [
        'type' => "nuban",
        'name' => $acct_name,
        'account_number' => $acct_number,
        'bank_code' => $bankCode,
        'currency' => "NGN"
    ];

    $fields_string = http_build_query($fields);

    // open connection
    $ch = curl_init();

    // set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $secretKey",
        "Cache-Control: no-cache",
    ));

    // So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // execute post
    $result = curl_exec($ch);
    $err = curl_error($ch);

    curl_close($ch);

    if ($err) {
        $output = array("result" => 'fail', "error" => "cURL Error: " . $err);
    } else {
        $result = json_decode($result, true); // Decode as associative array
        $output = array("result" => 'success', "data" => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($output);
}
