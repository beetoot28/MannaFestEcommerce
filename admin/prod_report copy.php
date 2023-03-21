<?php 
session_start();
include '../connections/connect.php';

if(!isset($_SESSION['admin_id'])){
  header('location:../log/signin.php');
}
 ?>
<!DOCTYPE html>
<html>





<?php include 'head.php' ?>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>


<body style="background-color: white">
    <div class="wrapper">



        <?php include 'navbar.php' ?>


        <section class="home-section">



            <div class="main_contents">
                <div class="container">

                    <h5 style="font-weight: bolder;">REPORT</h5>
                    <hr>




                    <div class="row">
                        <div class="col-4">
                            <div class="card" style="width:100%;max-width:100%;max-height:251px;">
                                <canvas id="net_income" style="width:100%;max-width:100%;max-height:251px;"></canvas>
                            </div>
                        </div>

                        <!-- end INCOME CHART -->
                        <div class="col-4">
                            <div class="col-3" style="width:100%;max-width:100%;max-height:270px;">
                                <div class="card" style="width:100%;max-width:100%;max-height:270px;">
                                    <br>
                                    <center>
                                        <h5 style="font-weight: bolder;">Top Selling Product</h5>
                                    </center>
                                    <?php 
                   
                                         $side = mysqli_query($con, "SELECT trans_record.prod_id,name,sum(quantity) as qty from trans_record LEFT JOIN product on trans_record.prod_id = product.prod_id group by name");?>
                                    <table class="table table-hover">
                                        <thead class='table-dark'>
                                            <tr>
                                                <th scope="col">Product </th>
                                                <th scope="col">Quantity Sold</th>
                                            </tr>
                                        </thead> <?php 
                                         while ($row = mysqli_fetch_array($side)) { ?> <tbody>
                                            <tr>
                                                <td> <?php echo $row['name']?> </td>
                                                <td> <?php echo $row['qty']?> </td>
                                            </tr> <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card" style="width:100%;max-width:100%;max-height:210px;">
                                <canvas id="inventory_chart"
                                    style="width:100%;max-width:100%;max-height:251px;"></canvas>
                            </div>
                        </div>
                    </div>

                    <br>


                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
                        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


                    <div class="row">
                        <div class="col-4">
                            <div class="card" style="width:100%;max-width:100%;max-height:251px;">
                                <canvas id="income_chart" style="width:100%;max-width:100%;max-height:251px;">
                                </canvas>
                            </div>
                        </div>

                        <!-- end INCOME CHART -->
                        <div class="col-4">
                            <div class="card" style="width:100%;max-width:100%;max-height:251px;">
                                <canvas id="gross_chart" style="width:100%;max-width:100%;max-height:251px;">
                                </canvas>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card" style="width:100%;max-height:251px;">
                                <canvas id="opex_chart" style="width:100%;max-width:100%;max-height:251px;">
                                </canvas>
                            </div>
                        </div>
                    </div>



                </div>

        </section>

    </div>


    <script type="text/javascript" src="../js/sidebar.js?v=1"></script>


    <?php include ('dashboard_chart.php'); ?>




    <!--Bootstrap Plugins-->
    <script type="text/javascript" src="../js/notify.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/popper.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>


<?php include('footer.php') ?>

</html>