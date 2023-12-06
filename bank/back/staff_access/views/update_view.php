<?php
include "../../funtion/conn.php";

if (isset($_POST['names'])) {   
    $id=$_POST['pid'];
   
    $link = $_POST['links'];
   
    $name = $_POST['names'];
    $icon = $_POST['icons'];
    $parent_id=$_POST['parent_ids'];
    if ($parent_id =="") {
        $parent_id=0;
    }

     
    $query = "UPDATE  `staff_modules` set name='$name',parent_id='$parent_id',link='$link',icon='$icon' where id=$id ";
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