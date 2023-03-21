<?php

include 'connections/connect.php';




if(isset($_GET["search"]))  
{  
     $search = $_GET["search"];  
     $checked = filter_var($_GET['search']) ;
     $char = preg_replace('#[^a-z]#i', '', $checked);  
     $query = "SELECT *
     FROM `product`
     LEFT JOIN photo ON product.prod_id = photo.prod_id
     LEFT JOIN category ON product.cat_id = category.cat_id
     WHERE category_name LIKE '%$char%'"; 
}  
else  
{  
    $query = " SELECT * FROM `product`
    LEFT JOIN category on product.cat_id = category.cat_id
    LEFT JOIN photo on product.prod_id = photo.prod_id  WHERE  price !='' or cost !=''   ";
}  
$sorting_items = mysqli_query($con, $query);



?>
<style>
.cardd {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.card {
    width: 100%;
    height: 100%;

}

.circle {
    border-radius: 50%;
    overflow: hidden;
    width: 150px;
    height: 150px;
    margin: 0 auto;
}

@media (max-width: 767px) {
    .circle {
        width: 100px;
        height: 100px;
    }
}
</style>

<div class="row mt-3">
    <center>
        <div class="wrapper">
            <div id="search-container">

            </div>
            <div id="buttons">
                <a href='category.php'
                    class="button-value  <?php if ($checked == '') { echo 'active'; } else { echo ''; } ?>"
                    style='text-decoration:none;font-weight:bold;color:#FDC96F;'>All</a>
                <a href='category.php?search=Bread' class="button-value
                            <?php if ($checked == 'Bread') { echo 'active'; } else { echo ''; } ?>"
                    style='text-decoration:none;font-weight:bold;color:#FDC96F;'>
                    Breads
                </a>
                <a href='category.php?search=Biscuit'
                    class="button-value  <?php if ($checked == 'Biscuit') { echo 'active'; } else { echo ''; } ?>"
                    style='text-decoration:none;font-weight:bold;color:#FDC96F;'>
                    Biscuits
                </a>

                <a href='category.php?search=Cake'
                    class="button-value  <?php if ($checked == 'Cake') { echo 'active'; } else { echo ''; } ?>"
                    style='text-decoration:none;font-weight:bold;color:#FDC96F;'>
                    Cakes
                </a>
                <a href='category.php?search=Others'
                    class="button-value   <?php if ($checked == 'Others') { echo 'active'; } else { echo ''; } ?>"
                    style='text-decoration:none;font-weight:bold;color:#FDC96F;'>
                    Others
                </a>
            </div>

        </div>
        <br>
        <hr>
    </center>

    <?php
         if(mysqli_num_rows($sorting_items) > 0)  
        {
           
            while ($row = mysqli_fetch_array($sorting_items))
            {
                // // echo '<h4 class="mb-3" style="font-weight: bolder;text-shadow: 2px 2px #a8b6c5;">' . $row['category_name'] . ' </h4>  ';
                // $itemid = $row['prod_id'];

?>

    <!--Items-->

    <div class="col-md-3 cardd">

        <div class="card w-100 dd" style="height:100%">


            <center>
                <div class="circle">
                    <img src="<?php echo 'img/products/' . $row['photo'] ?>" alt="" class="card-img-top"
                        style="width:150px;height: 150px">
                </div>
            </center>


            <div class="card-body" style="text-align: center;">
                <a href="product_details.php?prod=<?php echo $row['prod_id'] ?>" style="text-decoration: none"> <span
                        style="text-align: center;font-weight: bold"><?php echo $row['name'] ?></span> </a><br>
                <span class="card-text" style="text-align: left;"><?php echo $row['description'] ?>

                </span><br>
                <span class="text-secondary" style="font-size: 20px;font-weight: bolder;">₱
                    <?php echo $row['price'] ?>
                </span> <br>
                <p></p>
                <?php 
                    $prod_id = $row['prod_id'];
                    $query = "SELECT SUM(user_rating) as sum, COUNT(*) as count FROM review_table where prod_id='$prod_id '";
                    $sqlRes = $con->query($query);
                    
                    if ($sqlRes->num_rows > 0) {
                        $row_n = mysqli_fetch_array($sqlRes);
                        $sum = $row_n['sum'];
                        $count = $row_n['count'];
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
                        where prod_id='$prod_id' and status='delivered' or status='completed'";
                        $soldResult = $con->query($sqlTotalSold);
                        $arr = mysqli_fetch_array($soldResult);
                        $total_sold = $arr['total_sold'];
                   
                        if ($total_sold != 0 || $total_sold=null || $total_sold='') {
                            // Calculate the average rating
                            echo  '  '.$total_sold.' Sold' ;
                          } else {
                            echo  '' ;
                        
                          }

                ?>

            </div>
            <div class="card-footer">
                <center>

                    <?php 
        
                       $sql  = mysqli_query($con, "SELECT production_log.prod_id, sum(production_log.qty_remaining) AS quantity
                           FROM production_log
                           LEFT JOIN product ON product.prod_id = production_log.prod_id
                           WHERE production_log.prod_id='$prod_id' and production_log.status ='ACTIVE' or production_log.status ='LOW'");
                           $arr = mysqli_fetch_array($sql);
                    
                           if ($arr['quantity'] != 0) { ?>

                    <button class="btn btn-warning text-dark addcart" style="font-size: 13px;font-weight: bold;"
                        data-productid="<?php echo $row['prod_id'] ?>"> Add to Cart <i
                            class="fas fa-cart-plus"></i></button>


                    <?php 
                         }else{
                     ?>
                    <div class="btn btn-danger text-white" style="font-size: 13px;font-weight: bold; cursor: text;">
                        SOLD OUT </div>

                    <?php } ?>



                    <a href="product_details.php?prod=<?php echo $row['prod_id'] ?>" class="btn btn-dark "
                        style="font-size: 13px;font-weight: bold;"> View Product <i class="fas fa-eye"></i></a>

                </center>




            </div>

        </div>


    </div>

    <?php
    
        }
            
                }
                else
                {
                    echo '<h4 class="mb-3 text-center" style="font-weight: bolder;text-shadow: 2px 2px #a8b6c5;">Product not Found </h4>  ';
                    
                }
        
        ?>


</div>

<!---->


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

$('.addwishlist').click(function() {


    var productid = $(this).data('productid');

    $.ajax({
        url: "add&remove.php",
        method: "POST",
        data: {
            addwlist: 1,
            productid: productid
        },
        success: function(data) {
            getallitems();
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
            getallitems();
            $.notify("Removed from Wishlist", "success");
            countitemwishlist();
        }
    })
})





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

function getallitems() {


    $.ajax({
        url: "categories.php",
        method: "POST",
        data: {
            getAllitems: 1
        },
        success: function(data) {
            $('#sorted_by_categories').html(data);
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
</script>