<?php 
session_start();
include 'connections/connect.php';

 ?>
<!DOCTYPE html>
<html>

<?php include 'include/header.php' ?>
<body style="background-color:#f0f5f5;overflow-x: hidden;">

	<?php 
 
  include 'include/topnavbar.php';


 // / include 'include/allcategorynav.php';

  ?>

 	<style type="text/css">
  @media screen and (max-width: 768px) {
    .banner img {
      height: 240px;
    }
    #bnctitle {
      font-size: 30px;
    }
    #buttonsg {
      position: relative;
      left: 100%;
    }
  }
</style>
 <style type="text/css">
 
  .float-right {
    float: right;
  }
 </style>

  <div class="container-fluid mt-4">


  	  <div class="container">
  	  
  	   
         <div class="card shadow-sm">
            <div class="card-body">
                
                
                <h5 style="font-weight: bolder" class="text-success"> <span style="float: right;"> <button class="btn btn-light text-primary" onclick="window.location.href='orders.php' ">My Orders</button></span></h5>
                   
                <hr>

                  <h6 style="font-weight: bold">RECEIPT</h6>
                   <div class="card">
                      <div class="card-body">
                        <button class="btn btn-light text-primary" id="printreceipt" style="font-size: 13px;float: right;"> PRINT<i class="fas fa-print"></i> </button>
                        
                         <div class="ppage" id="ppage">
                            
                            <h5 style="font-weight: bolder;font-weight:bolder;font-family: 'Courgette', cursive;">Manna <span style="float: right;font-size: 14px ;font-weight: normal;"><?php echo date('m-d-Y') ?></span></h5>
                             <div class="table-responsive">
                             
                        <table class="table  mt-5" >
                          <thead>
                            <tr>
                              <th scope="col">Order Date</th>
                              <th scope="col">Product</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Price</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $user = $_SESSION['user_id'];
                          date_default_timezone_set('Asia/Manila');
                          $datenow = date('Y-m-d');


                                $gettransorder = "SELECT * FROM `transaction` where user_id = '$user' and date(datecreated) = '$datenow' and status ='pending'  ";
                                            $gettingorder = mysqli_query($con,$gettransorder); 
                                            $countingtrans= mysqli_num_rows($gettingorder);
                                           //  $get_id =  mysqli_insert_id($con); 
                                         if ($countingtrans>=1){
                                        
                                             while($row = mysqli_fetch_array($gettingorder)){
                                              $pmorder = $row['paymentmethod'];
                                              $tid = $row['tid'];
                                              
                                                ?>
                                                <tr>
                                                  <td colspan="4"><h6 style="text-align:center;letter-spacing: 3px; font-weight: bolder;"><?php
                                                  if($pmorder == 'reserve'){

                                                    echo 'Reserved Order';
                                                  }else if ($pmorder = 'deliver'){
                                                    echo 'For Delivery Order';
                                                  }


                                                   ?></h6></td>
                                                  
                                                
                                                </tr>
                                                <?php

                                                    $gettrans_records = "select * from trans_record where user_id = '$user' and transaction_id = '$tid'  ";
                                                     $gettingtrans = mysqli_query($con,$gettrans_records); 
                                                  
                                                   while($gtrans = mysqli_fetch_array($gettingtrans)){
                                                     $prodid = $gtrans['prod_id'];
                                                  
                                                         ?>
                                                  <tr>
                                                  <th scope="row"><?php echo date('h:i a @ F j,Y' , strtotime($row['datecreated'])) ?></th>
                                                  <td>
                                                    <?php 
                                                        $selectproduct = " select * from product where prod_id = '$prodid'  ";
                                                                    $pname = mysqli_query($con,$selectproduct); 
                                                                  
                                                                
                                                                     while($item = mysqli_fetch_array($pname)){

                                                                      $total[] = $gtrans['total'];
                                                                      $dfee = $gtrans['dfee'];
                                                                      $disc = $gtrans['disc'];

                                                                      echo $item['name'];
                                                    
                                                                     }
                                                              

                                                     ?>
                                                  </td>
                                                  <td><?php echo $gtrans['quantity'] ?></td>
                                                  <td>₱<?php echo $gtrans['price'] ?></td>
                                                </tr>
                                                <?php  
                                                     }
                                                  
                                                   


                                             /* $prodid = $row['prod_id'];
                                              $total[] = $row['total'];
                                              $dfee = $row['dfee'];
                                              $disc = $row['disc'];


                                                ?>
                                                  <tr>
                                                  <th scope="row"><?php echo date('h:i a @ F j,Y' , strtotime($row['date_ordered'])) ?></th>
                                                  <td>
                                                    <?php 
                                                        $selectproduct = " select * from product where prod_id = '$prodid'  ";
                                                                    $pname = mysqli_query($con,$selectproduct); 
                                                                  
                                                                
                                                                     while($item = mysqli_fetch_array($pname)){

                                                                      echo $item['name'];
                                                    
                                                                     }
                                                              

                                                     ?>
                                                  </td>
                                                  <td><?php echo $row['quantity'] ?></td>
                                                  <td>₱<?php echo $row['price'] ?></td>
                                                </tr>
                                                <?php*/
                                             }
                                      }

                             ?>
                                  <tr>
                              <td></td>
                              <td></td>
                              <td>
                                <?php 
                                 if(isset($disc)){
                                    echo 'Discount';
                                  }else {
                                    
                                  }
                                 ?>
                              </td>
                              <td  > <h6 style=""> <?php 
                                 if(isset($disc)){
                                    echo ' -₱'.$disc;
                                  }else {
                                    
                                  }
                                 ?></h6></td>
                            </tr>
                          
                            <tr>
                              <td></td>
                              <td></td>
                              <td>
                                <?php 
                                 if(isset($dfee)){
                                    echo 'Delivery Fee';
                                  }else {
                                    
                                  }
                                 ?>
                              </td>
                              <td  > <h6 style=""> <?php 
                                 if(isset($dfee)){
                                    echo ' ₱'.$dfee;
                                  }else {
                                    
                                  }
                                 ?></h6></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td>
                               
                                 <h6 style="font-size: 15px;font-weight: bolder;float: right;">Total Amount Paid:  </h6>
                              </td>
                              <td>
                               
                                 
                                <h6 style="font-size: 15px;font-weight: bolder;">₱<span style="font-weight: bold;font-size: 19px"><?php 

                                 if(isset($total)){

                                   if(isset($disc)){
                                       if(isset($dfee)){
                                     echo array_sum($total) + $dfee - $disc;
                                  }else {
                                    echo array_sum($total) - $disc;


                                  }
                                      }else {
                                        
                                         if(isset($dfee)){
                                     echo array_sum($total) + $dfee;
                                  }else {
                                    echo array_sum($total);


                                  }
                                      }
                                  
                                 

                                 }

                                  ?></span></h6>
                              </td>

                            </tr>
                          </tbody>
                        </table>
                        </div> 
                          <h6 style="font-size: 14px;text-align: center;" class="mt-5"> ** Nothing Follows **</h6>

                        </div> 
  

                      </div> 
                      
                   </div> 
                   


            </div> 
            
         </div> 
         
      

  	 
  	   

  	  </div> 
  	  
  	  <p><br></p>

  

                  <?php 
                  if(isset($_SESSION['pmt_method'] )){
                    $pm =$_SESSION['pmt_method'] ;

                    if($pm == 'reserve'){

                      $ppm = 'Reserved For Pick up.';

                         }else if ($pm == 'deliver'){
                         $ppm = 'is Preparing for Delivery.';
                         }

                  }


                   ?> 
  	 

 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <?php 
 if(isset($_SESSION['sccsfl'] )){
  ?>
  <script type="text/javascript">
    $(document).ready(function() {
        Swal.fire(
  'Your Order was Successful!',
  'Paid Successfully and <?php echo $ppm?>',
  'success'
)
    });
          
          
  </script>
  <?php
  unset($_SESSION['sccsfl'] );
 }

  ?>
  <script>
  $(document).ready(function() {

     if ( $(window).width() <= 767 ) { 
      $('#buttonsg').removeClass('row');
      $('#footrow').removeClass('row');
       $('#footrow').css('text-align','center');
       $('.e').removeClass('col-md-4');

      }


  

    $('#printreceipt').click(function() { 
      $(this).hide();
   printDiv('ppage');
   
    })

    function printDiv(divName){
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;

      window.print();

      document.body.innerHTML = originalContents;

    }


     countitemwishlist();

    function countitemwishlist (){

        $.ajax({
                 url : "contents.php",
                  method: "POST",
                   data  : {cartwlistitems:1},
                   success : function(data){
                $('#countwlist').text(data);
                   }
                })

    }

       countitemcart();
             function countitemcart (){
        
         $.ajax({
                 url : "contents.php",
                  method: "POST",
                   data  : {cartitems:1},
                   success : function(data){
                $('#countcart').text(data);
                 $('#countcarts').text(data);
                   }
                })
        
      
  
          
    }

  


  });
  </script>
  	 


  	
  </div> 

 <?php 
  include 'include/footer.php';
  include 'include/itemsview.php';
  ?>
  	
  

  	



     	   			 
		  
		
		<!--Bootstrap Plugins-->
	
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/popper.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>