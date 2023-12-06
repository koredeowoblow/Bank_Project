<?php
include "conn.php";
extract($_POST);
if (isset($_POST['fullname'])) {
    $nameSend = $_POST['fullname'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $cpassword = md5($_POST['PasswordConfirm']);
    $pin = md5($_POST['pin']);
    $cpin = md5($_POST['PinConfirm']);

    if ($phone_number != '') {
        $say = "SELECT * from user WHERE phone_number='$phone_number'";
        $result = mysqli_query($conn, $say);
        if (mysqli_num_rows($result) > 0) {
            $output = 'fails';
        } else {
            if ($cpassword == $password && $pin == $cpin) {
                $sql = "INSERT INTO user (fullname,password,email,phone_number,pin) values('$nameSend','$password','$email','$phone_number','$pin')";
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
        echo json_encode($output);
    }
}
