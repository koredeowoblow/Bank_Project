<?php
include "../../funtion/conn.php";

if (isset($_POST['name'])) {

    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $name = $_POST['name'];
    $cpassword = md5($_POST['cpassword']);

    if ($phone != '') {
        $say = "SELECT * from user WHERE phone_number='$phone' or email='$email'";
        $result = mysqli_query($conn, $say);
        if (mysqli_num_rows($result) > 0) {
            $output = 'faile';
        } else {
            if ($cpassword == $password ) {
                $sql = "INSERT INTO user (fullname,password,email,phone_number) values('$name','$password','$email','$phone')";
                $result = mysqli_query($conn, $sql);
                if ($result == true) {
                    $output = 'success';
                } else {
                    $output = 'fail';
                }
            } else {
                $output = 'failed';
            }
        }
       
    } else {
        $output = 'failed';
    }
    echo json_encode($output);
}
