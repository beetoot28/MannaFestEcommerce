<?php 
session_start();
include 'connections/connect.php';

	if(!isset($_SESSION['user_isset'])){
		header('location:log/signin.php');
	}else {

		if(isset($_POST['proceedwmethod'])){ 
			$flexRadioDefault = $_POST['flexRadioDefault'];

			echo $flexRadioDefault;
			
			$_SESSION['pmt_method'] = $flexRadioDefault;
			
		}


		if(isset($_POST['editaddress'])){ 

			$uid = $_POST['uid'];
			$val = $_POST['val'];

			$updateaddress = "UPDATE `accounts` SET `d_address`='$val' WHERE user_id = '$uid' ";
			mysqli_query($con,$updateaddress);
			$_SESSION['user_daddress'] = $val;
		}


		if(isset($_POST['payment'])){ 
			$pm = $_POST['pm'];
			$total = $_POST['total'];
			$total_purchased = $_POST['total_purchased'];
			$discount = $_POST['discount'];


			$user = $_SESSION['user_id'];
			date_default_timezone_set('Asia/Manila');
			$datenow = date('Y-m-d H:i:s');
			$_SESSION['sccsfl'] = 1;

				$_SESSION['pmt_method'] = $pm;
				$disc =  $_SESSION['disc'];




					//create transaction
						$create_transaction = "INSERT INTO `transaction`(`user_id`, `paymentmethod`, `datecreated`,`status`,`type`,`total_purchased`,`discount`,`total_amount`) 
																	VALUES ('$user','$pm','$datenow','pending','online','$total_purchased','$discount','$total')  ";
						 $transcation_ = mysqli_query($con,$create_transaction); 
						
						 $transaction_id = mysqli_insert_id($con);
					
					
					 


			          		$getallusercart = " SELECT * FROM `cart` where user_id = '$user'  ";
			                          $gettingusercart = mysqli_query($con,$getallusercart); 
			                          $counting= mysqli_num_rows($gettingusercart);
			                         //  $get_id =  mysqli_insert_id($con); 
			                       if ($counting>=1){
			                      
			                           while($row = mysqli_fetch_array($gettingusercart)){
			          						$prod_ids = $row['prod_id'];
			          						$qty = $row['quantity'];
			          						$price = $row['itemprice'];
			          						$total = $row['total'];
			          						$cartid = $row['cart_id'];

			          						if($pm == 'deliver'){
			          							$ftotal = 100;
			          							$inserttotrans = "INSERT INTO `trans_record`(`prod_id`, `quantity`, `price`, `date_ordered`,`total`, `user_id`,`pm`,`dfee`,`disc`,`transaction_id`) VALUES ('$prod_ids','$qty','$price','$datenow','$total','$user','pending','$ftotal','$disc','$transaction_id')";
			          						}else if ($pm == 'cod'){
			          							$ftotal = 100;
			          							$inserttotrans = "INSERT INTO `trans_record`(`prod_id`, `quantity`, `price`, `date_ordered`,`total`, `user_id`,`pm`,`dfee`,`disc`,`transaction_id`) VALUES ('$prod_ids','$qty','$price','$datenow','$total','$user','pending','$ftotal','$disc','$transaction_id')";
			          						}

			          						else {
			          							$inserttotrans = "INSERT INTO `trans_record`(`prod_id`, `quantity`, `price`, `date_ordered`,`total`, `user_id`,`pm`,`disc`,`transaction_id`) VALUES ('$prod_ids','$qty','$price','$datenow','$total','$user','$pm','$disc','$transaction_id')";
			          						}

			          						
			          						

			          						if(mysqli_query($con,$inserttotrans)){
			          			$deletecartitems = "DELETE FROM `cart` WHERE cart_id = '$cartid' ";
			                      mysqli_query($con,$deletecartitems);
			          						}

			                           }


			                    } 

			                      


			
		}
	}

	if(isset($_POST['makesession'])){ 
		$val = $_POST['val'];
		$_SESSION['disc'] = $val;
	}


 ?>