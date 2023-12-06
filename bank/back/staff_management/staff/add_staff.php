<?php
include "../../funtion/conn.php";

if (isset($_POST['name'])) {

    $password = md5($_POST['passwords']);
    $email = $_POST['emails'];
    $role = $_POST['role'];

    $name = $_POST['name'];

    $check = "SELECT * from staffs where email='.$email.'";
    $results = mysqli_query($conn, $check);
    $num = mysqli_num_rows($results);
    if ($num > 0) {
        $output = 'failed';
    } else {
        $query = "INSERT INTO `staffs` (name,email,password,role_ids) values  ('$name','$email','$password','$role')";
        $results = mysqli_query($conn, $query);
        if ($results == true) {

            $output = 'success';
        } else {
            $output = 'failed';
        }
    }
    echo json_encode($output);
}
