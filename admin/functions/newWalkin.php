<?php 
session_start();
include '../../connections/connect.php';
                function generateRandomString($length = 3) {
                        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        return $randomString;
                    }


                        if (isset($_POST['add'])) {
                            
                            date_default_timezone_set('Asia/Manila');
                    
                            $sql = mysqli_query($con, "SELECT  COUNT(*) from transaction  "); 
                            $transfer = mysqli_fetch_array($sql);

                            $generate= sprintf("%'03d", $transfer[0]+1);
                            $today = date("Y");
                            $randomText = generateRandomString();
                            $code = 'M'.$today . $generate;



                         
                            $datenow = date('Y-m-d H:i:s');
                            

                            $create_transaction = "INSERT INTO `transaction`(`user_id`, `paymentmethod`, `datecreated`,`status`,`type`,`trans_code`) 
                            VALUES ('59','cash','$datenow','walkin-pending','walkin','$code')  ";
                                $transcation_ = mysqli_query($con,$create_transaction); 

                                $transaction_id = mysqli_insert_id($con);
                                   
                                    if ($transcation_) {
    

                                        header("Location: ../walkin.php?trans=$transaction_id");
                                        // $_SESSION['new_address']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $transcation_. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>