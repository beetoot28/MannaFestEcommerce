<?php 
session_start();
if(!isset($_SESSION['cour_id'])){
  header('location:../log/signin.php');
}
 ?>
<!DOCTYPE html>
<html>

<?php include 'head.php' ?>
<body style="background-color:white">
 <div class="wrapper">
  

  <nav class="sidenav shadow">
       <div class="userinfo">
        <img src="../img/undraw_male_avatar_323b.svg" class="img-thumbnnail shadow" style="width: 60px;height: 60px;border-radius: 30px;">
       
       

  <div class="dropdown"  style="font-weight: bolder;">
    
 Courier_<span id="username" class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['cour_name'] ?></span>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="font-size: 13px;">
    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
     <li><a class="dropdown-item" href="../log/logout.php">Logout</a></li>
   
  </ul>
</div>
      
        <span style="font-weight: normal;font-size: 13px"><?php echo $_SESSION['cour_email'] ?></span>
        
       </div> 
       <hr>
        <div class="navigations">
          
        
      
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="font-size: 14px" >

           
          

               <li class="nav-item navitems" style="text-align:center;">
                <a class="nav-link navlinks text-secondary " href="index.php">
                   <i class="fas fa-cart-arrow-down"></i>
                    <span>Orders</span></a>
            </li>

         

            

      
           
           

          
           
          

        </ul>


        </div> 
        
       
  </nav>


  <section class="main">
    
     <div class="topbar shadow-sm">
      <button class="btn btn-light text-dark" id="slideleft" style="font-size: 10px;"><i class="fas fa-arrow-left"></i></button>

 
     </div> 

      <div class="main_contents">
         <div class="container">
         
          <h5 style="font-weight: bolder;">CREDENTIALS</h5>
          <hr>
           <div class="card shadow-sm" style="">
              <div class="card-body">
                  
                
                        <!--
    <label style="font-size: 14px" class="mb-2 mt-4">Enter new Category:</label>
                      <input type="text" name="" class="form-control" style="font-size: 12px">
                      <hr>
                       <button class="btn btn-light  text-primary" style="font-size: 12px;float: right;" >Add new <i class="fas fa-plus-circle"></i></button>
                        -->
                   
                   
                   
                    
                         <div id="table_category">
                         <div class="spinner-grow text-dark" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-dark" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-dark" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>

                         </div> 
                      
                    

                   



              </div> 
              
           </div> 
           </div> 



      </div> 


       <div class="footer shadow">
         
       </div> 
       
      
     
     
     

  </section>

   </div> 



 

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script type="text/javascript">
    
    $(document).ready(function() {


      table_category();
            function table_category(){
             
              
                 $.ajax({
                         url : "action_profile.php",
                          method: "POST",
                           data  : {profile:1},
                           success : function(data){
                      $('#table_category').html(data);
                           }
                        })
                   
                  
            }


          });      
          
  </script>
  
   <script type="text/javascript" src="../js/sidebar.js?v=1"></script>

    

  <!--Bootstrap Plugins-->
     <script type="text/javascript" src="../js/notify.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/popper.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>
</html>