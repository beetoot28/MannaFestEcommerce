<?php 
session_start();
include '../../connections/connect.php';
  if (isset($_POST['confirm'])) {
     $total_amount = preg_replace('/[^A-Za-z0-9!. ]/', '',$_POST['total_amount']);
     $transaction_id = $_POST['transaction_id'];

     $transaction_id = $_POST['transaction_id'];

     $trans_pay = $_POST['trans_pay'];
     $trans_changes = $_POST['trans_change'];



    $listTrans = mysqli_query($con, "SELECT * from trans_record where transaction_id='$transaction_id'");
    
    
    
    while ($row = mysqli_fetch_array($listTrans)) {


       $product_id= $row['prod_id'];
       $product_quantity= $row['quantity'];

   

      // Minus from the NTC Bodega
      $p_qty = mysqli_query($con, "SELECT * from product_quantity where prod_id='$product_id'");
      $p_arr = mysqli_fetch_array($p_qty);
      
      $inv = $p_arr['quantity'];

      $sql = mysqli_query($con, "SELECT * from production_log where prod_id='$product_id' AND status='ACTIVE' ORDER BY `production_code` DESC LIMIT 1");  
      $log = mysqli_fetch_array($sql);
      $prod_code = $log['production_code'];
      $prod_log_qty =  $log['qty_remaining'];



      // $newQty = (float)$inv - ((float)$product_quantity );
      $newQty_log = (float)$prod_log_qty - ((float)$product_quantity );

      


      $update = "UPDATE  production_log set qty_remaining ='$newQty_log' 
      WHERE  prod_id='$product_id' and production_code='$prod_code' ";


      $res = mysqli_query($con, $update);

    echo $newQty_log;
    }

          
    $update = "UPDATE  transaction set status ='walkin-completed' ,
    trans_pay='$trans_pay',trans_changes='$trans_changes',total_amount='$total_amount'
    WHERE  tid='$transaction_id'";
    $results = mysqli_query($con, $update);

     
    header("Location: ../walkin_record.php");
   
                              
    exit();              
   }
 ?>