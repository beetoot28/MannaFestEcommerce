<?php 
session_start();
include '../../connections/connect.php';
if (isset($_POST['delete'])) {

    $prod_id =$_POST['del_id'];



    $query = "DELETE FROM `product` WHERE prod_id = '$prod_id'";
    $results = mysqli_query($con, $query);

    $query = "DELETE FROM `production_log` WHERE prod_id = '$prod_id'";
    $results = mysqli_query($con, $query);

    $query = "DELETE FROM `product_quantity` WHERE prod_id = '$prod_id'";
    $results = mysqli_query($con, $query);
        
    $_SESSION["delete"]= "sales";
    header("Location: ../products.php");

        exit();
        }

?>