<?php include 'head.php';

include "../connections/connect.php";

if (isset($_GET['trans'])) {
    $trans_id = $_GET['trans'];
}

$sql  = mysqli_query($con, "SELECT *  from transaction
left join distributor_details on transaction.dis_id = distributor_details.dis_id where tid='$trans_id'");
$arr_dis = mysqli_fetch_array($sql);
$distributor_name = $arr_dis['distributor_name'];


$sql = "SELECT * FROM transaction where tid='$trans_id'";
$result = mysqli_query($con, $sql);
$arr = mysqli_fetch_array($result);
$trans_code = $arr['trans_code'];



 ?>


</head>
<link rel="stylesheet" href="css/walkin.css">
<link rel="stylesheet" type="text/css" href="../js/datatable/datatables.css">



<body>

    <header> <br>
        <h3>Mannafest Food Inc. </h3>

    </header>

    <main>
        <div class="container-p">
            <div class="flex-2-p">
                <span class=" bg-warning">
                    <h4>Trans Code : #<?php echo  $trans_code  ?></h4>

                    <h4>Distributor : <?php echo  $arr_dis['distributor_name'] ?></h4>
                </span>
                <hr>
                <div class="table-box-p">
                    <div id="live_data"></div>
                </div>

                <!-- END OF TABLE FLEX 2 -->

            </div>
            <div class="flex-1-p">

                <div class="bar-total">

                    Total Amount <input type="text" id="total_amount" class='form-control total_amount' readonly>
                    <br>
                </div>


                <div class="bar-top">
                    <br>
                    <div class="dtable">
                        <?php   $listProd = mysqli_query($con, "SELECT * from product");?>


                        <table id="table-prods" class="table">
                            <thead class="table-dark" style='font-size:12px'>
                                <tr>
                                    <th hidden>id</th>
                                    <th>Barcode</th>
                                    <th>Product </th>
                                    <th>Inventory</th>
                                    <th hidden> Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($listProd)) { 
                                   $prod_id =$row['prod_id'];
                                   $sql  = mysqli_query($con, "SELECT production_log.prod_id, sum(production_log.qty_remaining) AS quantity
                                       FROM production_log
                                       LEFT JOIN product ON product.prod_id = production_log.prod_id
                                       WHERE production_log.prod_id='$prod_id' and production_log.status ='ACTIVE' or production_log.status ='LOW'");
                                       $arr = mysqli_fetch_array($sql);
                                    
                                    
                                    ?>
                                <tr>
                                    <td hidden><?php echo $row['prod_id']?></td>
                                    <td><?php echo $row['barcode']?></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo empty($arr['quantity']) ? 0 : $arr['quantity'];?></td>
                                    <td hidden> ₱ <?php echo ($row['price']); ?></td>
                                    <td><button type="button" id='btnAdd' class='btnAdd'><i
                                                class="fa fa-plus-circle"></i></button>
                                    </td>
                                </tr>


                                <?php } ?>

                            </tbody>
                        </table>

                    </div>

                </div>
                <div class="menu-bar">

                    <div class="bar-4 btnConfirm">
                        <b>[ F5 ] <br> Confirm Transfer</b>
                    </div>
                    <div class="bar-3 btnVoid" data-bs-toggle="modal" data-bs-target="#staticVoid">
                        <b>[ F2 ] <br> VOID</b>
                    </div>

                </div>
            </div>
        </div>
    </main>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../js/datatable/datatables.js"></script>

<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>

</html>
<?php include('modal/distributor_modal.php')?>


<script>
function fetch_data() {

    $.ajax({
        url: "table/walkin_table.php",
        method: "POST",
        data: {
            trans_id: '<?php echo $trans_id ?>',

        },
        success: function(data) {
            $('#live_data').html(data);
        }
    });
}

fetch_data();


$(document).ready(function() {

    table = $('#table-prods').DataTable({
        dom: 'frtip',

    });





    $('#addProd').submit(function() {
        return false;
    });


    $('#addBtn').click(function() {
        $("#productAdd").modal("hide");
        $.post($('#addProd').attr('action'), $('#addProd :input').serializeArray(),
            function(result) {
                console.log(result);
                let nf = new Intl.NumberFormat('en-US');
                $('#total_amount').val('₱ ' + nf.format(result));
                fetch_data();
            });

    });


    $('#table-prods').on('click', '.btnAdd', function() {

        $('#productAdd').modal('show');
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        $('#product_id').val(data[0]);
        $('#barcode').val(data[1]);
        $('#p_name').val(data[2]);

        $('#p_price').val(data[4].replace(/[^0-9.]/g, ""));
    });



    $('.btnConfirm').on('click', function() {

        function fetch_data() {

            var trans_id = <?php echo $trans_id ?>;
            $.ajax({
                url: "table/confirm_walkin.php",
                method: "POST",
                data: {
                    trans_id: '<?php echo $trans_id ?>',

                },
                success: function(data) {
                    $('#confirm_table').html(data);
                }
            });
        }
        fetch_data();

        var trans_id = <?php echo $trans_id ?>;
        $('#c_total_amount').val($('#total_amount').val())
        $('#c_walkin_id').val(trans_id)
        $('#confirmModal').modal('show');


    });


    $('.btnVoid').on('click', function() {

        $('#voidTransfer').modal('show');


    });



});
</script>