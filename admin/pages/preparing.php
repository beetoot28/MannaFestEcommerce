<?php $results  = mysqli_query($con, " SELECT *,transaction.status as stat FROM `transaction`
    LEFT JOIN accounts ON transaction.user_id = accounts.user_id WHERE transaction.status='ready'"); ?>
<table id="preparing_table" class="table table-hover" style="width:100%;">
    <thead class="table-warning">
        <tr style='font-size:14px'>
            <th>Order Code</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Total Amount</th>
            <th>Action</th>


        </tr>
    </thead>
    <tbody style='font-size:40px'>
        <?php while ($row = mysqli_fetch_array($results)) {
                    $tid=  $row['tid'];
                  
                ?>
        <tr>
            <td>MN_<?php echo $row['tid']; ?></td>
            <td><?php echo $row['datecreated']; ?></td>
            <td><?php echo $row['name'].' '.$row['lastname']; ?></td>
            <td>₱ <?php echo $row['total_amount']; ?></td>


            <td>

                <button class="btn btn-dark text-light deliver" data-od="<?php echo $tid ?>"
                    data-date="<?php echo $row['datecreated'] ?>" data-userid="<?php echo $row['user_id']  ?>"
                    style="font-size: 14px;font-weight: bolder;">Deliver</button>

                <button class="btn btn-info text-dark print" data-od="<?php echo $tid ?>"
                    data-date_created="<?php echo $row['datecreated'] ?>" data-userid="<?php echo $row['user_id'] ?>"
                    style="font-size: 14px;font-weight: bolder;">Print
                    Delivery</button>


            </td>
        </tr>

        <?php } ?>
    </tbody>
</table>

<?php 

$res  = mysqli_query($con, "SELECT * from accounts where user_type='courier'"); 
$courierList='';
while($arr = mysqli_fetch_array($res))
{
$courierList .= '

<option value="'.$arr["user_id"].','.$arr["name"].' '.$arr["lastname"].' | Contact : '.$arr["mobile_number"].'">'.$arr["name"].' '.$arr["lastname"].' | Contact : '.$arr["mobile_number"].'</option>';
}

?>

<div class="modal fade" id="deliverOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deliver Item</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method='POST' action='functions/orders_action.php'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name='trans_id' id="d_trans_id" hidden>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Number</label>
                                <input type="email" class="form-control" id="d_order_code" aria-describedby="emailHelp"
                                    readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Date</label>
                                <input type="email" class="form-control" id="d_date_order" aria-describedby="emailHelp"
                                    readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col">
                        <center>
                            <label for="product_name" class="form-label"> Delivery</label>
                            <select class='form-select' name='courier' style='font-weight:bold;font-size:18px' required>
                                <option disabled="disabled" selected="selected" value=''>Select Courier </option>
                                <?php echo $courierList?>

                                <!--PHP echo-->
                            </select>
                        </center>
                    </div>

               
                    <hr>
                    <div id='d_address_customer'> </div>
                    <hr>
                    <h6>Product Order List</h6>
                    <div id='d_list_purchased_prod'> </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name='deliver' class="btn btn-info" id='btnSubmitModal'>Deliver</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="printDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print Order</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id='print_order_content'>
                    <div class="row">
                        <div class="col">
                            <input type="email" class="form-control" id="print_trans_id" hidden>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Number</label>
                                <input type="text" class="form-control" id="print_order_code"
                                    aria-describedby="emailHelp" readonly
                                    style='text-align:center;font-size:17px;font-weight:bold;'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Date</label>
                                <input type="text" class="form-control" id="print_date_order" readonly
                                    style='text-align:center;font-size:17px;font-weight:bold;'>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id='print_address_customer'> </div>
                    <hr>
                    <h6>Product Order List</h6>
                    <div id='print_list_purchased_prod'> </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" onclick='PrintElem()'>Print Order</button>
            </div>
        </div>
    </div>
</div>


<script>
function PrintElem() {
    // Get the values of the input boxes

    var orderCode = document.getElementById('print_order_code').value;
    var dateOrder = document.getElementById('print_date_order').value;


    // Set the values of the corresponding elements in the print_order_content div

    document.getElementById('print_order_code').innerHTML = orderCode;
    document.getElementById('print_date_order').innerHTML = dateOrder;

    // Open a new window and write the contents of the print_order_content div to it
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">');
    mywindow.document.write('<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">');
    mywindow.document.write('<html><head><title>' + document.title + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title + '</h1>');
    mywindow.document.write(document.getElementById('print_order_content').innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
}

$('.print').click(function() {
    //
    var od = $(this).data('od');
    var date = $(this).data('date_created');
    var userid = $(this).data('userid');

    console.log(date)
    $('#printDetails').modal('show')
    $('#print_date_order').val(date)
    $('#print_order_code').val('MN_' + od)
    $('#print_trans_id').val(od)

    function print_fetch_table() {

        var trans_id = (od);
        $.ajax({
            url: "fetch/view_order_details.php",
            method: "POST",
            data: {
                trans_id: trans_id,

            },
            success: function(data) {
                $('#print_list_purchased_prod').html(data);
            }
        });
    }
    print_fetch_table();


    function print_fetchAddress() {

        var trans_id = (od);
        $.ajax({
            url: "fetch/order_shipping.php",
            method: "POST",
            data: {
                trans_id: trans_id,
                userid: userid,
            },
            success: function(data) {
                $('#print_address_customer').html(data);
            }
        });
    }
    print_fetchAddress();

})


$('.deliver').click(function() {
    //
    var od = $(this).data('od');
    var date = $(this).data('date');
    var userid = $(this).data('userid');

    console.log(userid);
    $('#deliverOrder').modal('show')
    $('#d_date_order').val(date)
    $('#d_order_code').val('MN_' + od)
    $('#d_trans_id').val(od)

    function fetch_table() {

        var trans_id = (od);
        $.ajax({
            url: "fetch/view_order_details.php",
            method: "POST",
            data: {
                trans_id: trans_id,
            },
            success: function(data) {
                $('#d_list_purchased_prod').html(data);
            }
        });
    }
    fetch_table();


    function fetchAddress() {

        var trans_id = (od);
        $.ajax({
            url: "fetch/order_shipping.php",
            method: "POST",
            data: {
                trans_id: trans_id,
                userid: userid,
            },
            success: function(data) {
                $('#d_address_customer').html(data);
            }
        });
    }
    fetchAddress();


})
</script>