<?php
include "../../funtion/conn.php";

if (isset($_POST['name'])) {       
    $icon = $_POST['icon'];
    $link = $_POST['link'];    
    $name = $_POST['name'];  
    $parent_id=$_POST['parent_id'];
    if ($parent_id =="") {
        $parent_id=0;
    }

    $query = "INSERT INTO `staff_modules` (name,link,icon,parent_id) values  ('$name','$link','$icon','$parent_id')";
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