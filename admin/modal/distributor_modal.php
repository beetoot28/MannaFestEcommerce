<?php
$month = date("m");
$day = date("d");
$year = date("Y");
$dateNow = $month . "/" . $day . "/" . $year;


$res  = mysqli_query($con, "SELECT * from distributor_details ORDER BY dis_id ASC "); 

$disList='';
while($arr = mysqli_fetch_array($res))
{
$disList .= '

<option value="'.$arr["dis_id"].'">'.$arr["distributor_name"].'</option>';
}




?>

<div class="modal fade" id="distributorList" role="dialog" tabindex="-1" data-backdrop="false" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl  ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Distributor List</h5>
            </div>
            <div class="modal-body">
                <div class="inventory-table">
                    <div class="row">
                        <form class="col-md-5" method='POST' action='functions/distributor_action.php'>
                            <div class="mb-6">
                                <label for="category" class="form-label">Add Distributor</label>
                                <input type="text" class="form-control" name="name" aria-describedby="category"
                                    required>

                                <label for="category" class="form-label">Contact #</label>
                                <input type="text" class="form-control" name="contact" aria-describedby="category">

                                <label for="category" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" aria-describedby="category">

                                <br>
                                <button type="submit" name='add' class="btn btn-success">Add Distributor</button>
                            </div>
                        </form>
                        <div class="col-md-7">

                            <?php
                                            $results  = mysqli_query($con, "SELECT * from distributor_details ORDER BY dis_id ASC "); ?>
                            <table id="expense_category" class="table table-hover" style="width:100%">
                                <thead class="table-dark">
                                    <tr>
                                        <th hidden></th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody style='font-size:15px'>
                                    <?php
                                        $count = 1;
                                        while ($row = mysqli_fetch_array($results)) { 
                                        ?>
                                    <tr>
                                        <td hidden> <?php echo $row['dis_id']?> </td>
                                        <td> <?php echo $row['distributor_name']?> </td>
                                        <td> <?php echo $row['distributor_contact']?> </td>
                                        <td> <?php echo $row['distributor_address']?> </td>
                                        <td>
                                            <button type="button" class="btn btn-info btnEdit"><i
                                                    class="fa fa-edit"></i></button>

                                            <button class="btn btn-danger m-1 btnDeleteDistri" type="button"
                                                class="btn btn-info"><i class="fa fa-trash"></i></button>
                                        </td>

                                    </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>




<!-- update -->
<div class="modal fade" id="distriEdit" tabindex="-1"  data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Distributor Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="col-md-12" method='POST' action='functions/distributor_action.php'>
                    <div class="mb-12">
                        <input id='u_id' name='id' hidden>
                        <label for="category" class="form-label">Update Distributor</label>
                        <input type="text" class="form-control" name="name" id='u_name' aria-describedby="category"
                            required>

                        <label for="category" class="form-label">Contact #</label>
                        <input type="text" class="form-control" name="contact" id='u_contact'
                            aria-describedby="category">

                        <label for="category" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id='u_address'
                            aria-describedby="category">


                    </div>
            
            </div>
            <div class="modal-footer">
                <button type="submit" name='update' class="btn btn-success">Save changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="distriDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove from Distributor List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form class="col-md-12" method='POST' action='functions/distributor_action.php'>
                    <div class="mb-3">
                        <input id='d_id' name='d_id' hidden>
                        <div id="category" class="form-text mb-3">Please be advice that it will remove permanently.
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" name='delete' class="btn btn-danger">Continue</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createTransaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductLabel">WALK-IN TRANSACTION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='POST' action='functions/newDistributor.php'>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label for="barcode" class="form-label">Date</label>
                                <input type="text" class="form-control" name='date' value='<?php echo $dateNow ?>'
                                    style='font-size:20px;border: 1;font-weight:bold' readonly>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="product_name" class="form-label">Distributor</label>
                        <select class='form-select' name='distributor' required>
                            <option disabled="disabled" selected="selected" value=''>Select Distributor </option>
                            <?php echo $disList?>

                            <!--PHP echo-->
                        </select>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" name='add' class="btn btn-success">NEW TRANSACTION</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="productAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='POST' action='functions/walkinAddProd.php' id='addProd'>


                    <input type="text" class="form-control" name='product_id' id='product_id' hidden>
                    <input type="text" class="form-control" name='trans_id' value='<?php echo  $trans_id?> ' hidden>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Barcode: </label>
                                <input type="text" class="form-control" name='barcode' id='barcode' readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="barcode" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name='name' id='p_name' readonly>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Price: </label>
                                <input type="text" class="form-control" style='font-weight:bold;font-size:30px'
                                    name='price' id='p_price'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="barcode" class="form-label">Quantity</label>

                            <input type="text" class="form-control" style='font-weight:bold;font-size:30px'
                                name='quantity' value="1">

                        </div>
                    </div>










            </div>
            <div class="modal-footer">
                <button type="submit" name='add' id='addBtn' class="btn btn-success">ADD</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal View-->
<div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="receivingViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receivingViewLabel">CONFIRM TRANSACTION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='POST' action='functions/confirmDistributorTrans.php' id='addProd'>


                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Total Amount: </label>
                                <input type="text" class="form-control" name='total_amount' id='c_total_amount' readonly
                                    style='font-size:20px;border: none;font-weight:bold'>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Walkin ID. </label>
                                <input type="text" class="form-control" name='transaction_id' id='c_walkin_id' readonly
                                    style='font-size:20px;font-weight:bold' required>

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="barcode" class="form-label">Date</label>
                                <input type="text" class="form-control" name='date'
                                    value='<?php echo $today = date("F j, Y");    ?>'
                                    style='font-size:20px;border: none;font-weight:bold' readonly>

                                </select>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="mb-3">
                        <label for="supplier" class="form-label">Distributor Name : </label>
                        <input type="text" class="form-control" name='customer' id='customer' readonly
                            value='<?php echo $distributor_name ?>' style='font-size:20px;font-weight:bold'>

                        </select>
                    </div>
                    <hr>
                    <div id='confirm_table'> </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name='confirm' class="btn btn-success">Confirm</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Delete -->
<div class="modal fade" id="voidTransfer" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">VOID THIS TRANSACTION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='POST' action='functions/voidWalkin.php'>
                    <div class="mb-3">
                        <input type="text" hidden class="form-control" name='transaction_id'
                            value='<?php echo  $trans_id?>'>
                        <div id="brand" class="form-text mb-3">Please be advice that it will remove permanently.</div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" name='remove' class="btn btn-danger">Continue</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                </form>
            </div>
        </div>
    </div>
</div>


