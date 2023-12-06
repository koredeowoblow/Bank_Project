<?php
include "../funtion/conn.php";
$id = $_GET['id'];


$query="SELECT * FROM `transactions` WHERE id='$id' " ;
$sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($sql);
$r_details=json_decode($row['recipient_bank_details'], true);
$row["r_details"]=$r_details;

echo json_encode($row); 
?>