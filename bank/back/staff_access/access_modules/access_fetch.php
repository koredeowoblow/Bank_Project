<?php
include "../../funtion/conn.php";


$id = $_POST['id'];
$tr = '';
$query = "SELECT * FROM `staff_modules`";
$run_result = mysqli_query($conn, $query);


while ($row = mysqli_fetch_assoc($run_result)) {
    $rid = $row['id'];
    $tr .= '<tr style="justify-content: center;">';
    $tr .= '';
    if ($id != '') {
        $tr .= '<td style="font-weight:800;color:black;">' . $row['name'] . '</td>';

        $sql = "SELECT * FROM staff_access where role_id ='$id' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $datas = $row['crud'];
                $role = $row['role_id'];
                $ans = json_decode($datas);

                //print_r($ans);  
                $rs = count($ans);

                for ($row = 0; $row < $rs; $row++) {
                    $name = $ans[$row][0];
                    if ($name == $rid) {
                        $create = $ans[$row][1];
                        $check1 = '<td style="justify-content: center;"><input class="form-check-input form-check-primary mx-5  form-check-glow" type="checkbox" name="box"  value="create"  onchange="dat(' . $name . ', ' . $create . ',1, ' . $role . ')" id="checkboxPrimary' . $name . '1"></td>';

                        if ($create == 1) {
                            $check1 = '<td style="justify-content: center;"><input class="form-check-input form-check-primary  mx-5 form-check-glow" type="checkbox"  value="create"  name="box" onchange="dat(' . $name . ', ' . $create . ',1, ' . $role . ')" checked id="checkboxPrimary' . $name . '1"> </td>';
                        }
                        $read = $ans[$row][2];
                        $check2 = '<td style="justify-content: center;"><input class="form-check-input form-check-primary  mx-5 form-check-glow" type="checkbox" name="box" value="read" onchange="dat(' . $name . ', ' . $read . ', 2, ' . $role . ')" id="checkboxPrimary' . $name . '2"></td>';
                        if ($read == 1) {
                            $check2 = '<td style="justify-content: center;"><input class="form-check-input form-check-primary mx-5  form-check-glow" type="checkbox" value="read" name="box" onchange="dat(' . $name . ', ' . $read . ',2, ' . $role . ')" checked id="checkboxPrimary' . $name . '2"></td>';
                        }

                        $update = $ans[$row][3];
                        $check3 = '<td style="justify-content: center;"><input class="form-check-input form-check-primary  mx-5 form-check-glow" type="checkbox" name="box"  value="update"   onchange="dat(' . $name . ', ' . $update . ',3, ' . $role . ')" id="checkboxPrimary' . $name . '3"></td>';
                        if ($update == 1) {
                            $check3 = '<td style="justify-content: center;"><input class="form-check-input mx-5  form-check-primary form-check-glow" type="checkbox"  value="update"  name="box" onchange="dat(' . $name . ', ' . $update . ',3, ' . $role . ')" checked id="checkboxPrimary' . $name . '3"></td>';
                        }
                        $delete = $ans[$row][4];
                        $check4 = '<td style="justify-content: center;"><input class="form-check-input  mx-5 form-check-primary form-check-glow" type="checkbox" name="box" value="update"  onchange="dat(' . $name . ', ' . $delete . ',4, ' . $role . ')" id="checkboxPrimary' . $name . '4"></td>';

                        if ($delete == 1) {
                            $check4 = '<td style="justify-content: center;"><input type="checkbox" class="form-check-input mx-5  form-check-primary form-check-glow"  value="delete"  name="box" onchange="dat(' . $name . ', ' . $delete . ',4, ' . $role . ')" checked id="checkboxPrimary' . $name . '4"></td>';
                        }
                    }
                }
            }
        }
    } else {
        $check1 = '';
        $check2 = '';
        $check3 = '';
        $check4 = '';
    }
    $tr .= $check1;
    $tr .= $check2;
    $tr .= $check3;
    $tr .= $check4;

    $tr .= '</tr>';
}

echo $tr;
