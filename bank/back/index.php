<?php
include_once  "funtion/conn.php";
session_start();
if (isset($_SESSION['staff_id'])) {
  $query = "SELECT * FROM `staff_modules` orderby  ORDER BY id desc  ";
  $run_result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($run_result)) {
    $rid = $row['id'];
    $names = $row['name'];
    $link = $row['link'];
    $icon = $row['icon'];
    $sql = "SELECT * FROM staff_access where role_id ='$id'  ";
    $result = mysqli_query($conn, $sql);
    if ($fat != '') {
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
          $datas = $row['crud'];
          $ans = json_decode($datas);
          $read = $ans[$fat][2];

          if ($read == 0) {
            header("location:../index.php");
            die();
          }
        }
      }
    }
  }


  header("location:home/$site");
  die();
}
if (isset($_POST['submit'])) {

  $firstname = $_POST['email'];
  $password = md5($_POST['password']);
  $sql = "SELECT * FROM staffs where email = '" . $firstname . "' && password = '" . $password . "' ";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num > 0) {
    $rows = mysqli_fetch_assoc($result);
    $_SESSION['staff_id'] = $rows['id'];
    $_SESSION['name'] = $rows['name'];
    $_SESSION['role_ids'] = $rows['role_ids'];
    $id = $_SESSION['role_ids'];
    $query = "SELECT * FROM `staff_modules` orderby  ORDER BY id desc  ";
    $run_result = mysqli_query($conn, $query);
    // while ($row = mysqli_fetch_assoc($run_result)) {
    //   $rid = $row['id'];
    //   $names = $row['parent_id'];
    //   $link = $row['link'];
    //   if ($id != '') {
    //     $sql = "SELECT * FROM staff_access where role_id ='$id'  ";
    //     $result = mysqli_query($conn, $sql);
    //     if (mysqli_num_rows($result) > 0) {
    //       while ($row = mysqli_fetch_array($result)) {
    //         $datas = $row['crud'];
    //         $ans = json_decode($datas);
    //         //print_r($ans);
    //         $rs = count($ans);
    //         for ($row = 0; $row < $rs; $row++) {
    //           $name = $ans[$row][0];

    //           if ($name == $rid) {
    //             $read = $ans[$row][2];
    //             if ($read == 1) {
    //               $site = $link;
    //             }
    //           }
    //         }
    //       }
    //     }
    //   }
    // }
    // $_SESSION['sites'] = $sites;
    header("Location:home/index.php");
  } else {
    header("Location:index.php?error=Incorrect details ");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - clarity Admin Dashboard</title>
  <link rel="shortcut icon" href="../assets/images/logo/logo1.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/app.css">
  <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
  <div id="auth">

    <div class="row ">
      <div class="col-lg-5 col-12">
        <div id="auth-left">
          <div class="auth-logo">
            <a href="index.html"><img src="assets/images/logo/download (1).jpeg" alt="Logo" style="width: 100%;height:auto;display:block;object-fit:fill;"></a>
          </div>
          <h1 class="auth-title">Log in.</h1>
          <?php if (isset($_GET['error'])) { ?>
            <div id="msg1" class="alert alert-danger w-100" role="alert">
              <?php echo $_GET['error']

              ?>
            </div>
          <?php } ?>
          <form method="post">
            <p>Enter email</p>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="email" class="form-control form-control-xl" name="email" placeholder="email address">
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            <p>Enter password</p>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <div class="form-check form-check-lg d-flex align-items-end">
              <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label text-gray-600" for="flexCheckDefault">
                Keep me logged in
              </label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
          </form>

        </div>
      </div>
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
      </div>
    </div>

  </div>
  <script>
    // Use JavaScript to hide the error message after 5 seconds
    // setTimeout(function() {
    //   var errorDiv = document.getElementById('error');
    //   if (errorDiv) {
    //     errorDiv.style.display = 'none';
    //   }
    // }, 5000); // 5000 milliseconds = 5 seconds
  </script>
</body>

</html>