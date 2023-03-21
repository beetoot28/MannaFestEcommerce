<?php 
session_start();
 include('../connections/connect.php');
                        if (isset($_POST['add'])) {


                            $list_items = implode(",", $_POST["product_select"]);

                        
                             $user_id = $_POST['user_id'];
                             $tid = $_POST['tid'];
                             $reason = $_POST['reason'];


                             $date = $_POST['date'];
                             $payment = $_POST['payment'];


                            $image_name = $_FILES['image']['name'];
                            $tmp_name   = $_FILES['image']['tmp_name'];
                       
                                                                                                                                                                       
                            echo $fileName =basename($_FILES['image']['name']);
                           
                            $uploads_dir = '../img/return_proof';
                            move_uploaded_file($tmp_name , $uploads_dir .'/'.$fileName);

                            $selected_items = $_POST["product_select"];
                            $qty = $_POST["qty"];
                       
                       
                       
                       

                                $query = "INSERT INTO return_request (user_id,transaction_id,selected_prod,proof_img,reason,status,date_ordered,payment_type,type) 
                                        VALUES ('$user_id','$tid','$list_items','$fileName','$reason','Pending','$date','$payment','online')";
                                $results = mysqli_query($con, $query);
                                $return_id = $con->insert_id;
                                    if ($results) {

                                                                                
                                    for ($i = 0; $i < count($selected_items); $i++) {


                                    


                                        echo "Selected product: " . $selected_items[$i] . "<br>";
                                        echo "Assigned quantity: " . $qty[$i] . "<br><br>";
                                        $prod_id = $selected_items[$i];
                                        $qty_prod = $qty[$i];

                        
                                        $sql_check = "SELECT * from product where  prod_id='$prod_id'";
                                        $res_check = mysqli_query($con,$sql_check);
                                        $arr = mysqli_fetch_array($res_check);
                                        $total = $arr['price'] * $qty_prod;

                                        $query = "INSERT INTO return_product 
                                        (return_id,prod_id,qty,total) 
                                                VALUES ('$return_id','$prod_id','$qty_prod','$total')";
                                        $results = mysqli_query($con, $query);
                                    }


            
                                        header("Location: ../orders.php?p=$tid");
                                        $_SESSION['new_address']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }
 ?>