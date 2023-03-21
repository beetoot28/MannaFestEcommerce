<?php 

session_start();
include '../../../connections/connect.php';
                       
$transaction_id = $_POST['transaction_id'];
$product_id = $_POST['product_id'];


        $delete = "DELETE  FROM trans_record WHERE  transaction_id='$transaction_id' AND prod_id='$product_id' ";
        $results = mysqli_query($con, $delete);

        

        $sql = mysqli_query($con, "SELECT sum(total) as total_sum FROM trans_record WHERE  transaction_id='$transaction_id'");
        $row = mysqli_fetch_array($sql);
        echo $row['total_sum'];
    exit();
  
 ?>