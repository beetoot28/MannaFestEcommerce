<?php 
  session_start();
include 'connections/connect.php';

 ?>
<!DOCTYPE html>
<html>

<?php include 'include/header.php' ?>

<style type="text/css">

</style>

<body style="background-color:white;overflow-x: hidden;">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/filter.css">
    <?php 
  include 'include/topnavbar.php';
  include 'include/allcategorynav.php';

  ?>




    <div class="container-fluid">


        <div class="container">

            <div class="">
                <!--Sort By Categories--->
                

                <?php 
         
            
                  include 'products.php';

      
                 ?>
                <!-- <div id="sorted_by_categories">
                    <div class="spinner-grow text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div> -->



            </div>

            <!--Sort By Categories--->



        </div>




    </div>

    <p><br></p>

    <br><br><br><br><br><br><br><br>



    <!--<div class="fixed-top purple-rain shadow  d-none" style="border-bottom: 4px solid black" id="cartalert"   >
    <h5 style="font-weight:bolder;font-family: 'Courgette', cursive;float: left;padding: 10px; color:white">EB Fashion</h5> 
    <a href="cart.php"><h6 style="float: right;  font-weight: bolder;margin-right: 10px ;padding: 5px;padding-top: 15px; color:white;">Shopping Cart   <span class="badge badge-danger bg-dark" style="" id="countcarts"></span></h6></a>

    </div> -->



    </div>

    <?php 
  include 'include/footer.php';
  include 'include/itemsview.php';
  ?>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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

        var fixmeTop = $('#cartbutton').offset().top;

        $(window).scroll(function() {

            var currentScroll = $(window).scrollTop();

            if (currentScroll >= fixmeTop) {
                $('#cartalert').removeClass('d-none');
                $("#cartalert").toggle("slide", { direction: "left" }, 2000);
                $('#cartalert').animate({right:'120'},1000);
            } else {
                $('#cartalert').addClass('d-none');
                $('#cartalert').animate({left:'120'},1000);
            }

        });
    });
    </script>





    <!--Bootstrap Plugins-->
    <script type="text/javascript" src="js/notify.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>