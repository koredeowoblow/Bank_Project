<?php
include "../../funtion/conn.php";

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $date = date('Y,m,d');

  $sql = "UPDATE  loan_data set `status`='approved',approved_date='$date'  WHERE id='$id'";
  $result = mysqli_query($conn, $sql);


  $result = $conn->query($sql);

  if ($result == true) {
    $query = "SELECT * FROM `loan_data` where `id`='$id'";
    $run_result = mysqli_query($conn, $query);
    while ($rows = mysqli_fetch_assoc($run_result)) {
      $user_id = $rows['user_id'];
      $principal = $rows['principal'];
      $duration = $rows['duration'];
      $duration_type = $rows['duration_type'];
      $specific_duration = $rows['specific_duration'];
      if ($duration_type = "week") {

        $today = new DateTime(); // Current date and time

        $weeks_to_add = $duration; // Replace with the number of weeks you want to add

        $today->modify('+' . ($weeks_to_add * 7) . ' days'); // Convert weeks to days and add
        $formatted_date = $today->format('Y-m-d');
      }
      if ($duration_type = "year") {
        $today = new DateTime(); // Current date and time

        $years_to_add = $duration; // Replace with the number of years you want to add

        $today->modify('+' . $years_to_add . ' years');

        $formatted_date = $today->format('Y-m-d');
      }
      if ($duration_type = "day") {
        $today = new DateTime(); // Current date and time

        $days_to_add = $duration; // Replace with the number of days you want to add

        $today->modify('+' . $days_to_add . ' days');

         // Display the updated date
        $formatted_date = $today->format('Y-m-d');
      }
      $due_date = "UPDATE  loan_data set due_date='$formatted_date'  WHERE id='$id'";
      $due_date_run = mysqli_query($conn, $due_date);
      if ($due_date_run == true) {
        $query = "SELECT * FROM `user` where `id`='$user_id'";
        $run_result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($run_result)) {
          $loan_amount = $row['loan_amount'];
          $new_loanamount = $principal + $loan_amount;
          $update = "UPDATE  user set `loan_amount`='$new_loanamount'  WHERE id='$user_id'";
          $run = mysqli_query($conn, $update);
          if ($run == true) {
            $output = array("result" => 'success');
          } else {
            $output = array("result" => 'fail');
          }
        }
      } else {
        $output = array("result" => 'fail');
      }
    }
  } else {
    $output = array("result" => 'fail');
  }

  echo json_encode($output);
}
