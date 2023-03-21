<style>
  table {
    border-collapse: collapse;
    width: 100%;
  }
  th, td {
    border: 1px solid black;
    text-align: left;
    padding: 5px;
  }
  th {
    background-color: #dddddd;
  }
  @media only screen and (max-width: 600px) {
    th, td {
      border: none;
      text-align: center;
    }
    table {
      border: none;
    }
  }
</style>
<div class="row">
    <div class="col-sm-9">
        <center>
            <h5 style="font-weight: bolder;">Returned Product Orders</h5>
        </center>

        <div class="table">
            <?php $results  = mysqli_query($con, "SELECT *,return_request.status as return_status, SUM(total) as total_return FROM `return_request` LEFT JOIN accounts ON return_request.user_id = accounts.user_id LEFT JOIN return_product ON return_request.return_id = return_product.return_id GROUP BY return_request.return_id
           "); ?>
            <table id="returned_table" class="table table-hover" style="width:100%;">
                <thead class="table-warning">
                    <tr>

                        <th>ID</th>
                        <th>Customer</th>
                        <th>Order No.</th>
                        <th>Order Date</th>
                        <th>Payment</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Total Return</th>


                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($results)) {
                                    
                                          
                                            ?>
                    <tr>


                        <td><?php echo $row['return_id']; ?></td>
                        <td><?php echo $row['name'].' '.$row['lastname']; ?> </td>
                        <td>OD_<?php echo $row['transaction_id']; ?></td>
                        <td><?php echo $row['date_ordered']; ?></td>
                        <td><?php echo $row['payment_type']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td>

                            <div class="pending"><?php echo $row['return_status']; ?></div>
                        </td>
                        <td>₱ <?php echo number_format($row['total_return'],2); ?></td>
                      
                    </tr>

                    <?php } ?>
                </tbody>

            </table>
            <br>
            <hr>

            <center> <br>
                <h5 style="font-weight: bolder;">Cancelled Orders</h5>
            </center>
            <br>

            <?php $results  = mysqli_query($con, " SELECT *,transaction.status as stat FROM `transaction`
    LEFT JOIN accounts ON transaction.user_id = accounts.user_id WHERE transaction.status='Cancelled'"); ?>
            <table id="cancelled_table" class="table table-hover" style="width:100%;">
                <thead class="table-warning">
                    <tr style='font-size:14px'>
                        <th>Order Code</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Status</th>

                        <th>Reason</th>

                    </tr>
                </thead>
                <tbody style='font-size:40px'>
                    <?php while ($row = mysqli_fetch_array($results)) {
                    $tid=  $row['tid'];
                    $gettrans_records = "select sum(total) as total_pay from trans_record where transaction_id = '$tid'  ";
                    $gettingtrans = mysqli_query($con,$gettrans_records); 
                    $gtrans = mysqli_fetch_array($gettingtrans)
                ?>
                    <tr>
                        <td>MN_<?php echo $row['tid']; ?></td>
                        <td><?php echo $row['datecreated']; ?></td>
                        <td><?php echo $row['name'].' '.$row['lastname']; ?></td>
                        <td>₱ <?php echo number_format($gtrans['total_pay'],2); ?></td>
                        <td>
                            <i class="fa-solid fa-check"></i> Status : <b style='color:red'>Cancelled </b>
                        </td>
                        <td><b><?php echo $row['reason']; ?> </b></td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>





        <!-- end column -->
    </div>
    <div class="col-sm-3">
        <center>
            <h5 style="font-weight: bolder;">Monthly Returns</h5>
        </center>
        <br>
        <?php 
                   
                   $result = mysqli_query($con, "SELECT MONTHNAME(date_ordered) as month, count(*) as returns_count 
                   FROM return_request 
                   GROUP BY month(date_ordered)"); ?>
        <table class="table table-hover">
            <thead class='table-warning'>
                <tr>
                    <th scope="col">Product </th>
                    <th scope="col">Number of Returns</th>
                </tr>
            </thead> <?php 
                                         while ($row = mysqli_fetch_array($result)) { ?> <tbody>
                <tr style='text-align:center'>
                    <td> <?php echo $row['month']?> </td>
                    <td> <?php echo $row['returns_count']?> </td>
                </tr> <?php } ?>
            </tbody>
        </table>

        <hr>
        <br>
        <center>
            <h5 style="font-weight: bolder;">Monthly Cancelled Orders</h5>
        </center>
        <br>
        <?php 
                   
                   $result = mysqli_query($con, "SELECT MONTHNAME(datecreated) as month, count(*) as cancelled_count 
                   FROM transaction  WHERE status='cancelled'
                   GROUP BY month(datecreated)"); ?>
        <table class="table table-hover">
            <thead class='table-warning'>
                <tr>
                    <th scope="col">Product </th>
                    <th scope="col">Number of Returns</th>
                </tr>
            </thead> <?php 
                                         while ($row = mysqli_fetch_array($result)) { ?> <tbody>
                <tr style='text-align:center'>
                    <td> <?php echo $row['month']?> </td>
                    <td> <?php echo $row['cancelled_count']?> </td>
                </tr> <?php } ?>
            </tbody>
        </table>



    </div>
</div>

<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Return Request</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method='POST' action='functions/return_action.php' enctype="multipart/form-data">

                    <input type="number" name="return_id" id='r_return_id' hidden>
                    <input type="number" name="tid" value='' hidden>

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

                        <h5>Proof </h5>
                        <img id="imgUpload" style="width:25%;height:25%;">

                        <hr>



                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Remarks</label>
                                <input type="text" class="form-control" name='remarks' aria-describedby="emailHelp"
                                    style='text-align:center;font-size:20px;font-weight:bold;' readonly>
                            </div>
                        </div>
                        <hr>


                    </center>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
            </form>
        </div>
    </div>
</div>



<script>
$('.btnViewReturn').click(function() {

    var return_id = $(this).data('return_id');
    var trans_id = $(this).data('trans_id');
    var selected = $(this).data('selected');
    var date = $(this).data('date');
    var reason = $(this).data('reason');
    var proof = $(this).data('proof');

    $('#r_date').val(date)
    $('#r_return_id').val(return_id)

    console.log(return_id)


    var imgUrl = "../img/return_proof/" + proof;

    // Get the img element
    var img = document.getElementById("imgUpload");

    // Set the src attribute of the img element
    img.src = imgUrl;




    $.ajax({
        url: "fetch/fetch_return.php",
        method: "POST",
        data: {
            selected: selected,
            trans_id: trans_id
        },
        success: function(data) {
            $('#view_list_prod').html(data);

        }
    })
    $('#returnModal').modal('show');



})




$('#cancelled_table').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excel',
            title: ' List of Cancelled Orders'
        },
        {
            extend: 'pdf',
            title: ' List of Cancelled Orders'
        },
        {
            extend: 'print',
            title: ' List of Cancelled Orders'
        },
    ],

});

$('#returned_table').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'excel',
            title: ' List of Returned Orders'
        },
        {
            extend: 'pdf',
            title: ' List of Returned Orders'
        },
        {
            extend: 'print',
            title: ' List of Returned Orders'
        },
    ],
   
});

</script>