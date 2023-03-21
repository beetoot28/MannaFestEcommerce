<style>
#product_table th {
    font-size: 15px;
}

#product_table td {
    font-size: 20px;
    font-weight: bold;
}


.wrapper-decision {
    display: inline-flex;
    background: #fff;
    height: 100px;
    width: 400px;
    align-items: center;
    justify-content: space-evenly;
    border-radius: 5px;
    padding: 20px 15px;

}

.wrapper .option {
    background: #fff;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    margin: 0 10px;
    border-radius: 5px;
    cursor: pointer;
    padding: 0 10px;
    border: 2px solid lightgrey;
    transition: all 0.3s ease;
}

.wrapper .option .dot {
    height: 20px;
    width: 20px;
    background: #d9d9d9;
    border-radius: 50%;
    position: relative;
}

.wrapper .option .dot::before {
    position: absolute;
    content: "";
    top: 4px;
    left: 4px;
    width: 12px;
    height: 12px;
    background: #0069d9;
    border-radius: 50%;
    opacity: 0;
    transform: scale(1.5);
    transition: all 0.3s ease;
}

input[type="radio"] {
    display: none;
}

#option-1:checked:checked~.option-1 {


    background: #0069d9;
}

#option-2:checked:checked~.option-2 {

    background: #ff3359;
}

#option-1:checked:checked~.option-1 .dot,
#option-2:checked:checked~.option-2 .dot {
    background: #fff;
}

#option-1:checked:checked~.option-1 .dot::before,
#option-2:checked:checked~.option-2 .dot::before {
    opacity: 1;
    transform: scale(1);
}

.wrapper .option span {
    font-size: 20px;
    color: #808080;
}

#option-1:checked:checked~.option-1 span,
#option-2:checked:checked~.option-2 span {
    color: #fff;
}
</style>


<div class="row">
    <h6>Filter</h6>
    <div class="col-sm-3">
        <div class="form-group">
 
            <select class='form-select' id='filter_reason'>
                <option disabled="disabled" selected="selected" value=''>Select Reason </option>
                <option value=''>Show All</option>
                <option value='The product received is damaged'>The product received is damaged </option>
                <option value='The product received is not as described on the website '>The product received is not as
                    described on the website </option>
                <option value='The product received is the wrong speciification or grams'>The product received is the
                    wrong speciification or grams</option>
                <!--PHP echo-->
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <input type="text" id="return_min" name="min" class="form-control" placeholder="From Date" />
    </div>
    <div class="col-sm-3">
        <input type="text" id="return_max" name="max" class="form-control" placeholder="To Date" />

    </div>
    <div class="col-sm">
    <button class='btn btn-primary' id="clear-date-filter">Clear Date Filter</button>

    </div>
 
</div>


<hr>
<div class="table">
    <?php $results  = mysqli_query($con, " SELECT *,return_request.status as return_status FROM `return_request` 
                                LEFT JOIN accounts ON return_request.user_id =  accounts.user_id
                                where type='online'"); ?>
    <table id="returned_table" class="table table-hover" style="width:100%;">
        <thead class="table-warning">
            <tr>

                <th> Return ID </th>
                <th>Customer</th>
                <th>Order No.</th>
                <th>Order Date</th>
                <th>Payment</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>


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
                <td>
                <?php if ($row['return_status'] == 'Pending'){ ?>
                
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button"
                         data-return_id='<?php echo $row['return_id'];?>'
                            data-trans_id='<?php echo $row['transaction_id'];?>'
                            data-reason='<?php echo $row['reason'];?>'
                            data-selected='<?php echo $row['selected_prod'];?>'
                            data-proof='<?php echo $row['proof_img'];?>' data-date='<?php echo $row['date_ordered'];?>'
                            class="btn btn-success text-light btnViewReturn" style="font-size: 12px"><i
                                class="fas fa-eye"></i></button>
                    </div>
                    <?php }?>

                </td>
            </tr>

            <?php } ?>
        </tbody>

    </table>

</div>


<!-- New Address -->
<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
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

                        <div class="wrapper-decision">
                            <input type="radio" name="select" value='CONFIRMED' id="option-1" checked required>
                            <input type="radio" name="select" value='REJECTED' id="option-2" required>
                            <label for="option-1" class="option option-1">

                                <span>Accept</span>
                            </label>
                            <label for="option-2" class="option option-2">

                                <span>Reject</span>
                            </label>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Remarks</label>
                                <input type="text" class="form-control" name='remarks' aria-describedby="emailHelp"
                                    style='text-align:center;font-size:20px;font-weight:bold;' placeholder="Enter Remarks" required>
                            </div>
                        </div>
                        <hr>


                    </center>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name='submit' class="btn btn-primary">Confirm</button>
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
    $('#r_reason').val(reason)
    console.log(reason)


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
            return_id: return_id
        },
        success: function(data) {
            $('#view_list_prod').html(data);

        }
    })
    $('#returnModal').modal('show');



})
</script>