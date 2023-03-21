<?php 
session_start();
include '../../connections/connect.php';
require 'PHPMailer/PHPMailerAutoload.php';
// Get the expiration dates of all the products
$query = "SELECT product.name,production_code,production_log.prod_id, exp_date,production_log.qty_remaining FROM production_log
  LEFT JOIN product on production_log.prod_id = product.prod_id
 WHERE status='ACTIVE' or status='LOW'";
$result = $con->query($query);

date_default_timezone_set("Asia/Manila");

if ($result->num_rows > 0) {


  $expired_products = array();
  $expired_products_quantity = array();

  $tomorrow_expiry_prod = array();
  $tomorrow_expiry_prod_qty = array();


    while ($row = $result->fetch_assoc()) {
        $id = $row['prod_id'];
        $expiration_date = $row['exp_date'];
        $production_code = $row['production_code'];
        $current_date = date("Y-m-d");

        $current_timestamp = strtotime($current_date);
        $expiration_timestamp = strtotime($expiration_date);
        $tomorrow = date("Y-m-d", strtotime("+1 day"));


         $current_timestamp;
         $expiration_timestamp;
         
     

        // Compare the timestamps
        if ($current_timestamp >= $expiration_timestamp) {
            // The product is expired
            // echo "Product with ID $id is expired.<br>";
            $query = "UPDATE `production_log` SET status='EXPIRED' WHERE prod_id='$id' and production_code='$production_code' "; 
            $results = mysqli_query($con, $query);
            $expired_products[] = $row['name'];
            $expired_products_quantity[] = $row['qty_remaining'];

        }  
        elseif  ($expiration_date == $tomorrow) {
          // The product will expire tomorrow
          // echo "Product with ID $id will expire tomorrow.<br>";
          $tomorrow_expiry_prod[] = $row['name'];
          $tomorrow_expiry_prod_qty[] = $row['qty_remaining'];

        }
      //   print_r($expired_products);
      //  print_r($tomorrow_expiry_prod);

      // echo "Expired products:\n";
      // for ($i = 0; $i < count($expired_products); $i++) {
      //     echo '<br> ['.$expired_products[$i].'] </b> '. " Remaining Stock:  " . $expired_products_quantity[$i] . "<br>";
      // }


          

    }
  sendMail($expired_products, $expired_products_quantity,$tomorrow_expiry_prod,$tomorrow_expiry_prod_qty);

    
}


echo 'done';

function sendMail( $expired_products,$expired_products_quantity,$tomorrow_expiry_prod,$tomorrow_expiry_prod_qty){


  // Check the count of the expired products arrays

  $message_expired = '';
  if (count($expired_products) >= 0) {
    for ($i = 0; $i < count($expired_products); $i++) {
         // Debug message to check if the loop is being entered
       $message_expired .='<h4><br>Product Name:  ['.$expired_products[$i].'] </b> <br>'. " Remaining Stock:  " . $expired_products_quantity[$i] . "<br> </h4>----------------";
    }
      }


      $message_expired_tom = '';
      if (count($tomorrow_expiry_prod) >= 0) {
        for ($i = 0; $i < count($tomorrow_expiry_prod); $i++) {
             // Debug message to check if the loop is being entered
           $message_expired_tom .='<h4><br>Product Name:  ['.$tomorrow_expiry_prod[$i].'] </b> <br>'. " Remaining Stock:  " . $tomorrow_expiry_prod_qty[$i] . "<br> </h4>----------------";
        }
          }






          
    // $phpmailer = new PHPMailer();

    // $phpmailer = new PHPMailer();

    // try {
    //     //Server settings
    //     $phpmailer->isSMTP();
    //     $phpmailer->Host = 'smtp.hostinger.com';
    //     $phpmailer->SMTPAuth = true;
    //     $phpmailer->Port = 587;
    //     $phpmailer->Username = 'notify@mannafest-app.online';
    //     $phpmailer->Password = 'Mannafest_101';
    
    //     // Check if the email address is valid
    //     if (!PHPMailer::validateAddress('mannafestfoodinc@gmail.com')) {
    //         throw new Exception("Invalid email address");
    //     }
    
    //     $phpmailer->setFrom('notify@mannafest-app.online', 'Mannafest Food Inc. Online');
    //     $phpmailer->addAddress('mannafestfoodinc@gmail.com');

    //     //Attachments
    //     //$phpmailer->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //     // $phpmailer->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //     //Content
    //     $phpmailer->isHTML(true);                                  //Set email format to HTML
    //     $phpmailer->Subject = 'Expiration Notification | Mannafest Food Online'; 

    //     $today = date("Y-m-d");
    //     $tomorrow = date("Y-m-d", strtotime("+1 day"));



    //     $phpmailer->Body    = "
    //             <center>
    //             <img src='https://i.ibb.co/pRm7g7h/logo.png' alt='header' border='0'>
    //                 <h3>Mannafest Food Inc. Online</h3>
    //             </center>
    //             <h2>Number of expired products: " . count($expired_products) . "</h2>
    //             Today's date: $today <br>
    //              $message_expired
    //              <hr>

    //              <h2>Number of Product that will expire tomorrow ($tomorrow): " . count($tomorrow_expiry_prod) . "</h2>
    //              $message_expired_tom
    //              <hr>
    //                 ";


    //     $phpmailer->send();
    //     echo 'Message has been sent';

    //   $_SESSION['sent']= "successful";

    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    // }



}

?>