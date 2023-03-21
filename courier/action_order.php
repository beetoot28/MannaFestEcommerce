<?php 
session_start();
include '../connections/connect.php';

		?>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php



if(isset($_POST['uploadproof'])){
	echo $tid = $_POST['tid'];
	echo $courier_id = $_POST['courier_id'];
	echo $d_remarks = $_POST['d_remarks'];

	date_default_timezone_set('Asia/Manila');
	 $datenow = date('Y-m-d H:i:s');



	 $image_name = $_FILES['image']['name'];
	 $tmp_name   = $_FILES['image']['tmp_name'];
	 $size       = $_FILES['image']['size'];
	 $type       = $_FILES['image']['type'];
	 $error      = $_FILES['image']['error'];

			                                                                                                                                    
	 $fileName =basename($_FILES['image']['name']);
	
	 $uploads_dir = '../img/Proof_of_delivery';
	 move_uploaded_file($tmp_name , $uploads_dir .'/'.$fileName);

	$confirm = "UPDATE `transaction` SET `status`='delivered',date_delivered='$datenow' , `photo_proof`='$fileName' 
	,delivery_remarks='$d_remarks'
	WHERE tid = '$tid' ";
	mysqli_query($con,$confirm);


    
    // get total
    $sql = "SELECT sum(total_amount) as total_pay from transaction where tid = '$tid'  ";
    $res = mysqli_query($con,$sql);
    $arr = mysqli_fetch_array($res);

    $total_amount = $arr['total_pay'];
    $dateNow = date("Y-m-d");


	 // check for existing rec
	 $sql_check = "SELECT * from courier_trans where date = '$dateNow' and user_id='$courier_id'";
	 $res = mysqli_query($con,$sql_check);

	 $count = mysqli_num_rows($res);

	 if ($count ==0 ){
		$sql = "INSERT INTO `courier_trans`(user_id, date,total_amount,total_cash_onhand,total_remit) 
		VALUES ('$courier_id','$dateNow','$total_amount','$total_amount',0)";
		mysqli_query($con,$sql);
	 }
	 else {
		$row = mysqli_fetch_array($res);
		$trans_id = $row['courier_trans_id'];
		$new_total = $row['total_amount'] + $total_amount;
		$new_total_cash = $row['total_cash_onhand'] + $total_amount;
		$sql = "UPDATE `courier_trans` SET `total_amount`='$new_total' , `total_cash_onhand`='$new_total_cash' WHERE courier_trans_id = '$trans_id' ";
		mysqli_query($con,$sql);

	 }


	 $listOrder = mysqli_query($con, "SELECT * from trans_record 
	 LEFT JOIN product on trans_record.prod_id = product.prod_id
	 where transaction_id='$trans_id'");
	 while ($row = mysqli_fetch_array($listOrder)) {

		echo $prod_id= $row['prod_id'];
		echo $order_qty = $row['quantity'];
		echo $stockAlert = $row['stockAlert'];
		echo $status ='ACTIVE';
		// select product quantity
		// $sql = mysqli_query($con, "SELECT * from product_quantity where prod_id='$prod_id'");  
		// $prod = mysqli_fetch_array($sql);
		// $prod_qty =  $prod['quantity'];

		$sql = mysqli_query($con, "SELECT * from production_log where prod_id='$prod_id' AND status='ACTIVE' ORDER BY `production_code` DESC LIMIT 1");  
		$log = mysqli_fetch_array($sql);

		$prod_log_qty =  $log['qty_remaining'];


		$prod_qty = $prod_qty - $order_qty;
		$prod_log_qty = $prod_log_qty - $order_qty;


		if ($prod_log_qty <=$stockAlert){
			$status='LOW';


		}
		else if ($prod_log_qty <= 0)
		{
			$status='EMPTY';
		}



		$update = "UPDATE  product_quantity set quantity ='$prod_qty' WHERE  prod_id='$prod_id'";
		$res = mysqli_query($con, $update);
  
		$update = "UPDATE  production_log set qty_remaining ='$prod_log_qty',status='$status' WHERE  prod_id='$prod_id'";
		$res = mysqli_query($con, $update);

	 }
	


   


    
	$_SESSION['complete'] = 1;
	header('location:remit.php');


	
}
 ?>