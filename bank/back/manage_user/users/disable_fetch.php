<?php
include "../../funtion/conn.php";
session_start();
$fat = '1';
$query = '';
$output = array();
$query = "SELECT * FROM `user` where `status`='disable'";

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
    $sub_data[] = $row['fullname'];
    $sub_data[] = $row['email'];
    $sub_data[] = $row['phone_number'];
    $amount = $row['account_balance'];
    $sub_data[]='&#8358;' . number_format($amount, 2);
    $role_id = $row['role_id'];
    $option=""; 

    if ($role_id != '') {
        $sql = "SELECT * FROM `access_role` where id='$role_id'";
        $rest = mysqli_query($conn, $sql);
        $cam = mysqli_fetch_assoc($rest);
        $id = $cam['name'];
    }
   
    $rid = $_SESSION['role_ids'];
    $sql = "SELECT * FROM access where role_id ='$rid'  ";
    $result = mysqli_query($conn, $sql);
    if ($fat != '') {
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_array($result)) {
                $datas = $rows['crud'];
                $ans = json_decode($datas);
                $delete = $ans[$fat][4];
                $update = $ans[$fat][3];;

                if ($delete && $update == 1) {
                    $option = '<div  style="float:right"  ><a href="javascript:void()"  id="editbtn"  data-id="' . $row['id'] . '"   class="text-primary"> <i class="far fa-edit "></i>Edit</a>&nbsp;&nbsp;|<a href="javascript:void()" data-id="' . $row['id'] . '" class="text-success btnactivate"> <i class="fas fa-user"></i>enable</a>&nbsp;&nbsp;|<a href="javascript:void()" data-id="' . $row['id'] . '" class="text-danger btnDelete"> <i class="fas fa-delete"></i>Delete</a></div>';
                } elseif ($delete == 1) {
                    $option = '<div  style="float:right"  ><a href="javascript:void()" data-id="' . $row['id'] . '" class="text-danger btnDelete"> <i class="anticon anticon-delete"></i>Delete</a></div>';
                } elseif ($update == 1) {
                    $option = '<div  style="float:right" ><a href="javascript:void()"  id="editbtn"  data-id="' . $row['id'] . '"   class="text-primary"> <i class="far fa-edit "></i>Edit</a></div>&nbsp;&nbsp;|<a href="javascript:void()" data-id="' . $row['id'] . '" class="text-success btnactivate"> <i class="fas fa-user"></i>enable</a>';
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
