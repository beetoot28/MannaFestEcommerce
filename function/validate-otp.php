<?php 
session_start();
 include('../connections/connect.php');
                        if (isset($_POST['verify'])) {

                            $user_id = $_POST['user_id'];
                            $first = $_POST['first'];
                            $second = $_POST['second'];
                            $third = $_POST['third'];
                            $fourth = $_POST['fourth'];
                            $fifth = $_POST['fifth'];
                            $sixth = $_POST['sixth'];

                             $merged = $first.''.$second.''.$third.''.$fourth.''.$fifth.''.$sixth;

                             $sql = " select * from `otp-sms` where  user_id = '$user_id' and otp='$merged' ";
                              $result = mysqli_query($con,$sql); 
                              
                             $count = mysqli_num_rows($result);
                            if($count == 0){
                                $_SESSION['error']= "successful";
                                header("Location: ../log/verify.php?v=$user_id");     
                            }	
                        else{

                            $query = "UPDATE  `otp-sms` SET `status`=1 WHERE user_id='$user_id' and otp='$merged'  ";
                            $res = mysqli_query($con, $query);

                            $sql = "UPDATE  accounts SET `status`=1 WHERE user_id='$user_id' ";
                            $changedefault = mysqli_query($con, $sql);

                            $_SESSION['success_verify']= "successful";
                            header("Location: ../index.php");         
                                    }
                          
                                exit();
                                }
 ?>