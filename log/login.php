<?php 
session_start();
include '../connections/connect.php';

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



if(isset($_POST['login'])){ 

	$email = $_POST['email'];
	$password = $_POST['password'];

	$password = encrypt_decrypt('encrypt', $password);

	
			$compare = " SELECT * FROM `accounts` where email = '$email' and password = '$password' and user_type = 'client'  ";
	                $credentials = mysqli_query($con,$compare); 
	                $count= mysqli_num_rows($credentials);



	               //  $get_id =  mysqli_insert_id($con); 
	             if ($count>=1){
					
	            	
	                 while($row = mysqli_fetch_array($credentials)){
						$_SESSION['user_id'] = $row['user_id'];
						$_SESSION['user_name'] = $row['name'].' '.$row['lastname'];
						$_SESSION['user_isset']=1;
						$_SESSION['user_daddress'] = $row['d_address'];
						$userid = $row['user_id'];
						$userphone = $row['mobile_number'];
						$ipadd = $row['ipaddress'];
						$_SESSION['user_ip'] = $ipadd;
	                 }

					 $sql = " select * from `accounts` where  user_id = '$userid' and status=0 ";
					 $result = mysqli_query($con,$sql); 
					 $countVerify= mysqli_num_rows($result);
					 if($countVerify >= 1){
						// send otp

						$SixDigitRandomNumber = mt_rand(100000,999999);
						$SixDigitRandomNumber;

									
							$send_otp = "INSERT INTO `otp-sms`(`user_id`, `mobile_number`,`otp`,status)
							VALUES ('$userid','$userphone','$SixDigitRandomNumber',0)";
							mysqli_query($con,$send_otp);

						   require '../vendor/autoload.php';


							$client = new GuzzleHttp\Client(); 

							$response = $client->request("POST", "https://api.sms.fortres.net/v1/messages", [
								"headers" => [
									"Content-type" => "application/json"
								],
								"auth" => ["ea74cab6-4f29-4ca5-92a8-3ff758aaa9cf", "X0qRewwoT8f36lAPDucrICHbQgQVCenCuD7wbwEB"],
								"json" => [
									"recipient" => "$userphone",
									"message" => "Your Mannafest verification code is $SixDigitRandomNumber"
								]
							]);

						// 	if ($response->getStatusCode() == 200) {
						// 		echo $response->getBody();
							

						// 	}
						$_SESSION['reg_phone'] = $userphone;
						$_SESSION['verify_user_id'] = $userid;
						$_SESSION['verify_first']= "successful";
						echo 'verify_first';   
						exit();
					}
					else {

						echo 'match';
	                 		$getallcartitems = " select * from cart where user_id = '$ipadd'  ";
	                                 $gettingcart_items = mysqli_query($con,$getallcartitems); 
	                             
	                                  while($row = mysqli_fetch_array($gettingcart_items)){
	                 					

	                 					$prod_id = $row['prod_id'];
	                 					$qty = $row['quantity'];

	                 					

	                 							$checkcart = " select * from cart where user_id = '$userid' and prod_id = '$prod_id' ";
	                 					                $chckngcart = mysqli_query($con,$checkcart); 
	                 					                $countcart= mysqli_num_rows($chckngcart);
	                 					               //  $get_id =  mysqli_insert_id($con); 
	                 					             if ($countcart>=1){
	                 					            	
	                 					            	
	                 					                 while($gi = mysqli_fetch_array($chckngcart)){
	                 											$cartids = $gi['cart_id'];
	                 											$qtys = $gi['quantity'];
	                 											$prid = $gi['prod_id'];
	                 											$totalqty = $qtys + $qty;
	                 											$price = $gi['itemprice'];

	                 											$totalprice = $price * $totalqty;

	                 						$updatecart_toforwarditems = "UPDATE `cart` SET `quantity`='$totalqty' , `total` = '$totalprice' WHERE user_id = '$userid' and cart_id = '$cartids' ";
	                 					mysqli_query($con,$updatecart_toforwarditems);

	                 					
	                 					


	                 					                 }


	                 					               
	                 					          }else {
	                 					          	
	                 					$updatecart_toforwarditems = "UPDATE `cart` SET `user_id`='$userid' WHERE user_id = '$ipadd' and prod_id = '$prod_id' ";
	                 					mysqli_query($con,$updatecart_toforwarditems);
	                 					          }

	                 					

	                 					/*
										*/
	                                  }

	                                  	$getallwishlistitems = " SELECT * FROM `wishlist` where user_id = '$ipadd'    ";
	                                                  $gettingwishlist = mysqli_query($con,$getallwishlistitems); 
	                                                 
	                                              
	                                                   while($row = mysqli_fetch_array($gettingwishlist)){

	                                                   	$prod_id = $row['prod_id'];


	                                                   	$checkwl = " select * from wishlist where user_id = '$userid' and prod_id = '$prod_id' ";
	                 					                $chckngwl = mysqli_query($con,$checkwl); 
	                 					                $countcart= mysqli_num_rows($chckngwl);
	                 					               //  $get_id =  mysqli_insert_id($con); 
	                 					             if ($countcart>=1){
	                 					            	
	                 					          

	                 					               
	                 					          }else {
	                 					          	$updatewislist_toforwarditems = "UPDATE `wishlist` SET `user_id`='$userid' WHERE user_id = '$ipadd' and prod_id = '$prod_id' ";
	                                  					mysqli_query($con,$updatewislist_toforwarditems);
	                 					
	                 					          }

	                                  					
	                                                   

	                                                   }

	                                                  
	                                            
	                           
			}


	          }else {
	          

	          			$checkadmin = " SELECT * FROM `accounts` where email = '$email' and password = '$password' and user_type = 'admin'   ";
	          	                $ckadmin = mysqli_query($con,$checkadmin); 
	          	                $cad = mysqli_num_rows($ckadmin);
	          	               
	          	             if ($cad>=1){
	          	            
	          	                 while($row = mysqli_fetch_array($ckadmin)){
	          	                 	$tp = $row['user_type'];
	          							  				
	          	                 	$_SESSION['admin_id'] = $row['user_id'];
	          						$_SESSION['admin_name'] = $row['name'];
	          						$_SESSION['admin_email'] = $row['email'];
	          						

	          	                 }

	          	               echo 'adminmatch';
	          	                 


	          	               
	          	          }else {

	          	          			$checkadmins = " SELECT * FROM `accounts` where email = '$email' and password = '$password' and user_type = 'courier'   ";
	          	                $ckadmins = mysqli_query($con,$checkadmins); 
	          	                $cads = mysqli_num_rows($ckadmins);	

	          	                if($cads >=1 ){

	          	                	   while($row = mysqli_fetch_array($ckadmins)){
	          	                 	$tp = $row['user_type'];
	          							  				
	          	            		$_SESSION['cour_id'] = $row['user_id'];
	          						$_SESSION['cour_name'] = $row['name'];
	          						$_SESSION['cour_email'] = $row['email'];
	          							
	          						

	          	                 }

	          	                 echo 'couriermatch';

	          	                }else {
	          	                echo 'notmatch';	
	          	                }


	          	          		
	          	          }
	          }




	
}


 ?>