<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("location:../log/signin.php");
}
?>
<!DOCTYPE html>
<html>

<?php
include "head.php";
include "../connections/connect.php";


// expense category
$sql = "SELECT * FROM product";
$result = mysqli_query($con, $sql);
$prod_list='';
while($arr = mysqli_fetch_array($result))
{
$prod_list .= '

<option value="'.$arr["prod_id"].'">'.$arr["name"].'</option>';
}


$sql = "SELECT * FROM category";
$result = mysqli_query($con, $sql);
$category_map = array();
$category='';
while($arr = mysqli_fetch_array($result))
{
  $category_map[$arr["category_name"]] = $arr["cat_id"];
  $category .= '<option value="'.$arr["cat_id"].'">'.$arr["category_name"].'</option>';
}

include "modal/product_modal.php";


?>

<style>
.table td {
    font-size: 18px;
}
</style>

<body style="background-color: white">
    <div class="wrapper">


        <nav class="sidenav shadow">
            <?php include "navbar.php"; ?>
        </nav>



        <section class="home-section">

            <br>
            <div class="main_contents">
                <div class="container">

                    <h5 style="font-weight: bolder;">ITEM LIST</h5>
                    <hr>
                    <div class="card shadow-sm" style="">
                        <div class="card-body">


                            <button class="btn btn-warning text-white mb-2" data-bs-toggle="modal"
                                data-bs-target="#newProd" data-backdrop="static" data-keyboard="false"
                                style="font-size: 14px;">Add new <i class="fas fa-plus-circle"></i></button>


                            <div class="table-responsive">
                                <?php $results  = mysqli_query($con, " SELECT * FROM `product` 
                                LEFT JOIN product_quantity ON product_quantity.prod_id =  product.prod_id
                                LEFT JOIN category ON product.cat_id =  category.cat_id
                                LEFT JOIN photo ON product.prod_id =  photo.prod_id"); ?>
                                <table id="product_table" class="table table-hover" style="width:100%;">
                                    <thead class="table-warning">
                                        <tr style='font-size:14px'>
                                            <th hidden> id </th>
                                            <th> Img </th>
                                            <th>Barcode</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Description/Details</th>
                                            <th>Ingredients</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody style='font-size:40px'>
                                        <?php while ($row = mysqli_fetch_array($results)) {
                                            if ($row['ingredients']== ','){
                                                $row['ingredients'] = 'N/A';
                                            } 
                                          
                                            ?>
                                        <tr>
                                            <td hidden><?php echo $row['prod_id']; ?> </td>
                                            <td>
                                                <div class="circle">

                                                    <img src="<?php echo '../img/products/' . $row['photo'] ?>" alt=""
                                                        class="card-img-top" style="width:70px;height: 70px">
                                                </div>
                                            </td>
                                            <td><?php echo $row['barcode']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td><?php echo $row['ingredients']; ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-success text-light editmodal"
                                                        style="font-size: 12px"><i class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-dark text-light btnDelete"
                                                        style="font-size: 12px"><i class="fas fa-trash"></i></button>

                                                </div>

                                            </td>
                                        </tr>

                                        <?php } ?>
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="footer shadow">

            </div>
        </section>

    </div>
</body>




</html>

<script type="text/javascript">
$(document).ready(function() {
    $('#product_table').DataTable();

    var max_fields = 10;
    var wrapper = $(".input_fields_wrap");
    var add_button = $(".add_field_button");
    var remove_button = $(".remove_field_button");

    $(add_button).click(function(e) {
        e.preventDefault();
        var total_fields = wrapper[0].childNodes.length;
        if (total_fields < max_fields) {
            $(wrapper).append(
                '<br><input type="text" name="ingredients[]" placeholder="Ingredient" class="form-control field-long" />'
            );
        }
    });
    $(remove_button).click(function(e) {
        e.preventDefault();
        var total_fields = wrapper[0].childNodes.length;
        if (total_fields > 1) {
            wrapper[0].childNodes[total_fields - 1].remove();
        }
    });



});
</script>

<script type="text/javascript" src="../js/sidebar.js?v=1"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../js/datatable/datatables.js"></script>
<link rel="stylesheet" type="text/css" href="../js/datatable/datatables.css">
<!--Bootstrap Plugins-->
<script type="text/javascript" src="../js/notify.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    $('#addphotos').on('submit', function(event) {
        event.preventDefault();
        var $fileUpload = $("#filess");


        if (parseInt($fileUpload.get(0).files.length) > 3) {
            $('#imgsad').addClass('text-danger');
        } else {
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",

                success: function(data) {
                    alert(data);
                }
            })
        }


    });


    updateList = function() {
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');


        for (var i = 0; i < input.files.length; ++i) {
            output.innerHTML +=
                '<div class="card mb-1 " style="border-left:4px solid #5a7c7d"><div class="card-body">' +
                input.files.item(i).name + '</div></div>';
        }


    }

    updateListUpdate = function() {
        var input = document.getElementById('fileUpdate');
        var output = document.getElementById('fileListUpdate');


        for (var i = 0; i < input.files.length; ++i) {
            output.innerHTML +=
                '<div class="card mb-1 " style="border-left:4px solid #5a7c7d"><div class="card-body">' +
                input.files.item(i).name + '</div></div>';
        }


    }


    removeList = function() {
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');

        output.innerHTML =
            '';

    }



    $('#product_table').on('click', '.editmodal', function() {


        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        
        $('#prod_id_update').val(data[0]);
        $('#edit_barcode').val(data[2]);
        $('#edit_name').val(data[3]);
        $('#edit_cat').val(data[4]).change();
        // Get the select element
        $('#prodUpdate').modal('show');


        $('#edit_desc').val(data[5]);
        // $('#whole_price').val(data[5]);
    });


    $('#product_table').on('click', '.btnDelete', function() {


        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#prodDelete').modal('show');
        $('#del_id').val(data[0].replace(/\s/g, ''));

        // Get the select element

        // $('#whole_price').val(data[5]);
    });
});
</script>

<?php if (isset($_SESSION['existing'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        icon: 'info',
        title: 'Product Already Exist!',
        text: 'Input new product',
    })
    </script>
    <?php 
			unset($_SESSION['existing']);
		?>
</div>
<?php endif ?>