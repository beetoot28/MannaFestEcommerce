<hr>



<div class="row mb-4">
    <?php 
    $courier_id = $_SESSION["cour_id"];
  $sql = " select * from courier_trans where user_id='$courier_id'";
  $res = mysqli_query($con,$sql); 
  $arr= mysqli_fetch_array($res);

$cash_on_hand =  (!empty($arr['total_cash_onhand']) ? $arr['total_cash_onhand'] : 0); 
$total_amount =  (!empty($arr['total_amount']) ? $arr['total_amount'] : 0); 
$total_remit = (!empty($arr['total_remit']) ? $arr['total_remit'] : 0); 
?>

    <div class="col-md-3">
        <div class="card shadow border-success">
            <div class="card-body">

                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                    TOTAL CASH ON HAND <br>
                    <?php 
                echo '₱ '.number_format($cash_on_hand);      
         ?>

                </h5>
            </div>

        </div>

    </div>



    <div class="col-md-3">
        <div class="card shadow border-warning">
            <div class="card-body">

                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                    PENDING DELIVERY <br><span class="badge bg-dark text-light"> <?php 
            $corders = " select * from transaction where status='otw'  ";
                        $countord = mysqli_query($con,$corders); 
                        $allorders= mysqli_num_rows($countord);
              echo $allorders;     

        ?></span>
                </h5>
            </div>

        </div>

    </div>

    <div class="col-md-3">
        <div class="card shadow border-success">
            <div class="card-body">

                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                    COMPLETED DELIVERY <br> <span class="badge bg-success text-light">
                        <?php 
            $ccustomers = " select * from accounts  ";
                        $ccustom = mysqli_query($con,$ccustomers); 
                        $allcustomers= mysqli_num_rows($ccustom);
                echo $allcustomers;      
         ?>
                    </span>
                </h5>
            </div>

        </div>

    </div>

    <div class="col-md-3">
        <div class="card shadow border-success">
            <div class="card-body">

                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                    TOTAL DELIVERY AMOUNT <br>
                    <?php 
                echo '₱ '.number_format($total_amount);    
         ?>

                </h5>
            </div>

        </div>

    </div>







</div>


<?php


$results  = mysqli_query($con, " SELECT *,transaction.status as stat FROM `transaction`
    LEFT JOIN accounts ON transaction.user_id = accounts.user_id WHERE transaction.status='otw'
    and delivery_rider_id='$courier_id'"); ?>
<table id="production_table" class="table table-hover" style="width:100%;">
    <thead class="table-warning">
        <tr style='font-size:14px'>
            <th>Order Code</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>


        </tr>
    </thead>
    <tbody style='font-size:15px'>
        <?php while ($row = mysqli_fetch_array($results)) {
                    $tid=  $row['tid'];
     
                ?>
        <tr>
            <td>MN_<?php echo $row['tid']; ?></td>
            <td><?php echo $row['datecreated']; ?></td>
            <td><?php echo $row['name'].' '.$row['lastname']; ?></td>
            <td>₱ <?php echo $row['total_amount']; ?></td>
            <td>
                <div class="pending"><?php if($row['stat'] ='otw'){
                    echo 'On The Way';
                }else {
                    echo $row['stat'];
                } ?></div>
            </td>

            <td>

                <button class="btn btn-dark text-light confirmd" data-od="<?php echo $tid ?>"
                    data-date="<?php echo $row['datecreated'] ?>" data-userid="<?php echo $row['user_id']  ?>"
                    style="font-size: 14px;font-weight: bolder;">Delivered</button>

                <button class="btn btn-danger text-light unattended" data-od="<?php echo $tid ?>"
                    data-date="<?php echo $row['datecreated'] ?>" data-userid="<?php echo $row['user_id']  ?>"
                    style="font-size: 14px;font-weight: bolder;">Unattended</button>




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
            <!-- <form method='POST' action='functions/orders_action.php'> -->
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

                <div class="form-group">
                    <center>
                        <label for="exampleInputEmail1">Total Payable</label> <br>
                        <input type="email" class="form-control" id="m_total_pay" name='total_pay' readonly
                            style='text-align:center;font-size:35px;font-weight:bold;'>
                    </center>
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" name='confirm' class="btn btn-warning btnSubmitModal" id='btnSubmitModal'>Upload
                    Proof
                    Delivery</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<div class="modal fade" id="unattendedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ORDER DETAILS | UNATTENDED</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method='POST' action='function/cancel_order.php'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name='trans_id' id="u_trans_id" hidden>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Number</label>
                                <input type="email" class="form-control" id="u_order_code" aria-describedby="emailHelp"
                                    readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Date</label>
                                <input type="email" class="form-control" id="u_date_order" aria-describedby="emailHelp"
                                    readonly style='text-align:center;font-size:20px;font-weight:bold;'>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id='address_customer'> </div>
                    <hr>
                    <h6>Product Order List</h6>
                    <div id='u_list_purchased_prod'> </div>

                    <div class="form-group">
                        <center>
                            <label for="exampleInputEmail1">Total Payable</label> <br>
                            <input type="email" class="form-control" id="u_total_pay" name='total_pay' readonly
                                style='text-align:center;font-size:35px;font-weight:bold;'>

                        </center>
                    </div>
                    <br>
                    <p>
                    <div class="form-group">
                        <center>
                            <h5>REASON</h5>

                            <select class='form-select' name='reason' style='font-size:16px' required>
                                <option disabled="disabled" selected="selected" value=''>Select Reason </option>
                                <option value='The customer was not available at the time of delivery'>The customer was
                                    not available at the time of delivery
                                </option>
                                <option value=' incorrect or incomplete address,'>The customer provided an incorrect or
                                    incomplete address, </option>
                                <option value='Customer Contact Number is Cannot be reached'>Customer Contact Number is
                                    Cannot be reached</option>
                                <!--PHP echo-->
                            </select>
                        </center>
                    </div>

                    </p>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name='confirm' class="btn btn-danger ">CANCEL
                        ORDER</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="uploadProofModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Proof of Delivery For Order
                    BNC_<?php echo $tid  ?></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="post" action="action_order.php">
                <div class="modal-body">
                    <center>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyHlhRBUevbh8DcWe7o5epTHj3PS0o7vsV1A&usqp=CAU"
                            id="img<?php echo $tid  ?>" style="width:60%;">
                    </center>
                    <br> <Br>

                    <input type="file" name="image" id="<?php echo $tid ?>" class="form-control mt-2" accept="image/*"
                        required>

            <br> <br>
                    <div class="form-group">
                        <center>
                            <label for="exampleInputEmail1">Remarks</label> <br>
                            <input type="text" class="form-control" id="d_remarks" name='d_remarks' 
                                style='text-align:center;font-size:20px;font-weight:bold;' placeholder="Enter Remarks">

                        </center>
                    </div>
                </div>
                <input type="hidden" name="tid" value="<?php echo $tid ?>">
                <input type="text" hidden name="courier_id" value="<?php echo $courier_id ?>">
                <div class="modal-footer">

                    <button type="submit" name="uploadproof" class="btn btn-light text-primary"
                        style="font-size:13px">Mark as Complete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#<?php echo $tid?>').change(function() {

        if (this.files[0].type != "image/jpeg" && this.files[0].type !=
            "image/png" && this.files[0].type != "image/gif") {
            alert("Sorry invalid file type. Please upload an image");
        } else {
            $('#img<?php echo $tid?>').attr('src', URL.createObjectURL(this.files[
                0]));
        }
    })

});
</script>


<script>
$('.confirmd').click(function() {
    //

    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    var od = $(this).data('od');
    var date = $(this).data('date');
    var userid = $(this).data('userid');

    console.log(userid);
    $('#orderDetails').modal('show')
    $('#date_order').val(date)
    $('#order_code').val('MN_' + od)
    $('#m_trans_id').val(od)
    $('#m_total_pay').val(data[3])

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

$('.btnSubmitModal').click(function() {
    $('#orderDetails').modal('hide');
    $('#uploadProofModal').modal('show');


})




$('.unattended').click(function() {
    //

    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();


    var od = $(this).data('od');
    var date = $(this).data('date');
    var userid = $(this).data('userid');

    console.log(userid);
    $('#unattendedModal').modal('show')
    $('#u_date_order').val(date)
    $('#u_order_code').val('MN_' + od)
    $('#u_trans_id').val(od)
    $('#u_total_pay').val(data[3])

    function fetch_table() {

        var trans_id = (od);
        $.ajax({
            url: "fetch/view_order_details.php",
            method: "POST",
            data: {
                trans_id: trans_id,
            },
            success: function(data) {
                $('#u_list_purchased_prod').html(data);
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