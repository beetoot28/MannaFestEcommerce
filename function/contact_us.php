<?php 

session_start();
include('../connections/connect.php');

date_default_timezone_set("Asia/Manila");
$datenow = date("Y-m-d");

$name = $_POST['name']; 
$email_address = $_POST['email']; 
$message = $_POST['feedback']; 

$query = "INSERT INTO customer_feedback (name,email,feedback,date) 
VALUES ('$name','$email_address','$message','$datenow')";
$results = mysqli_query($con, $query);

if ($results) {
	header("Location: ../index.php");
	$_SESSION['sent_contact']= "successful";

} else {
	echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
}


?>