<?php 

include '../connections/connect.php';


if(isset($_POST['category'])){ 

	?>
<div class="table-responsive">

    <table class="table table-sm" id="categorytable">
        <thead>
            <tr>`
                <th scope="col">Email</th>
                <th scope="col">Lastname</th>
                <th scope="col">Firstname</th>
                <th scope="col">Contact</th>
                <th scope="col">User_Productlist</th>

                <th scope="col">Date-Registered</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

			$gettabledata = "SELECT * FROM `accounts` where user_type ='client' or user_type ='courier'   ";
	                $gettingcategories = mysqli_query($con,$gettabledata); 
	                $cat_count= mysqli_num_rows($gettingcategories);
	               //  $get_id =  mysqli_insert_id($con); 
	             if ($cat_count>=1){
	            
	                 while($row = mysqli_fetch_array($gettingcategories)){
	                 	$type =$row['user_type'];
	             
					?>
            <tr>

                <td> <?php echo $row['email'] ?> </td>
                <td><?php echo $row['lastname'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['mobile_number'] ?></td>
                <td>
                    <?php 
                      		if($type == 'admin'){
                      			echo 'N/A';
                      	}else if($type == 'courier'){ 

                      		echo 'N/A';
                      	}else {
                      		?>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-light text-info cartl"
                            data-id="<?php echo $row['user_id'] ?>" data-name="<?php echo $row['name'] ?>"
                            data-bs-toggle="modal" data-bs-target="#cartlist" style="font-size: 12px"><i
                                class="fas fa-shopping-cart"></i></button>

                        <button type="button" class="btn btn-light text-danger wl"
                            data-id="<?php echo $row['user_id'] ?>" data-name="<?php echo $row['name'] ?>"
                            data-bs-toggle="modal" data-bs-target="#wishlist" style="font-size: 12px"><i
                                class="fas fa-heart"></i></button>

                    </div>

                    <?php
                      	}

                      	 ?>


                </td>

                <td>
                    <?php 
                      	echo date('M j,Y @ h:i a',strtotime($row['date_registered'])) ;
                      	 ?>

                </td>
                <td>
                    <?php 
                      	if($type == 'admin'){
                      			echo 'ADMINISTRATOR';
                      	}else if($type == 'courier'){ 

                      		echo 'DELIVERY';
                      		?>

                    <hr>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#editmodal"
                            data-name="<?php echo $row['name'] ?>" data-lastname="<?php echo $row['lastname'] ?>"
                            data-email="<?php echo $row['email'] ?>" data-id="<?php echo $row['user_id'] ?>"
                            data-backdrop="static" data-keyboard="false" class="btn btn-light text-primary editmodal"
                            data-id="<?php echo $row['user_id'] ?>" style="font-size: 12px"><i
                                class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-light text-danger deletecat"
                            data-id="<?php echo $row['user_id'] ?>" style="font-size: 12px"><i
                                class="fas fa-trash"></i></button>

                    </div>
                    <hr>
                    <?php
                      	}else {
                      		?>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#editmodal"
                            data-contact="<?php echo $row['mobile_number'] ?>" data-name="<?php echo $row['name'] ?>"
                            data-lastname="<?php echo $row['lastname'] ?>" data-email="<?php echo $row['email'] ?>"
                            data-id="<?php echo $row['user_id'] ?>" data-backdrop="static" data-keyboard="false"
                            class="btn btn-light text-primary editmodal" data-id="<?php echo $row['user_id'] ?>"
                            style="font-size: 12px"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-light text-danger deletecat"
                            data-id="<?php echo $row['user_id'] ?>" style="font-size: 12px"><i
                                class="fas fa-trash"></i></button>

                    </div>
                    <?php
                      	}
                      	 ?>




                </td>
            </tr>
            <?php
	                 }
	          }else {
	          	//echo 'none';
	          	?>

            <?php
	          }

	          ?>
        </tbody>
    </table>
</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../js/datatable/datatables.js"></script>
<link rel="stylesheet" type="text/css" href="../js/datatable/datatables.css">
<script type="text/javascript">
$(document).ready(function() {
    $('#categorytable').DataTable();


    $('.changepicture').click(function() {
        var id = $(this).data('id');
        $('#userid').val(id);

    })

    $('.cartl').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#usercart').text(name + ' Cart');
        $('#userid').val(id);
        getusercart(id)

    })

    $('.wl').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#usercartw').text(name + ' Wishlist');
        $('#useridw').val(id);
        getuserwlist(id);
    })

    function getusercart(id) {
        $.ajax({
            url: "action_account.php",
            method: "POST",
            data: {
                getusercart: 1,
                id: id
            },
            success: function(data) {
                $('#usercarts').html(data);

            }
        })
    }

    function getuserwlist(id) {
        $.ajax({
            url: "action_account.php",
            method: "POST",
            data: {
                getuserwlist: 1,
                id: id
            },
            success: function(data) {
                $('#userwlist').html(data);

            }
        })
    }


    $('.editmodal').click(function() {
        var name = $(this).data('name');
        var lastname = $(this).data('lastname');
        var email = $(this).data('email');
        var contact = $(this).data('contact');
        var id = $(this).data('id');
        $('#eemail').val(email);
        $('#elastname').val(lastname);
        $('#efirstname').val(name);
        $('#catid').val(id);
        $('#econtact').val(contact);

    })
    $('.deletecat').click(function() {
        var id = $(this).data('id');


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "action_account.php",
                    method: "POST",
                    data: {
                        deletecat: 1,
                        id: id
                    },
                    success: function(data) {
                        $.notify("Deleted Successfully!", "success");
                        table_category();
                    }
                })
            }
        })




    })


    function table_category() {


        $.ajax({
            url: "action_account.php",
            method: "POST",
            data: {
                category: 1
            },
            success: function(data) {
                $('#table_category').html(data);
            }
        })


    }

});
</script>
<?php

	         


	
	
}
////////////////////////////Check if exist//////////////////////

if(isset($_POST['checkifexistcat'])){ 
	$val = $_POST['val'];

					$checkcategory = " select * from category where category_name = '$val'  ";
			                $chckng = mysqli_query($con,$checkcategory); 
			                $count= mysqli_num_rows($chckng);
			               //  $get_id =  mysqli_insert_id($con); 
			             if ($count>=1){
			            	echo 'exist';
			                
			          }else {
			          		echo 'none';
			          }
	
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
////////////////////////////// SAVE EDIT DELETE ///////////////////////////////////////////////
if(isset($_POST['savenew'])){ 
	// Saving NEW CATEGORY
	date_default_timezone_set('Asia/Manila'); 
	$datenow = date('Y-m-d H:i:s');

	$email = $_POST['email'];
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$password = $_POST['password'];
	$usertype = $_POST['usertype'];
	$contact = $_POST['contact'];


	$password = encrypt_decrypt('encrypt', $password);

	//echo $email.$lastname.$firstname.$password;
	


			
		
	        //           $image_name = $_FILES['profile']['name'];
	        //            $tmp_name   = $_FILES['profile']['tmp_name'];
	        //         $size       = $_FILES['profile']['size'];
	        //          $type       = $_FILES['profile']['type'];
	        //          $error      = $_FILES['profile']['error'];
	                                                                                                                                    
	             
	                                                                                                                                    
	        //    $fileName =basename($_FILES['profile']['name']);
	             
	            
	        //     $uploads_dir = '../img/users';
	        //  move_uploaded_file($tmp_name , $uploads_dir .'/'.$fileName);
	             
	        
	        $insertnewaccount = "INSERT INTO `accounts`(`name`, `lastname`, `email`, `user_type`,`date_registered`, `password`, `mobile_number`) VALUES ('$firstname','$lastname','$email','$usertype','$datenow','$password','$contact')";
	        mysqli_query($con,$insertnewaccount);
	                                                                                                                          
	         
	         
	
	
	            

	
}

if(isset($_POST['deletecat'])){ 
	$id = $_POST['id'];

			$selectuser = " select * from accounts where user_id = '$id'  ";
	                $tounlinkphoto = mysqli_query($con,$selectuser); 
	              
	            
	                 while($row = mysqli_fetch_array($tounlinkphoto)){
							$src = '../img/users/'.$row['photo'];
	                 }
	                 unlink($src);
	          

	$delete_category = "DELETE FROM `accounts` WHERE user_id = '$id' ";
	mysqli_query($con,$delete_category);
	
}

if(isset($_POST['editcategory'])){ 
	$eemail = $_POST['eemail'];
	$elastname = $_POST['elastname'];
	$efirstname = $_POST['efirstname'];
	$contact = $_POST['econtact'];

	$uid = $_POST['uid'];
	$editcategory = "UPDATE `accounts` SET `mobile_number`='$contact',`name`='$efirstname',`lastname`='$elastname',`email`='$eemail' WHERE user_id='$uid' ";
	mysqli_query($con,$editcategory);
	
}

if(isset($_POST['changepicture'])){ 
	$uid = $_POST['uid'];

		$selectuser = " select * from accounts where user_id = '$uid'  ";
	                $tounlinkphoto = mysqli_query($con,$selectuser); 
	              
	            
	                 while($row = mysqli_fetch_array($tounlinkphoto)){
							$src = '../img/users/'.$row['photo'];
	                 }
	                 unlink($src);


	                  $image_name = $_FILES['pp']['name'];
	                   $tmp_name   = $_FILES['pp']['tmp_name'];
	                $size       = $_FILES['pp']['size'];
	                 $type       = $_FILES['pp']['type'];
	                 $error      = $_FILES['pp']['error'];
	                                                                                                                                    
	             
	                                                                                                                                    
	           $fileName =basename($_FILES['pp']['name']);
	             
	            
	            $uploads_dir = '../img/users';
	         move_uploaded_file($tmp_name , $uploads_dir .'/'.$fileName);


	         $upt = "UPDATE `accounts` SET`photo`='$fileName' WHERE user_id='$uid' ";
	         mysqli_query($con,$upt);
	




}

if(isset($_POST['getusercart'])){ 
	$id = $_POST['id'];
	

	?>

<table class="table table-borderless table-striped table-sm">
    <thead>
        <tr>

            <th scope="col">Product_name</th>
            <th scope="col">Quantity</th>

        </tr>
    </thead>
    <tbody>
        <?php 
                			$getusercart = " select * from cart where user_id = '$id'  ";
                	                $gcart = mysqli_query($con,$getusercart); 
                	                $countg= mysqli_num_rows($gcart);
                	               //  $get_id =  mysqli_insert_id($con); 
                	             if ($countg>=1){
                	            
                	                 while($row = mysqli_fetch_array($gcart)){
                	                 	$product_id = $row['prod_id'];
                	                 	$cartid = $row['cart_id'];
                						?>
        <tr>

            <td>
                <?php 
                    		$getproducts = " select * from product where prod_id = '$product_id'  ";
                                      		                $productdetails = mysqli_query($con,$getproducts); 
                                      		               
                                      		                 while($item = mysqli_fetch_array($productdetails)){
                                      		                 	echo $item['name'];
                                      		                 }

                    	 ?>
            </td>
            <td><?php echo $row['quantity'] ?></td>

        </tr>
        <?php
                	                 }
                	          }

                	 ?>


    </tbody>
</table>


<?php
}

if(isset($_POST['getuserwlist'])){ 
	$id = $_POST['id'];
	

	?>

<table class="table table-borderless table-striped table-sm">
    <thead>
        <tr>

            <th scope="col">Product_name</th>
            <th scope="col">wlist</th>

        </tr>
    </thead>
    <tbody>
        <?php 
                			$getusercart = " select * from wishlist where user_id = '$id'  ";
                	                $gcart = mysqli_query($con,$getusercart); 
                	                $countg= mysqli_num_rows($gcart);
                	               //  $get_id =  mysqli_insert_id($con); 
                	             if ($countg>=1){
                	            
                	                 while($row = mysqli_fetch_array($gcart)){
                	                 	$product_id = $row['prod_id'];
                	                 
                						?>
        <tr>

            <td>
                <?php 
                    		$getproducts = " select * from product where prod_id = '$product_id'  ";
                                      		                $productdetails = mysqli_query($con,$getproducts); 
                                      		               
                                      		                 while($item = mysqli_fetch_array($productdetails)){
                                      		                 	echo $item['name'];
                                      		                 }

                    	 ?>
            </td>
            <td><i class="fas fa-heart text-danger"></i></td>


        </tr>
        <?php
                	                 }
                	          }

                	 ?>


    </tbody>
</table>


<?php
}
 ?>