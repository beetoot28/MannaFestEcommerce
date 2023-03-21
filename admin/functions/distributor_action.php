<?php 
session_start();
include '../../connections/connect.php';
                        if (isset($_POST['add'])) {
                            
                            $name = $_POST['name'];
                            $address = $_POST['address'];
                            $contact = $_POST['contact'];
              

                                $query = "INSERT INTO distributor_details (distributor_name,distributor_address,distributor_contact) 
                                        VALUES ('$name','$address','$contact')";
                                $results = mysqli_query($con, $query);
                                   
                                    if ($results) {
                                      

                                        header("Location: ../distributor_record.php");
                                        $_SESSION['new_brand']= "successful";
                                        
                                        exit();
                                    } else {
                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                    }
                                //exit();
                                }

                                if (isset($_POST['update'])) {
                                    $id = $_POST['id'];
                                    $name = $_POST['name'];
                                    $address = $_POST['address'];
                                    $contact = $_POST['contact'];
                      
        
                                        $query = "UPDATE distributor_details 
                                        SET distributor_name = '$name', distributor_address = '$address', distributor_contact = '$contact'
                                        WHERE dis_id='$id'";
                                        $results = mysqli_query($con, $query);
                                           
                                            if ($results) {
                                              
        
                                                header("Location: ../distributor_record.php");
                                                $_SESSION['new_brand']= "successful";
                                                
                                                exit();
                                            } else {
                                                echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                            }
                                        //exit();
                                        }
                                        if (isset($_POST['delete'])) {
                                            $id = $_POST['d_id'];
                                          
                              
                
                                                $query = "DELETE FROM `distributor_details` WHERE dis_id ='$id' ";
                                                $results = mysqli_query($con, $query);
                                                   
                                                    if ($results) {
                                                      
                
                                                        header("Location: ../distributor_record.php");
                                                        $_SESSION['new_brand']= "successful";
                                                        
                                                        exit();
                                                    } else {
                                                        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
                                                    }
                                                //exit();
                                                }
                                
 ?>