<?php
session_start();
include 'partials/_db.com';
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $token_val = $_GET['token'];
    $token = filter_var($token_val, FILTER_SANITIZE_STRING);
    $sql_update = "UPDATE `users` SET `status` = 'active'
     WHERE `users`.`token`='$token'";
    $result_update = mysqli_query($conn, $sql_update);
    header('location: login.php');
    exit();
}
?>