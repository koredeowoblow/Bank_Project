<?php
include "../../funtion/conn.php";

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $sql = "UPDATE  user set `status`='disable' WHERE id='$id'";
  $result = mysqli_query($conn, $sql);


  $result = $conn->query($sql);

  if ($result == true) {
    $output = array("result" => 'success');
  } else {
    $output = array("result" => 'fail');
  }

  echo json_encode($output);
}
