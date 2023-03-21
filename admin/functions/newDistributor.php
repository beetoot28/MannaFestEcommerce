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
                            $datenow = date('Y-m-d H:i:s');
                            $distributor = $_POST['distributor'];

                            date_default_timezone_set('Asia/Manila');
                    
                            $sql = mysqli_query($con, "SELECT  COUNT(*) from transaction  "); 
                            $transfer = mysqli_fetch_array($sql);

                            $generate= sprintf("%'03d", $transfer[0]+1);
                            $today = date("Y");
                            $randomText = generateRandomString();
                            $code = 'M'.$today . $generate;
                         

                            $create_transaction = "INSERT INTO `transaction`(`user_id`,`dis_id`, `paymentmethod`, `datecreated`,`status`,`type`,`trans_code`) 
                            VALUES ('60','$distributor','cash','$datenow','Distributor-pending','distributor','$code')  ";
                                $transcation_ = mysqli_query($con,$create_transaction); 

                                $transaction_id = mysqli_insert_id($con);
                                   
                                    if ($transcation_) {
                                    

                                        header("Location: ../distributor.php?trans=$transaction_id");
                               

                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
 ?>