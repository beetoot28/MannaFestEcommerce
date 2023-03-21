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

                    <h5 style="font-weight: bolder;">RETURN REQUEST</h5>
                    <hr>
                    <div class="card shadow-sm" style="">
                        <div class="card-body">


                            <button class="btn btn-dark text-white mb-2" data-bs-toggle="modal"
                                data-bs-target="#returnRequest" data-backdrop="static" data-keyboard="false"
                                style="font-size: 20px;">NEW RETURN <i class="fas fa-undo"></i></button>



                            <div class="table">
                                <?php $results  = mysqli_query($con, " SELECT *,return_request.status as return_status FROM `return_request` 
                                LEFT JOIN accounts ON return_request.user_id =  accounts.user_id
                                where type='admin'"); ?>
                                <table id="returned_table" class="table table-hover" style="width:100%;">
                                    <thead class="table-warning">
                                        <tr>

                                            <th> Return ID </th>
                                            <th>Transaction Code</th>
                                            <th>Customer</th>
                                         
                                            <th>Order Date</th>
                                            <th>Reason</th>
                                            <th>Total Return Amount</th>

                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) {
                                        $return_id =$row['return_id'];
                                       $res=   mysqli_query($con, " SELECT sum(total) as total_return FROM `return_product` 
                                           where return_id='$return_id'");
                                          $arr = mysqli_fetch_array($res)
                                            ?>
                                        <tr>


                                            <td><?php echo $row['return_id']; ?></td>
                                            <td><?php echo $row['trans_code']; ?></td>
                                            <td><?php echo $row['name'].' '.$row['lastname']; ?> </td>
                                           
                                            <td><?php echo $row['date_ordered']; ?></td>
                                            <td><?php echo $row['reason']; ?></td>
                                            <td>₱ <?php echo number_format($arr["total_return"],2) ?></td>

                                            <td>

                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button"
                                                        data-return_id='<?php echo $row['return_id'];?>'
                                                        data-trans_id='<?php echo $row['transaction_id'];?>'
                                                        data-reason='<?php echo $row['reason'];?>'
                                                        data-selected='<?php echo $row['selected_prod'];?>'
                                                        data-proof='<?php echo $row['proof_img'];?>'
                                                        data-date='<?php echo $row['date_ordered'];?>'
                                                        data-remarks='<?php echo $row['remarks'];?>'
                                                        class="btn btn-success text-light btnViewReturn"
                                                        style="font-size: 12px"><i class="fas fa-eye"></i></button>
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







<div class="modal fade" id="returnRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Return Request</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='POST' action='functions/return_module.php' enctype="multipart/form-data">

                    <center>
                        <div class="row">
                            <div class="col-md-6">
                                <input name="user_id" id="user_id" value='' hidden>
                                <input name="trans_id" id="trans_id" value='' hidden>
                                <input id='trans_code' class='form-control'   name="trans_code"
                                    style='font-size:25px;border: 2 solid black;font-weight:bold;text-align:center'
                                    placeholder="Enter Transaction Code">
                                <label> Transaction Code </label>

                            </div>
                            <div class="col-md-3">
                                <button type="button" onclick="clickCheck()" id='checkTrans'
                                    class="btn btn-primary checkTrans">
                                    <i class="fas fa-magnifying-glass "></i> Check Transaction</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id='btnListTrans' class="btn btn-secondary btnListTrans">
                                    <i class="fas fa-magnifying-glass "></i> List Trans</button>
                            </div>
                        </div>
                    </center>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-sm">
                            <label> Customer </label> <br>
                            <input id='customer_name' class='form-control'
                                style='font-size:20px;border: none;font-weight:bold' readonly>
                        </div>
                        <div class="col-sm">
                            <label> Transaction Date :</label> <br>
                            <input id='trans_date' name='trans_date' class='form-control'
                                style='font-size:20px;border: none;font-weight:bold' readonly required>
                        </div>
                        <div class="col-sm">
                            <label>Transaction Type</label> <br>
                            <input id='trans_type' name='voucher' class='form-control'
                                style='font-size:20px;border: none;font-weight:bold' readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm">
                            <label> Sub Total </label> <br>
                            <input id='total_purchased' class='form-control'
                                style='font-size:20px;border: none;font-weight:bold' readonly>
                        </div>
                        <div class="col-sm">
                            <label> Discount :</label> <br>
                            <input id='discount' class='form-control'
                                style='font-size:20px;border: none;font-weight:bold' readonly>
                        </div>
                        <div class="col-sm">
                            <label>Total Amount</label> <br>
                            <input id='total_amount' name='voucher' class='form-control'
                                style='font-size:20px;border: none;font-weight:bold' readonly>
                        </div>
                    </div>
                    <hr>
                    <center>
                        <h4> Products </h4>
                        <div id='view_product'> </div>
                        <hr>

                        <div class="form-group">
                            <h5>Return Type</h5>
                            <br>
                            <select class='form-select' name='reason'
                                style='font-weight:bold;font-size:18px;text-align:center' required>
                                <option disabled="disabled" selected="selected" value=''>Select Reason </option>
                                <option value='Good Stock'>Good Stock
                                </option>
                                <option value='Bad Stock'>
                                    Bad Stock</option>
                                <option value='Others'>
                                    Others</option>

                                <!--PHP echo-->
                            </select>
                        </div>
                        <hr>



                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Remarks</label>
                                <input type="text" class="form-control" name='remarks' aria-describedby="emailHelp"
                                    style='text-align:center;font-size:20px;font-weight:bold;' required>
                            </div>
                        </div>
                        <hr>


                    </center>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name='add' class="btn btn-primary">Confirm</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="listTrans" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">List Trans</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <?php $results  = mysqli_query($con, "SELECT *,transaction.status as stat , sum(trans_record.total) as total_amount FROM `transaction` 
                                LEFT JOIN accounts ON transaction.user_id = accounts.user_id LEFT JOIN trans_record ON transaction.tid = trans_record.transaction_id 
                                WHERE transaction.type='walkin' or transaction.type='distributor' group by tid"); ?>
                    <table id="walkintable" class="table table-hover" style="width:100%;">
                        <thead class="table-warning">
                            <tr style='font-size:14px'>

                                <th hidden> Transaction ID </th>
                                <th>Trans Code</th>
                                <th>Date</th>
                                <th>Total Purchased</th>
                                <th>Pay</th>
                                <th>Changes</th>
                                <th>Status</th>
                          

                            </tr>
                        </thead>
                        <tbody style='font-size:40px'>
                            <?php while ($row = mysqli_fetch_array($results)) {
                                 
                                            ?>
                            <tr>
                                <td hidden><?php echo $row['tid']; ?> </td>
                                <td><?php echo $row['trans_code']; ?> </td>
                                <td><?php echo $row['datecreated']; ?></td>
                                <td>₱ <?php echo number_format($row['total_amount'],2)?></td>
                                <td>₱ <?php echo number_format($row['trans_pay'],2)?></td>
                                <td>₱ <?php echo number_format($row['trans_changes'],2)?></td>
                                <td><?php echo $row['stat']; ?></td>

                               
                            </tr>

                            <?php } ?>
                        </tbody>

                    </table>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btnReturnList" >Return</button>

            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Return Request</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='POST' action='functions/return_action.php' enctype="multipart/form-data">


                    <div class="row">
                        <div class="col">
                            <label>Date Delivered:</label>
                            <input type="text" class="form-control txt mb-2" name="date" id='r_date' readonly value=''>

                        </div>

                        <div class="col">
                            <label>Order Type:</label>
                            <input type="text" class="form-control txt mb-2" value='Cash On Delivery' readonly>
                        </div>
                    </div>

                    <hr>
                    <div id='view_list_prod'> </div>
                    <hr>
                    <center>
                        <div class="form-group">
                            <h5>Reason of return</h5>

                            <input type="text" class="form-control txt mb-2" id="r_reason"
                                style='font-size:19px;font-weight:bold;text-align:center' readonly>

                        </div>
                        <hr>




                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Remarks</label>
                                <input type="text" class="form-control" id='r_remarks' aria-describedby="emailHelp"
                                    style='text-align:center;font-size:20px;font-weight:bold;' readonly>
                            </div>
                        </div>
                        <hr>


                    </center>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary "data-bs-dismiss="modal" >Close</button>

            </div>
            </form>
        </div>
    </div>
</div>


<script>
$('.btnListTrans').click(function() {
    $('.modal-backdrop').remove();
    $('#returnRequest').modal('hide');


    $('#listTrans').modal('show');


})

$('.btnReturnList').click(function() {
    $('.modal-backdrop').remove();
    $('#listTrans').modal('hide');


    $('#returnRequest').modal('show');


})
</script>


<script>
function clickCheck() {

    trans = document.getElementById("trans_code").value
    console.log(trans)
    getTransInfo(trans)
}



function getTransInfo(str) {
    if (str.length == 0) {

        document.getElementById("trans_code").value = ""
        return;
    } else {
        // Creates a new XMLHttpRequest object
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {


            // Defines a function to be called when
            // the readyState property changess
            if (this.readyState == 4 &&
                this.status == 200) {

                var myObj = JSON.parse(this.responseText);


                document.getElementById("trans_id").value = myObj[0];
                document.getElementById("customer_name").value = myObj[1];
                document.getElementById("trans_date").value = myObj[2];
                document.getElementById("trans_type").value = myObj[4];
                document.getElementById("user_id").value = myObj[6];
                document.getElementById("total_amount").value = '₱ ' + myObj[5];
                document.getElementById("total_purchased").value = '₱ ' + myObj[5];
                // document.getElementById("p_name").value = myObj[1];

                

                $.ajax({
                    url: "fetch/fetch_return_product.php",
                    method: "POST",
                    data: {
                        trans_id: myObj[0],

                    },
                    success: function(data) {
                        $('#view_product').html(data);
                    }
                });






            }
        };

        // xhttp.open("GET", "filename", true);
        xmlhttp.open("GET", "fetch/fetchReturnDetails.php?trans_code=" + str, true);

        // Sends the request to the server
        xmlhttp.send();
    }
}


$('.btnViewReturn').click(function() {

    var return_id = $(this).data('return_id');
    var trans_id = $(this).data('trans_id');
    var selected = $(this).data('selected');
    var date = $(this).data('date');
    var reason = $(this).data('reason');
    var proof = $(this).data('proof');
    var remarks = $(this).data('remarks');


    $('#r_date').val(date)
    $('#r_return_id').val(return_id)
    $('#r_reason').val(reason)
    $('#r_remarks').val(remarks)
    console.log(return_id)



    $.ajax({
        url: "fetch/fetch_return_2.php",
        method: "POST",
        data: {
            selected: selected,
            return_id: return_id
        },
        success: function(data) {
            $('#view_list_prod').html(data);

        }
    })
    $('#returnModal').modal('show');



})

$('#returned_table').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'excel', 'pdf', 'print'
    ],

});
</script>