<?php
session_start();
include "../connections/connect.php";
if (!isset($_SESSION["admin_id"])) {
    header("location:../log/signin.php");
}
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
<link rel='stylesheet' href='css/dataTables.dateTime.min.css'>


<link rel='stylesheet' href='css/tab-orders.css'>

<style>
.pending {
    /* Set the background color and border */
    background-color: #FDC96F;
    border-radius: 10px;
    border: 1px solid #6c757d;

    /* Set the font size and color */
    font-size: 13px;
    color: black;

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

<body style="background-color: white">
    <div class="wrapper">



        <?php include "navbar.php"; ?>



        <section class="home-section">


            <div class="container-fluid">
                <div class="wrapper" id="myTab">
                    <input type="radio" name="slider" id="home" checked>
                    <input type="radio" name="slider" id="blog"
                        <?php if ($tab == '2') { echo 'checked'; } else { echo ''; } ?>>
                    <input type="radio" name="slider" id="code"
                        <?php if ($tab == '3') { echo 'checked'; } else { echo ''; } ?>>
                    <input type="radio" name="slider" id="help"
                        <?php if ($tab == '4') { echo 'checked'; } else { echo ''; } ?>>
                    <input type="radio" name="slider" id="cancel"
                        <?php if ($tab == '5') { echo 'checked'; } else { echo ''; } ?>>

                    <input type="radio" name="slider" id="about"
                        <?php if ($tab == '6') { echo 'checked'; } else { echo ''; } ?>>
                    <nav>
                        <label for="home" class="home"><i class="fa fa-book"></i>New Orders</label>
                        <label for="blog" class="blog"><i class="fas fa-tasks"></i>Preparing</label>
                        <label for="code" class="code"><i class="fa-solid fa-truck"></i> On Delivery</label>
                        <label for="help" class="help"><i class="fa-solid fa-check"></i> Completed</label>
                        <label for="cancel" class="cancel"><i class="fa-solid fa-times"></i> Cancelled</label>
                        <label for="about" class="about"><i class="fa-solid fa-undo"></i> Returns</label>

                        <div class="slider"></div>
                    </nav>
                    <section>
                        <div class="content content-1">
                            <hr>
                            <div class="title">New Order</div>

                            <?php include('pages/orders.php') ?>

                        </div>
                        <div class="content content-2">
                            <hr>
                            <div class="title">Preparing</div>
                            <?php include('pages/preparing.php') ?>

                        </div>
                        <div class="content content-3">
                            <hr>
                            <div class="title">On Delivery</div>

                            <?php include('pages/deliver.php') ?>

                        </div>
                        <div class="content content-4">
                            <hr>
                            <div class="title">Completed</div>
                            <?php include('pages/completed.php') ?>

                        </div>
                        <div class="content content-5">
                            <hr>
                            <div class="title">Cancelled</div>

                            <?php include('pages/cancel.php') ?>
                        </div>
                        <div class="content content-6">
                            <hr>
                            <div class="title">Returns</div>

                            <?php include('pages/return.php') ?>

                        </div>

                    </section>
                </div>

            </div>
    </div>


    </section>
</body>



</html>

<script type="text/javascript">
$(document).ready(function() {
    $('#production_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

    });


    $('#preparing_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

    });


    $('#ondelivery_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

    });

    $('#completed_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

    });
    $('#cancelled_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

    });


    $('#returned_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

    });

    var max_fields = 10;
    var wrapper = $(".input_fields_wrap");
    var add_button = $(".add_field_button");
    var remove_button = $(".remove_field_button");

    $(add_button).click(function(e) {
        e.preventDefault();
        var total_fields = wrapper[0].childNodes.length;
        if (total_fields < max_fields) {
            $(wrapper).append(
                '<br><input type="text" name="ingredients[]" placeholder="Ingredient" class="form-control field-long" />'
            );
        }
    });
    $(remove_button).click(function(e) {
        e.preventDefault();
        var total_fields = wrapper[0].childNodes.length;
        if (total_fields > 1) {
            wrapper[0].childNodes[total_fields - 1].remove();
        }
    });



});
</script>

<script type="text/javascript" src="../js/sidebar.js?v=1"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" type="text/css" href="../js/datatable/datatables.css">
<!--Bootstrap Plugins-->
<script type="text/javascript" src="../js/notify.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/popper.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
<script type="text/javascript"  src="js/dataTables.dateTime.min.js"></script>
<script type="text/javascript"  src="js/moment.min.js"></script>
<?php include('orders_script.php') ?>

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