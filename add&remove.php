<?php 
session_start();
include 'connections/connect.php';
	 
	$user = $_SESSION['user_id'];
	if(isset($_POST['addtocart'])){
		$productid = $_POST['productid'];

					$getproduct_price = " SELECT * FROM `product` where prod_id = '$productid' ";
			                $pr = mysqli_query($con,$getproduct_price); 
			             
			                 while($row = mysqli_fetch_array($pr)){
								$productprice = $row['price'];
			                 }
			          

			                 		$checkcartifexist = "SELECT * FROM `cart` where user_id = '$user' and prod_id = '$productid'  ";
			                                 $checkingcart = mysqli_query($con,$checkcartifexist); 
			                                 $countingcart= mysqli_num_rows($checkingcart);
			                                //  $get_id =  mysqli_insert_id($con); 
			                              if ($countingcart>=1){

			                              	echo 'alreadyadded';
			                             	
			                                  while($row = mysqli_fetch_array($checkingcart)){
			                 						$qty = $row['quantity'];
			                 						$total = $row['total'];
			                 						$cartid = $row['cart_id'];

			                                  }
			                                  	$overallqty = $qty + 1 ;

			                                  	$the_total_price = $total * $overallqty;


			                                  	$update_item_qty_and_price = "UPDATE `cart` SET `quantity`='$overallqty',`total`='$the_total_price'  WHERE cart_id = '$cartid' ";
			                                  	mysqli_query($con,$update_item_qty_and_price);


			                           }else {
			                           		$addtocart = "INSERT INTO `cart`(`prod_id`, `quantity`, `total`, `user_id`,`itemprice`) VALUES ('$productid','1','$productprice','$user','$productprice')";
										mysqli_query($con,$addtocart);
			                           }

	/*	 */

		
	}

	if(isset($_POST['addwlist'])){
	//INSERT INTO `wishlist`( `prod_id`) VALUES ('') 
		$user = $_SESSION['user_id'];

		$productid = $_POST['productid'];
		
				/*$checkif_exist = " select * from wishlist where user_id = '$user'  ";
		                $checking = mysqli_query($con,$checkif_exist); 
		                $countingwlist= mysqli_num_rows($checking);
		               //  $get_id =  mysqli_insert_id($con); 
		             if ($countingwlist>=1){
		            		echo 'already added';
		                 while($row = mysqli_fetch_array($checking)){
							
		                 }
		          }else {

		          	echo 'add';

		          } */

		         $insertwlist = "INSERT INTO `wishlist`(`prod_id`, `user_id`) VALUES ('$productid','$user')";
		         mysqli_query($con,$insertwlist);
	}

	if(isset($_POST['removewlist'])){ 

			$user = $_SESSION['user_id'];

		$productid = $_POST['productid'];

		$removewlist = "DELETE FROM `wishlist` WHERE prod_id = '$productid' and user_id = '$user' ";
		mysqli_query($con,$removewlist);
		
	}

	if(isset($_POST['removefromcart'])){ 
		$cartid = $_POST['cartid'];

		$removefromcart = "DELETE FROM `cart` WHERE cart_id = '$cartid' ";
		mysqli_query($con,$removefromcart);
	}
	if(isset($_POST['reduceqty'])){ 
		$totalqty = $_POST['totalqty'];
		$cartid = $_POST['cartid'];
		$total = $_POST['total'];

		$reduceqty = "UPDATE `cart` SET `quantity`='$totalqty',`total`='$total' WHERE  cart_id = '$cartid'";
		mysqli_query($con,$reduceqty);
		
	}

	

	if(isset($_POST['increaseqty'])){ 
		$totalqty = $_POST['totalqty'];
		$cartid = $_POST['cartid'];
		$total = $_POST['total'];

		$reduceqty = "UPDATE `cart` SET `quantity`='$totalqty',`total`='$total' WHERE  cart_id = '$cartid'";
		mysqli_query($con,$reduceqty);
		
	}

 ?>