<?php 
session_start();
include '../../connections/connect.php';

                        if (isset($_POST['confirm'])) {
                            
                             $trans_id = $_POST['trans_id'];
                            $reason = $_POST['reason'];
                                    date_default_timezone_set('Asia/Manila');
                                     $datenow = date('Y-m-d H:i:s');
                                    $query = "UPDATE `transaction` SET status='cancelled',reason='$reason'
                                    WHERE tid='$trans_id'";         
                                   $results = mysqli_query($con, $query);

                                   
                                    if ($results) {
                                        header("Location: ../index.php");
                                        // $_SESSION['confirmed_order']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }
                                

                             ?>