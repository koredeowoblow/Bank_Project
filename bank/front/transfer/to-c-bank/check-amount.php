<?php
include "../../funtion/conn.php";

$amount = $_GET["amount"];
$id = $_GET['id'];

$query = "SELECT * FROM  user WHERE id='$id' ";
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);
if (mysqli_num_rows($sql) > 0) {
   if ($amount <  $row['account_balance'] || $amount == $row['account_balance']) {
      $output = $output = array("result" => 'true');
      echo json_encode($output);
   } else {
      $output = $output = array("result" => 'false');;
      echo json_encode($output);
   }
}
else {
   $output = $output = array("result" => 'fail');;
   echo json_encode($output);
}
