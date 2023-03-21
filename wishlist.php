<?php 
session_start();

include 'connections/connect.php';

 ?>
<!DOCTYPE html>
<html>

<?php include 'include/header.php' ?>

<body style="background-color:white;overflow-x: hidden;">

    <?php 
  $wishlist = 1;
  include 'include/topnavbar.php';


 // / include 'include/allcategorynav.php';

  ?>


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

    <div class="container-fluid mt-4">


        <div class="container">

            <div class="card">
                <div class="card-header">
                    <h5 class="text-dark" style="font-weight: bolder;">Wishlist</h5>

                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="container">
                            <div id="items_in_the_cart">
                                <!--Items-->

                                <div class="spinner-grow text-info" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow text-info" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow text-info" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>



                                <!---->

                            </div>




                        </div>



                    </div>




                </div>

            </div>





        </div>

        <p><br></p>








    </div>

    <?php 
  include 'include/footer.php';
  include 'include/itemsview.php';
  ?>










    

    <script type="text/javascript">
    $(document).ready(function() {
        if ($(window).width() <= 767) {
            $('#buttonsg').removeClass('row');
            $('#footrow').removeClass('row');
            $('#footrow').css('text-align', 'center');
            $('.e').removeClass('col-md-4');

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

        items();

        function items() {


            $.ajax({
                url: "contents.php",
                method: "POST",
                data: {
                    listitems: 1
                },
                success: function(data) {
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