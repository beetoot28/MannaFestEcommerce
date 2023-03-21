<?php 
session_start();
include '../../connections/connect.php';
                        if (isset($_POST['submit'])) {
                            

                            echo $autoReceived = $_POST['autoReceived'];
                            echo  $minOrder = $_POST['minOrder'];
  
                            $query = "UPDATE `settings` SET autoReceived='$autoReceived',
                            minTotalOrder='$minOrder'";     
                                $result = mysqli_query($con,$query); 

                        
                                   
                                    if ($result) {

                                        header("Location: ../orders.php");
                                        // $_SESSION['new_address']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                exit();
                                }
 ?>