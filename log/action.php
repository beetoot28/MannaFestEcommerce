<?php 
session_start();
include '../connections/connect.php';


// Required if your environment does not handle autoloading
require '../vendor/autoload.php';






$tempusers = $_SESSION['user_id'];

if(isset($_POST['reg_step1'])){

$ln = $_POST['ln']; 
$fn = $_POST['fn'];
$bd = $_POST['bd'];
$addr = $_POST['addr'];
$daddr = $_POST['daddr'];
$postal = $_POST['postal'];
echo $tempusers;

	$updatetemp = "UPDATE `tempuser` SET postal='$postal', `lastname`='$ln',`firstname`='$fn',`birthdate`='$bd',`address`='$addr',`deliveryaddr`='$daddr' WHERE ipaddress = '$tempusers' ";
	mysqli_query($con,$updatetemp);


	
}

if(isset($_POST['reg_step2'])){

$em = $_POST['em'];
$pass = $_POST['pass'];

	$updatetemp = "UPDATE `tempuser` SET `email`='$em',`password`='$pass' WHERE ipaddress = '$tempusers' ";
	mysqli_query($con,$updatetemp);


	
}

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = '1f312kj3hj12h5jh32j4h';
    $secret_iv = '45643tj2ikljrdlfjsaljd';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}


if(isset($_POST['reg_step3'])){

$phone = $_POST['phone_number'];

date_default_timezone_set('Asia/Manila'); 
	$datenow = date('Y-m-d H:i:s');
	$updatetemp = "UPDATE `tempuser` SET `mobile_number`='$phone' WHERE ipaddress = '$tempusers' ";
	


	if(mysqli_query($con,$updatetemp)){
		//get the tempdata and save to accounts
					$selecttemp = " select * from tempuser where  ipaddress = '$tempusers' ";
			                $getthetemp_data = mysqli_query($con,$selecttemp); 
			             
			                 while($row = mysqli_fetch_array($getthetemp_data)){
					$ln = $row['lastname'];
                    $fn = $row['firstname'];
                    $bd = $row['birthdate'];
                    $addr = $row['address'];
                    $deliv = $row['deliveryaddr'];
                    $email = $row['email'];
                    $pass = $row['password'];
					$postal = $row['postal'];
                    $phone = '+63'.$row['mobile_number'];

					$pass = encrypt_decrypt('encrypt', $pass);



					$SixDigitRandomNumber = mt_rand(100000,999999);
					 $SixDigitRandomNumber;
                  
				

                    $savecustomer = "INSERT INTO `accounts`(`name`, `lastname`, `email`, `user_type`,`date_registered`, `password`,`birthdate`, `address`, `d_address`, `mobile_number`,`ipaddress`,status)
                     VALUES ('$fn','$ln','$email','client','$datenow','$pass','$bd','$addr','$deliv','$phone','$tempusers','0')";
                    mysqli_query($con,$savecustomer);
					$user_id = $con->insert_id;
					echo $user_id;
					
					$send_otp = "INSERT INTO `otp-sms`(`user_id`, `mobile_number`,`otp`,status)
					VALUES ('$user_id','$phone','$SixDigitRandomNumber',0)";
				   mysqli_query($con,$send_otp);


				   $full_n = $fn.' '.$ln;
				   $save_shipping = "INSERT INTO `account_ship_address`(`contact_name`, `phone_number`,`address`,`postal_code`,`user_id`,`status`)
				   VALUES ('$full_n','$phone','$deliv','$postal','$user_id','1')";
				  	mysqli_query($con,$save_shipping);
			

				   $_SESSION['reg_phone'] = $phone;
				   $_SESSION['verify_user_id'] = $user_id;
				   	require '../vendor/autoload.php';


							$client = new GuzzleHttp\Client(); 

							$response = $client->request("POST", "https://api.sms.fortres.net/v1/messages", [
								"headers" => [
									"Content-type" => "application/json"
								],
								"auth" => ["ea74cab6-4f29-4ca5-92a8-3ff758aaa9cf", "X0qRewwoT8f36lAPDucrICHbQgQVCenCuD7wbwEB"],
								"json" => [
									"recipient" => "$phone",
									"message" => "Your Mannafest verification code is $SixDigitRandomNumber"
								]
							]);

						
			
								
			                 }
							
							
	}


	
}




?>