<?php 
session_start();

include 'connections/connect.php';

 ?>
<!DOCTYPE html>
<html>

<?php include 'include/header.php' ?>
<body style="background-color:white;overflow-x: hidden;">

	<?php 
  $myacc = 1;
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
   #items_in_the_cart {
    height: 400px;
    overflow-y: scroll;
   }
   #items_in_the_cart::-webkit-scrollbar {
 
  width: 4px;
  }
  .float-right {
    float: right;
  }
 </style>

  <div class="container-fluid mt-4">


  	  <div class="container">
  

           <div class="row">
              <div class="col-md-3"></div> 
              <div class="col-md-6">

                 <div class="" id="myaccs"> 
                 
                <h6 style="font-weight: bolder;"> My Account</h6>
                  <?php 
                  $user = $_SESSION['user_id'];

                        $getuserdata = "SELECT * FROM `accounts` where user_id = '$user' ";
                                    $guserdata = mysqli_query($con,$getuserdata); 
                                  
                                
                                     while($row = mysqli_fetch_array($guserdata)){
                                          ?>

                                           <label>Lastname:</label>
                <input type="text" class="form-control txt mb-2 datatext" data-tp="lastname"  name="ln" style="" required="" value="<?php echo $row['lastname'] ?>" >

                <label>Firstname:</label>
                <input type="text" class="form-control txt mb-2 datatext" name="fn" data-tp="firstname" style="" required="" value="<?php echo $row['name'] ?>" >

                <label>BirthDate:</label>
                <input type="date" class="form-control txt mb-2 datatext" id="chd" name="bd" data-tp="bd"  style="" required="" value="<?php echo $row['birthdate'] ?>">

                <label>Address:</label>
                <input type="text" class="form-control txt mb-2 datatext" name="addr" data-tp="address" style="" required="" value="<?php echo $row['address'] ?>">

                <label>Delivery Address:</label>
                
                <textarea  class="form-control txt mb-2 datatext" name="daddr" value="" data-tp="d_address" cols="4"><?php echo $row['d_address'] ?></textarea>

                  <label>Email:</label>
                <input type="text" class="form-control txt mb-2 datatext" name="" data-tp="email" style="" required="" value="<?php echo $row['email'] ?>">


                                          <?php


                                     }
                              

                   ?>
                   </div>


                    <div class="d-none" id="cp">

                            <!--save new password-->


                          <div class="container">
      <h5>Changing Password <i style="font-size: 22px;" class="fas fa-user-lock"></i></h5>
      <p></p>
        <div class="row">
           
           <div class="container">
              
          <label>Enter Current Password</label>
                                                  <input type="password" style="font-size: 13px" name="txtcurrent" id="txtcurrent" class="form-control"  required="" autofocus="">

                                                   <div id="notify" style="margin-top: 5px;"></div> 
                                                 
                                                      
                                                      <form method="post"  id="savenewpassword" onsubmit="return false">
                                                       <br> 
                                                       <input type="hidden" name="savenewpassword">
                                                        <label>Enter New Password</label>
                                                  <input type="password" name="txtnew" style="font-size: 13px" id="txtnew" class="form-control" disabled=""> 
                                                     <div class="d-none" id="restrict">
                                                     
                                                    <div class="card">
                                                              <div class="container">
                                                                 <ul>
                                                                    <li id="upper">Must have Uppercase _Ex.(ABCDEFGHI)</li>  
                                                                    <li id="lower">Must have a Lowercase _Ex. (abcdefghi)</li>
                                                                    <li id="numb">Must have a Number _Ex.(123456789)</li>
                                                                    <li id="chara">Must have at Least 8 Characters _Ex.(********)</li>
                                                                 </ul>
                                                                 
                                                              </div>     
                                                        </div> 
                                                         <br>
                                                         </div> 
                                                  <label>ReEnter New Password</label>
                                                  <input type="password" name="txtreenter" style="font-size: 13px" id="txtreenter" class="form-control" disabled="" >
                                                  <div id="pregmatch"></div> 
                                                   
                                                        

                                                  <br> 
                                                  <button type="submit" id="btnsavepass" name="savenewpass" class="btn btn-success" disabled="" > Save Password  </button>
                                                 
                                                   </form>  

           </div> 
                 
        
    
          
        </div>
        </div> 

        <!--End save new password-->

                    </div> 
                    


                   <script type="text/javascript">
                     
                     $(document).ready(function() {
                         if ( $(window).width() <= 767 ) { 
      $('#buttonsg').removeClass('row');
      $('#footrow').removeClass('row');
       $('#footrow').css('text-align','center');
       $('.e').removeClass('col-md-4');

      }

                      ////////save new Password ////////////

                            $('#txtcurrent').keyup(function(){ 
                              var value = $(this).val();
                            
                                   $.ajax({
                               url : "acc.php",
                                method: "POST",
                                 data  : {compare:1,currentpass:value},
                                 success : function(data){
                                          
                                   if(value == '') {
                                        $('#txtreenter').attr('disabled',true);
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                       $('#notify').html('');  
                                        $('#txtnew').attr('disabled',true);
                                        $('#btnsavepass').attr('disabled',true);
                                        
                                  }else {
                                           if (data == 'success') {
                                        $('#txtnew').removeAttr('disabled');
                                      //  $('#txtreenter').removeAttr('disabled');
                                        $('#txtnew').attr('required',true);
                                      //  $('#txtreenter').attr('required',true);
                                      $('#txtcurrent').attr('disabled',true);
                                        $('#notify').html('');
                                         $('#txtnew').focus();
                                   }else if (data == 'fail') {
                                        $('#txtnew').removeAttr('required');
                                     //   $('#txtreenter').removeAttr('required');
                                        $('#txtnew').attr('disabled',true);
                                        $('#txtreenter').attr('disabled',true);
                                        $('#txtnew').val('');
                                        $('#txtreenter').val('');
                                         $('#pregmatch').html('');
                                         $('#btnsavepass').attr('disabled',true);
                                        $('#notify').html('<h6 style="color: red">Password doesnt Match your current pass <i class="fas fa-exclamation-triangle"></i></h6>');
                                   }


                                  }
                                 
                                   
                                 }
                              })
                        })

         $('#txtnew').keyup(function(){ 
                              var newvalue = $(this).val();

                              if(newvalue == '') {
                                   $('#restrict').addClass('d-none');
                                  
                                   $('#txtreenter').attr('disabled',true);
                                   $('#txtreenter').val('');

                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                              }else {
                                  $('#restrict').removeClass('d-none'); 
                                   var lowerCaseLetters = /[a-z]/g;
                                   var upperCaseLetters = /[A-Z]/g;
                                    var numbers = /[0-9]/g;

                                    if(newvalue.match(lowerCaseLetters) && newvalue.match(upperCaseLetters) &&  newvalue.match(numbers) && newvalue.length >= 8 ) {
                                          $('#restrict').addClass('d-none');
                                          $('#txtreenter').removeAttr('disabled');
                                        $('#txtreenter').attr('required',true);
                                    }else {

                                     if(newvalue.match(lowerCaseLetters)) {
                                        $('#lower').addClass('d-none');
                                    }else {
                                        $('#lower').removeClass('d-none');
                                        $('#txtreenter').attr('disabled',true);
                                         $('#txtreenter').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                    if(newvalue.match(upperCaseLetters)) {
                                        $('#upper').addClass('d-none');
                                    }else {
                                        $('#upper').removeClass('d-none');
                                        $('#txtreenter').attr('disabled',true);
                                         $('#txtreenter').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                    if(newvalue.match(numbers)) {
                                        $('#numb').addClass('d-none');
                                    }else {
                                        $('#numb').removeClass('d-none');
                                        $('#txtreenter').attr('disabled',true);
                                         $('#txtreenter').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }
                                    if(newvalue.length >= 8) { 
                                       $('#chara').addClass('d-none');
                                      
                                    }else {
                                         $('#chara').removeClass('d-none');
                                         $('#txtreenter').attr('disabled',true);
                                         $('#txtreenter').val('');
                                        $('#btnsavepass').attr('disabled',true);
                                         $('#pregmatch').html('');
                                    }

                                    }

                               




                              }
                              
                         })

          $('#txtreenter').keyup(function(){ 
                              var valuenew = $('#txtnew').val();
                              var reentervalue = $(this).val();

                              if(valuenew == reentervalue) {
                                   $('#pregmatch').html('<span style="color: Green">Password Match <i class="fas fa-check-circle"></i></span>');
                                  
                                 
                                   $('#btnsavepass').removeAttr('disabled');

                              } else {
                                    $('#pregmatch').html('<span style="color: red">Password does not Match <i class="fas fa-times-circle"></i> </span>');
                                     $('#btnsavepass').attr('disabled',true);
                              }    


                         })  

            ////////End save new Password ////////////




                         $('#savenewpassword').on('submit', function(event){
                       event.preventDefault();
                     
                             $.ajax({
                                       url : "acc.php",
                                        method: "POST",
                                         data  : $(this).serialize(),
                                         success : function(data){
                                  Swal.fire(
                                'Well Done!',
                                'Your Password changed Successfully!',
                                'success'
                              ).then((result) => {
                                  if (result.isConfirmed) {
                                   location.reload();
                                  }
                                })
                                 
                                         }
                                      })
                       }); 
                       
                             $('.datatext').keyup(function(){ 

                              var tp = $(this).data('tp');
                              var val = $(this).val();


                              
                                 $.ajax({
                                         url : "acc.php",
                                          method: "POST",
                                           data  : {setacc:1,tp:tp,val:val},
                                           success : function(data){
                                        
                                           }
                                        })
                                     
                                  
                           
                             
                             })





                            $('#chd').change(function(){

                                 var tp = $(this).data('tp');
                              var val = $(this).val();
                            $.ajax({
                                         url : "acc.php",
                                          method: "POST",
                                           data  : {setacc:1,tp:tp,val:val},
                                           success : function(data){
                                        
                                           }
                                        })
                            });



                            $('#cppw').click(function() { 
                              var t = $(this).text();
                            
                              if(t == 'Change Password'){
                               $('#myaccs').addClass('d-none');
                              $('#cp').removeClass('d-none');
                              $('#txtcurrent').focus();
                              $(this).text('Cancel');
                              }else {
                                  $('#myaccs').removeClass('d-none');
                              $('#cp').addClass('d-none');
                             
                              $(this).text('Change Password');
                              }


                            
                            })

                           });      
                           
                   </script>

              </div> 
              <div class="col-md-3">
                   <button class="btn btn-light form-control" id="cppw">Change Password</button>
                    <button class="btn btn-light form-control mt-3 text-danger logout">Logout</button>

              </div> 
              
           </div> 
           
  	 
  	   

  	  </div> 
  	  
  	  <p><br></p>

  	
  	 
  
  	 


  	
  </div> 

 <?php 
  include 'include/footer.php';
  include 'include/itemsview.php';
  ?>
  	
  

  	



     	   			 
		  
		
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  
  $(document).ready(function() {

        
        $('.logout').click(function(){
                       window.location.href='log/logout.php';   
        })
   
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

items();
    function items(){
        
      
         $.ajax({
                 url : "contents.php",
                  method: "POST",
                   data  : {listitems:1},
                   success : function(data){
              $('#items_in_the_cart').html(data);
                   }
                })
           
          
    }
        
        });      
        
</script>


               
      
    
    <!--Bootstrap Plugins-->
     <script type="text/javascript" src="js/notify.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>