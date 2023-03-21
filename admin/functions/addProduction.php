<?php 
session_start();
include '../../connections/connect.php';
                        if (isset($_POST['add'])) {
                            
                            $prod_code = $_POST['prod_code'];
                            $prod_id = $_POST['prod_id'];
                            $qty = $_POST['quantity'];
                            $prod_date = $_POST['prod_date'];
                            $exp_date = $_POST['exp_date'];

                            $cost = $_POST['cost'];
                            $price = $_POST['price'];

                                $query = "INSERT INTO production_log (production_code,prod_id,qty_added,qty_remaining,prod_date,exp_date,status,cost,price) 
                                        VALUES ('$prod_code','$prod_id','$qty','$qty','$prod_date','$exp_date','ACTIVE',$cost,$price)";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                        // update qty
                                        $sql = mysqli_query($con, "SELECT * from product_quantity
                                         where prod_id ='$prod_id'");  
                                        $arr = mysqli_fetch_array($sql);

                                        $prev_qty = $arr['quantity'];
               
                                        $newQty = (int)$qty +(int)$prev_qty;
                                        
                                        $query = "UPDATE `product_quantity` SET quantity='$newQty'
                                         WHERE prod_id='$prod_id'";         
                                        $results = mysqli_query($con, $query);


                                        $sql = "UPDATE `product` SET cost='$cost',price='$price'
                                        WHERE prod_id='$prod_id'";         
                                          $res = mysqli_query($con, $sql);

                        
                                        header("Location: ../stock-in.php");
                                        $_SESSION['new_brand']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>