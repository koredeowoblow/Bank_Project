<?php
include "../../funtion/conn.php";

$z=$_POST['z'];
$y=$_POST['y'];
$x=$_POST['x'];
$w=$_POST['w'];
$sql = "SELECT * FROM staff_access where role_id ='$w' ";
$run_result = mysqli_query($conn, $sql);
if (mysqli_num_rows($run_result) > 0) {
    while ($row = mysqli_fetch_array($run_result)) {
        $datas = $row['crud'];
        $ans = json_decode($datas);      
        $rs = count($ans);

        for ($row = 0; $row < $rs; $row++) {
            $name = $ans[$row][0];

            if ($name==$x) {
                $ans[$row][$z] = $y;
                
            }
        }

        $array=json_encode($ans);
        $sql=" UPDATE  staff_access set crud='$array' where role_id ='$w' ";
        $results = mysqli_query($conn, $sql);
        if($results == true){
            
            $output='success';
        }
        else{
            $output='failed';

        }
       json_encode($output);
    }}
    

?>