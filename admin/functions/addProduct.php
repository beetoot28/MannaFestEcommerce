<?php 
session_start();
include '../../connections/connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(isset($_POST['savenew'])){ 
	$name = $_POST['name'];
	$barcode = $_POST['barcode'];
	$desc = $_POST['desc'];
	date_default_timezone_set('Asia/Manila'); 
	$datenow = date('Y-m-d H:i:s');
	echo $cat = $_POST['cat'];

	$ingredients = $_POST['ingredients'];
	$list_ingredients = implode(',', $ingredients);

	$sql_check = "SELECT * from product where  barcode='$barcode'";
	$res_check = mysqli_query($con, $sql_check);
	$count = mysqli_num_rows($res_check);

	if ($count == 0) {
		$insertnew_product = "INSERT INTO `product`(`name`, `description`, `cat_id`, `datecreated`, `ingredients`,`barcode`) 
		VALUES ('$name','$desc','$cat','$datenow','$list_ingredients','$barcode')";
		mysqli_query($con, $insertnew_product);

		$getp_id = mysqli_insert_id($con); 
		$uploads_dir = '../../img/products';

		foreach ($_FILES['image']['name'] as $key => $val) {
			$fileName = basename($_FILES['image']['name'][$key]);
			$tmp_name = $_FILES['image']['tmp_name'][$key];
			move_uploaded_file($tmp_name, "$uploads_dir/$fileName");

			$insertphotos = "INSERT INTO `photo`(`prod_id`, `photo`) VALUES ('$getp_id','$fileName')";
			mysqli_query($con, $insertphotos);
		}

		header("Location: ../products.php");
		$_SESSION['new_brand'] = "successful";
		exit();
	} else {
		header("Location: ../products.php");
		$_SESSION['existing'] = "successful";
		exit();
	}
}

else if(isset($_POST['updateproduct'])){ 
	echo  $id = $_POST['prod_id'];
	 $name = $_POST['name'];

	 $barcode = $_POST['barcode'];
	 $desc = $_POST['desc'];
	date_default_timezone_set('Asia/Manila'); 
	
	 $cat = $_POST['cat'];
	
	

	$update_product = "UPDATE `product` 
	SET `name`='$name',`description`='$desc',`cat_id`='$cat',`barcode`='$barcode' 
	WHERE prod_id = $id";
	mysqli_query($con, $update_product);

	
        $image_name = $_FILES['image']['name'];
        $tmp_name   = $_FILES['image']['tmp_name'];
        $size       = $_FILES['image']['size'];
        $type       = $_FILES['image']['type'];
        $error      = $_FILES['image']['error'];
        
       echo  $fileName = basename($_FILES['image']['name']);
        $rand = rand(100,1000);

        // File upload path
        $uploads_dir = '../../img/products';
        move_uploaded_file($tmp_name , $uploads_dir .'/'.$fileName);
        
        $insertphotos = "UPDATE photo SET photo='$fileName' WHERE prod_id = $id  ";
        mysqli_query($con,$insertphotos);

	

	header("Location: ../products.php");
	exit();
}
 ?>