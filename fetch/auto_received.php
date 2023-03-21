<?php 
session_start();
include '../connections/connect.php';

$user_id = (string)$_POST['user_id'];
 
$sql = "SELECT * FROM settings";
$res = $con->query($sql);
$settings = mysqli_fetch_array($res);

$settings = $settings['autoReceived'];


// Get the expiration dates of all the products
$query = "SELECT * from transaction 
where user_id='$user_id' and status='delivered'";
$result = $con->query($query);
date_default_timezone_set('Asia/Manila');


if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $id = $row['tid'];
        $date_delivered = $row['date_delivered'];
        echo $current_date = date("Y-m-d");
        $current_date = date("Y-m-d H:i:s");
   

        if($settings == 1 || $settings=='1'){
            $completion_date = date("Y-m-d H:i:s", strtotime($date_delivered . "+1 day"));

        }
        elseif ($settings == 2 || $settings=='2') {
            $completion_date = date("Y-m-d H:i:s", strtotime($date_delivered . "+2 day"));

        }
        elseif ($settings == 0 || $settings=='0') {
            $completion_date = date("Y-m-d H:i:s", strtotime($date_delivered));

        }
  

        
     

        // Compare the timestamps
        if ($current_date >= $completion_date) {
            // // The product is expired
            // // echo "Product with ID $id is expired.<br>";
            $query = "UPDATE `transaction` SET status='completed',date_completed='$current_date' WHERE tid='$id'"; 
            $results = mysqli_query($con, $query);

        }  
      



          

    }

    
}


echo $user_id;


?>