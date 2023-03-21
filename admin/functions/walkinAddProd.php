<?php

session_start();
include '../../connections/connect.php';


    $trans_id = $_POST['trans_id']; 
    $product_id = $_POST['product_id'];
    $newQuantity = $_POST['quantity'];
    $price = preg_replace('/[^A-Za-z0-9!. ]/', '',$_POST['price']);
    date_default_timezone_set('Asia/Manila');
    $datenow = date('Y-m-d H:i:s');


     $total_amount = ((float)$newQuantity * (float)$price);
    // check if the product is in cart already

    $check = mysqli_query($con, "SELECT * FROM trans_record WHERE  prod_id='$product_id' AND transaction_id='$trans_id'");
    $arrCheck = mysqli_fetch_array($check);





    if($check->num_rows == 1) {
        $quantity = $arrCheck['quantity'];
        $prevTotal = $arrCheck['total'];

        $newTotal = $prevTotal + $total_amount;
        
        $quantity += $newQuantity;

        $update = "UPDATE  trans_record set quantity ='$quantity',total='$newTotal' WHERE  prod_id='$product_id' AND transaction_id='$trans_id' ";
        $results = mysqli_query($con, $update);

        }

        else{

        $query = "INSERT INTO trans_record (prod_id,transaction_id,quantity,total,price,user_id,date_ordered) 
                VALUES ('$product_id','$trans_id','$newQuantity','$total_amount','$price','59','$datenow')";
        $results = mysqli_query($con, $query);

    }
    $sql = mysqli_query($con, "SELECT sum(total) as total_sum FROM trans_record WHERE  transaction_id='$trans_id'");
    $row = mysqli_fetch_array($sql);
    echo $row['total_sum'];
    exit();
  
 ?>