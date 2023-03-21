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

date_default_timezone_set("Asia/Manila");




?>

<link rel='stylesheet' href='css/dataTables.dateTime.min.css'>
<style>
.badge {
    /* Set the background color and border */
    background-color: #FDC96F;
    border-radius: 10px;
    border: 1px solid #6c757d;

    /* Set the font size and color */
    font-size: 15px;
    color: black;

    /* Add some padding and alignment */
    padding: 5px 10px;
    text-align: center;
}

.badge_1 {
    /* Set the background color and border */
    background-color: #19B854;
    border-radius: 10px;
    border: 1px solid #6c757d;

    /* Set the font size and color */
    font-size: 15px;
    color: white;
    font-weight: bold;

    /* Add some padding and alignment */

    text-align: center;
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

                    <h5 style="font-weight: bolder;">STOCK IN</h5>
                    <hr>
                    <div class="card shadow-sm" style="">
                        <div class="card-body">


                            <button class="btn btn-warning text-white mb-2" data-bs-toggle="modal"
                                data-bs-target="#newProduction" data-backdrop="static" data-keyboard="false"
                                style="font-size: 14px;">Add new <i class="fas fa-plus-circle"></i></button>

                            <button class="btn btn-danger text-white mb-2" data-bs-toggle="modal"
                                data-bs-target="#expiredModal" data-backdrop="static" data-keyboard="false"
                                style="font-size: 14px;">Expired Items </button>

                            <div class="table-responsive">
                                <?php $results  = mysqli_query($con, " SELECT * FROM `product` 
                                LEFT JOIN category ON product.cat_id =  category.cat_id
                                LEFT JOIN photo ON product.prod_id =  photo.prod_id"); ?>
                                <table id="production_table" class="table table-hover" style="width:100%;">
                                    <thead class="table-warning">
                                        <tr style='font-size:14px'>
                                            <th hidden>prod_id</th>
                                            <th>Barcode</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Cost</th>
                                            <th>Price</th>
                                            <th>Total Stock</th>

                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody style='font-size:40px'>
                                        <?php while ($row = mysqli_fetch_array($results)) {
                                            if ($row['ingredients']== ','){
                                                $row['ingredients'] = 'N/A';
                                            } 

                                            $prod_id =$row['prod_id'];
                                            $sql  = mysqli_query($con, "SELECT production_log.prod_id, sum(production_log.qty_remaining) AS quantity
                                                FROM production_log
                                                LEFT JOIN product ON product.prod_id = production_log.prod_id
                                                WHERE production_log.prod_id='$prod_id' and production_log.status ='ACTIVE' or production_log.status ='LOW'");
                                                $arr = mysqli_fetch_array($sql);
                                            ?>
                                        <tr>
                                            <td hidden><?php echo $row['prod_id']; ?></td>
                                            <td><?php echo $row['barcode']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <td><?php echo $row['cost']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td>
                                                <div class='badge'>
                                                    <?php echo  (empty($arr['quantity'])) ? "0" : $arr['quantity']; ?>
                                                </div>
                                            </td>

                                            <td>

                                                <button type="button"
                                                    class="btn btn-success btn-sm text-light btnViewProd"
                                                    style="font-size: 12px"><i class="fas fa-eye"></i></button>


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

    <script src="https://unpkg.com/jquery-tabledit@1.0.0/jquery.tabledit.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="../js/datatable/datatables.css">
    <!--Bootstrap Plugins-->

    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/popper.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
    <script type="text/javascript" src="js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" src="js/moment.min.js"></script>

</body>

<?php 
include "modal/production_modal.php";

?>

</html>
<script>
var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[4]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    }
);


minDate = new DateTime($('#date_min'), {
    format: "YYYY-MM-DD"
});
maxDate = new DateTime($('#date_max'), {
    format: "YYYY-MM-DD"
});





expired_table_list = $('#expired_table_list').DataTable({
    dom: 'Bfrtip',
    buttons: [{
            extend: 'excel',
            title: 'List of Expired Products'
        },
        {
            extend: 'pdf',
            title: 'List of Expired Products'
        },
        {
            extend: 'print',
            title: 'List of Expired Products'
        },
    ],

});

$('#date_min, #date_max').on('change', function() {
    expired_table_list.draw();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    const options = {
        timeZone: 'Asia/Manila'
    };






    $('#production_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
    });


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


    removeList = function() {
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');

        output.innerHTML =
            '';

    }

    $('#production_table').on('click', '.btnViewProd', function() {
        console.log('hello')

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#viewProductionDetails').modal('show');
        $('#p_name').val(data[2]);
        $('#p_category').val(data[3]);
        $('#p_cost').val(data[4]);
        $('#p_price').val(data[5]);

        function fetch_table() {
            var prod_id = data[0].replace(/\s/g, '');
            $.ajax({
                url: "table/production_details.php",
                method: "POST",
                data: {
                    prod_id: prod_id,

                },
                success: function(data) {
                    $('#view_prod_history').html(data);
                }
            });
        }
        fetch_table();
    });

    // $('.btnViewProd').on('click', function() {
    //     console.log('hello')


    // });


    $("#prod_select").on("change", function() {
        var prod_id = $(this).val();

        console.log(prod_id)
        $.ajax({
            url: "fetch/fetch_cost_price.php",
            method: "POST",
            data: {
                prod_id: prod_id,
            },
            success: function(response) {
                // Parse the response as a JSON object
                var myObj = JSON.parse(response);

                // Check if the response contains an error
                if (myObj.error) {
                    // If the response contains an error, log the error message
                    console.error(myObj.error);
                } else {
                    // If the response does not contain an error, log the cost and price values
                    // console.log(myObj.cost);
                    // console.log(myObj.price);
                    $('#cost').val(myObj.cost);
                    $('#price').val(myObj.price);
                }
            }
        });
    });



});
</script>

<script>
// var current_date = new Date();

// // Set the time of day to run the code (e.g. midnight)
// var run_time = new Date(current_date.getFullYear(), current_date.getMonth(), current_date.getDate(), 0, 0, 0);

// // Check if it is after the specified time of day
// if (current_date > run_time) {
//     // Run the code
//     console.log('first code run');

//     $.ajax({
//         type: "POST",
//         url: "fetch/check_expiration.php",

//         success: function(data) {
//             console.log(data)
//         }
//     });
//     // Set the flag to prevent the code from running again
//     var code_ran = true;
// }

// // Check if the code has already run
// if (!code_ran) {
//     // Run the code
//     console.log('first code again');
//     // Set the flag to prevent the code from running again
//     var code_ran = true;
// }
</script>