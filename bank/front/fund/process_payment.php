<?php
// Sanitize user input
$ref = isset($_POST['reference']) ? $_POST['reference'] : null;
if ($ref == "") {
    $output = array("result" => 'fail', "error" => "Paystack API error.");
    exit();
} else {
    session_start();
    include("../funtion/conn.php");
    $secretKey = 'sk_test_c8f05824e8480423710a00338bc1d6f603cc4bde';
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($ref),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . rawurlencode($secretKey),
            "Cache-Control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $output = array("result" => 'fail', "error" => "cURL Error: " . $err);
    } else {
        $result = json_decode($response);

        if ($result->status === true) {
            $data = $result->data;

            if ($data->status == 'success') {
                $sending_details = $data->authorization->bank;
                $status = $data->status;
                $reference = $data->reference;
                $funding1 = $data->authorization->channel;
                $funding2 = $data->authorization->card_type;
                $funding3 = $data->authorization->last4;
                $ans = array("channel" => "$funding1", "card_type" => "$funding2", "last4" => "$funding3");
                $funding_details = json_encode($ans);
                // Make sure $amount is defined before using it
                $amount1 = $data->amount;
                $amount = $amount1 / 100;

                $id = $_SESSION["User_id"];
                $accout=$_SESSION['phone_number'];
                $name=$_SESSION['Username'];
                $ansed = array("account_number" => "$accout", "account_name" => "$name", "bank_name" => "clarity");
               
                $phone =json_encode($ansed);
                $transaction_type = "funding";
                $transaction_nature = 'credit';
                date_default_timezone_set('Africa/Lagos');
                $created_at = date('Y-m-d H:i:s');

                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO transactions (reference_number, transaction_type, amount, sender_bank_detail, recipient_bank_details, user_id, funding_details, created_at, transaction_nature) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssdssdsss", $reference, $transaction_type, $amount, $sending_details, $phone, $id, $funding_details, $created_at, $transaction_nature);

                if ($stmt->execute()) {
                    // Update user's account balance
                    $query = "SELECT * FROM `user` WHERE id=?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result) {
                        $row = $result->fetch_assoc();

                        if ($row) {
                            $currentBalance = $row["account_balance"];

                            // Calculate the new balance
                            $newBalance = $currentBalance + $amount;

                            // Update the user's account balance with the new amount
                            $stmt = $conn->prepare("UPDATE `user` SET `account_balance` = ? WHERE `id` = ?");
                            $stmt->bind_param("ds", $newBalance, $id);
                            $stmt->execute();

                            $stmt->close();
                            $output = array("result" => 'success');
                        } else {
                            $output = array("result" => 'fail', "error" => "Error: Unable to fetch user data.");
                        }
                    } else {
                        $output = array("result" => 'fail', "error" => "Error: Unable to fetch user data.");
                    }
                } else {
                    $output = array("result" => 'fail', "error" => "Error: Unable to execute transaction.");
                }
            } else {
                $output = array("result" => 'fail', "error" => "Payment status is not success.");
            }
        } else {
            // Handle Paystack API error
            $output = array("result" => 'fail', "error" => "Paystack API error.");
        }
    }

    $conn->close();

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($output);
}
