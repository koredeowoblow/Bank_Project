<?php
include "../funtion/conn.php";
session_start();
$account_id = $_SESSION['User_id'];
$limit = $_GET['y'];
$lim = $limit + 3;

$select = "SELECT * FROM transactions WHERE user_id='$account_id' ORDER BY created_at DESC LIMIT $lim";
$result = mysqli_query($conn, $select);
$output = "<div class='col-sm-12'>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $transactionNature = $row['transaction_nature'];
        $amount = number_format($row['amount'], 2);
        $recipientDetails = json_decode($row['recipient_bank_details'], true);

        $output .= "<a href='javascript:void()' onclick='show()' id='editbtn' data-id='" . $row['id'] . "'>
            <div class='card text-dark card-outline col-sm-12 my-2 p-1' style='box-shadow: 2px 2px 20px #70707057;'>";

        $output .= "<div class='card-header d-flex' style='background-image: linear-gradient(to bottom right,";

        if ($transactionNature == 'credit') {
            $output .= 'springgreen,green';
        } elseif ($transactionNature == 'debit') {
            $output .= 'red,tomato';
        }
        $output .= ");'>
                    <h4 class='card-title' style='text-align:center; color:;font-weight:700;float:left;'>";
        if ($transactionNature == 'debit') {
            $output .= 'Debit';
        } elseif ($transactionNature == 'credit') {
            $output .= 'Credit';
        }
        $output .= "</h4>
                    <p class='ml-auto' style='text-align:center;font-size:15px;font-weight:700;color:";

        $output .= ";float:right;'>";

        if ($transactionNature == 'debit') {
            $output .= '-';
        } elseif ($transactionNature == 'credit') {
            $output .= '+';
        }
        if ($transactionNature == 'credit') {
            $pone = $row['sender_bank_detail'];
            if (ctype_alpha($pone)) {
                $mess = "transfered from " . $pone;
            } else {
                $sel = "SELECT * from user where phone_number=$pone";
                $req = mysqli_query($conn, $sel);
                $dat = mysqli_fetch_assoc($req);
                $name = $dat['fullname'];
                $mess = "transfered from " . $name;
            }
        } else {
            $mess = "transfered to " . $recipientDetails['account_name'];
        }
        $output .= "&#8358;$amount</p>  
                </div>
                <div class='card-body d-flex'>
                    <p class='mr-auto' style='text-align:left;color:black;font-size:15px;font-weight:500;float:left;'>" . $mess . "</p>

                    <span class='ml-auto text-muted'>" . $row['created_at'] . "</span>                                                              
                </div>                                                                                  
            </div></a>";
    }

    if ($lim <= $result->num_rows) {
        $output .= "<button class='btn btn-block btn-tone p-2 font-weight-bold my-4' id='total" . $lim . "' style='background-color:#dfdfdf7d;color:#087907;' onclick='show_more(" . $lim . ")'><i class='fas fa-refresh'></i>Load more</button>";
    }
    else{
        $output .= "<p>No More Transactions Found.</p>";
    }
    echo $output;
} else {
    echo "<p>No transactions found.</p>";
}
