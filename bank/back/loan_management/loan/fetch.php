<?php
include "../../funtion/conn.php";
session_start();
$fat = '1';
$query = '';
$output = array();
$query = "SELECT * FROM `loan_data` where `status`='approved' or `status`='due'";

$result = mysqli_query($conn, $query);
$count_all_rows = mysqli_num_rows($result);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $query .= " WHERE name like '%" . $search_value . "%' ";
    $query .= " OR id like '%" . $search_value . "%' ";
}
$column_order = array('id', 'name', 'name', 'id');
if (isset($_POST['order'])) {
    $column = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $query .= " ORDER BY " . $column_order[$_POST['order'][0]['column']] . ' ' . $order;
} else {
    $query .= " ORDER BY id desc ";
}
$data = array();

$run_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($run_result)) {
    $sub_data = array();
    $sub_data[] = $row['id'];
    $id = $row['user_id'];
    $find_name = "SELECT * FROM `user` where id='$id'";
    $proccess_name = mysqli_query($conn, $find_name);
    if ($proccess_name == true) {
        $cam = mysqli_fetch_assoc($proccess_name);
        $name = $cam['fullname'];
    }

    $sub_data[] = $name;

    $sub_data[] = '&#8358;' . $row['principal'];
    $duration = $row['duration'];
    $duration_type = $row['duration_type'];
    $specific_duration = $row['specific_duration'];
    if ($specific_duration == 0) {
        $sub_data[] = $duration . "" . $duration_type;
    } else {
        $sub_data[] = $specific_duration . "" . $duration_type;
    }
    $date = date('Y,m,d');
    $due = $row['due_date'];
    if ($due >= $date) {
        $sub_data[]="loan due";
    }
    else{
        $sub_data[]="loan still on going" ;
    }
    $rid = $_SESSION['role_ids'];
    $sql = "SELECT * FROM staff_access where role_id ='$rid'  ";
    $result = mysqli_query($conn, $sql);
    if ($fat != '') {
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_array($result)) {
                $datas = $rows['crud'];
                $ans = json_decode($datas);
                $delete = $ans[$fat][4];
                $update = $ans[$fat][3];;

                if ($update == 1) {
                    $option = '<div  style="float:right"  ><a href="javascript:void()"  id="editbtn"  data-id="' . $row['id'] . '"   class="text-primary"> <i class="fa fa-info-circle"></i>info</a></div>';
                }
            }
        }
    }
    $sub_data[] = $option;
    $data[] = $sub_data;
}

$output = array(

    "recordsTotal" => $count_all_rows,
    "recordsFiltered" => $count_all_rows,
    "data" => $data,

);
echo json_encode($output);
