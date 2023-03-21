<?php 
session_start();
include 'connections/connect.php';
unset($_SESSION['disc']);

if(isset($_SESSION['user_ip'])){
  $ipadd = $_SESSION['user_ip'];

$deletetempcart = "DELETE FROM `cart` WHERE user_id = '$ipadd' ";
                            mysqli_query($con,$deletetempcart);
$deletetempwishlist = "DELETE FROM `wishlist` WHERE user_id = '$ipadd' ";
                            mysqli_query($con,$deletetempwishlist);
}






 ?>
<!DOCTYPE html>
<html>

<?php include 'include/header.php';
if (isset($_GET['prod'])) {
    $prod_id = $_GET['prod'];
  }

  $sql = mysqli_query($con, "SELECT * from product  JOIN photo on
  product.prod_id = photo.prod_id
   WHERE product.prod_id='$prod_id'"); 
  $arr = mysqli_fetch_array($sql);



?>

<body style="background-color:white;overflow-x: hidden;">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/product_details.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php 
  include 'include/topnavbar.php';
  ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
    .column {
        display: grid;
        column-count: 2;
        width: 50%;
    }

    /* Clear floats after the columns */
    button {
        column-span: all;
        margin-top: 5px;
    }

    .row {
        display: flex;
    }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <div class="container">

    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">Product Details </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active"> <img class="d-block w-100"
                                src="img/products/<?php echo $arr['photo']?>" alt="First slide">
                        </div>
                        <div class="carousel-item"> <img class="d-block w-100" src="c52.jpg" alt="Second slide"> </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span
                            class="sr-only">Previous</span> </a> <a class="carousel-control-next"
                        href="#carouselExampleControls" role="button" data-slide="next"> <span
                            class="carousel-control-next-icon" aria-hidden="true"></span> <span
                            class="sr-only">Next</span> </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <h2><?php echo $arr['name']?></h2>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="row">

                            <div class="col-2 col-md-2">
                                <h5 class="text-warning ">
                                    <b><span id="average_rating">0.0</span> / 5</b>
                                </h5>
                            </div>

                            <div class="col-sm-4">

                                <div class="mb-6">
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                </div>
                            </div>
                            <?php 
                            $sqlTotalSold = "SELECT prod_id,SUM(quantity) as total_sold FROM trans_record 
                            LEFT JOIN transaction on trans_record.transaction_id = transaction.tid
                            where prod_id='$prod_id' and status='delivered' or status='completed'";
                            $soldResult = $con->query($sqlTotalSold);
                            $total = mysqli_fetch_array($soldResult);
                            $total_sold = $total['total_sold'];
                        echo  '  '.$total_sold.' Sold' ;
                                ?>

                        </div>



                    </div>
                    &nbsp; &nbsp;

                </div>
                <div class="row">
                    <p><i class="text-success fa fa-check-square-o" aria-hidden="true"></i> <?php echo $arr['name']?>
                    </p>

                    <p><i class="text-success fa fa-check-square-o" aria-hidden="true"></i> <strong>Details : </strong>
                        <?php echo $arr['description']?></p>

                    <p><i class="text-success fa fa-check-square-o" aria-hidden="true"></i> <strong>Ingredients</strong>
                        <?php echo $arr['ingredients']?></p>

                </div>
                <div class="row mt-4">
                    <div class="row">
                        <div class="column">
                            <?php 
                                
                                $sql  = mysqli_query($con, "SELECT production_log.prod_id, sum(production_log.qty_remaining) AS quantity
                                    FROM production_log
                                    LEFT JOIN product ON product.prod_id = production_log.prod_id
                                    WHERE production_log.prod_id='$prod_id' and production_log.status ='ACTIVE' or production_log.status ='LOW'");
                                    $arrSold = mysqli_fetch_array($sql);
                            
                                if ($arrSold['quantity'] != 0) { ?>

                                 <button class="btn btn-warning text-dark addcart"
                                    data-productid="<?php echo $arr['prod_id'] ?>"> Add to Cart <i
                                        class="fas fa-cart-plus"></i></button>


                            <?php 
                                 }else{
                             ?>
                            <div class="btn btn-danger text-white"
                                style="font-size: 13px;font-weight: bold; cursor: text;">
                                SOLD OUT </div>

                            <?php } ?>

                        </div>
                        <div class="column">

                            <button class="btn btn-dark text-light addwishlist"
                                data-productid="<?php echo $row['prod_id'] ?>"><i class="far fa-heart"></i> Wish
                                List</button>
                        </div>
                    </div>




                </div>





            </div>
        </div>
    </div>

    <br>

    <div class="container">
        <div class="row mt-5">
            <h2>Similar Products</h2>
        </div>

        <div class="row mt-5" style='padding-right: 10px;'>
            <?php 
               $GetProducts = " select * from product limit 4 ";
               $Items = mysqli_query($con, $GetProducts);
               $countingItems = mysqli_num_rows($Items);
               //  $get_id =  mysqli_insert_id($con);
               if ($countingItems >= 1)
               {
           
                   while ($row = mysqli_fetch_array($Items))
                   {
                       $itemid = $row['prod_id'];

  
            ?>

            <div class="col-md-3  ">

                <div class="card w-100 border-0" style="height:80%">
                    <?php
            $get_items_photo = " SELECT * FROM `photo` where prod_id = '$itemid' limit 1 ";
            $productphotos = mysqli_query($con, $get_items_photo);
            $countproduct_photos = mysqli_num_rows($productphotos);

            if ($countproduct_photos >= 1)
            {
                while ($photo = mysqli_fetch_array($productphotos))
                {
                  ?>
                    <center>
                        <div class="circle">
                            <img src="<?php echo 'img/products/' . $photo['photo'] ?>" alt="" class="card-img-top"
                                style="width:150px;height: 150px">
                        </div>
                    </center>
                    <?php
                }
            }
            else
            {

            }

            ?>

                    <div class="card-body" style="text-align: center;">
                        <a href="javascript:void(0)" data-bs-toggle="modal" class="openproductview"
                            data-id="<?php echo $row['prod_id'] ?>" data-bs-target="#exampleModald"
                            data-backdrop="static" data-keyboard="false" style="text-decoration: none"> <span
                                style="text-align: center;font-weight: bold"><?php echo $row['name'] ?></span> </a><br>
                        <span class="card-text" style="text-align: left;"><?php echo $row['description'] ?>
                        </span><br>
                        <span class="text-secondary" style="font-size: 20px;font-weight: bolder;">₱
                            <?php echo $row['price'] ?>
                        </span> <br>
                        <p></p>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-warning text-dark addcart" style="font-size: 13px;font-weight: bold;"
                            data-productid="<?php echo $row['prod_id'] ?>"> Add to Cart <i
                                class="fas fa-cart-plus"></i></button>

                        <?php

                            $user = $_SESSION['user_id'];

                            $checkifonthelist = " select * from wishlist where prod_id ='$itemid' and user_id = '$user'  ";
                            $checkingitem = mysqli_query($con, $checkifonthelist);
                            $thecountings = mysqli_num_rows($checkingitem);
            //  $get_id =  mysqli_insert_id($con);
                    if ($thecountings >= 1)
                    {
                    ?>
                        <button class="btn btn-light text-danger removewlist"
                            data-productid="<?php echo $row['prod_id'] ?>" style="font-size: 13px;font-weight: bold"><i
                                class="fas fa-heart"></i></button>
                        <?php
                    }
                    else
                    {
        ?>
                        <button class="btn btn-light text-danger addwishlist"
                            data-productid="<?php echo $row['prod_id'] ?>" style="font-size: 13px;font-weight: bold"><i
                                class="far fa-heart"></i></button>
                        <?php
            }

            ?>

                    </div>

                </div>

            </div>



            <!---->
            <?php
        }

    }
    else
    {

    }

?>

            <h2>Review</h2>
            <div class="container">

                <div class="card">
                    <div class="card-header"><?php echo $arr['name']?></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <h1 class="text-warning mt-4 mb-4">
                                    <b><span id="average_rating">0.0</span> / 5</b>
                                </h1>
                                <div class="mb-3">
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                    <i class="fas fa-star star-light mr-1 main_star"></i>
                                </div>
                                <h3><span id="total_review">0</span> Review</h3>
                            </div>
                            <div class="col-sm-4">
                                <p>
                                <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                </div>
                                </p>
                                <p>
                                <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                                <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                </div>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mt-5" id="review_content"></div>
            </div>

            <div class="mt-5" id="review_content"></div>
        </div>

    </div>





    <style>
    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #e9ecef;
    }
    </style>

    <script>
    $(document).ready(function() {




        load_rating_data();

        function load_rating_data() {
            prod_id = <?php echo  $prod_id;?>;
            $.ajax({
                url: "function/submit_rating.php",
                method: "POST",
                data: {
                    action: 'load_data',
                    prod_id: prod_id
                },
                dataType: "JSON",
                success: function(data) {
                    $('#average_rating').text(data.average_rating);
                    $('#total_review').text(data.total_review);

                    var count_star = 0;

                    $('.main_star').each(function() {
                        count_star++;
                        if (Math.ceil(data.average_rating) >= count_star) {
                            $(this).addClass('text-warning');
                            $(this).addClass('star-light');
                        }
                    });

                    $('#total_five_star_review').text(data.five_star_review);

                    $('#total_four_star_review').text(data.four_star_review);

                    $('#total_three_star_review').text(data.three_star_review);

                    $('#total_two_star_review').text(data.two_star_review);

                    $('#total_one_star_review').text(data.one_star_review);

                    $('#five_star_progress').css('width', (data.five_star_review / data
                        .total_review) * 100 + '%');

                    $('#four_star_progress').css('width', (data.four_star_review / data
                        .total_review) * 100 + '%');

                    $('#three_star_progress').css('width', (data.three_star_review / data
                        .total_review) * 100 + '%');

                    $('#two_star_progress').css('width', (data.two_star_review / data
                        .total_review) * 100 + '%');

                    $('#one_star_progress').css('width', (data.one_star_review / data
                        .total_review) * 100 + '%');

                    if (data.review_data.length > 0) {
                        var html = '';

                        for (var count = 0; count < data.review_data.length; count++) {
                            html += '<div class="row mb-3">';

                            html +=
                                '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">' +
                                data.review_data[count].user_name.charAt(0) + '</h3></div></div>';

                            html += '<div class="col-sm-11">';

                            html += '<div class="card">';

                            html += '<div class="card-header"><b>' + data.review_data[count]
                                .user_name + '</b><br>' + data.review_data[
                                    count].datetime + '</div>';

                            html += '<div class="card-body">';

                            for (var star = 1; star <= 5; star++) {
                                var class_name = '';

                                if (data.review_data[count].rating >= star) {
                                    class_name = 'text-warning';
                                } else {
                                    class_name = 'star-light';
                                }

                                html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                            }

                            html += '<br />';

                            html += data.review_data[count].user_review;

                            html += '</div>';



                            html += '</div>';

                            html += '</div>';

                            html += '</div>';
                        }

                        $('#review_content').html(html);
                    }
                }
            })
        }

    });
    </script>







    <?php 
  include 'include/footer.php';

  ?>




    <script>
    $('.addcart').click(function() {


        var productid = $(this).data('productid');



        $.ajax({
            url: "add&remove.php",
            method: "POST",
            data: {
                addtocart: 1,
                productid: productid
            },
            success: function(data) {

                countitemcart();
                if (data.match("alreadyadded")) {
                    $.notify("Quantity added", "success");
                } else {
                    $.notify("Added to Cart", "success");
                }
            }
        })


    })


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
    </script>





    <!--Bootstrap Plugins-->
    <script type="text/javascript" src="js/notify.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>