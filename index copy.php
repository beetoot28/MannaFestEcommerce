<?php 
session_start();
include 'connections/connect.php';
//echo $_SESSION['user_id'];
  /////////////////////////////SET ONLY IF USER ACCOUNT ID IS NOT SET //////////////////////////////////////
if(isset($_SESSION['user_isset'])){

 

}else {
 
    function getClientIP() {

    if (isset($_SERVER)) {

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];

        return $_SERVER["REMOTE_ADDR"];
    }

    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');

    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');

    return getenv('REMOTE_ADDR');
}

    $usertempip = getClientIP();
      $checktemporary_user = " SELECT * FROM `tempuser` WHERE ipaddress= '$usertempip'  ";
                  $checkandtosave = mysqli_query($con,$checktemporary_user); 
                  $counttemporary_user= mysqli_num_rows($checkandtosave);
               
               if ($counttemporary_user>=1){
                   while($row = mysqli_fetch_array( $checkandtosave)){
                    $temp_id = $row['ipaddress'];
                  
                                 }
                    $_SESSION['user_id'] = $temp_id;
               
               }else {
                  date_default_timezone_set('Asia/Manila'); 
                  $datenow = date('Y-m-d H:i:s');
                $insertnewtemp_users = "INSERT INTO `tempuser`(`ipaddress`, `datecreated`) VALUES ('$usertempip','$datenow')";
                mysqli_query($con,$insertnewtemp_users);

               $_SESSION['user_id']=  $usertempip;
               }


}

if (!isset($_SESSION['ran_traffic_script'])) {

    // Get the user agent
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Try to determine the device type (phone, tablet, or computer)
    if (preg_match('/mobile/i', $user_agent)) {
        $device_type = "phone";
    } elseif (preg_match('/tablet/i', $user_agent)) {
        $device_type = "tablet";
    } else {
        $device_type = "computer";
    }
    $current_datetime = date("Y-m-d H:i:s");
     // Insert the data into the database
     $query = "INSERT INTO traffic_log (date, device_type) VALUES ('$current_datetime', '$device_type')";
     mysqli_query($con,$query);
 
     // Set a session variable to indicate that the script has been run
     $_SESSION['ran_traffic_script'] = true;

}


               //////////////////////////////////////////////////////////


 ?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/home.css">

<!-- animte on scroll -->
<?php include 'include/header.php' ?>

<style type="text/css">
@media screen and (max-width: 100%) {
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




.stretched-link::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    pointer-events: auto;
    content: "";

}
</style>

<body style="background-color:white;overflow-x: hidden;">

    <?php 
  
  include 'include/topnavbar.php';
  include 'include/allcategorynav.php';

  ?>


    <div class="intro">
        <div class="row">
            <div class="col-sm-6">

                <div class="left">
                    <center>
                        <h1>
                            Healthy, delicious and faithfully<br>
                            <div class='intro_sub'>baked fresh!</div>
                        </h1>
                        <br>
                        <a href='category.php'> <i class="fa fa-search" style=" font-size: 26px"> </i> Order Now! </a>
                    </center>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item ">
                                        <img class="d-block w-100" src="assets/img/banner.png" alt="First slide">
                                    </div>
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="assets/img/right_intro.jpg" alt="Second slide">
                                    </div>

                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">


        <br><br><br>
        <div class="container">

            <div class="row mt-3">


                <h4 style="font-weight: bolder">Top Products</h4>

                <div class="row mt-4" id="items">
                    <div class="spinner-grow text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="" style="float: right;">

                    <button onclick="window.location.href='category.php' " class="btn btn-dark"
                        style="font-size: 13px;width: auto;float: right;">View All Products <i
                            class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <br> <br><br>
            <center>
                <h3>Top Features</h3>

                <b>Top Features created just for you.</b>
            </center>
            <br><br>
            <div class="feature_card">


                <div class="card_info" data-aos="fade-up" data-aos-anchor-placement="center-center">
                    <div class="one">
                        <p>&nbsp;</p>
                    </div>
                    <div class="two">
                        <p>Best Quality Bread in Town</p>
                    </div>
                    <div class="three"><i class="fa fa-hat-chef"></i></div>
                </div>
                <div class="card_info" id="two" data-aos="fade-up" data-aos-anchor-placement="center-center"
                    data-aos-delay="200">
                    <div class="one"></div>
                    <div class="two">
                        <p>Quick Pickup and Delivery</p>
                    </div>
                    <div class="three"><i class="far fa-truck"></i></div>
                </div>
                <div class="card_info" id="three" data-aos="fade-up" data-aos-anchor-placement="center-center"
                    data-aos-delay="300">
                    <div class="one"></div>
                    <div class="two">
                        <p>Mode of Payment made easier</p>
                    </div>
                    <div class="three"><i class="fa fa-money-bill"></i></div>
                </div>
                <div class="card_info" id="four" data-aos="fade-up" data-aos-anchor-placement="center-center"
                    data-aos-delay="400">
                    <div class="one"></div>
                    <div class="two">
                        <p>Precise product description</p>
                    </div>
                    <div class="three"><i class="far fa-file"></i></div>
                </div>
            </div>

        </div>
        <!-- <img src="assets/img/banner.png" class="our_product_bg_img"> -->
        <p><br></p>



        <!--<div class="fixed-top purple-rain shadow  d-none" style="border-bottom: 4px solid black" id="cartalert">

            <a href="home.php">
                <img src="assets/logo/logo_transparent.png" alt="">
            </a>

            <a href="cart.php">
                <h6
                    style="float: right;  font-weight: bolder;margin-right: 10px ;padding: 5px;padding-top: 15px; color:white;">
                    Shopping Cart <span class="badge badge-danger bg-dark" style="" id="countcarts"></span></h6>
            </a>

        </div>-->




    </div>

    <?php 
  include 'include/footer.php';
  include 'include/itemsview.php';
  ?>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript">
    if ($(window).width() <= 767) {
        $('#buttonsg').removeClass('row');
        $('#footrow').removeClass('row');
        $('#footrow').css('text-align', 'center');
        $('.e').removeClass('col-md-4');

    }



    $('.unaddtowishlist').click(function() {


    })
    items();



    function runOncePerIP() {
        // Get the IP address of the user
        var userIP = '<?php echo $_SERVER['REMOTE_ADDR']; ?>';
        // localStorage.removeItem(userIP);
        // Check if the function has already been run for this IP address
        if (localStorage.getItem(userIP) === null) {
            // Run the function
            console.log('Running function for the first time for this IP address');

            // Set a value in local storage to indicate that the function has been run
            localStorage.setItem(userIP, '1');
        } else {
            console.log('Function has already been run for this IP address');
        }
    }

    // Run the function
    runOncePerIP();


    function items() {

        $.ajax({
            url: "contents.php",
            method: "POST",
            data: {
                allitems: 1
            },
            success: function(data) {
                $('#items').html(data);
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
            //$("#cartalert").toggle("slide", { direction: "left" }, 2000);
            //$('#cartalert').animate({right:'120'},1000);
        } else {
            $('#cartalert').addClass('d-none');
            //$('#cartalert').animate({left:'120'},1000);
        }

    });
    </script>




    <!--Bootstrap Plugins-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="js/notify.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>

<!-- RECEIVING VOUCHER -->
<?php if (isset($_SESSION['success_verify'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        icon: 'success',
        title: 'Yehey, Welcome!',
        text: 'Verification of account is successful',
    })
    </script>
    <?php 
			unset($_SESSION['success_verify']);
		?>
</div>
<?php endif ?>


<!-- RECEIVING VOUCHER -->
<?php if (isset($_SESSION['sent_contact'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        icon: 'success',
        title: 'Thank you!',
        text: 'Thank you for submitting the form. We will contact you soon!',
    })
    </script>
    <?php 
			unset($_SESSION['sent_contact']);
		?>
</div>
<?php endif ?>