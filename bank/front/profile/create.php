<?php
include "../funtion/conn.php";
session_start();

$name = $_SESSION['Username'];
$id = $_SESSION['User_id'];

// Use mysqli_real_escape_string to prevent SQL injection
$nameSend = mysqli_real_escape_string($conn, $_POST['fullname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// Check if only email and fullname are updated
if (empty($_POST['pin']) && empty($_FILES['profilePic']) && empty($_POST['PinConfirm'])) {
    if (!empty($_POST['password']) && !empty($_POST['PasswordConfirm'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if ($password == password_hash($_POST['PasswordConfirm'], PASSWORD_DEFAULT)) {
            $sql = "UPDATE user SET fullname = '$nameSend', email = '$email', `password`='$password' WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo json_encode('success');
                $sql = "SELECT * from user where id='$id'";
                $req = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($req);
                $_SESSION['Username'] = $row['fullname'];
            } else {
                echo json_encode('fail');
            }
        } else {
            echo json_encode('fail');
        }
    } else {
        $sql = "UPDATE user SET fullname = '$nameSend', email = '$email' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode('success');
        } else {
            echo json_encode('fail');
        }
    }
}

// Check if only pin is updated
if (empty($_POST['password']) && empty($_POST['fullname']) && empty($_POST['email']) && !empty($_POST['pin']) && !empty($_POST['PinConfirm']) && empty($_FILES['profilePic'])) {
    $pin = md5($_POST['pin']);
    $cpin = md5($_POST['PinConfirm']);

    if ($pin == $cpin) {
        $sql = "UPDATE user SET pin = '$pin' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode('success');
        } else {
            echo json_encode('fail');
        }
    } else {
        echo json_encode('fail');
    }
}

// Check if only profile picture is updated
if (empty($_POST['password']) && empty($_POST['pin']) && empty($_POST['PinConfirm']) && !empty($_FILES['profilePic'])) {
    $uploadDir = '../image'; // Update with your desired upload directory
    $uploadFile = $uploadDir . basename($_FILES['profilePic']['name']);

    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($imageFileType, $allowedExtensions)) {
        echo json_encode('Invalid file type for profile picture.');
        exit();
    }

    // Check if the file is an actual image
    if (!getimagesize($_FILES['profilePic']['tmp_name'])) {
        echo json_encode('Invalid image file.');
        exit();
    }

    if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFile)) {
        $profilePicPath = mysqli_real_escape_string($conn, $uploadFile);
        $sql = "UPDATE user SET profile_pic = '$profilePicPath' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode('success');
        } else {
            echo json_encode('fail');
        }
    } else {
        echo json_encode('Error uploading profile picture.');
    }
}
?>
