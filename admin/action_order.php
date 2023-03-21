<?php 
include '../connections/connect.php';

	if(isset($_POST['category'])){ 

		?>
<div class="table-responsive">

    <table class="table table-sm" id="categorytable">
        <thead>
            <tr>
                <th scope="col">Order_No</th>
                <th scope="col">Date</th>

                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php

			$gettabledata = " SELECT * FROM `transaction` where status != 'completed' ";
	                $gettingcategories = mysqli_query($con,$gettabledata); 
	                $cat_count= mysqli_num_rows($gettingcategories);
	               //  $get_id =  mysqli_insert_id($con); 
	             if ($cat_count>=1){
	            
	                 while($row = mysqli_fetch_array($gettingcategories)){
	                 		$userid = $row['user_id'];
	                 	$tid = $row['tid'];
	                 		$stat = $row['status'];
	                 		$pm = $row['paymentmethod'];
	                 	
	                 		$da = $row['datecreated'];

	                 		if($pm == 'reserve') {
	                 			$pmorder = 'Reserved Orders';
	                 		}else if($pm == 'deliver'){
	                 			$pmorder = 'For Delivery Orders';
	                 		}else if ($pm == 'cod'){
	                 			$pmorder = 'For Cash on Delivery Orders';
	                 		}

	                 	


								?>
            <tr class="table-warning">
                <td colspan="7">
                    <h6 style="font-weight:bolder;letter-spacing:2px;text-align: center;">
                        <?php echo $pmorder.' ( MN_'.$tid.' )' ?> <br>
                        <?php 

	   								$getusername = " select * from accounts where user_id = '$userid'  ";
	   						                $guname = mysqli_query($con,$getusername); 
	   						           
	   						                 while($uname = mysqli_fetch_array($guname)){
	   										echo 'Name : '.$uname['name'].' '.$uname['lastname'];
	   						                 }
	   						          

	   						 ?>
                    </h6>
                </td>
                <td>

                    <?php 
							

							if($pm == 'reserve') {

								if($stat == 'pending'){
									?>
                    <button class="btn btn-light text-primary confirm" data-od="<?php echo $tid ?>"
                        style="font-size: 14px;font-weight: bolder;">Confirm</button>
                    <?php
								}else if ($stat == 'confirmed') {
									?>
                    <button class="btn btn-light text-success mc" data-od="<?php echo $tid ?>"
                        style="font-size: 14px;font-weight: bolder;">Mark as Complete</button>
                    <?php
								}


							}else if ($pm == 'deliver' || $pm == 'cod'){

								if($stat == 'pending'){
									?>
                    <button class="btn btn-light text-primary confirmd" data-od="<?php echo $tid ?>"
                        data-date="<?php echo $row['datecreated'] ?>" data-userid="<?php echo $userid ?>"
                        style="font-size: 14px;font-weight: bolder;">Confirm</button>
                    <?php
								}else if ($stat == 'ready'){

									?>
                    <button class="btn btn-dark text-light deliver" data-od="<?php echo $tid ?>"
                        style="font-size: 14px;font-weight: bolder;">Deliver</button>
                        <button class="btn btn-info text-dark print" data-od="<?php echo $tid ?>"
                        data-userid="<?php echo $userid ?>"
                        style="font-size: 14px;font-weight: bolder;">Print Delivery</button>
                    <?php
								}else if ($stat == 'otw'){
										date_default_timezone_set('Asia/Manila');
										$datenow = date('Y-m-d');
									

									if($da < $datenow ){
										?>
                    <button class="btn btn-light text-success mc" data-od="<?php echo $tid ?>"
                        style="font-size: 14px;font-weight: bolder;">Mark as Complete</button>
                    <?php
									
									}else {
										?>
                    <h6 class="text-success" style="font-size: 13px;font-weight: bolder;">Waiting ...</h6>
                    <?php
									}
								}else if ($stat == 'delivered'){
										?>
                    <h6 class="text-success" style="font-size: 13px;font-weight: bolder;">Waiting For the Courier...
                    </h6>
                    <?php
								}


							}

							 ?>

                </td>
            </tr>

            <?php 
	   						$gettrans_records = "select * from trans_record where transaction_id = '$tid'  ";
	   								 $gettingtrans = mysqli_query($con,$gettrans_records); 
	   								
	   							 while($gtrans = mysqli_fetch_array($gettingtrans)){
	   							 	$prid = $gtrans['prod_id'];

	   													

	   							 	?>

            <tr>
                <td>MN_<?php echo $row['tid'] ?></td>
                <td><?php echo date('@H:i:s F j,Y',strtotime($row['datecreated'])) ?></td>


                <td>



                    <?php 

	   							
	   							 

	   								$getproductname = " select * from product where prod_id = '$prid'  ";
	   						                $gpname = mysqli_query($con,$getproductname); 
	   						           
	   						                 while($pname = mysqli_fetch_array($gpname)){
	   											

	   											?>

                    <a
                        href="?viewproducts&productname=<?php echo $pname['name'] ?>&token=<?php echo $pname['prod_id'] ?>&_view">
                        <?php echo $pname['name']; ?>
                    </a>
                    <?php
	   						                 }
	   						          

	   						 ?>

                </td>
                <td>₱ <?php echo $gtrans['price'] ?></td>
                <td><?php echo $gtrans['quantity'] ?></td>
                <td>₱ <?php echo $gtrans['total'] ?></td>

                <?php



	   								 }
	   							

	   					 ?>

                <td>






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


<!-- ORDER DETAILS -->
<!-- Modal -->
<div class="modal fade" id="orderDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <input type="email" class="form-control" id="m_trans_id" hidden>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order Number</label>
                            <input type="email" class="form-control" id="order_code" aria-describedby="emailHelp"
                                readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order Date</label>
                            <input type="email" class="form-control" id="date_order" aria-describedby="emailHelp"
                                readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                        </div>
                    </div>
                </div>
                <hr>
                <div id='address_customer'> </div>
                <hr>
                <h6>Product Order List</h6>
                <div id='list_purchased_prod'> </div>


              

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id='btnSubmitModal'>Confirm Order</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="printDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print Order</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id='print_order_content'>
                <div class="row">
                    <div class="col">
                        <input type="email" class="form-control" id="print_trans_id" hidden>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order Number</label>
                            <input type="email" class="form-control" id="print_order_code" aria-describedby="emailHelp"
                                readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Order Date</label>
                            <input type="text" class="form-control" id="print_date_order" aria-describedby="emailHelp"
                                readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                        </div>
                    </div>
                </div>
                <hr>
                <div id='print_address_customer'> </div>
                <hr>
                <h6>Product Order List</h6>
                <div id='print_list_purchased_prod'> </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick='PrintElem()'>Print Order</button>
            </div>
        </div>
    </div>
</div>

<!-- END -->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/rr-1.2.8/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/rr-1.2.8/datatables.min.js">
</script>

<script type="text/javascript">


function PrintElem()
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">');
    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById('print_order_content').innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();


}



let table = new DataTable('#categorytable', {

    "search": {
        "caseInsensitive": false
    }

});
</script>
<script type="text/javascript">
$(document).ready(function() {
   
    $('.confirmd').click(function() {
        //
        var od = $(this).data('od');
        var date = $(this).data('date');
        var userid = $(this).data('userid');
        $('#orderDetails').modal('show')
        $('#date_order').val(date)
        $('#order_code').val('MN_' + od)
        $('#m_trans_id').val(od)

        function fetch_table() {

            var trans_id = (od);
            $.ajax({
                url: "fetch/view_order_details.php",
                method: "POST",
                data: {
                    trans_id: trans_id,
                },
                success: function(data) {
                    $('#list_purchased_prod').html(data);
                }
            });
        }
        fetch_table();


        function fetchAddress() {

            var trans_id = (od);
            $.ajax({
                url: "fetch/order_shipping.php",
                method: "POST",
                data: {
                    trans_id: trans_id,
                    userid: userid,
                },
                success: function(data) {
                    $('#address_customer').html(data);
                }
            });
        }
        fetchAddress();


    })


    
    $('.print').click(function() {
        //
        var od = $(this).data('od');
        var date = $(this).data('date');

        $('#printDetails').modal('show')
        $('#print_date_order').val(date)
        $('#print_order_code').val('MN_' + od)
        $('#print_trans_id').val(od)

        function print_fetch_table() {

            var trans_id = (od);
            $.ajax({
                url: "fetch/view_order_details.php",
                method: "POST",
                data: {
                    trans_id: trans_id,
                 
                },
                success: function(data) {
                    $('#print_list_purchased_prod').html(data);
                }
            });
        }
        print_fetch_table();


        function print_fetchAddress     () {

            var trans_id = (od);
            $.ajax({
                url: "fetch/order_shipping.php",
                method: "POST",
                data: {
                    trans_id: trans_id,
                    userid: userid,
                },
                success: function(data) {
                    $('#print_address_customer').html(data);
                }
            });
        }
        print_fetchAddress();



    



    })


    $('#btnSubmitModal').click(function() {
        //
        od = $('#m_trans_id').val();

        $.ajax({
            url: "action_order.php",
            method: "POST",
            data: {
                confirmd: 1,
                od: od
            },
            success: function(data) {
                table_category();

                Swal.fire(
                    'Confirmed!',
                    'Order confirmed successfully!',
                    'success'
                )
            }
        })
		$('#orderDetails').modal('hide')





    })



    function table_category() {


        $.ajax({
            url: "action_order.php",
            method: "POST",
            data: {
                category: 1
            },
            success: function(data) {
                $('#table_category').html(data);
            }
        })


    }

    $('.deliver').click(function() {
        //
        var od = $(this).data('od');


        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#81c3dd',
            cancelButtonColor: '#dd9b81',
            confirmButtonText: 'Yes, its for delivery!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "action_order.php",
                    method: "POST",
                    data: {
                        transport: 1,
                        od: od
                    },
                    success: function(data) {
                        table_category();

                        Swal.fire(
                            'Item for transport!',
                            'Order marked on transport',
                            'success'
                        )
                    }
                })
            }
        })





    })




    $('.mc').click(function() {
        var od = $(this).data('od');


        Swal.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#81c3dd',
            cancelButtonColor: '#dd9b81',
            confirmButtonText: 'Yes, Mark as complete!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "action_order.php",
                    method: "POST",
                    data: {
                        mc: 1,
                        od: od
                    },
                    success: function(data) {
                        table_category();

                        Swal.fire(
                            'Marked Completed!',
                            'Order was completed successfully!',
                            'success'
                        )
                    }
                })
            }
        })

    })


});
</script>


<?php
	
}

if(isset($_POST['completedorder'])){ 


	?>
<h5 style="font-weight: bolder" class="text-success">Completed Orders</h5>
<div class="table-responsive">

    <table class="table table-sm" id="categorytable">
        <thead>
            <tr>
                <th scope="col">Order_No</th>
                <th scope="col">Date</th>

                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">action</th>

            </tr>
        </thead>
        <tbody>
            <?php

			$gettabledata = " SELECT * FROM `transaction` where status = 'completed' ";
	                $gettingcategories = mysqli_query($con,$gettabledata); 
	                $cat_count= mysqli_num_rows($gettingcategories);
	               //  $get_id =  mysqli_insert_id($con); 
	             if ($cat_count>=1){
	            
	                 while($row = mysqli_fetch_array($gettingcategories)){
	                 		$userid = $row['user_id'];
	                 	$tid = $row['tid'];
	                 		$stat = $row['status'];
	                 		$pm = $row['paymentmethod'];
	                 	
	                 		$da = $row['datecreated'];

	                 	 		if($pm == 'reserve') {
	                 			$pmorder = 'Reserved Orders';
	                 		}else if($pm == 'deliver'){
	                 			$pmorder = 'For Delivery Orders';
	                 		}else if ($pm == 'cod'){
	                 			$pmorder = 'For Cash on Delivery Orders';
	                 		}

	                 	


								?>
            <tr class="table-success">
                <td colspan="7">
                    <h6 style="font-weight:bolder;letter-spacing:2px;text-align: center;">
                        <?php echo $pmorder.' ( BNC_'.$tid.' )' ?> <br>
                        <?php 

	   								$getusername = " select * from accounts where user_id = '$userid'  ";
	   						                $guname = mysqli_query($con,$getusername); 
	   						           
	   						                 while($uname = mysqli_fetch_array($guname)){
	   										echo 'Name : '.$uname['name'].' '.$uname['lastname'];
	   						                 }
	   						          

	   						 ?>
                    </h6>
                </td>
                <td>
                    <?php 
									if($pm == 'cod' || $pm == 'deliver'){
										?>
                    <button type="button" class="btn btn-light text-primary" style="font-size:12px"
                        data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $tid ?>">
                        Proof of Delivery
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $tid ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Proof of Delivery For Order
                                        MN_<?php echo $tid  ?></h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <img src="<?php echo '../img/Proof_of_delivery/'.$row['photo_proof'] ?>"
                                        id="img<?php echo $tid  ?>" style="width:100%;height:400px;">

                                </div>



                            </div>
                        </div>
                    </div>
                    <?php
									}

									 ?>
                </td>

            </tr>

            <?php 
	   						$gettrans_records = "select * from trans_record where transaction_id = '$tid'  ";
	   								 $gettingtrans = mysqli_query($con,$gettrans_records); 
	   								
	   							 while($gtrans = mysqli_fetch_array($gettingtrans)){
	   							 	$prid = $gtrans['prod_id'];

	   													

	   							 	?>

            <tr>
                <td>BNC_<?php echo $row['tid'] ?></td>
                <td><?php echo date('@H:i:s F j,Y',strtotime($row['datecreated'])) ?></td>


                <td>



                    <?php 

	   							
	   							 

	   								$getproductname = " select * from product where prod_id = '$prid'  ";
	   						                $gpname = mysqli_query($con,$getproductname); 
	   						           
	   						                 while($pname = mysqli_fetch_array($gpname)){
	   											

	   											?>

                    <a
                        href="?viewproducts&productname=<?php echo $pname['name'] ?>&token=<?php echo $pname['prod_id'] ?>&_view">
                        <?php echo $pname['name']; ?>
                    </a>
                    <?php
	   						                 }
	   						          

	   						 ?>

                </td>
                <td>₱ <?php echo $gtrans['price'] ?></td>
                <td><?php echo $gtrans['quantity'] ?></td>
                <td>₱ <?php echo $gtrans['total'] ?></td>

                <?php



	   								 }
	   							

	   					 ?>

                <td>






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
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/rr-1.2.8/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/b-2.0.1/rr-1.2.8/datatables.min.js">
</script>
<script type="text/javascript">
$(document).ready(function() {


    let table = new DataTable('#categorytable', {

        "search": {
            "caseInsensitive": false
        }

    });

});
</script>
<?php

	
}

if(isset($_POST['confirm'])){ 
	$od = $_POST['od'];

	$confirm = "UPDATE `transaction` SET `status`='confirmed' WHERE tid = '$od' ";
	mysqli_query($con,$confirm);
	
}
if(isset($_POST['confirmd'])){ 
	$od = $_POST['od'];

	$confirm = "UPDATE `transaction` SET `status`='ready' WHERE tid = '$od' ";
	mysqli_query($con,$confirm);
	
}

if(isset($_POST['mc'])){ 
	$od = $_POST['od'];

	$confirm = "UPDATE `transaction` SET `status`='completed' WHERE tid = '$od' ";
	mysqli_query($con,$confirm);
	
}
if(isset($_POST['transport'])){ 
	$od = $_POST['od'];

	date_default_timezone_set('Asia/Manila');
	$date = date('Y-m-d');

	$confirm = "UPDATE `transaction` SET `status`='otw' WHERE tid = '$od' ";
	mysqli_query($con,$confirm);
	
}
 ?>