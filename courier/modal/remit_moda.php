<div class="modal fade" id="promptRemit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="receivingViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receivingViewLabel">Remit Cash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='POST' action='function/cash_remit.php'>
                    <div class="row">
                        <input type='text'  name='prev_total_remit'  value="<?php echo number_format($total_remit); ?>"> 
                        <div class="col-sm">
                            <label> Rider Name </label> <br>
                            <input id='p_name' value='<?php echo $rider_name?>' class='form-control'
                                style='font-size:25px;border: none;font-weight:bold;text-align:center' readonly>
                        </div>

                        <div class="col-sm">
                            <label> Rider ID</label> <br>
                            <input name='user_id' class='form-control' value='#<?php echo $courier_id?>'
                                style='font-size:25px;border: none;font-weight:bold;text-align:center' readonly>
                        </div>
                    </div>
                    <hr>


                    <div class="row">
                        <div class="col-sm">
                            <label>Date </label> <br>
                            <input name='datenow' class='form-control' value='<?php echo $dateNow?>'
                                style='font-size:25px;border: none;font-weight:bold;text-align:center' readonly>
                        </div>

                        <div class="col-sm">
                            <label> Total Amount Delivered Today</label> <br>
                            <input id='r_total_amount' class='form-control'
                                value="₱ <?php echo number_format($total_amount); ?>"
                                style='font-size:25px;border: none;font-weight:bold;text-align:center' readonly>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm">
                            <label>Cash on Hand </label> <br>
                            <input class='form-control' id='r_cash_onhand' name='prev_cash_onhand'
                                value="₱ <?php echo  number_format($cash_on_hand); ?>"
                                style='font-size:30px;border: none;font-weight:bold;text-align:center' readonly>
                        </div>

                        <div class="col-sm">
                            <label>Cash Remit</label> <br>
                            <input id='r_cash_remit' name='cash_remit' class='form-control' value='' required
                                style='font-size:30px;font-weight:bold;text-align:center;background-color: #DAF6B0'>
                        </div>
                    </div>

                    <hr>
                    <label>Remaining Cash on Hand</label> <br>
                    <input id='r_cash_remain' name='cash_remaining' class='form-control'
                        value="₱ <?php echo  number_format($cash_on_hand); ?>"
                        style='font-size:35px;border: none;font-weight:bold;text-align:center; background-color: #F3FFCB;'
                        readonly>





            </div>
            <div class="modal-footer">

                <button type="submit" name='submit' class="btn btn-success">Remit Cash</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
$(function() {
    $("#r_cash_remit").keyup(function() {

        cash_onhand = $('#r_cash_onhand').val().replace(/[^0-9.]/g, "");
        cash_remit = $('#r_cash_remit').val().replace(/[^0-9.]/g, "");

        remaining = parseFloat(+cash_onhand) - (parseFloat(+cash_remit))

        document.getElementById("r_cash_remain").value = ('₱ ' + remaining);

    });
});
</script>