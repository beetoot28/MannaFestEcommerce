<?php 
session_start();
include('../connections/connect.php');

    $output='';
    $ship_id = $_POST['ship_id'];
    $user_id = $_POST['user_id'];


$sql = "UPDATE `account_ship_address` SET `status`=0 WHERE user_id='$user_id'  ";
$setzero = mysqli_query($con, $sql);
                                   



  $query = "UPDATE `account_ship_address` SET `status`=1 WHERE ship_id='$ship_id' and user_id='$user_id'  ";
  $changedefault = mysqli_query($con, $query);


    $output = $ship_id.'-'.$user_id;

  echo $output;

?>