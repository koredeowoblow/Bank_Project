<?php
session_start();
unset($_SESSION['staff_id']);
unset($_SESSION['name']);
header("Location:../index.php");
die();
?>