<?php
session_start();
unset($_SESSION['User_id']);
unset($_SESSION['Username']);
header("Location:../index.php");
die();
?>