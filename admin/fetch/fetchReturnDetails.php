<?php
session_start();
include '../../connections/connect.php';
// Get the user id 
$trans_code = $_REQUEST['trans_code'];
  

if ($trans_code !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($con, "SELECT * FROM transaction
    LEFT JOIN accounts ON transaction.user_id = accounts.user_id
     WHERE trans_code='$trans_code'");
  
    $row = mysqli_fetch_array($query);

    // Get the first name
    $name = $row["name"].' '.$row["lastname"];
    $trans_id = $row["tid"];
    $date = $row["datecreated"];
    $status = $row["status"];
    $type = $row["type"];
    $total_amount = $row["total_amount"];
    $user_id = $row["user_id"];
}
  
// Store it in a array
$result = array("$trans_id","$name","$date","$status","$type","$total_amount","$user_id");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>