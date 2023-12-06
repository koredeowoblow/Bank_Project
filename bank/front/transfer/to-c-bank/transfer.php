<?php
include "../../funtion/conn.php";
function generateRandomNumericKey($length)
{
    $key = '';
    $characters = '0123456789';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $key .= $characters[rand(0, $charactersLength - 1)];
    }

    return $key;
}

function generateUniqueReferenceKey($conn, $length = 9, $maxAttempts = 3)
{
    for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
        $key = generateRandomNumericKey($length);

        // Check if the generated key already exists in the database
        $existingKeyQuery = "SELECT COUNT(*) as count FROM transactions WHERE reference_number = ?";

        // Use prepared statement to prevent SQL injection
        $stmt = mysqli_prepare($conn, $existingKeyQuery);
        mysqli_stmt_bind_param($stmt, "s", $key);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_fetch_assoc($result)['count'] === 0) {
            return $key; // Unique key found, return it
        }
    }

    // If max attempts reached, keep trying until a unique key is found
    while (true) {
        $key = generateRandomNumericKey($length);
        if (!keyExistsInDatabase($conn, $key)) {
            return $key; // Unique key found, return it
        }
    }
}

function keyExistsInDatabase($conn, $key)
{
    $existingKeyQuery = "SELECT COUNT(*) as count FROM transactions WHERE reference_number = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $existingKeyQuery);
    mysqli_stmt_bind_param($stmt, "s", $key);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return $result && mysqli_fetch_assoc($result)['count'] > 0;
}

if (isset($_POST['ids'], $_POST['account_numbered'], $_POST['amounted'], $_POST['pin'])) {
    $id = $_POST['ids'];
    $acct_number = $_POST['account_numbered'];
    $amount = $_POST['amounted'];
    $pin = md5($_POST['pin']);

    $sql = "SELECT * FROM user WHERE id='$id' AND pin='$pin'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $senderRow = mysqli_fetch_assoc($result);
        $senderPhone = $senderRow["phone_number"];
        $senderBalance = $senderRow["account_balance"];

        // Deduct amount from sender's account
        $newSenderBalance = $senderBalance - $amount;
        $updateSenderSql = "UPDATE user SET account_balance='$newSenderBalance' WHERE id=$id";
        $updateSenderResult = mysqli_query($conn, $updateSenderSql);

        if ($updateSenderResult) {
            // Add amount to recipient's account
            $recipientSql = "SELECT * FROM user WHERE phone_number=$acct_number";
            $recipientResult = mysqli_query($conn, $recipientSql);

            if ($recipientResult && mysqli_num_rows($recipientResult) > 0) {
                $recipientRow = mysqli_fetch_assoc($recipientResult);
                $recipientId = $recipientRow["id"];
                $recipientBalance = $recipientRow["account_balance"];
                $recipientName=$recipientRow["fullname"];


                $newRecipientBalance = $recipientBalance + $amount;
                $updateRecipientSql = "UPDATE user SET account_balance='$newRecipientBalance' WHERE id=$recipientId";
                $updateRecipientResult = mysqli_query($conn, $updateRecipientSql);

                if ($updateRecipientResult) {
                    // Record transactions
                    date_default_timezone_set('Africa/Lagos');
                    $currentDate = date('Y-m-d H:i:s');
                    $refernce = generateUniqueReferenceKey($conn);
                    $ans = array("account_number" => "$acct_number", "account_name" => "$recipientName", "bank_name" => "clarity");
                    $array=json_encode($ans);
                                       

                    $senderTransactionSql = "INSERT INTO transactions (reference_number, transaction_type, amount, user_id, sender_bank_detail, recipient_bank_details, created_at, transaction_nature) VALUES ('$refernce', 'same_bank_transfer', '$amount', '$id','$senderPhone', '$array', '$currentDate', 'debit')";
                    $recipientTransactionSql = "INSERT INTO transactions (reference_number, transaction_type, amount, user_id, sender_bank_detail, recipient_bank_details, created_at, transaction_nature) VALUES ('$refernce', 'same_bank_transfer', '$amount', '$recipientId', '$senderPhone','$array', '$currentDate', 'credit')";

                    $senderTransactionResult = mysqli_query($conn, $senderTransactionSql);
                    $recipientTransactionResult = mysqli_query($conn, $recipientTransactionSql);

                    if ($senderTransactionResult && $recipientTransactionResult) {
                        $output = array("result" => 'success',"reference"=>"$refernce","date"=>"$currentDate","acct_number"=>"$acct_number");
                        echo json_encode($output);
                    } else {
                        $output = array("result" => 'failed');
                        echo json_encode($output);
                    }
                } else {
                    $output = array("result" => 'failed');
                    echo json_encode($output);
                }
            } else {
                $output = array("result" => 'failed');
                echo json_encode($output);
            }
        } else {
            $output = array("result" => 'failed');
            echo json_encode($output);
        }
    } else {
        $output = array("result" => 'failed');
        echo json_encode($output);
    }
} else {
    $output = array("result" => 'failed');
    echo json_encode($output);
}
