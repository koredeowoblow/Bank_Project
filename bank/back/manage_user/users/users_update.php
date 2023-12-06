<?php
include "../../funtion/conn.php";

if (isset($_POST['names'])) {   
    $id=$_POST['pid'];  
    $name = $_POST['names'];
    $email = $_POST['emails'];
    $phone_number = $_POST['phone_numbers'];
    
    $query = "UPDATE  user set fullname='$name',email='$email',phone_number='$phone_number' where id=$id ";
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