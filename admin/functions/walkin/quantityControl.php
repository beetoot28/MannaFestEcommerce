
<?php 
session_start();
include '../../../connections/connect.php';
                       
    $quantity = $_POST['quantity']; 
    $transaction_id = $_POST['transaction_id'];
    $product_id = $_POST['product_id'];
  


    $check = mysqli_query($con, "SELECT * FROM trans_record WHERE  prod_id='$product_id' AND transaction_id='$transaction_id'");
    $arrCheck = mysqli_fetch_array($check);

    $price = $arrCheck['price'];

    $newTotal = (float)$quantity * (float)$price;
    

        $update = "UPDATE  trans_record set quantity ='$quantity',total='$newTotal' WHERE  prod_id='$product_id' AND transaction_id='$transaction_id'";
        $results = mysqli_query($con, $update);


        $sql = mysqli_query($con, "SELECT sum(total) as total_sum FROM trans_record WHERE  transaction_id='$transaction_id'");
    $row = mysqli_fetch_array($sql);
    echo $row['total_sum'];
    exit();
  
 ?>


