<?php
session_start();
function generateUniqueReference()
{
    // Get the current timestamp
    $timestamp = time();

    // Generate a random component (you can customize the length as needed)
    $randomComponent = mt_rand(10000, 99999);

    // Combine timestamp and random component to create a unique reference key
    $referenceKey = "REF" . $timestamp . $randomComponent;

    return $referenceKey;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if required fields are present in the request
    if (!isset($_POST['pin']) || !isset($_POST['amount']) || !isset($_POST['recipient_code'])) {
        $response = array("result" => "fail", "error" => "Incomplete data provided");
        echo json_encode($response);
        exit();
    }
    include "../../funtion/conn.php";
    // Example usage
    $uniqueReference = generateUniqueReference();


    $secretKey = 'sk_test_c8f05824e8480423710a00338bc1d6f603cc4bde';
    $pin = md5($_POST['pin']);
    $amount = $_POST['amount'];
    $id = $_SESSION['User_id'];
    $recipientCode = $_POST['recipient_code'];
    $acct_number = $_POST['acct_number'];
    $reason = $_POST['reason'];
    $bank_code = $_POST['bank_code'];
    $sql = "SELECT * from banks where bank_code=$bank_code";
    $run = mysqli_query($conn, $sql);
    if (mysqli_num_rows($run) > 0) {
        while ($row = mysqli_fetch_array($run)) {           
            $bank_name = $row['bank_name'];         
        }
    }
    $acctname = $_POST['acct_name'];
    // Check if the pin is empty
    if (empty($pin)) {
        $response = array("result" => "fail", "error" => "Pin cannot be empty");
        echo json_encode($response);
        exit();
    } else {
        $sql = "SELECT * FROM user WHERE id='$id' AND pin='$pin'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $url = "https://api.paystack.co/transfer";

            $fields = [
                'source' => "balance",
                'recipient' => $recipientCode,
                "reason" => $reason,
                "amount" => $amount * 100,
                "reference" => $uniqueReference
            ];

            $fields_string = http_build_query($fields);

            //open connection
            $ch = curl_init();

            //set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer $secretKey ",
                "Cache-Control: no-cache",
            ));

            //So that curl_exec returns the contents of the cURL; rather than echoing it
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //execute post
            $result = curl_exec($ch);

            // echo $result;
            $result = json_decode($result);

            if ($result->status === true) {
                $id = $_SESSION['User_id'];
                $query = "SELECT * FROM `user` WHERE id='$id'";
                $sql = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($sql);
                $bal = $row['account_balance'];
                $newbal = $bal - $amount;
                $senderPhone = $_SESSION['phone_number'];
                date_default_timezone_set('Africa/Lagos');
                $currentDate = date('Y-m-d H:i:s');
                $ans = array("account_number" => "$acct_number", "account_name" => "$acctname", "bank_name" => "$bank_name");
                $array = json_encode($ans);
                // $recipient_details = $acct_number . " " . $acctname . " " . $bankname;

                $senderTransactionSql = "INSERT INTO transactions (reference_number, transaction_type, amount, user_id, sender_bank_detail, recipient_bank_details, created_at, transaction_nature) VALUES ('$uniqueReference', 'bank_transfer', '$amount', '$id','$senderPhone', '$array', '$currentDate', 'debit')";
                $senderTransactionResult = mysqli_query($conn, $senderTransactionSql);
                if ($senderTransactionResult) {
                    $updateRecipientSql = "UPDATE user SET account_balance='$newbal' WHERE id=$id";
                    $updateRecipientResult = mysqli_query($conn, $updateRecipientSql);
                    if ($updateRecipientResult) {
                        $response = array("result" => "success", "message" => "Transfer successful");
                        echo json_encode($response);
                        exit();
                    } else {
                        $response = array("result" => "fail", "error" => "Invalid request method");
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response = array("result" => "fail", "error" => "Invalid request method");
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response = array("result" => "fail", "error" => "Invalid request method");
                echo json_encode($response);
                exit();
            }
        } else {
            $response = array("result" => "fail", "error" => "Invalid request method");
            echo json_encode($response);
            exit();
        }
    }
} else {
    // If the request method is not POST, return an error response
    $response = array("result" => "fail", "error" => "Invalid request method");
    echo json_encode($response);
    exit();
}
