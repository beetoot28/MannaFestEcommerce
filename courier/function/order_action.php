<?php 
session_start();
include '../../connections/connect.php';

                        if (isset($_POST['confirm'])) {
                            
                           echo  $trans_id = $_POST['trans_id'];
                            // $prod_id = $_POST['prod_id'];
                                    date_default_timezone_set('Asia/Manila');
                                     $datenow = date('Y-m-d H:i:s');
                                    $query = "UPDATE `transaction` SET status='ready',date_delivered='$datenow'
                                    WHERE tid='$trans_id'";         
                                   $results = mysqli_query($con, $query);

                                   
                                    if ($results) {
                                        header("Location: ../orders.php");
                                        $_SESSION['confirmed_order']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }
                                

                                if (isset($_POST['deliver'])) {
                            
                                      $trans_id = $_POST['trans_id'];
                                     // $prod_id = $_POST['prod_id'];
                                     date_default_timezone_set('Asia/Manila');
                                     echo $datenow = date('Y-m-d H:i:s');
                               
                                    
                                        $query = "UPDATE `transaction` SET status='otw',date_delivered='$datenow' WHERE tid='$trans_id'";         
                                         $results = mysqli_query($con, $query);
         
                                         $listOrder = mysqli_query($con, "SELECT * from trans_record 
                                         LEFT JOIN product on trans_record.prod_id = product.prod_id
                                         where transaction_id='$trans_id'");
                                         while ($row = mysqli_fetch_array($listOrder)) {

                                            echo $prod_id= $row['prod_id'];
                                            echo $order_qty = $row['quantity'];
                                            echo $stockAlert = $row['stockAlert'];
                                            echo $status ='ACTIVE';
                                            // select product quantity
                                            // $sql = mysqli_query($con, "SELECT * from product_quantity where prod_id='$prod_id'");  
                                            // $prod = mysqli_fetch_array($sql);
                                            // $prod_qty =  $prod['quantity'];

                                            $sql = mysqli_query($con, "SELECT * from production_log where prod_id='$prod_id' AND status='ACTIVE' ORDER BY `production_code` DESC LIMIT 1");  
                                            $log = mysqli_fetch_array($sql);

                                            $prod_log_qty =  $log['qty_remaining'];


                                            $prod_qty = $prod_qty - $order_qty;
                                            $prod_log_qty = $prod_log_qty - $order_qty;


                                            if ($prod_log_qty <=$stockAlert){
                                                $status='LOW';


                                            }
                                            else if ($prod_log_qty <= 0)
                                            {
                                                $status='EMPTY';
                                            }


                       
                                            $update = "UPDATE  product_quantity set quantity ='$prod_qty' WHERE  prod_id='$prod_id'";
                                            $res = mysqli_query($con, $update);
                                      
                                            $update = "UPDATE  production_log set qty_remaining ='$prod_log_qty',status='$status' WHERE  prod_id='$prod_id'";
                                            $res = mysqli_query($con, $update);

                                         }
    

                                            
                                             if ($results) {

                    
                                                 header("Location: ../orders.php?tab=2");
                                                 $_SESSION['deliver_order']= "successful";

                                                 
                                                 
                                                 exit();
                                             } else {
                                                 echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                             }
                                         exit();
                                         }
 ?>