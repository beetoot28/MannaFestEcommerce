<?php

include 'connections/connect.php';




if(isset($_GET["search"]))  
{  
     $search = $_GET["search"];  
     $checked = filter_var($_GET['search']) ;
    //  $char = preg_replace('#[^a-z]#i', '', $char);  
     $query = "SELECT * FROM `product` 
     LEFT JOIN photo on product.prod_id = photo.prod_id
     LEFT JOIN category on product.cat_id = category.cat_id WHERE
      name LIKE '%$search%' or  category_name LIKE '%$search%'"; 
}  
else  
{  
    $query = " SELECT * FROM `product`
    LEFT JOIN category on product.cat_id = category.cat_id
    LEFT JOIN photo on product.prod_id = photo.prod_id ";
}  
$sorting_items = mysqli_query($con, $query);



?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="row mt-4">
    <center>
        <div class="wrapper">
            <div id="search-container">

            </div>
            <div id="buttons">
                <a href='category.php'
                    class="button-value  <?php if ($checked == '') { echo 'active'; } else { echo ''; } ?>"
                    style='text-decoration:none;font-weight:bold;color:#FDC96F;'>All</a>
                <a href='category.php?search=Breads' class="button-value
                            <?php if ($checked == 'Breads') { echo 'active'; } else { echo ''; } ?>"
                    style='text-decoration:none;font-weight:bold;color:#FDC96F;'>
                    Breads
                </a>
                <a href='category.php?search=biscuits'
                    class="button-value  <?php if ($checked == 'biscuits') { echo 'active'; } else { echo ''; } ?>"
                    style='text-decoration:none;font-weight:bold;color:#FDC96F;'>
                    Biscuits
                </a>
                <a href='category.php?search=Cakes'
                    class="button-value  <?php if ($checked == 'Cakes') { echo 'active'; } else { echo ''; } ?>"
                    style='text-decoration:none;font-weight:bold;color:#FDC96F;'>
                    Cakes
                </a>
                <a href='category.php?search=others'
                    class="button-value   <?php if ($checked == 'others') { echo 'active'; } else { echo ''; } ?>"
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
           
                    // Calculate the average rating
                    $avg_rating = $sum / $count;
                    
                    
                    
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
                echo  '  '.$total_sold.' Sold' ;
                ?>

            </div>
            <div class="card-footer">
                <center>
                    <a href="product_details.php?prod=<?php echo $row['prod_id'] ?>" class="btn btn-dark "
                        style="font-size: 13px;font-weight: bold;"> View Product <i class="fas fa-eye"></i></a>
                    <button class="btn btn-warning text-dark addcart" style="font-size: 13px;font-weight: bold;"
                        data-productid="<?php echo $row['prod_id'] ?>"> Add to Cart <i
                            class="fas fa-cart-plus"></i></button>
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