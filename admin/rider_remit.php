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



?>
<link rel='stylesheet' href='css/dataTables.dateTime.min.css'>

<style>
.table td {
    font-size: 18px;
}
</style>


<body style="background-color: white">
    <div class="wrapper">


        <nav class="sidenav shadow">
            <?php include "navbar.php"; 
            
            $res  = mysqli_query($con, "SELECT * from accounts where user_type='courier'"); 
            $courierList='';
            while($arr = mysqli_fetch_array($res))
            {
            $courierList .= '

            <option value="'.$arr["name"].' '.$arr["lastname"].'">'.$arr["name"].' '.$arr["lastname"].'</option>';
            }
            
            ?>
        </nav>



        <section class="home-section">

            <br>
            <div class="main_contents">
                <div class="container">

                    <h5 style="font-weight: bolder;">RIDER REMIT RECORDS</h5>
                    <hr>
                    <div class="card shadow-sm" style="">
                        <div class="card-body">
                            <div class="row">
                                <h6>Filter</h6>
                                <div class="col-sm-3">
                                    <select class='form-select' id='filter_rider'>
                                        <option disabled="disabled" value='' selected="selected">Select Rider
                                        </option>
                                        <option value=''>All</option>
                                        <?php echo  $courierList ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="min" name="min" class="form-control"
                                        placeholder="From Date" />
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="max" name="max" class="form-control" placeholder="To Date" />

                                </div>
                            </div>
                            <hr>




                            <div class="table-responsive">
                                <?php $results  = mysqli_query($con, " SELECT * FROM `courier_trans`
                                    LEFT JOIN accounts on courier_trans.user_id =accounts.user_id  "); ?>
                                <table id="remit_table" class="table table-hover" style="width:100%;">
                                    <thead class="table-warning">
                                        <tr style='font-size:14px'>

                                            <th>Date</th>
                                            <th>Rider Name</th>
                                            <th>Total Amount</th>
                                            <th>Total Cash Remit</th>
                                            <th>Cash Onhand</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody style='font-size:20px;font-weight:bold'>
                                        <?php while ($row = mysqli_fetch_array($results)) {
                                                    ?>
                                        <tr>

                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['name'].' '.$row['lastname']; ?></td>

                                            <td>₱ <?php echo $row['total_amount'] ?></td>
                                            <td>₱ <?php echo $row['total_remit']; ?></td>
                                            <td>₱ <?php echo $row['total_cash_onhand']; ?></td>
                                           
                                        </tr>

                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    
                                    </tfoot>
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








<!-- Modal View-->
<div class="modal fade" id="viewSalesDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="receivingViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receivingViewLabel">SALE RECORD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm">
                        <label> Transactio ID </label> <br>
                        <input id='s_trans_id' class='form-control' style='font-size:20px;border: none;font-weight:bold'
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


                <hr>
                <div id='view_sales_rec'> </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return</button>
            </div>

        </div>
    </div>
</div>
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


<script>
$('.viewTransRecord').on('click', function() {

    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#s_trans_id').val(data[0]);
    $('#s_date').val(data[1]);
    $('#s_trans_type').val(data[3]);

    function fetch_table() {

        var trans_id = (data[0]);
        $.ajax({
            url: "table/sales_record_table.php",
            method: "POST",
            data: {
                trans_id: trans_id,

            },
            success: function(data) {
                $('#view_sales_rec').html(data);
            }
        });
    }
    fetch_table();
    $('#viewSalesDetails').modal('show');


});







var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[0]);

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


minDate = new DateTime($('#min'), {
    format: "YYYY-MM-DD"
});
maxDate = new DateTime($('#max'), {
    format: "YYYY-MM-DD"
});





remit_table = $('#remit_table').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'excel', 'pdf', 'print'
    ],
   
});

$('#min, #max').on('change', function() {
    remit_table.draw();
});
$('#filter_rider').on('change', function() {
    var tosearch = '' + this.value + '';
    remit_table.search(tosearch).draw();
});

</script>