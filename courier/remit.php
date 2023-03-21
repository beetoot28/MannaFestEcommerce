<?php
session_start();
include "../connections/connect.php";
if (!isset($_SESSION["cour_id"])) {
    header("location:../log/signin.php");
}
 $courier_id = $_SESSION["cour_id"];

$sql  = mysqli_query($con, "SELECT *  from accounts where user_id='$courier_id'");
$users_row = mysqli_fetch_array($sql);
$rider_name = $users_row['name'].' '.$users_row['lastname'];
$rider_contact = $users_row['mobile_number'];

$dateNow = date("Y-m-d");


?>
<!DOCTYPE html>
<html>

<?php
include "head.php";


$tab= '';
if (isset($_GET['tab'])) {
    $tab = filter_var($_GET['tab']) ;
  }
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<link rel='stylesheet' href='css/tab.css'>
<link rel='stylesheet' href='css/nav.css'>
<style>
.pending {
    /* Set the background color and border */
    background-color: #FDC96F;
    border-radius: 10px;
    border: 1px solid #6c757d;

    /* Set the font size and color */
    font-size: 13px;
    color: black;
    font-weight: bold;

    /* Add some padding and alignment */
    padding: 5px 5px;
    text-align: center;
}

.ready_badge {
    /* Set the background color and border */
    background-color: blue;
    border-radius: 10px;
    border: 1px solid #6c757d;

    /* Set the font size and color */
    font-size: 13px;
    color: black;

    /* Add some padding and alignment */
    padding: 5px 10px;
    text-align: center;
}

.waiting {
    /* Set the background color and border */
    background-color: green;
    border-radius: 10px;
    border: 1px solid #6c757d;

    /* Set the font size and color */
    font-size: 13px;
    color: white;

    /* Add some padding and alignment */
    padding: 5px 10px;
    text-align: center;
}
</style>
<?php include "nav.php"; ?>

<body style="background-color: white">


    <?php 
  $sql = " select * from courier_trans where user_id='$courier_id'";
  $res = mysqli_query($con,$sql); 
  $arr= mysqli_fetch_array($res);

$cash_on_hand =  (!empty($arr['total_cash_onhand']) ? $arr['total_cash_onhand'] : 0); 
$total_amount =  (!empty($arr['total_amount']) ? $arr['total_amount'] : 0); 
$total_remit = (!empty($arr['total_remit']) ? $arr['total_remit'] : 0); 
?>
    <?php include "modal/remit_moda.php"; ?>
    <section class="home-section">

        <br><br>
        <div class="container-fluid">

            <div class="wrapper" id="myTab">
                <div class="row mb-3">

                    <div class="col-md-3">
                        <div class="card shadow border-success" style="background-color: #DAF6B0;">
                            <div class="card-body">

                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    TOTAL CASH ON HAND <br>
                                    <h3>
                                        <center>
                                            <?php 
                        
                          echo '₱ '.number_format($cash_on_hand);      
                                           ?>

                                        </center>
                                    </h3>
                            </div>

                        </div>

                    </div>





                    <div class="col-md-3">
                        <div class="card shadow border-success" style="background-color: #F6B6B1;">
                            <div class="card-body">

                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    TOTAL DELIVERY AMOUNT<br> </h5>
                                <h3>
                                    <center>
                                        <?php 
                                 echo '₱ '.number_format($total_amount);      
                                           ?>

                                    </center>
                                </h3>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="card shadow border-success" style="background-color: #80F0FF;">
                            <div class="card-body">

                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    TOTAL CASH REMITTED TODAY <br>
                                    <h3>
                                        <center>
                                            <?php 
                          echo '₱ '.number_format($total_remit);      
                                           ?>

                                        </center>
                                    </h3>
                            </div>

                        </div>

                    </div>







                </div>

                <h2>Remit Cash Record</h2>
                <hr>
                <center>

                    <h4> <?php echo $rider_name?> </h4>
                    <H6> Rider Name <h6>
                </center>
                <hr>

                <button class="btn btn-dark  btn-lg text-white mb-2 btnRemitCash" style="font-size: 14px;">REMIT CASH <i
                        class="fas fa-plus-circle"></i></button>
                <br>
                <?php $results  = mysqli_query($con, " SELECT * FROM `courier_trans`
                LEFT JOIN accounts on courier_trans.user_id =accounts.user_id 
                where courier_trans.user_id='$courier_id' "); ?>
                <table id="production_table" class="table table-hover" style="width:100%;">
                    <thead class="table-warning">
                        <tr style='font-size:14px'>

                            <th>Date</th>
                            <th>Rider Name</th>
                            <th>Total Amount</th>
                            <th>Total Cash Remit</th>
                            <th>Cash Onhand</th>
                        </tr>
                    </thead>
                    <tbody style='font-size:20px;font-weight:bold'>
                        <?php while ($row = mysqli_fetch_array($results)) {
                         ?>
                        <tr>

                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $rider_name ?></td>

                            <td>₱ <?php echo number_format($row['total_amount'],2) ?></td>
                            <td>₱ <?php echo number_format($row['total_remit'],2); ?></td>
                            <td>₱ <?php echo number_format($row['total_cash_onhand'],2); ?></td>

                        </tr>

                        <?php } ?>
                    </tbody>
                </table>


            </div>

        </div>

    </section>
</body>




</html>

<script type="text/javascript" src="../js/sidebar.js?v=1"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../js/datatable/datatables.js"></script>
<link rel="stylesheet" type="text/css" href="../js/datatable/datatables.css">
<!--Bootstrap Plugins-->
<script type="text/javascript" src="../js/notify.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>



<script>
$('.btnRemitCash').click(function() {

    cash_onhand = <?php echo $cash_on_hand;?>;


    if (cash_onhand == 0) {
        console.log(cash_onhand)
        Swal.fire(
            'You currently have no cash onhand!',
            'Please Complete assigned deliveries first',
            'question'
        )
    } else {
        $('#promptRemit').modal('show');
    }



})
</script>