<?php 

$sql = mysqli_query($con, "SELECT  COUNT(*) from production_log  "); 
$withdrawal = mysqli_fetch_array($sql);

$generate= sprintf("%'03d", $withdrawal[0]+1);
$today = date("Y");
$code = 'P'.$today . $generate;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="modal fade" id="viewProductionDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="receivingViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receivingViewLabel">Product Production Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <label> Product Name </label> <br>
                <input id='p_name' class='form-control' style='font-size:20px;border: none;font-weight:bold' readonly>
                <hr>
                <div class="row">
                    <div class="col-sm">
                        <label> Category </label> <br>
                        <input id='p_category' class='form-control' style='font-size:20px;border: none;font-weight:bold'
                            readonly>
                    </div>
                    <div class="col-sm">
                        <label> Current Cost :</label> <br>
                        <input id='p_cost' class='form-control' style='font-size:20px;border: none;font-weight:bold'
                            readonly>
                    </div>
                    <div class="col-sm">
                        <label> Current Price</label> <br>
                        <input id='p_price' name='voucher' class='form-control'
                            style='font-size:20px;border: none;font-weight:bold' readonly>
                    </div>
                </div>

                <br>



                <hr>
                <div id='view_prod_history'> </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return</button>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="newProduction" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" style="float: right;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title">Add Daily Production</h5>

            </div>
            <div class="modal-body">
                <form method='POST' action='functions/addProduction.php'>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Production Code</label>
                            <input type="text" class="form-control" name="prod_code" value='<?php echo $code ?>'
                                aria-describedby="amount" readonly>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product List</label>
                            <select class='form-select category' name='prod_id' id='prod_select' required>
                                <option disabled="disabled" selected="selected" value=''>Select Product </option>
                                <?php echo $prod_list?>

                                <!--PHP echo-->
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="quantity" aria-describedby="amount" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Cost</label>
                                <input type="text" class="form-control" name="cost" id="cost" aria-describedby="amount"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" id="price"
                                    aria-describedby="amount" required>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Production Date</label>
                                <input type="date" class="form-control" name="prod_date" id='prod_date'
                                    aria-describedby="amount" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Expiration Date</label>
                                <input type="date" class="form-control" name="exp_date" id="exp_date"
                                    aria-describedby="amount" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name='add' class="btn btn-warning">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const prodDate = document.getElementById('prod_date');
    const expDate = document.getElementById('exp_date');


    prodDate.setAttribute('min', new Date().toISOString().split("T")[0]);
    expDate.setAttribute('min', new Date().toISOString().split("T")[0]);
});
</script>


<div class="modal fade" id="expiredModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" style="float: right;" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title">Expired Items</h5>

            </div>
            <div class="modal-body">



                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Current Date</label>
                            <input type="text" class="form-control" name="prod_code"
                                value='<?php  echo date("Y-m-d"); ?>' aria-describedby="amount" readonly>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    <label for="amount" class="form-label"><b>Date Filter : </b> From</label>
                        <input type="text" id="date_min" name="min" class="form-control" placeholder="From Date" />
                    </div>
                    <div class="col-sm-3">
                    <label for="amount" class="form-label"><b></b> To</label>
                        <input type="text" id="date_max" name="max" class="form-control" placeholder="To Date" />

                    </div>
                </div>

                <hr>
                <table id="expired_table_list" class="table" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Production Code</th>
                            <th>Name</th>
                            <th>Qty Added</th>
                            <th>Remaining Quantity</th>
                            <th>Production Date</th>
                            <th>Expiration Date</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $sqlExpire = "SELECT * from production_log
                                LEFT JOIN product on production_log.prod_id = product.prod_id
                                WHERE status='EXPIRED'
                                ORDER BY log_id DESC";
                                $res = mysqli_query($con, $sqlExpire);
                                if(mysqli_num_rows($res) > 0) {
                                    while($arr = mysqli_fetch_array($res)) {
                                    $color='';
                                    if ($arr['status'] == 'EMPTY') {
                                        $color = 'danger';
                                    } else if ($arr['status'] == 'LOW') {
                                        $color = 'warning';
                                    } else if ($arr['status'] == 'ACTIVE') {
                                        $color = 'success';
                                    } else if ($arr['status'] == 'EXPIRED') {
                                        $color = 'danger';
                                    }
                                ?>
                        <tr>
                            <td><?php echo $arr['production_code']; ?></td>
                            <td><?php echo $arr['name']; ?></td>
                            <td><?php echo $arr['qty_added']; ?></td>
                            <td><?php echo $arr['qty_remaining']; ?></td>
                            <td><?php echo $arr['prod_date']; ?></td>
                            <td><?php echo $arr['exp_date']; ?></td>
                            <td>₱ <?php echo number_format($arr["cost"],2); ?></td>
                            <td>₱ <?php echo number_format($arr["price"],2); ?></td>
                            <td><span
                                    class="badge bg-<?php echo $color; ?> text-white"><?php echo $arr["status"]; ?></span>
                            </td>
                        </tr>
                        <?php
                                }
                            } else {
                            ?>
                        <tr>
                            <td colspan="9">No records found</td>
                        </tr>
                        <?php
                                    }
                                    ?>
                    </tbody>
                </table>




                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

