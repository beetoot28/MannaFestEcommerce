<?php 
session_start();
include '../connections/connect.php';

    $user = $_SESSION['cour_id'];

if(isset($_POST['setacc'])){ 
	$tp = $_POST['tp'];
	$val = $_POST['val'];


		if($tp == 'lastname'){
			$update = "UPDATE `accounts` SET `lastname`='$val' WHERE user_id = '$user' ";
			mysqli_query($con,$update);
		}else if($tp == 'firstname'){
			$update = "UPDATE `accounts` SET `name`='$val' WHERE user_id = '$user' ";
			mysqli_query($con,$update);
		}else if($tp == 'bd'){
			$update = "UPDATE `accounts` SET `birthdate`='$val' WHERE user_id = '$user' ";
			mysqli_query($con,$update);


		}else if($tp == 'address'){
			$update = "UPDATE `accounts` SET `address`='$val' WHERE user_id = '$user' ";
			mysqli_query($con,$update);
		}else if($tp == 'd_address'){
			$update = "UPDATE `accounts` SET `d_address`='$val' WHERE user_id = '$user' ";
			mysqli_query($con,$update);
		}else if($tp == 'email'){
				$update = "UPDATE `accounts` SET `email`='$val' WHERE user_id = '$user' ";
			mysqli_query($con,$update);
		}
}

if(isset($_POST['compare'])){ 
	$currentpass = $_POST['currentpass'];


			$comparedata = " select * from `accounts` where user_id = '$user' and password = '$currentpass' ";
	                $cmpdata = mysqli_query($con,$comparedata); 
	                $countingcmp= mysqli_num_rows($cmpdata);
	               //  $get_id =  mysqli_insert_id($con); 
	             if ($countingcmp>=1){
	            
	                 while($row = mysqli_fetch_array($cmpdata)){
						$defaultpass = $row['password'];
	                 }
	          }
	          if(isset($defaultpass)){

	          }else {
	          	$defaultpass = '';
	          }

	          		if($currentpass == $defaultpass) {
                    			echo 'success';
                    		}else {
                    		
                    			echo 'fail';
                    		}
	
}

if(isset($_POST['savenewpassword'])){ 
	$txtnew = $_POST['txtnew'];

	$uptpass = "UPDATE `accounts` SET `password`='$txtnew' WHERE user_id = '$user' ";
	mysqli_query($con,$uptpass);


	
}
 ?>