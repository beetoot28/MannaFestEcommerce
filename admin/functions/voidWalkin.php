<?php 
session_start();
include '../../connections/connect.php';
                  
  if (isset($_POST['remove'])) {

    echo $transaction_id = $_POST['transaction_id'];

    $delete = "DELETE  FROM transaction WHERE  tid='$transaction_id' ";
    $results = mysqli_query($con, $delete);


    $listTrans = mysqli_query($con, "SELECT * from trans_record where transaction_id='$transaction_id'");
    
    
    while ($row = mysqli_fetch_array($listTrans)) {

      echo $product_id= $row['prod_id'];

      $delete = "DELETE  FROM trans_record WHERE  prod_id='$product_id' and transaction_id='$transaction_id'  ";
        $results = mysqli_query($con, $delete);


      // /////////////////////////////////////////////////

    }

    header("Location: ../walkin_record.php");
    $_SESSION['new_brand']= "successful";   
                              
    exit();              
   }
 ?>