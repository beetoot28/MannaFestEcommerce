

<div class="modal fade" id="newProd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="btn-close" style="float: right;" data-bs-dismiss="modal"
                    aria-label="Close"></button>

                <br>
                <form method="post" action="functions/addProduct.php" id="savenew" enctype="multipart/form-data">

                    <input type="hidden" name="savenew">




                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <label style="font-size: 14px" class="mb-3">Multiple Photo Selection </label>
                                <input type="file" name="image[]" onchange="javascript:updateList()" id="file"
                                    style="font-size: 14px" class="form-control" accept="image/*" multiple="">
                                <span style="font-size: 14px" id="imgsa"> Max of 3 Images will be accepted <span
                                        class="text-danger">*</span></span>
                                <hr>
                                <style type="text/css">
                                #fileList::-webkit-scrollbar {

                                    width: 2px;
                                }
                                </style>
                                <h6 style="font-size: 14px">Selected Photos</h6>

                                <div id="fileList"
                                    style="height: 240px;overflow-y: scroll;border-bottom:1px solid #b2c1c2;border-top:1px solid #b2c1c2">
                                </div>



                            </div>
                            <div class="col-md-5">
                                <hr>
                                <label style="font-size: 14px" class="">Item Code/Barcode: </label>
                                <input type="text" name="barcode" style="font-size: 14px" class="form-control"
                                    required="">
                                <br>
                                <label style="font-size: 14px" class="">Enter Product Name : </label>
                                <input type="text" name="name" style="font-size: 14px" class="form-control mb-2"
                                    required="">
                                <label style="font-size: 14px" class="mb-1">Select Category: </label>
                                <select class="form-select mb-2" name="cat" style="font-size: 14px">
                                    <option disabled="disabled" selected="selected" value="">Select Category </option>
                                    <?php echo $category?>
                                </select>
                                <!-- <div class="row">
                                    <div class="col">
                                        <label style="font-size: 14px" class="mb-3">Enter Cost: </label>
                                        <input type="text" name="cost"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            style="font-size: 14px" class="form-control mb-2" required="">
                                    </div>
                                    <div class="col">
                                        <label style="font-size: 14px" class="mb-3">Enter Price: </label>
                                        <input type="text" name="price"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                            style="font-size: 14px" class="form-control mb-2" required="">
                                    </div>
                                </div> -->


                                <label style="font-size: 14px" class="mb-3">Enter Description: </label>
                                <textarea style="font-size: 14px" name="desc" class="form-control"></textarea>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <label style="font-size: 14px" class="mb-3">Enter Ingredients: </label> <br>
                                <button type="button" class=" btn btn-warning add_field_button">Add Field</button>
                                <button type="button" class="btn btn-dark  remove_field_button">Remove
                                    Field</button>
                                <hr>
                                <div class="input_fields_wrap">
                                    <input type="text" name="ingredients[]" placeholder="Ingredient"
                                        class="form-control field-long" />

                                </div>
                            </div>
                        </div>

                    </div>
                    <br>

                    <button type="submit" id="disabledsave" name='savenew' class="btn btn-warning text-dark"
                        style="font-size: 15px;float: right;">Save</button>

                </form>

            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="prodUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="btn-close" style="float: right;" data-bs-dismiss="modal"
                    aria-label="Close"></button>

                <br>
                <form method="post" action="functions/addProduct.php"  enctype="multipart/form-data">
                <input type="hidden" name="prod_id" id='prod_id_update'>
                    <div class="container">
                        <div class="row">
                        <div class="col-md-4">
                                <label style="font-size: 14px" class="mb-3"> Photo Selection </label>
                                <input type="file" name="image" onchange="javascript:updateListUpdate()" id="fileUpdate"
                                    style="font-size: 14px" class="form-control" accept="image/*" >
                                <span style="font-size: 14px" id="imgsa">Insert Image <span
                                        class="text-danger">*</span></span>
                                <hr>
                                <style type="text/css">
                                #fileList::-webkit-scrollbar {

                                    width: 2px;
                                }
                                </style>
                                <h6 style="font-size: 14px">Selected Photos</h6>

                                <div id="fileListUpdate"
                                    style="height: 240px;overflow-y: scroll;border-bottom:1px solid #b2c1c2;border-top:1px solid #b2c1c2">
                                </div>



                            </div>
                            <div class="col-md-6">
                                <hr>
                                <label style="font-size: 14px" class="">Item Code/Barcode: </label>
                                <input type="text" name="barcode" id='edit_barcode' style="font-size: 14px"
                                    class="form-control" required="">
                                <br>
                                <label style="font-size: 14px" class="">Enter Product Name : </label>
                                <input type="text" name="name" style="font-size: 14px" id='edit_name'
                                    class="form-control mb-2" required="">
                                <label style="font-size: 14px" class="mb-1">Select Category: </label>

                                <select class="form-select mb-2" name="cat" id='edit_cat' style="font-size: 14px" required>
                                    <option disabled="disabled" selected="selected" value="">Select Category </option>
                                    <?php echo $category?>
                                </select>
                               


                                <label style="font-size: 14px" class="mb-3">Enter Description: </label>
                                <textarea style="font-size: 14px" name="desc" id='edit_desc'
                                    class="form-control"></textarea>
                            </div>
                            <!-- <div class="col-md-3">
                                <br>
                                <label style="font-size: 14px" class="mb-3">Enter Ingredients: </label> <br>
                                <button type="button" class=" btn btn-warning add_field_button">Add Field</button>
                                <button type="button" class="btn btn-dark  remove_field_button">Remove
                                    Field</button>
                                <hr>
                                <div class="input_fields_wrap">
                                    <input type="text" name="ingredients[]" placeholder="Ingredient"
                                        class="form-control field-long" />

                                </div>
                            </div> -->
                        </div>

                    </div>
                    <br>

                    <button type="submit" name='updateproduct' class="btn btn-warning text-dark"
                        style="font-size: 15px;float: right;">Save</button>

                </form>

            </div>

        </div>
    </div>
</div>



<!-- Modal Delete-->
<div class="modal fade" id="prodDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="supplierDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expensesDeleteLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="functions/deleteProduct.php" method="POST">
                <div class="modal-body">
                    <input type="number" id="del_id" name="del_id" style="display: none">
                    <p>Row Data will be remove permanently, Continue?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="delete" class="btn btn-danger" data-bs-dismiss="modal">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>
