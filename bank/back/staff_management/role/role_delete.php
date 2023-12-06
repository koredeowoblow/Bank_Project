<?php
include "../../funtion/conn.php";
$id = $_POST['id'];
$search = "SELECT * FROM staff_access where role_id='$id'";
$search_n = mysqli_query($conn, $search);

$row = mysqli_fetch_assoc($search_n);
$rid=$row['id'];
$sql = "DELETE FROM `staff_roles`  WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$del="DELETE FROM `staff_access`  WHERE id='$rid'";
$del_result=mysqli_query($conn, $del);

$result = $conn->query($sql);

if ($result == true && $del_result == true) {
  $output = array("result" => 'success');
 
} else {
  $output = array("result" => 'fail');
  
}

echo json_encode($output);


?>