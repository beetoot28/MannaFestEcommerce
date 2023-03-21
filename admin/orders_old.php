<?php 
session_start();
if(!isset($_SESSION['admin_id'])){
  header('location:../log/signin.php');
}

 ?>
<!DOCTYPE html>
<html>

<?php include 'head.php'; include '../connections/connect.php'; ?>

<body style="background-color: #EDF2F7">
    <div class="wrapper">


    <nav class="sidenav shadow">
        <?php include 'navbar.php' ?>
        </nav>


        <section class="home-section">
        

            <div class="main_contents">
                <div class="container-fluid">

                    <h5 style="font-weight: bolder;">ORDERS</h5>
                    <hr>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button class="btn btn-light text-success mb-3" id="cpo" style="font-size: 15px">Completed
                                Orders →</button>

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





        </section>

    </div>



    <?php 
   if(isset($_GET['viewproducts'])){ 
      $id = $_GET['token'];
      ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#openview').click();

    });
    </script>



    <button type="button" class="btn btn-primary " id="openview" data-bs-toggle="modal" data-bs-target="#itemsview"
        data-bs-target="#staticBackdrop">
        asd
    </button>


    <div class="modal fade " id="itemsview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg ">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" onclick="window.location.href='orders.php'" style="float: right;"
                        class="btn-close mb-2" data-bs-dismiss="modal" aria-label="Close"></button>


                    <div class="row">
                        <div class="col-md-8">

                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">

                                    <?php 
       
                            $gtproductphotosactive = " select * from photo where prod_id = '$id' limit 1  ";
                                            $result_of_getactive = mysqli_query($con,$gtproductphotosactive); 
                                        
                                            while($rowactive = mysqli_fetch_array($result_of_getactive)){
                                            $prodactive = $rowactive['p_id'];
                                            $src = '../img/products/'.$rowactive['photo'];
                                            

                                        ?>

                                    <div class="carousel-item active">
                                        <img src="<?php echo $src ?>" class="d-block w-100" alt="..."
                                            style="width: 100%;height: 500px;">
                                    </div>

                                    <?php
                         }

                        if(isset($prodactive)){
                            $gtproductphotos = " select * from photo where prod_id = '$id' and p_id != '$prodactive'  ";
                        $result_of_get = mysqli_query($con,$gtproductphotos); 
                       
                         while($row = mysqli_fetch_array($result_of_get)){
                          $src = '../img/products/'.$row['photo'];
                      ?>

                                    <div class="carousel-item">
                                        <img src="<?php echo $src ?>" class="d-block w-100" alt="..."
                                            style="width: 100%;height: 500px;">
                                    </div>

                                    <?php
                         }

                        }else {
                          echo 'NO PHOTO AVAILABLE';
                        }

                        
               
        
         ?>




                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>


                        </div>
                        <div class="col-md-4">

                            <p><br><br></p>

                            <style type="text/css">
                            .det::-webkit-scrollbar {

                                width: 0px;
                            }
                            </style>
                            <?php 
               
                    $viewprod = " select * from product where prod_id = '$id' ";
                                $result_of_view = mysqli_query($con,$viewprod); 
                           
                            
                                 while($row = mysqli_fetch_array($result_of_view)){
                                ?>
                            <h5 style="font-weight: bolder;" id="pname"><?php echo $row['name'] ?></h5>
                            <span class="text-secondary mb-2" id="pprice"
                                style="font-size: 20px;font-weight: bolder;">₱<?php echo $row['price'] ?></span>
                            <br>
                            <div class="det" id="descc" style="font-size: 14px;height: 240px;overflow-y: scroll;">
                                <?php echo $row['description'] ?>
                            </div>

                            <?php
                                 }

                                 
                          
                 ?>


                            <br>





                        </div>


                    </div>




                </div>

            </div>
        </div>
    </div>
    <?php
   }

    ?>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript" src="../js/sidebar.js?v=1"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        table_category();

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

        function table_completed() {


            $.ajax({
                url: "action_order.php",
                method: "POST",
                data: {
                    completedorder: 1
                },
                success: function(data) {
                    $('#table_category').html(data);
                }
            })


        }

        $('#cpo').click(function() {
            var t = $(this).text();

            if (t == 'Completed Orders →') {
                table_completed();
                $(this).text('← Back');
            } else if (t == '← Back') {
                $(this).text('Completed Orders →');
                table_category();
            }


        })

    });
    </script>


    <!--Bootstrap Plugins-->
    <script type="text/javascript" src="../js/notify.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/popper.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>

</html>