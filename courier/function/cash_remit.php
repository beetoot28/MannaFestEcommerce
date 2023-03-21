<?php 
session_start();
include '../../connections/connect.php';
function remove_non_numeric($string) {
    return preg_replace("/[^0-9]/", "", $string);
}

date_default_timezone_set("Asia/Manila");

                        if (isset($_POST['submit'])) {
                        
                             $user_id = remove_non_numeric($_POST['user_id']);
                          
                              $cash_remit = remove_non_numeric($_POST['cash_remit']);
                              $cash_remaining = remove_non_numeric($_POST['cash_remaining']);
                              $prev_total_remit = remove_non_numeric($_POST['prev_total_remit']);
                             
                              echo $datenow = date('Y-m-d H:i:s');
                               echo $total_remit = (float)$prev_total_remit + (float)$cash_remit;


                               echo $datenow  = date("Y-m-d");
                                    $sql = "UPDATE `courier_trans` SET `total_remit`='$total_remit' , `total_cash_onhand`='$cash_remaining' WHERE user_id = '$user_id' and date='$datenow'";
                                        $result =  mysqli_query($con,$sql);

                                   
                                    if ($result) {
                                        // header("Location: ../remit.php");
                                        $_SESSION['remit']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $sql. ".mysqli_error($con);
                                    }
                                exit();
                                }
                                

                             
 ?>