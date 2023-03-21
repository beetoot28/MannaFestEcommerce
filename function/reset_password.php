<?php 
session_start();
 include('../connections/connect.php');
                        if (isset($_POST['verify'])) {

                            $token = $_GET['token'];
                            $password = $_POST['password'];
                            $conpassword = $_POST['conpassword'];
                      

                             $sql = " select * from `password_reset` where  reset_token = '$token' and is_valid='1'  ";
                             $result = mysqli_query($con,$sql); 
                          
                             $count = mysqli_num_rows($result);
                            if($count == 0){
               
                        
                                $_SESSION['error']= "successful";
                                header("Location: ../log/forgot.php?token=$token");     
                            }	
                        else{
                            $data = mysqli_fetch_array($result);
                            $user_id = $data['user_id'];
                            $query = "UPDATE  `accounts` SET `password`='$password' WHERE user_id='$user_id' ";
                            $res = mysqli_query($con, $query);

                            $sql = "UPDATE  password_reset SET `is_valid`=0 WHERE token='$token' ";
                            $changedefault = mysqli_query($con, $sql);

                            $_SESSION['success']= "successful";
                            header("Location: ../log/signin.php");         
                                    }
                          
                                exit();
                                }
 ?>