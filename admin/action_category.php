<?php 
include '../connections/connect.php';


if(isset($_POST['category'])){ 

	?>
	 <div class="table-responsive">
	 
	    <table class="table table-sm" id="categorytable">
                  <thead>
                    <tr>
                      <th scope="col">Category</th>
                 
                      <th scope="col">Date-Created</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody >
	<?php

			$gettabledata = " SELECT * FROM `category` ";
	                $gettingcategories = mysqli_query($con,$gettabledata); 
	                $cat_count= mysqli_num_rows($gettingcategories);
	               //  $get_id =  mysqli_insert_id($con); 
	             if ($cat_count>=1){
	            
	                 while($row = mysqli_fetch_array($gettingcategories)){
					?>
	   				<tr>
                      <td><?php echo $row['category_name'] ?></td>
                
                      <td>
                      	<?php 
                      	echo date('M j,Y @ h:i a',strtotime($row['datecreated'])) ;
                      	 ?>

                      </td>
                      <td>
                      	<div class="btn-group" role="group" aria-label="Basic example">
					  <button type="button" data-bs-toggle="modal" data-bs-target="#editmodal" data-backdrop="static" data-keyboard="false" class="btn btn-light text-primary editmodal" data-id="<?php echo $row['cat_id'] ?>" data-cat="<?php echo $row['category_name'] ?>"  style="font-size: 12px"><i class="fas fa-edit"></i></button>
					  <button type="button" class="btn btn-light text-danger deletecat" data-id="<?php echo $row['cat_id'] ?>" style="font-size: 12px"><i class="fas fa-trash"></i></button>
					 
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
     	      	   	var cat = $(this).data('cat');
     	      	   	$('#editcat').val(cat);
     	      	   	$('#catid').val(id);
     	      	   
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
					           url : "action_category.php",
					            method: "POST",
					             data  : {deletecat:1,id:id},
					             success : function(data){
								 $.notify("Deleted Successfully!", "success");
								  table_category();
					             }
					          }) 
							  }
							})
					
					
					    
						  
						  })

     	      	    
            function table_category(){
             
              
                 $.ajax({
                         url : "action_category.php",
                          method: "POST",
                           data  : {category:1},
                           success : function(data){
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
	$cat = $_POST['cat'];
	date_default_timezone_set('Asia/Manila'); 
	$datenow = date('Y-m-d H:i:s');
	$insertnew_category = "INSERT INTO `category`(`category_name`, `datecreated`) VALUES ('$cat','$datenow')";
	mysqli_query($con,$insertnew_category);


	
}

if(isset($_POST['deletecat'])){ 
	$id = $_POST['id'];

	$delete_category = "DELETE FROM `category` WHERE cat_id = '$id' ";
	mysqli_query($con,$delete_category);
	
}

if(isset($_POST['editcategory'])){ 
	$cat = $_POST['cat'];
	$catid = $_POST['catid'];
	$editcategory = "UPDATE `category` SET `category_name`='$cat'  WHERE cat_id ='$catid' ";
	echo "
		<script>
			alert('$editcategory');
		</script>
	";
	mysqli_query($con,$editcategory);
	
}

 ?>