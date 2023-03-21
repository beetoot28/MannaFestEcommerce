<?php 
session_start();
include 'connections/connect.php';
//echo $_SESSION['user_id'];
  /////////////////////////////SET ONLY IF USER ACCOUNT ID IS NOT SET //////////////////////////////////////
if(isset($_SESSION['user_isset'])){



} else {

    function getClientIP()
    {

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
    $checkandtosave = mysqli_query($con, $checktemporary_user);
    $counttemporary_user = mysqli_num_rows($checkandtosave);

    if ($counttemporary_user >= 1) {
        while ($row = mysqli_fetch_array($checkandtosave)) {
            $temp_id = $row['ipaddress'];

        }
        $_SESSION['user_id'] = $temp_id;

    } else {
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');
        $insertnewtemp_users = "INSERT INTO `tempuser`(`ipaddress`, `datecreated`) VALUES ('$usertempip','$datenow')";
        mysqli_query($con, $insertnewtemp_users);

        $_SESSION['user_id'] = $usertempip;
    }

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

h1 {
    padding: 15px 60px;
    width: 30%;
    background: #0D3CE3;
    border: 1px solid rgb(185, 185, 185);
    text-transform: uppercase;
    border-radius: 20px;
    margin-top: 10px;
    font-weight: bold;
    font-size: 50px;
    color: #FEF58E;
    text-decoration: none;
}

.vision-mission-values {
    padding: 50px 0;
    background-color: #f5f5f5;
}

.vision-mission-values h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

.vision-mission-values p {
    font-size: 18px;
    line-height: 1.5;
}

.vision-mission-values ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
</style>

<body style="background-color:white;overflow-x: hidden;">

    <?php 
  
  include 'include/topnavbar.php';
  include 'include/allcategorynav.php';

  ?>

    <div class="col-md-12">
      
    </div>

    <div class="container-fluid">


        <br><br><br>
        <div class="container">
            <center>


                <h1> ABOUT US </h1>
                <br> <br>
                <div class="card">
                    <div class="card-body">
                        <p style='font-size:18px'>

                            Zamboanga city is known for its semi-latin culture. It’s the only city in the Philippines
                            that has a
                            dialect similar to that of the Spanish language, and most of the city has a certain Spanish
                            vibe to
                            it. But despite its label as “Asia’s latin city”, Zamboanga's’ signature identity lies in
                            her
                            dialect. Whenever a person from another part of the archipelago visits the city, it’s mostly
                            about
                            the Latin atmosphere. The word Manna was taken from the Bible, specifically in the book of
                            Exodus,
                            where God provided food for His people in the form of delicious wafer-like bread called
                            “Manna” that
                            He sprouted out from the ground ❨Exo.16:4 “I will rain bread from heaven❩. God who is the
                            "Master
                            Baker" provided bread that truly satisfy His people. And this is where MannaFest was built
                            upon.
                            It’s not just any bread, its bread from heaven, meaning that in any aspect, it is The
                            Quality and
                            the taste, and the uniqueness of bread bake faithfully to perfection. MannaFest will provide
                            the
                            Zamboangueños with bread that is of class. The people deserve bread that is baked clean and
                            baked
                            delicious by people who are faithful to quality. Bread also is the basic connotation of
                            food.
                            Whatever the race, culture or country a person comes from, bread is always present. It also
                            symbolizes peace. Whenever two people share bread together, there is genuine peace. Another
                            reason
                            why the company was brought to existence was the owner’s great desire to create something
                            that the
                            Zamboangueños can be proud of and call their own. Something with a certain kind of mojo that
                            lets
                            you taste and experience Zamboanga. Something that tells your mind that this product is
                            Zamboanga.
                            Yes, the whole Latin thing is cool and unique, but a product adds something more to the
                            city’s
                            signature style. The city is beautiful due to its culture and people and with Manna rising
                            up to the
                            challenge it could be something big. <br>
                            <b>-Jerome T. </b>
                        </p>
                    </div>
                </div>

                <br>
                <br>

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

        <div class="vision-mission-values">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Vision</h2>
                        <p>We are a Filipino food company that is most admired for its product, people,partnership, and
                            performance.</p>
                    </div>
                    <div class="col-md-4">
                        <h2>Mission</h2>
                        <p>Our Customers deserve the best ,so we commit to produce only the best quality and innovative
                            food products through:
                            <br> <br>
                            - Maintaining a clean and standard quality facilities, <br>
                            - Nurturing professional people who are faithful in work integrity. <br>
                            - Strengthened relationship with our Business Partners. <br>
                            - Sustaining Profitability. <br>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2>Core Values</h2>
                        <ul>
                            <li>Integrity</li>
                            <li>Excellence</li>
                            <li>Innovation</li>
                            <li>Teamwork</li>
                            <li>Community</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>






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