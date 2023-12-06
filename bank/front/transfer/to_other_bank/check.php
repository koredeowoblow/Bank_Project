<?php
$bankCode = isset($_POST['bankCode']) ? $_POST['bankCode'] : null;
$acct_number = isset($_POST['acct_number']) ? $_POST['acct_number'] : null;

if ($bankCode === "" || $acct_number === "") {
    $output = array("result" => 'fail', "error" => "Invalid input parameters.");
    header('Content-Type: application/json');
    echo json_encode($output);
    exit();
} else {
    $curl = curl_init();
    $secretKey = 'sk_test_c8f05824e8480423710a00338bc1d6f603cc4bde';

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=" . rawurlencode($acct_number) . "&bank_code=" . rawurlencode($bankCode) . "",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $secretKey",
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $output = array("result" => 'fail', "error" => "cURL Error: " . $err);
    } else {
        $result = json_decode($response, true); // Decode as associative array
        $output = array("result" => 'success', "data" => $result);
    }

    header('Content-Type: application/json');
    echo json_encode($output);
}
