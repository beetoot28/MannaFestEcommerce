<?php 
session_start();
include '../../connections/connect.php';
                        if (isset($_POST['submit'])) {
                            

                              $verdict = $_POST['select'];
                            echo  $return_id = $_POST['return_id'];
                            echo  $remarks = $_POST['remarks'];
                            date_default_timezone_set('Asia/Manila');
                            $datenow = date('Y-m-d');
                   
                            $query = "UPDATE `return_request` SET status='$verdict',
                            remarks='$remarks',date_verdict='$datenow',type='online'

                            WHERE return_id='$return_id'";     
                                $result = mysqli_query($con,$query); 

                        
                                   
                                    if ($result) {

                                        header("Location: ../orders.php?tab=5");
                                        // $_SESSION['new_address']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }
 ?>