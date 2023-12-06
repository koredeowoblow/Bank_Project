<?php
include "../../funtion/conn.php";
session_start();
$account = $_GET["account_number"];
if (strlen($account) > 10) {
    $acct = $account;
} else {
    $acct = "0" . $account;
}
$id = $_SESSION["User_id"];
$querys = "SELECT * FROM  user WHERE phone_number='$acct' && id='$id'";
$sqls = mysqli_query($conn, $querys);
if (mysqli_num_rows($sqls) > 0) {
    $rowed = array("result" => 'false');;
    echo json_encode($row);
} else {
    $query = "SELECT * FROM  user WHERE phone_number='$acct' ";
    $sql = mysqli_query($conn, $query);
    $rows = mysqli_fetch_assoc($sql);
    if (mysqli_num_rows($sql) > 0) {
        echo json_encode($rows);
    } else {
        $rowed = array("result" => 'false');;
        echo json_encode($rowed);
    }
}
