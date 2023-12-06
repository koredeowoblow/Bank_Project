<?php
include "../../funtion/conn.php";

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $query = "INSERT INTO `staff_roles` (name) values  ('$name')";
    $results = mysqli_query($conn, $query);
    if ($results == true) {
        $search = "SELECT * FROM staff_roles where name='$name'";
        $search_n = mysqli_query($conn, $search);
        $row = mysqli_fetch_assoc($search_n);
        $id = $row['id'];
        $query1 = "INSERT INTO `staff_access` (role_id) values  ('$id')";
        $results1 = mysqli_query($conn, $query1);
        if ($results1 == true) {
            $output = 'success';
        } else {
            $output = 'failed';
        }
    } else {
        $output = 'failed';
    }
    echo json_encode($output);
}
