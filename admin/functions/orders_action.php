<?php 
session_start();
include '../../connections/connect.php';
require 'vendor/autoload.php';

                        if (isset($_POST['confirm'])) {
                            
                          
                           echo  $trans_id = $_POST['trans_id'];
                            // $prod_id = $_POST['prod_id'];
           
                                    $query = "UPDATE `transaction` SET status='ready'
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
                                    $courier = $_POST['courier'];
                                    echo  $trans_id = $_POST['trans_id'];
                                     // $prod_id = $_POST['prod_id'];
                                     preg_match('/^\d+/', $courier, $matches);
                                     $delivery_id = $matches[0];

                                     
                                         $query = "UPDATE `transaction` SET status='otw',delivery_rider='$courier',
                                         delivery_rider_id='$delivery_id'
                                          WHERE tid='$trans_id'";         
                                         $results = mysqli_query($con, $query);
         
                                         $listOrder = mysqli_query($con, "SELECT * from trans_record 
                                         LEFT JOIN product on trans_record.prod_id = product.prod_id
                                         where transaction_id='$trans_id'");
                                         $customer_id='';
                                         while ($row = mysqli_fetch_array($listOrder)) {
                                            echo $customer_id = $row['user_id'];
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
                                            $prod_code =  $log['production_code'];
                                            $prod_log_qty =  $log['qty_remaining'];


                                            // $prod_qty = $prod_qty - $order_qty;
                                            $prod_log_qty = $prod_log_qty - $order_qty;


                                            if ($prod_log_qty <=$stockAlert){
                                                $status='LOW';


                                            }
                                            else if ($prod_log_qty <= 0)
                                            {
                                                $status='EMPTY';
                                            }


                       
                                            // $update = "UPDATE  product_quantity set quantity ='$prod_qty' WHERE  prod_id='$prod_id'";
                                            // $res = mysqli_query($con, $update);
                                      
                                            $update = "UPDATE  production_log set qty_remaining ='$prod_log_qty',status='$status' WHERE  prod_id='$prod_id'
                                            and production_code='$prod_code'";
                                            $res = mysqli_query($con, $update);
                                            $update = "UPDATE  transaction set prod_log_id ='$trans_id' WHERE  tid='$trans_id'";
                                            $res = mysqli_query($con, $update);

                                            // prod_log_id
                                         }


                                         $getAddress = " select * from account_ship_address where user_id='$customer_id' and status='1' ";
                                         $results = mysqli_query($con, $getAddress);
                                         $arrCon = mysqli_fetch_array($results);
                                        $contact = $arrCon['phone_number'];



                                        //  $client = new GuzzleHttp\Client(); 
             
                                        //  $response = $client->request("POST", "https://api.sms.fortres.net/v1/messages", [
                                        //      "headers" => [
                                        //          "Content-type" => "application/json"
                                        //      ],
                                        //      "auth" => ["ea74cab6-4f29-4ca5-92a8-3ff758aaa9cf", "X0qRewwoT8f36lAPDucrICHbQgQVCenCuD7wbwEB"],
                                        //      "json" => [
                                        //          "recipient" => "$contact",
                                        //          "message" => "Mannafest Food Inc. | Your order has been pickup by our delivery riders ,
                                        //          please prepare exact amount. Photo proof of delivery is require, thanks and be safe."
                                        //      ]
                                        //  ]);

                                            
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