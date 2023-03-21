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
    font-weight:bold;

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



    <section class="home-section">

        <br><br>
        <div class="container-fluid">
            <div class="wrapper" id="myTab">
                <input type="radio" name="slider" id="home" checked>
                <input type="radio" name="slider" id="blog"
                    <?php if ($tab == '2') { echo 'checked'; } else { echo ''; } ?>>
                    <input type="radio" name="slider" id="code"
                    <?php if ($tab == '3') { echo 'checked'; } else { echo ''; } ?>>


                <nav>
                    <label for="home" class="home"><i class="fa fa-book"></i>Pending Delivery</label>
                    <label for="blog" class="blog"><i class="fas fa-tasks"></i>Delivered</label>
                    <label for="code" class="code"><i class="fas fa-times"></i>Cancelled</label>


                    <div class="slider"></div>
                </nav>
                <section>
                    <div class="content content-1">
                        <hr>
                        <div class="title">Pending Delivery : <?php echo $rider_name?></div>
                        <?php include('pages/pending.php')?>

                    </div>
                    <div class="content content-2">
                        <hr>
                        <div class="title">Delivered</div>
                        <?php include('pages/delivered.php')?>


                    </div>
                    <div class="content content-3">
                        <hr>
                        <div class="title">Cancelled</div>
                        <?php include('pages/cancel.php')?>


                    </div>


                </section>
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


<?php if (isset($_SESSION['confirmed_order'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Order Accepted!',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php 
			unset($_SESSION['confirmed_order']);
		?>
</div>
<?php endif ?>

<?php if (isset($_SESSION['deliver_order'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'The order has been processed for delivery.',
        timer: 1500
    })
    </script>
    <?php 
			unset($_SESSION['deliver_order']);
		?>
</div>
<?php endif ?>