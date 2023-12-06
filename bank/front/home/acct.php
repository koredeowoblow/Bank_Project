<?php
include "../funtion/conn.php";
$id = $_GET['id'];

$check = "SELECT * from loan_data where user_id=$id";
$check_run = mysqli_query($conn, $check);
if ($check_run == true) {
    $rows = mysqli_fetch_assoc($check_run);
    
    if ($rows != '') {
        $date = date('Y,m,d');
    $due = $rows['due_date'];
        if ($due >= $date) {
            $query = "SELECT * FROM user where id=$id";
            $results = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($results);
            $update = "UPDATE  loan_data set `status`='due'  WHERE user_id='$id'";
            $sat = mysqli_query($conn, $update);
            if ($sat == true) {
                if ($row > 0) {
                    $acct = $row['account_balance'];
                    $loan = $row['loan_amount'];
                    $accts = $acct - $loan;

                    $output = '&#8358;' . number_format($accts, 2);
                    # code...
                }  # code...
            }
        } else {
            $query = "SELECT * FROM user where id=$id";
            $results = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($results);
            if ($row > 0) {
                $acct = $row['account_balance'];
                $loan = $row['loan_amount'];
                $accts = $acct + $loan;

                $output = '&#8358;' . number_format($accts, 2);
                # code...
            }
        }
    } else {
        $query = "SELECT * FROM user where id=$id";
        $results = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($results);
        if ($row > 0) {
            $acct = $row['account_balance'];
            $loan = $row['loan_amount'];
            $accts = $acct + $loan;

            $output = '&#8358;' . number_format($accts, 2);
            # code...
        }
    }
} else {
    $output = 'error';
}
echo json_encode($output);
