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

include "modal/distributor_modal.php";


?>

<style>
.table td {
    font-size: 18px;
}

/* modal backdrop fix */
.modal:nth-of-type(even) {
    z-index: 1052 !important;
}

.modal-backdrop.show:nth-of-type(even) {
    z-index: 1051 !important;
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

                    <h5 style="font-weight: bolder;">DISTRIBUTOR TRANSACTION RECORD</h5>
                    <hr>
                    <div class="card shadow-sm" style="">
                        <div class="card-body">


                            <button class="btn btn-dark text-white mb-2" data-bs-toggle="modal"
                                data-bs-target="#createTransaction" data-backdrop="static" data-keyboard="false"
                                style="font-size: 14px;">NEW TRANSACTION <i class="fas fa-plus-circle"></i></button>
                            <button class="btn btn-warning text-white mb-2" data-bs-toggle="modal"
                                data-bs-target="#distributorList" data-backdrop="static" data-keyboard="false"
                                style="font-size: 14px;">DISTRIBUTOR LIST <i class="fas fa-plus-circle"></i></button>


                            <div class="table-responsive">
                                <?php $results  = mysqli_query($con, "SELECT *,transaction.status as stat , sum(trans_record.total) as total_amount FROM `transaction` 
                                LEFT JOIN accounts ON transaction.user_id = accounts.user_id LEFT JOIN trans_record ON transaction.tid = trans_record.transaction_id 
                                WHERE transaction.type='distributor' group by tid"); ?>
                                <table id="product_table" class="table table-hover" style="width:100%;">
                                    <thead class="table-warning">
                                        <tr style='font-size:14px'>

                                            <th hidden> Transaction ID </th>
                                            <th>Transaction Code </th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th hidden></th>

                                        </tr>
                                    </thead>
                                    <tbody style='font-size:40px'>
                                        <?php while ($row = mysqli_fetch_array($results)) {
                                 
                                            ?>
                                        <tr>
                                            <td hidden><?php echo $row['tid']; ?> </td>
                                            <td><?php echo $row['trans_code']; ?></td>
                                            <td><?php echo $row['datecreated']; ?></td>
                                            <td>₱ <?php echo number_format($row['total_amount'],2)?></td>
                                            <td><?php echo $row['stat']; ?></td>

                                            <td>

                                                <button type="button" class="btn btn-success text-light viewTransRecord"
                                                    id='viewTransRecord' style="font-size: 12px"><i
                                                        class="fas fa-book"></i></button>



                                            </td>
                                            <td hidden>₱ <?php echo number_format($row['total_purchased'],2)?></td>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" type="text/css" href="../js/datatable/datatables.css">
<!--Bootstrap Plugins-->
<script type="text/javascript" src="../js/notify.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
<script type="text/javascript" src="js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>




</html>




<!-- Modal View-->
<div class="modal fade" id="viewSalesDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="receivingViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receivingViewLabel">DISTRIBUTOR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm" hidden>
                        <label> Transactio ID </label> <br>
                        <input id='s_trans_id' class='form-control' style='font-size:20px;border: none;font-weight:bold'
                            readonly>
                    </div>
                    <div class="col-sm">
                        <label> Transactio Code </label> <br>
                        <input id='s_trans_code' class='form-control' style='font-size:20px;border: none;font-weight:bold'
                            readonly>
                    </div>
                    <div class="col-sm">
                        <label> Date :</label> <br>
                        <input id='s_date' class='form-control' style='font-size:20px;border: none;font-weight:bold'
                            readonly>
                    </div>
                    <div class="col-sm">
                        <label>Transaction Type</label> <br>
                        <input id='s_trans_type' name='voucher' class='form-control'
                            style='font-size:20px;border: none;font-weight:bold' readonly>
                    </div>
                </div>
                <br> <br>
                <div class="row">
                    <div class="col-sm">
                        <label>Total Purchased</label> <br>
                        <input id='total_purchased' name='voucher' class='form-control'
                            style='font-size:20px;border: none;font-weight:bold' readonly>
                    </div>
                    <div class="col-sm">
                        <label>Discount :</label> <br>
                        <input id='discount' class='form-control'
                            style='font-size:20px;border: none;font-weight:bold' value='N/A'readonly>
                    </div>

                    <div class="col-sm">
                        <label> Net Total:</label> <br>
                        <input id='netotal' class='form-control' style='font-size:20px;border: none;font-weight:bold'
                            readonly>
                    </div>
                </div>


                <hr>
                <div id='view_sales_rec'> </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return</button>
            </div>

        </div>
    </div>
</div>


<script>
$('.viewTransRecord').on('click', function() {

    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#s_trans_id').val(data[0]);
    $('#s_trans_code').val(data[1]);
    $('#s_date').val(data[2]);
    $('#s_trans_type').val(data[4]);
    $('#total_purchased').val(data[3]);
    $('#netotal').val(data[3]);
     
    function fetch_table() {

        var trans_id = (data[0]);
        var trans_code = (data[1]);
        $.ajax({
            url: "table/sales_record_table.php",
            method: "POST",
            data: {
                trans_id: trans_id,
                trans_code: trans_code
            },
            success: function(data) {
                $('#view_sales_rec').html(data);
            }
        });
    }
    fetch_table();
    $('#viewSalesDetails').modal('show');


});
</script>
<script>
$('.btnEdit').on('click', function() {
    $('.modal-backdrop').remove();
    document.getElementById("distributorList").style.display = "none";
    $('#distriEdit').modal('show');

    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $('#u_id').val(data[0]);
    $('#u_name').val(data[1]);
    $('#u_contact').val(data[2]);
    $('#u_address').val(data[3]);


});




$('.btnDeleteDistri').on('click', function() {
    $('#distriDelete').modal('show');
    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    $('#d_id').val(data[0]);


});
</script>