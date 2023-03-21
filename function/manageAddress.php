<?php 
session_start();
include('../connections/connect.php');

    $output='';
    $ship_id = $_POST['ship_id'];


// $sql = "UPDATE `account_ship_address` SET `status`=0 WHERE user_id='$user_id'  ";
// $setzero = mysqli_query($con, $sql);
                                   
//   $query = "UPDATE `account_ship_address` SET `status`=1 WHERE ship_id='$ship_id' and user_id='$user_id'  ";
//   $changedefault = mysqli_query($con, $query);

    // Execute the database query to fetch the data
    $query = "SELECT * FROM account_ship_address where ship_id='$ship_id'";
    $result = $con->query($query);
    $rowList = mysqli_fetch_array($result);

    $contact_name = $rowList['contact_name'];
    $phone_number = $rowList['phone_number'];
    $address = $rowList['address'];
    $postal_code = $rowList['postal_code'];
    $address_1 = $rowList['address_1'];
    $address_2 = $rowList['address_2'];


    // Store the data in an array
    // $result = ["$contact_name","$phone_number","$address_1","$address_2","$postal_code"];
    $result = ["ship_id" => "$ship_id","contact_name" => "$contact_name", "phone_number" => "$phone_number", "address_1" => "$address_1", "address_2" => "$address_2", "postal_code" => "$postal_code"];




    $myJSON = json_encode($result);
  
    echo $myJSON;

// $result = ["cost" => "$cost", "price" => "$price"];
// // Encode the result as a JSON object
// $myJSON = json_encode($result);
  
// // Return the JSON object
// echo $myJSON;
?>