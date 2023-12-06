<?php
include "../funtion/conn.php";
session_start();
$name=$_SESSION['Username'];
$id= $_SESSION['User_id'];
$sql="SELECT * from user where id='$id'";
$result=mysqli_query($conn,$sql);
$rows = mysqli_fetch_assoc($result);


// if ($rows["role_id"] !=""){
//     $role_id = $rows["role_id"];
// $sqls="SELECT * from `access role` where id='$role_id'";
// $dats=mysqli_query($conn,$sqls);
// $row = mysqli_fetch_assoc($dats);
// $rows["role_name"]=$row["name"];
// }

echo json_encode($rows);
?>
