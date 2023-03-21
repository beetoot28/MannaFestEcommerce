<?php 
include '../connections/connect.php';


if(isset($_POST['category'])){ 

	?>
<div class="table-responsive">

    <table class="table table-sm" id="categorytable">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Discount Amount</th>
                <th scope="col">Min Amount to Avail</th>
                <th scope="col">Status</th>
                <th scope="col">Date-Created</th>
                <th scope="col">Expiration Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

			$gettabledata = " SELECT * FROM `promos` ";
	                $gettingcategories = mysqli_query($con,$gettabledata); 
	                $cat_count= mysqli_num_rows($gettingcategories);
	               //  $get_id =  mysqli_insert_id($con); 
	             if ($cat_count>=1){
	            
	                 while($row = mysqli_fetch_array($gettingcategories)){
					?>
            <tr>
                <td><span class="text-info" style="font-weight: bolder;"><?php echo $row['code'] ?></span></td>
                <td>₱<?php echo $row['discount'] ?> </td>
                <td>₱<?php echo $row['minvalue_toavail'] ?></td>
                <td>
                    <?php 
                      	date_default_timezone_set('Asia/Manila');
                      	$datenow = date('Y-m-d');
						if(($row['expiration-date']) == 'No Expiry'  ){
							?>
                    <span class="badge bg-info" style="font-size: 12px;padding: 5px">No Expiry</span>
                    <?php
						}
                      	elseif(($row['expiration-date']) < $datenow  ){
                      		?>
                    <span class="badge bg-danger" style="font-size: 12px;padding: 5px">Expired</span>
                    <?php
                      	}else {
                      		?>
                    <span class="badge bg-success" style="font-size: 12px;padding: 5px">ACTIVE</span>
                    <?php
                      	}

                      	 ?>

                </td>
                <td>
                    <?php 
                      	echo date('M j,Y @ h:i a',strtotime($row['datecreated'])) ;
                      	 ?>

                </td>
                <td><?php  
					  
					  if ($row['expiration-date'] == 'No Expiry'){

						  echo $row['expiration-date'];
					  }
					  else {
						 	echo date('M j,Y @ h:i a', strtotime($row['expiration-date']));
					  }?>


                </td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#editmodal" data-backdrop="static"
                            data-keyboard="false" class="btn btn-light text-primary editmodal"
                            data-id="<?php echo $row['promo_id'] ?>" data-discount="<?php echo $row['discount'] ?>"
                            data-maxamount="<?php echo $row['maxvalue_toavail'] ?>" style="font-size: 12px"><i
                                class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-light text-danger deletecat"
                            data-id="<?php echo $row['promo_id'] ?>" style="font-size: 12px"><i
                                class="fas fa-trash"></i></button>

                    </div>

                </td>
            </tr>
            <?php
	                 }
	          }else {
	          	//echo 'none';
	          	?>
            <tr></tr>
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


    $('.editmodal').click(function() {
        var id = $(this).data('id');
        var disc = $(this).data('discount');
        var maxamount = $(this).data('maxamount');

        $('#ediscount').val(disc);
        $('#emaxamount').val(maxamount);
        $('#promoid').val(id);

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
                    url: "action_promo.php",
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
            url: "action_promo.php",
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



////////////////////////////// SAVE EDIT DELETE ///////////////////////////////////////////////
if(isset($_POST['savenew'])){ 
	// Saving NEW CATEGORY
	$minvalue_toavail = $_POST['minimum'];
	$discount = $_POST['discount'];
	$xpdate = $_POST['xpdate'];

	 function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$code =  generateRandomString();

	date_default_timezone_set('Asia/Manila'); 
	$datenow = date('Y-m-d H:i:s');

			
		if(empty($xpdate)) {
			$expiry = "No Expiry";
		} else {
			$expiry = $xpdate;
		}
			
	$insertnew_category = "INSERT INTO `promos`(`code`, `minvalue_toavail`, `discount`, `datecreated`, `expiration-date`) VALUES ('$code','$minvalue_toavail','$discount','$datenow','$expiry')";
	mysqli_query($con,$insertnew_category); 


	
}

if(isset($_POST['deletecat'])){ 
	$id = $_POST['id'];

	$delete_category = "DELETE FROM `promos` WHERE promo_id = '$id' ";
	mysqli_query($con,$delete_category);
	
}

if(isset($_POST['editcategory'])){ 
	$maxamount = $_POST['emaxamount'];
	$discount = $_POST['ediscount'];
	$xpdate = $_POST['expdate'];
	$promoid = $_POST['promoid'];
	
	$editcategory = "UPDATE `promos` SET `maxvalue_toavail`='$maxamount',`discount`='$discount',`expiration-date`='$xpdate' WHERE promo_id = '$promoid' ";
	mysqli_query($con,$editcategory);
	
}

 ?>