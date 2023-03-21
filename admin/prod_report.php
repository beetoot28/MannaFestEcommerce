<?php 
session_start();
include '../connections/connect.php';

if(!isset($_SESSION['admin_id'])){
  header('location:../log/signin.php');
}

$tab= '';
if (isset($_GET['tab'])) {
    $tab = filter_var($_GET['tab']) ;
  }
  date_default_timezone_set('Asia/Manila'); 
 ?>
<!DOCTYPE html>
<html>





<?php include 'head.php' ?>


<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel='stylesheet' href='css/tab-report.css'>
<link rel='stylesheet' href='css/dataTables.dateTime.min.css'>


<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>


<body style="background-color: white">
  



        <?php include 'navbar.php' ?>


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
                    <!--  <input type="radio" name="slider" id="about"
                        <?php if ($tab == '5') { echo 'checked'; } else { echo ''; } ?>> -->
                    <nav>
                        <label for="home" class="home"><i class="fa fa-book"></i>Summary Report</label>
                        <label for="blog" class="blog"><i class="fas fa-tasks"></i>Sales Report</label>
                        <label for="code" class="code"><i class="fa-solid fa-truck"></i>Product Report</label>
                        <label for="help" class="help"><i class="fa-solid fa-check"></i> Returns And Cancelled
                            Orders</label>
                        <!-- <label for="about" class="about"><i class="fa-solid fa-undo"></i> Others</label> -->

                        <div class="slider"></div>
                    </nav>
                    <section>
                        <div class="content content-1">
                            <hr>
                            <div class="title">Summary for 2023</div>
                            <?php include('reportPage/summary.php');?>
                        </div>
                        <div class="content content-2">
                            <hr>
                            <div class="title">Sales Report</div>
                            <?php include('reportPage/sale_rep.php');?>
                        </div>
                        <div class="content content-3">
                            <hr>
                            <div class="title">Product Reports</div>
                            <?php include('reportPage/product_sales.php');?>
                        </div>
                        <div class="content content-4">
                            <hr>
                            <div class="title">Returns And Cancelled Orders</div>
                            <?php include('reportPage/return_cancel.php');?>
                        </div>
                        <!--<div class="content content-5">
                            <hr>
                            <div class="title">Others</div>
                        </div> -->

                    </section>
                </div>

            </div>

    </section>
    <script type="text/javascript" src="../js/sidebar.js?v=1"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../js/datatable/datatables.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/datatable/datatables.css">
    <!--Bootstrap Plugins-->
    <script type="text/javascript" src="../js/notify.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/popper.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>






    <?php include ('dashboard_chart.php'); ?>



</body>



</html>