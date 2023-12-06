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
        $say = "SELECT * from user WHERE phone_number='$phone_number' or email='$email'";
        $result = mysqli_query($conn, $say);
        if (mysqli_num_rows($result) > 0) {
            $output = 'fails';
        } else {
            if ($cpassword == $password && $pin == $cpin) {
                if ($_FILES['profilePic']['error'] == 0) {
                    $uploadDir = '../image'; // Update with your desired upload directory
                    $uploadFile = $uploadDir . basename($_FILES['profilePic']['name']);

                    // Check file type if needed
                    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                    if (!in_array($imageFileType, $allowedExtensions)) {
                        // Handle invalid file type
                        echo json_encode('Invalid file type for profile picture.');
                        exit();
                    }

                    if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFile)) {
                        // File uploaded successfully, you can save the file path in the database or do other processing
                        $profilePicPath = $uploadFile;

                        // ... Your existing database insertion code ...
                        $sql = "INSERT INTO user (fullname, password, email, phone_number, pin, profile_pic) 
                                VALUES ('$nameSend', '$password', '$email', '$phone_number', '$pin', '$profilePicPath')";

                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            echo json_encode('success');
                        } else {
                            echo json_encode('fail');
                        }
                    } else {
                        // Handle file upload error
                        echo json_encode('Error uploading profile picture.');
                    }
                } else {
                    echo json_encode('Image not provided.');
                }
            } else {
                $output = 'failed';
            }
        }
        echo json_encode($output);
    }
}
