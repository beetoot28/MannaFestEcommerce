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


                    <div class="mb-3">
                        <label for="product_name" class="form-label">Price: </label>
                        <input type="text" class="form-control" name='price' id='p_price' readonly>
                    </div>



                    <hr>
                    <center>
                        <label for="barcode" class="form-label">Quantity</label>
                        <div class="counter-modal">

                            <input type="text" name='quantity' value="1">

                        </div>
                    </center>

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
                <form method='POST' action='functions/confirmWalkin.php' id='addProd'>


                    <div class="row">
                        <div class="col">
                        <input type="text" class="form-control" name='transaction_id' id='c_walkin_id' hidden
                                    style='font-size:20px;font-weight:bold' >

                            <div class="mb-3">
                                <label for="supplier" class="form-label">Customer Name : (optional) </label>
                                <input type="text" class="form-control" name='customer' id='customer' value='Walk-in'
                                    style='font-size:20px;font-weight:bold'>

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Walkin ID. </label>
                                <input type="text" class="form-control" name='trans_code' value='<?php echo $trans_code ?>' readonly
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
                        <label for="product_name" class="form-label">Total Amount: </label>
                        <input type="text" class="form-control" name='total_amount' id='con_total_amount' readonly
                            style='font-size:35px;border: none;font-weight:bold;text-align:center'>
                    </div>

                    <div class="row">
                        <div class="col">


                            <div class="mb-3">
                                <label for="supplier" class="form-label"> Pay : </label>
                                <input type="text" class="form-control" name='trans_pay' id='customer_pay'
                                    style='font-size:35px;font-weight:bold;text-align:center' required>

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Change </label>
                                <input type="text" class="form-control" name='trans_change' id='trans_changes' readonly
                                    style='font-size:35px;font-weight:bold;text-align:center' required>

                                </select>
                            </div>
                        </div>

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
<div class="modal fade" id="voidTransfer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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