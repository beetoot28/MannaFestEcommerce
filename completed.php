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

    #pane::-webkit-scrollbar {
        width: 5px;
    }

    #pane::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    #pane::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    #pane::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    </style>

    <div class="container-fluid mt-4">


        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="orders.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  active" href="completed.php">Completed</a>
                </li>

            </ul>
            <div class="row">

                <style type="text/css">
                #pane::-webkit-scrollbar {
                    width: 10px;
                }

                #pane {
                    height: 700px;
                    overflow-y: scroll;
                }
                </style>

                <div class="card">
                    <div class="card-body" style="">
                        <div class="container">
                            <div class="row">

                                <div class="col-md-2"></div>
                                <div class="col-md-8">

                                    <div id="pane">



                                        <?php 
                                         $userid = $_SESSION['user_id'];
                                         $gtstatus = " SELECT * FROM `transaction` where status='completed' and user_id = '$userid'   ";
                                                        $gstatus = mysqli_query($con,$gtstatus); 
                                                        $countingstat= mysqli_num_rows($gstatus);
                                                       //  $get_id =  mysqli_insert_id($con); 
                                                     if ($countingstat>=1){
                                                    
                                                         while($row = mysqli_fetch_array($gstatus)){
                                                            $tid = $row['tid'];
                                                            $pm = $row['paymentmethod'];
                                                            $date_completed =$row['date_completed'];
                                                                $gett_Transrecord = "select * from trans_record where transaction_id = '$tid'  ";
                                                                 $gettingtrans = mysqli_query($con,$gett_Transrecord); 
                                                               
                                                             while($gtrans = mysqli_fetch_array($gettingtrans)){
                                                            
                                                                    
                                                                 $id = $gtrans['prod_id'];

                                                               ?>
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div id="carouselExampleControls" class="carousel slide"
                                                            data-bs-ride="carousel">
                                                            <div class="carousel-inner">
                                                                <?php 

      $gtproductphotosactive = " select * from photo where prod_id = '$id' limit 1  ";
                        $result_of_getactive = mysqli_query($con,$gtproductphotosactive); 
                       
                         while($rowactive = mysqli_fetch_array($result_of_getactive)){
                          $prodactive = $rowactive['p_id'];
                          $src = 'img/products/'.$rowactive['photo'];
                          

                      ?>

                                                                <div class="carousel-item active">
                                                                    <img src="<?php echo $src ?>" class="d-block w-100"
                                                                        alt="..." style="width: 200;height: 200px;">
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
                                                                    <img src="<?php echo $src ?>" class="d-block w-100"
                                                                        alt="..." style="width: 200;height: 200px;">
                                                                </div>

                                                                <?php
                         }

                        }else {
                          echo 'NO PHOTO AVAILABLE';
                        }
                        
                  

    ?>
                                                            </div>
                                                            <button class="carousel-control-prev" type="button"
                                                                data-bs-target="#carouselExampleControls"
                                                                data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button"
                                                                data-bs-target="#carouselExampleControls"
                                                                data-bs-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>


                                                        <h6 style="font-weight: bolder;font-size: 14px;"
                                                            class="mt-3 text-success"> Completed @ : <?php echo $date_completed ?> </h6>



                                                    </div>
                                                    <div class="col-md-6">

                                                        <h6 style="font-size: 14px">
                                                            ORDER_NO :
                                                            <span style="font-weight: bolder">
                                                                BNC_<?php echo $gtrans['order_id'] ?> </span>
                                                            <br>

                                                            Date-Ordered :
                                                            <?php echo  date('F j, Y',strtotime($gtrans['date_ordered'])) ?>
                                                            <br>
                                                            Order type : <span class="text-primary">
                                                                <?php 
                               

                                  switch ($pm) {
                                      case 'deliver':
                                         echo 'For Delivery';
                                          break;
                                           case 'cod':
                                           echo 'Cash on Delivery';
                                          break;
                                      
                                      default:
                                            echo 'Reservation';
                                          break;
                                  }
                                   ?>


                                                            </span>
                                                            <br>




                                                        </h6>
                                                        <div class="card mt-5">
                                                            <div class="card-body">
                                                                <h6 style="font-size: 14px">
                                                                    Quantity : <span
                                                                        style="font-weight: bolder; float: right;"><?php echo $gtrans['quantity'] ?></span><br>
                                                                    Price : <span
                                                                        style="font-weight: bolder;float: right;">₱
                                                                        <?php echo $gtrans['price'] ?></span><br>
                                                                    <hr>
                                                                    Total : <span
                                                                        style="font-weight: bolder;float: right;">₱
                                                                        <?php echo $gtrans['total'] ?> </span>
                                                                </h6>

                                                            </div>

                                                        </div>

                                                        <h6 style="float: right;font-size: 14px" class="mt-4">Amount
                                                            paid : <span style="font-weight: bolder;font-size: 16px">₱
                                                                <?php echo $gtrans['total'] ?></span></h6>



                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <?php


                                                                 }
                                                            }
                                                        }else {


                                                            ?>
                                        <div class="container mt-5">
                                            <h6 style="text-align: center;" class="text-secondary">You dont have any
                                                orders yet.</h6>
                                        </div>

                                        <?php
                                                        }
                                                             

                                                         
                                      ?>









                                    </div>

                                </div>
                                <div class="col-md-2"></div>

                            </div>

                        </div>

                    </div>

                </div>




            </div>






        </div>

        <p><br></p>





        <script>
        $(document).ready(function() {

            if ($(window).width() <= 767) {
                $('#buttonsg').removeClass('row');
                $('#footrow').removeClass('row');
                $('#footrow').css('text-align', 'center');
                $('.e').removeClass('col-md-4');

            }




            countitemwishlist();

            function countitemwishlist() {

                $.ajax({
                    url: "contents.php",
                    method: "POST",
                    data: {
                        cartwlistitems: 1
                    },
                    success: function(data) {
                        $('#countwlist').text(data);
                    }
                })

            }
            countitemcart();

            function countitemcart() {

                $.ajax({
                    url: "contents.php",
                    method: "POST",
                    data: {
                        cartitems: 1
                    },
                    success: function(data) {
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