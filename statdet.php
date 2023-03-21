<?php 
session_start();
include 'connections/connect.php';

if(isset($_POST['details'])){ 
	$p = $_POST['p'];

	 $gtstatus = " SELECT * FROM `trans_record` where transaction_id = '$od'  ";
                                                        $gstatus = mysqli_query($con,$gtstatus); 
                                                        $countingstat= mysqli_num_rows($gstatus);
                                                       //  $get_id =  mysqli_insert_id($con); 
                                                     if ($countingstat>=1){
                                                    
                                                         while($row = mysqli_fetch_array($gstatus)){
                                                         	$id = $row['prod_id'];
                                                          ?>
                        								
                        		<div class="row">
                                <div class="col-md-6">
                               	   <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
   <?php 

      $gtproductphotosactive = " select * from photo where prod_id = '$id' limit 1  ";
                        $result_of_getactive = mysqli_query($con,$gtproductphotosactive); 
                       
                         while($rowactive = mysqli_fetch_array($result_of_getactive)){
                          $prodactive = $rowactive['p_id'];
                          $src = 'img/products/'.$rowactive['photo'];
                          

                      ?>

         <div class="carousel-item active">
      <img src="<?php echo $src ?>" class="d-block w-100" alt="..." style="width: 100%;height: 240px;">
    </div>

                      <?php
                         }

                        if(isset($prodactive)){
                            $gtproductphotos = " select * from photo where prod_id = '$id' and p_id != '$prodactive'  ";
                        $result_of_get = mysqli_query($con,$gtproductphotos); 
                       
                         while($rowe = mysqli_fetch_array($result_of_get)){
                          $src = 'img/products/'.$rowe['photo'];
                      ?>

         <div class="carousel-item">
      <img src="<?php echo $src ?>" class="d-block w-100" alt="..." style="width: 100%;height: 240px;">
    </div>

                      <?php
                         }

                        }else {
                          echo 'NO PHOTO AVAILABLE';
                        }

                        
                  

    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>	



                                </div> 
                                <div class="col-md-6">
                                    
                                    <h6 style="font-size: 14px">
                                      ORDER_NO :
                                        <span style="font-weight: bolder"> BNC_<?php echo $row['order_id'] ?>  </span>
                                        <br>

                                           Date-Ordered : <?php echo  date('F j, Y',strtotime($row['date_ordered'])) ?>
                                        <br>
                                        Order type : <span class="text-primary">
                                  <?php 
                                  if($row['pm'] == 'deliver'){
                                    echo 'For Delivery';
                                  }else {
                                    echo 'Reservation';
                                  }

                                   ?>


                                        </span>
                                        <br>




                                    </h6>
                                     <div class="card mt-5">
                                        <div class="card-body">
                                            <h6 style="font-size: 14px">
                                              Quantity : <span style="font-weight: bolder; float: right;"><?php echo $row['quantity'] ?></span><br>
                                              Price : <span style="font-weight: bolder;float: right;">₱ <?php echo $row['price'] ?></span><br>
                                              <hr>
                                               Total : <span style="font-weight: bolder;float: right;">₱ <?php echo $row['total'] ?> </span>
                                            </h6>

                                        </div> 
                                        
                                     </div> 

                                     <h6 style="float: right;font-size: 14px" class="mt-4">Amount paid : <span style="font-weight: bolder;font-size: 16px">₱ <?php echo $row['total'] ?></span></h6>
                                     


                                </div>
                                
                             </div>
                                                          <?php
                                                         }
                                                  }

	
}

if(isset($_POST['status'])){ 
		
		$od = $_POST['od'];

		  $gtstatus = " SELECT * FROM `trans_record` where order_id = '$od'  ";
                                                        $gstatus = mysqli_query($con,$gtstatus); 
                                                        $countingstat= mysqli_num_rows($gstatus);
                                                       //  $get_id =  mysqli_insert_id($con); 
                                                     if ($countingstat>=1){
                                                    
                                                         while($row = mysqli_fetch_array($gstatus)){
                                                          ?>
                          <div class="row">
                            <h6 style="font-size: 14px">
                              Date-Ordered : <?php echo  date('F j, Y',strtotime($row['date_ordered'])) ?>
                              <br>
                              Order type : <span class="text-primary">
                                  <?php 
                                  if($row['pm'] == 'deliver'){
                                    echo 'For Delivery';
                                  }else {
                                    echo 'Reservation';
                                  }

                                   ?>

                              </span>
                            </h6>
                         </div> 

                          <div class="row mt-5 mb-5">
                              
                              <h2 style="text-align: center;" class="text-success"> 
                                <?php 
                                if($row['status'] == 'pending'){
                                  echo 'PREPARING ORDER';
                                }else  if($row['status'] == 'confirmed'){
                                  echo '<span style="font-weight:bolder">READY FOR PICK UP</span>';
                                }else  if($row['status'] == 'ready'){
                                  echo '<span class="text-info">READY FOR TRANSPORT</span>';
                                }else  if($row['status'] == 'otw'){
                                  echo '<span class="text-info" style="font-weight:bolder">ON TRANSPORT</span>';
                                    ?>
                                    <br>
                                    <button  class="btn btn-success mt-5 btnreceive" style="font-size: 14px">RECEIVE</button>
                                    <br>
                                    <span style="font-size: 13px">If order was received successfully. please click this ↑ received button above to confirm order.</span>
                                    <?php
                                }

                                 ?>

                              </h2>
                          </div>
                                                          <?php
                                                         }
                                                  }
}

if(isset($_POST['confirmreceived'])){
$od = $_POST['od']; 
date_default_timezone_set('Asia/Manila');
$datenow = date('Y-m-d H:i:s');
      $orderreceived = "UPDATE `transaction` SET `status`='completed'  WHERE tid = '$od' ";
      mysqli_query($con,$orderreceived);
  
}

 ?>