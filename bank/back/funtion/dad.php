<?php
include "conn.php";
$username = $_POST["username"];
$email = $_POST["email"];
$password = md5($_POST["password"]);
$cpassword = md5($_POST["PasswordConfirm"]);
if ($cpassword != '' && $password != '') {

    $sqli = "SELECT * FROM user where fullname ='$username' AND email ='$email'";
    if ($result = mysqli_query($conn, $sqli)) {

        while ($rowed = mysqli_fetch_assoc($result)) {
            $pars = $rowed['id'];
        }
    }
    if ($password == $cpassword) {
        $sqli = "UPDATE user set password='$password' WHERE id = '$pars'";
        $result = mysqli_query($conn, $sqli);
        if ($result == true) {
            $output = "success";
        } else {
            $output = "fails";
        }


    }
} else {
    $output = "pass";
}

echo json_encode($output);


?>