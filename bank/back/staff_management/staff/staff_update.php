<?php
include "../../funtion/conn.php";

if (isset($_POST['fullname'])) {   
    $id=$_POST['pid'];  
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $role=$_POST['role'];
    

  
    $query = "UPDATE  staffs set name='$name',email='$email',role_id='$role' where id=$id ";
    $results = mysqli_query($conn, $query);
    if($results == true){
        
        $output='success';
    }
    else{
        $output='failed';
    }
    echo json_encode($output);
}

?>