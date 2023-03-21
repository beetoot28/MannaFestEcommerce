<?php 
session_start();
 include('../connections/connect.php');
                        if (isset($_POST['update'])) {
                            
                            $ship_id = $_POST['ship_id'];
                            $name = $_POST['name'];
                            $address = $_POST['address_1'].', '.$_POST['address_2'].', '.$_POST['address_3'];

                            $address_1 = $_POST['address_1'];
                            $address_2 = $_POST['address_2'];
                        
                            $postal = $_POST['postal'];
                            $contact = $_POST['phone_number'];
                      

                                // $query = "INSERT INTO account_ship_address (contact_name,phone_number,address,postal_code,user_id,status,address_1,address_2) 
                                //         VALUES ('$name','$contact','$address','$postal','$user_id','1','$address_1','$address_2')";
                                // $results = mysqli_query($con, $query);


                                $query = "UPDATE `account_ship_address` 
                                SET contact_name='$name',phone_number='$contact',address='$address',postal_code='$postal',
                                address_1='$address_1',address_2='$address_2'
                                 WHERE ship_id='$ship_id' ";
                                $changedefault = mysqli_query($con, $query);
                                   
                                    if ($changedefault) {
                                        header("Location: ../cart.php");
                                        $_SESSION['new_address']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }
                                else if (isset($_POST['delete'])) {
                            
                                    $ship_id = $_POST['ship_id'];
                         
                              
                                    $query = "DELETE FROM `account_ship_address` WHERE ship_id = '$ship_id'";
                                    $results = mysqli_query($con, $query);

        
                                            if ($results) {
                                                header("Location: ../cart.php");
                                                $_SESSION['new_address']= "successful";
                                                
                                                exit();
                                            } else {
                                                echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                            }
                                        //exit();
                                        }
 ?>