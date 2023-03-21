<?php 
session_start();
include '../../connections/connect.php';
if (isset($_POST['add'])) {

     $list_items = implode(",", $_POST["product_select"]);
     $user_id = $_POST['user_id'];
     $tid = $_POST['tid'];
     $reason = $_POST['reason'];
     $remarks = $_POST['remarks'];
     $trans_code = $_POST['trans_code'];
     

     $date = $_POST['trans_date'];
     $payment ='Walkin';


     $selected_items = $_POST["product_select"];
     $qty = $_POST["qty"];




        $query = "INSERT INTO return_request 
        (user_id,transaction_id,selected_prod,reason,status,date_ordered,payment_type,type,remarks,trans_code) 
                VALUES ('$user_id','$tid','$list_items','$reason','CONFIRMED','$date','$payment','admin','$remarks','$trans_code')";
        $results = mysqli_query($con, $query);
        $return_id = $con->insert_id;

            if ($results) {

                            
            for ($i = 0; $i < count($selected_items); $i++) {


             


                echo "Selected product: " . $selected_items[$i] . "<br>";
                echo "Assigned quantity: " . $qty[$i] . "<br><br>";
                $prod_id = $selected_items[$i];
                $qty_prod = $qty[$i];

   
                $sql_check = "SELECT * from product where  prod_id='$prod_id'";
                $res_check = mysqli_query($con,$sql_check);
                $arr = mysqli_fetch_array($res_check);
                   $total = $arr['price'] * $qty_prod;

                $query = "INSERT INTO return_product 
                (return_id,prod_id,qty,total) 
                        VALUES ('$return_id','$prod_id','$qty_prod','$total')";
                $results = mysqli_query($con, $query);
            }


      
                header("Location: ../return_request.php");
                $_SESSION['new_address']= "successful";


                
                
                exit();
            } else {
                echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
            }
        exit();
        }
 ?>