<?php
session_start();
include 'connections/connect.php';

if (isset($_POST['gettheitemsview']))
{
    $id = $_POST['id'];

?>
<style>
@media only screen and (max-width: 767px) {
  .card {
    width: 100%;
  }
}


@media (max-width: 767px) {
    .circle {
        width: 100px;
        height: 100px;
    }
}
</style>
<div class="row">
    <div class="col-md-8">

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php

    $gtproductphotosactive = " select * from photo where prod_id = '$id' limit 1  ";
    $result_of_getactive = mysqli_query($con, $gtproductphotosactive);

    while ($rowactive = mysqli_fetch_array($result_of_getactive))
    {
        $prodactive = $rowactive['p_id'];
        $src = 'img/products/' . $rowactive['photo'];

?>

                <div class="carousel-item active">
                    <div class="product">
                        <div class="circle">
                            <img src="<?php echo $src ?>" alt="">
                        </div>
                    </div>
                </div>

                <?php
    }

    if (isset($prodactive))
    {
        $gtproductphotos = " select * from photo where prod_id = '$id' and p_id != '$prodactive'  ";
        $result_of_get = mysqli_query($con, $gtproductphotos);

        while ($row = mysqli_fetch_array($result_of_get))
        {
            $src = 'img/products/' . $row['photo'];
?>

                <div class="carousel-item">
                    <div class="product">
                        <div class="circle">
                            <img src="<?php echo $src ?>" alt="">
                        </div>
                    </div>


                </div>

                <?php
        }

    }
    else
    {
        echo 'NO PHOTO AVAILABLE';
    }

?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


    </div>
    <div class="col-md-4">

        <p><br><br></p>



        <?php
    $viewprod = " select * from product where prod_id = '$id' ";
    $result_of_view = mysqli_query($con, $viewprod);

    while ($row = mysqli_fetch_array($result_of_view))
    {
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
        <?php
    if (isset($cart))
    {

    }
    else if (isset($wishlist))
    {

    }
    else
    {
?>
        <button class="btn btn-light text-info addcarts" style="font-size: 13px;font-weight: bold"
            data-productid="<?php echo $id ?>"> Add to Cart <i class="fas fa-cart-plus"></i></button>


        <?php

     
?>

        <?php
    }

    /*
    
    
    
    */

?>
        <script type="text/javascript">
        $('.addcarts').click(function() {


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
        </script>

    </div>


</div>
<?php

}

if (isset($_POST['cartitems']))
{
    $user = $_SESSION['user_id'];

    $countcartitems = " select * from cart where user_id = '$user'  ";
    $result_of_counting = mysqli_query($con, $countcartitems);
    $thecount = mysqli_num_rows($result_of_counting);
    //  $get_id =  mysqli_insert_id($con);
    if ($thecount >= 1)
    {
        echo $thecount;
    }
    else
    {
        
    }

    



}

if (isset($_POST['cartwlistitems']))
{
    $user = $_SESSION['user_id'];

    $countwlistitems = " select * from wishlist where user_id = '$user'  ";
    $result_of_counting = mysqli_query($con, $countwlistitems);
    $thecount = mysqli_num_rows($result_of_counting);
    //  $get_id =  mysqli_insert_id($con);
    if ($thecount >= 1)
    {
        echo $thecount;
    }
    else
    {
        echo '0';
    }
}

if (isset($_POST['allitems']))
{

    $GetProducts = " select * from product
    LEFT JOIN category on product.cat_id= category.cat_id
    where price !='' or cost !='' limit 4";
    $Items = mysqli_query($con, $GetProducts);
    $countingItems = mysqli_num_rows($Items);
    //  $get_id =  mysqli_insert_id($con);
    if ($countingItems >= 1)
    {

        while ($row = mysqli_fetch_array($Items))
        {
            $itemid = $row['prod_id'];

?>

<!--TOP PRODUCT DISPLAY INDEX-->
<div class="col-md-3 col-sm-6">
  <div class="card w-100 h-100">
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

            <?php
                        }
                    }
                    else
                    {

                    }

            ?>

            <div class="card-body" style="text-align: center;">

                <a href="product_details.php?prod=<?php echo $row['prod_id'] ?>" style="text-decoration: none"> <span
                        style="text-align: center;font-weight: bold"><?php echo $row['name'] ?></span> </a><br>
                <span class="card-text" style="text-align: left;"><?php echo $row['description'] ?>
          
                </span><br>
                <span class="text-secondary" style="font-size: 20px;font-weight: bolder;">₱ <?php echo $row['price'] ?>
                </span> <br>
                <p></p>
                <?php 
                    $prod_id = $row['prod_id'];
                    $query = "SELECT SUM(user_rating) as sum, COUNT(*) as count FROM review_table where prod_id='$prod_id '";
                    $result = $con->query($query);
                    
                    if ($result->num_rows > 0) {
                        $row = mysqli_fetch_array($result);
                        $sum = $row['sum'];
                        $count = $row['count'];
                    } else {
                        $sum = 0;
                        $count = 0;
                    }
           
                    if ($count != 0) {
                        // Calculate the average rating
                        $avg_rating = $sum / $count;
                      } else {
                        // Set the average rating to zero if the count is zero
                        $avg_rating = 0;
                      }
                    
                    
                    
                        // Display the stars
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $avg_rating) {
                                echo '<i class="fa fa-star yellow-star"></i>';
                            
                            } else {
                                echo '<i class="fa fa-star-o"></i>';
                            }
                        }

                        $sqlTotalSold = "SELECT prod_id,SUM(quantity) as total_sold FROM trans_record 
                        LEFT JOIN transaction on trans_record.transaction_id = transaction.tid
                        where prod_id='$prod_id' and (status='delivered' or status='completed')";
                        $soldResult = $con->query($sqlTotalSold);
                        $arr = mysqli_fetch_array($soldResult);
                        $total_sold = $arr['total_sold'];



                        if ($total_sold != 0 || $total_sold=null || $total_sold='') {
                            // Calculate the average rating
                            echo  '  '.$total_sold.' Sold' ;
                          } else {
                            // Set the average rating to zero if the count is zero
                        
                          }
                        
                        
                ?>


            </div>
            <div class="card-footer">
            <?php 
                                
                                $sql  = mysqli_query($con, "SELECT production_log.prod_id, sum(production_log.qty_remaining) AS quantity
                                    FROM production_log
                                    LEFT JOIN product ON product.prod_id = production_log.prod_id
                                    WHERE production_log.prod_id='$prod_id' and production_log.status ='ACTIVE' or production_log.status ='LOW'");
                                    $arr = mysqli_fetch_array($sql);
                            
                                if ($arr['quantity'] != 0) { ?>

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

                <?php

            $user = $_SESSION['user_id'];

            $checkifonthelist = " select * from wishlist where prod_id ='$itemid' and user_id = '$user'  ";
            $checkingitem = mysqli_query($con, $checkifonthelist);
            $thecountings = mysqli_num_rows($checkingitem);
            //  $get_id =  mysqli_insert_id($con);
            if ($thecountings >= 1)
            {
            ?>
                <button class="btn btn-light text-danger removewlist" data-productid="<?php echo $row['prod_id'] ?>"
                    style="font-size: 13px;font-weight: bold"><i class="fas fa-heart"></i></button>
                <?php
            }
            else
            {
        ?>
                <button class="btn btn-light text-danger addwishlist" data-productid="<?php echo  $prod_id ?>"
                    style="font-size: 13px;font-weight: bold"><i class="far fa-heart"></i></button>
                <?php
            }

            ?>

            </div>
        </center>
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

<script type="text/javascript">
$(document).ready(function() {
    if ($(window).width() <= 767) {
        $('.cardd').removeClass('col-md-3').addClass('col').addClass('mt-2');


    }


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

    $('.addwishlist').click(function() {
        var productid = $(this).data('productid');

        console.log(productid)

        $.ajax({
            url: "add&remove.php",
            method: "POST",
            data: {
                addwlist: 1,
                productid: productid
            },
            success: function(data) {
                items();
                $.notify("Added to Wishlist", "success");
                countitemwishlist();
            }
        })
    })

    $('.removewlist').click(function() {
        var productid = $(this).data('productid');
        $.ajax({
            url: "add&remove.php",
            method: "POST",
            data: {
                removewlist: 1,
                productid: productid
            },
            success: function(data) {
                items();
                $.notify("Removed from Wishlist", "success");
                countitemwishlist();
            }
        })
    })



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

    $('.openproductview').click(function() {
        var id = $(this).data('id');


        $.ajax({
            url: "contents.php",
            method: "POST",
            data: {
                gettheitemsview: 1,
                id: id
            },
            success: function(data) {
                $('#productsview').html(data);
            }
        })



    })

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
});
</script>
<?php

}

if (isset($_POST['listitems']))
{

    $user = $_SESSION['user_id'];
    $items = " SELECT * FROM `wishlist` where user_id = '$user'  ";
    $gettingitems = mysqli_query($con, $items);
    $count = mysqli_num_rows($gettingitems);
    //  $get_id =  mysqli_insert_id($con);
    if ($count >= 1)
    {

        while ($row = mysqli_fetch_array($gettingitems))
        {
            $product_id = $row['prod_id'];
            $getproduct = " SELECT * FROM `product` where prod_id = '$product_id' ";
            $getting_products = mysqli_query($con, $getproduct);

            while ($item = mysqli_fetch_array($getting_products))
            {
?>

<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php

                $gtproductphotosactive = " select * from photo where prod_id = '$product_id' limit 1  ";
                $result_of_getactive = mysqli_query($con, $gtproductphotosactive);

                while ($rowactive = mysqli_fetch_array($result_of_getactive))
                {
                    $prodactive = $rowactive['p_id'];
                    $src = 'img/products/' . $rowactive['photo'];

?>

                            <div class="carousel-item active">
                                <img src="<?php echo $src ?>" class="d-block w-100" alt="..."
                                    style="width: 100px;height: 250px;">
                            </div>

                            <?php
                }

                if (isset($prodactive))
                {
                    $gtproductphotos = " select * from photo where prod_id = '$product_id' and p_id != '$prodactive'  ";
                    $result_of_get = mysqli_query($con, $gtproductphotos);

                    while ($row = mysqli_fetch_array($result_of_get))
                    {
                        $src = 'img/products/' . $row['photo'];
?>

                            <div class="carousel-item">
                                <img src="<?php echo $src ?>" class="d-block w-100" alt="..."
                                    style="width: 100px;height: 250px;">
                            </div>

                            <?php
                    }

                }
                else
                {
                    echo 'NO PHOTO AVAILABLE';
                }

?>
                        </div>

                    </div>

                </div>

                <div class="col-sm-8">


                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-backdrop="static" data-keyboard="false" style="text-decoration: none">
                        <h5 style="font-weight: bolder;"><?php echo $item['name'] ?></h5>
                    </a>

                    <div class="det" style="font-size: 14px;height: 80px;overflow-y: scroll;">
                        <?php echo $item['description'] ?>
                    </div>
                    <span class="text-secondary mb-2" style="font-size: 16px;font-weight: bolder;">₱
                        <?php echo $item['price'] ?> </span>



                    <button class="btn btn-light text-info addcart"
                        style="font-size: 13px;font-weight: bold;float: right;"
                        data-productid="<?php echo $item['prod_id'] ?>"> Add to Cart <i
                            class="fas fa-cart-plus"></i></button>

                    <button class="btn btn-light text-danger removefromlist "
                        data-productid="<?php echo $item['prod_id'] ?>"
                        style="font-size: 13px;font-weight: bold;float: right; margin-right: 5px;"
                        data-productid="<?php echo $item['prod_id'] ?>"> Remove <i class="fas fa-times"></i></button>
                </div>

            </div>


        </div>

    </div>

</div>


<?php
            }

        }
    }
    else
    {
?>
<div class="container">
    <div style="text-align: center;">
        <img src="assets/img/wishlist.png" class="img-fluid mt-5" style="width: 200px">
        <h6 class="mt-4">Your wishlist is Empty</h6>
    </div>

</div>

<?php
    }

?>
<script type="text/javascript">
$(document).ready(function() {

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
    $('.removefromlist').click(function() {
        var productid = $(this).data('productid');
        $.ajax({
            url: "add&remove.php",
            method: "POST",
            data: {
                removewlist: 1,
                productid: productid
            },
            success: function(data) {

                $.notify("Removed from Wishlist", "success");
                items();
            }
        })
    })

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
<?php
}
?>