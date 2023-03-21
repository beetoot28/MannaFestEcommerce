<?php $results  = mysqli_query($con, " SELECT *,transaction.status as stat FROM `transaction`
    LEFT JOIN accounts ON transaction.user_id = accounts.user_id WHERE transaction.status='pending'"); ?>
<table id="production_table" class="table table-hover" style="width:100%;">
    <thead class="table-warning">
        <tr style='font-size:14px'>
            <th>Order Code</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Total Amount</th>
            <th>Status</th>
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
                <div class="pending"><?php echo $row['stat']; ?></div>
            </td>

            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button class="btn btn-dark text-light confirmd" data-od="<?php echo $tid ?>"
                        data-date="<?php echo $row['datecreated'] ?>" data-userid="<?php echo $row['user_id']  ?>"
                        data-purchased="<?php echo $row['total_purchased'] ?>"
                        data-discount="<?php echo $row['discount'] ?>" data-amount="<?php echo $row['total_amount'] ?>"
                        style="font-size: 14px;font-weight: bolder;">Confirm</button>

                </div>
                </div>

            </td>
        </tr>

        <?php } ?>
    </tbody>
</table>



<div class="modal fade" id="orderDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method='POST' action='functions/orders_action.php'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name='trans_id' id="m_trans_id" hidden>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Number</label>
                                <input type="email" class="form-control" id="order_code" aria-describedby="emailHelp"
                                    readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Date</label>
                                <input type="email" class="form-control" id="date_order" aria-describedby="emailHelp"
                                    readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                            </div>
                        </div>
                    </div>





                    <hr>
                    <div id='address_customer'> </div>
                    <hr>
                    <h6>Product Order List</h6>
                    <div id='list_purchased_prod'> </div>


                    <center>

                        <table>

                            <tr>
                                <td>
                                   Total Purchased : 
                                </td>
                                <td>
                                    ₱ <label id='order_purchased'> </label>
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    Discount : 
                                </td>
                                <td>
                                    ₱ - <label id='order_discount'> </label>
                                       
                                   
                                </td>
                            </tr>

                            <tr>

                                <td>
                                    Total Amount : 
                                </td>
                                <td>
                                    ₱  <label id='order_total'> </label>
                                </td>
                            </tr>
                        </table>


                    </center>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name='confirm' class="btn btn-warning" id='btnSubmitModal'>Confirm
                        Order</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
$('.confirmd').click(function() {
    //
    var od = $(this).data('od');
    var date = $(this).data('date');
    var userid = $(this).data('userid');

    var purchased = $(this).data('purchased');
    var discount = $(this).data('discount');
    var amount = $(this).data('amount');

    $('#order_purchased').text(purchased)
    $('#order_discount').text(discount)
    $('#order_total').text(amount)



    console.log(userid);
    $('#orderDetails').modal('show')
    $('#date_order').val(date)
    $('#order_code').val('MN_' + od)
    $('#m_trans_id').val(od)

    function fetch_table() {

        var trans_id = (od);
        $.ajax({
            url: "fetch/view_order_details.php",
            method: "POST",
            data: {
                trans_id: trans_id,
            },
            success: function(data) {
                $('#list_purchased_prod').html(data);
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
                $('#address_customer').html(data);
            }
        });
    }
    fetchAddress();


})
</script>