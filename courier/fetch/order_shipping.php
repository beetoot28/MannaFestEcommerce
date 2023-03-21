<link rel="stylesheet" href="../css/address.css">
    <link rel="stylesheet" href="../css/select_address.scss">
<?php  
  session_start();
include '../../connections/connect.php';

 $output = '';  

 $userid = $_POST['userid'];
$getAddress = " select * from account_ship_address where user_id='$userid' and status='1' ";
$results = mysqli_query($con, $getAddress);
$row = mysqli_fetch_array($results);
//  $get_id =  mysqli_insert_id($con);

 
 $output .= ' 
 
 <div class="address_box">
 <div class="left">
     <div class="delivery_address">
         <div class="icon_circle">
             <i class="far fa-location"></i>
         </div>
         <p>Delivery Address</p>
         <div class="delivery_address_info">

             <?php
                 ?>

             <label class="card mx-2 ">
                 <input name="address" id="" value="" class="radio" type="radio" checked hidden>
                 <span class="plan-details">

                     <span>Customer : '.$row["contact_name"].'  <br> Contact No. : 
                     +63'.$row["phone_number"].'</span>
                     <span>Address : '.$row["address"].'</span>
                     <span>Postal : '.$row["postal_code"].'</span>
                 </span>
             </label>

             <?php
                             }
                        }
                        ?>


         </div>
     </div>
     <hr>
 </div>
</div>';  
 echo $output;  
 ?>