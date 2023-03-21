<?php 
session_start();
include '../connections/connect.php';

if(!isset($_SESSION['admin_id'])){
  header('location:../log/signin.php');
}
 ?>
<!DOCTYPE html>
<html>

<?php include 'head.php';
   date_default_timezone_set('Asia/Manila');
 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style>
.stretched-link::after {
    position: absolute;
    top: 0;
    PENDING right: 0;
    bottom: 0;
    left: 0;
    pointer-events: auto;
    content: "";

}
</style>

<body style="background-color: white">
    <div class="wrapper">



        <?php include 'navbar.php' ?>


        <section class="home-section">


            <br> <br>


            <div class="container">
                <div class="row">
                    <div class="col-sm-10">
                        <h5 style="font-weight: bolder;">DASHBOARD</h5>
                    </div>
                    <div class="col-sm-2"> <button type='button' class='btn btn-success getData' id='getData'>
                            Print Data</button></div>
                </div>


                <hr>

                <div class="row mb-4">

                    <div class="col-md-4">
                        <div class="card shadow border-warning">
                            <div class="card-body">
                                <a href="accounts.php" class="stretched-link"></a>
                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    REGISTERED CUSTOMERS <br>
                                    <?php 
                                $ccustomers = " select * from accounts  ";
                                            $ccustom = mysqli_query($con,$ccustomers); 
                                            $allcustomers= mysqli_num_rows($ccustom);
                                    echo $allcustomers;      
                             ?>

                                </h5>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="card shadow border-success">
                            <div class="card-body">
                                <a href="accounts.php" class="stretched-link"></a>
                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    TOTAL RIDERS <br>
                                    <?php 
                                $ccustomers = " select * from accounts where user_type='courier'  ";
                                            $ccustom = mysqli_query($con,$ccustomers); 
                                            $allcustomers= mysqli_num_rows($ccustom);
                                    echo $allcustomers;      
                             ?>

                                </h5>
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">
                        <div class="card shadow border-danger">
                            <div class="card-body">
                                <a href="distributor_record.php" class="stretched-link"></a>
                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    No. of Distributor <br>

                                    <?php 
                                $cproducts = " select * from distributor_details ";
                                            $countproduct = mysqli_query($con,$cproducts); 
                                            $allproducts= mysqli_num_rows($countproduct);
                                        echo $allproducts;   

                             ?>

                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- SECOND ROW -->
                <div class="row mb-4">

                    <div class="col-md-4">
                        <div class="card shadow border-warning">
                            <div class="card-body">
                                <center>
                                    <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                        Total Sales Today <br>


                                        <?php 
                                    $current_date = date('F d, Y');
                                $total_today  = mysqli_query($con, "SELECT  sum(transaction.total_amount) as total from transaction
                                where DATE(datecreated) = CURDATE();");
                                $total_today = mysqli_fetch_array($total_today);
                                echo  '₱ '.number_format($total_today['total'],2);  ?>
                                    </h5>
                                    <?php echo $current_date?>
                                </center>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow border-success">
                            <div class="card-body">
                                <a href="accounts.php" class="stretched-link"></a>
                                <center>
                                    <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                        Total Website Visits <br>

                                        <?php  $current_date = date(' Y');
                             $sql = " select * from traffic_log  ";
                               $sql = mysqli_query($con,$sql); 
                             $visits= mysqli_num_rows($sql);
                                 echo $visits;      
                                        ?>

                                    </h5>
                                    <?php echo $current_date?>
                            </div>
                            </center>
                        </div>

                    </div>


                    <div class="col-md-4">
                        <div class="card shadow border-danger">
                            <div class="card-body">
                                <a href="products.php" class="stretched-link"></a>
                                <center>
                                    <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                        Total Walkin Transaction<br>

                                        <?php 
                                     $cproducts = " SELECT count(*) FROM production_log WHERE production_log.status ='LOW' ";
                                    $countproduct = mysqli_query($con,$cproducts); 
                                 $allproducts= mysqli_num_rows($countproduct);
                                   echo $allproducts;   
                                  ?>

                                    </h5>
                                    <?php echo $current_date?>
                            </div>
                            </center>
                        </div>

                    </div>


                </div>
                <!-- third column -->

                <div class="row">

                    <div class="col">
                        <div class="card shadow border-dark">
                            <div class="card-body">
                                <a href="orders.php?tab=1" class="stretched-link"></a>
                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    NEW ORDERS <br>
                                    <span class="badge bg-secondary text-white">
                                        <?php 
                        $corders = " select * from transaction where status='pending'  ";
                        $countord = mysqli_query($con,$corders); 
                        $allorders= mysqli_num_rows($countord);
                         echo $allorders;     

                            ?>
                                </h5>
                            </div>

                        </div>

                    </div>

                    

                    <div class="col">
                        <div class="card shadow border-dark">
                            <div class="card-body">
                                <a href="orders.php?tab=3" class="stretched-link"></a>
                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    ON DELIVERY <br>
                                    <span class="badge bg-primary">
                                        <?php 
                                $corders = " select * from transaction where status='otw'  ";
                                $countord = mysqli_query($con,$corders); 
                                $allorders= mysqli_num_rows($countord);
                                echo $allorders;      
                             ?>

                                </h5>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="col">
                        <div class="card shadow border-dark">
                            <div class="card-body">
                                <a href="orders.php?tab=6" class="stretched-link"></a>
                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    RETURN ORDERS <br>
                                    <span class="badge bg-success">
                                        <?php 
                                $corders = " select * from return_request   ";
                                $countord = mysqli_query($con,$corders); 
                                $allorders= mysqli_num_rows($countord);
                                echo $allorders;      
                             ?>
                                    </span>
                                </h5>
                            </div>

                        </div>

                    </div>
                    <div class="col">
                        <div class="card shadow border-dark">
                            <div class="card-body">
                                <a href="orders.php?tab=5" class="stretched-link"></a>
                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                    CANCELLED ORDER <br>
                                    <span class="badge bg-danger">
                                        <?php 
                                $corders = " select * from transaction where status='cancelled'  ";
                                $countord = mysqli_query($con,$corders); 
                                $allorders= mysqli_num_rows($countord);
                                echo $allorders;      
                             ?>
                                    </span>
                                </h5>
                            </div>

                        </div>

                    </div>
                    <div class="col">
                        <div class="card shadow border-dark">
                            <div class="card-body">
                                <a href="product_reviews.php" class="stretched-link"></a>
                                <h5 style="font-weight: bolder;text-align: center;" class="text-dark">
                                     PRODUCT REVIEWS<br> <span class="badge bg-warning text-dark">
                                        <?php 
                            $corders = " select * from review_table  ";
                            $countord = mysqli_query($con,$corders); 
                            $allorders= mysqli_num_rows($countord);
                            echo $allorders;      
                        ?> </span>
                                </h5>

                            </div>

                        </div>

                    </div>



                </div>
                <br>
                <div id='div_print'>
                    <div class="row">
                        <div class="col-4">
                            <div class="card" style="width:100%;max-width:100%;max-height:251px;">
                                <canvas id="sales_trend" style="width:100%;max-width:100%;max-height:251px;"></canvas>
                            </div>
                        </div>

                        <!-- end INCOME CHART -->
                        <div class="col-4">
                            <div class="card" style="width:100%;max-width:100%;max-height:251px;">
                                <canvas id="purchase_chart" style="width:100%;max-width:100%;max-height:251px;">
                                </canvas>
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
                    <div class="card shadow-sm" style="">
                        <div class="card-body">

                            <?php 

                        $getcat = " select * from category  ";
                                    $gcat = mysqli_query($con,$getcat); 
                                    $countcat= mysqli_num_rows($gcat);
                                


                                ?>
                            <script>
                            window.onload = function() {

                                var chart = new CanvasJS.Chart("chartContainer", {
                                    exportEnabled: true,
                                    animationEnabled: true,
                                    title: {
                                        text: "Data Statistics"
                                    },
                                    legend: {
                                        cursor: "pointer",
                                        itemclick: explodePie
                                    },
                                    data: [{
                                        type: "pie",
                                        showInLegend: true,
                                        toolTipContent: "{name}: <strong>{y}%</strong>",
                                        indexLabel: "{name} - {y}%",
                                        dataPoints: [{
                                                y: <?php echo $allproducts ?>,
                                                name: "Product",
                                                exploded: true
                                            },
                                            {
                                                y: <?php echo $allcustomers ?>,
                                                name: "Customers"
                                            },
                                            {
                                                y: <?php echo $allorders ?>,
                                                name: "Sales"
                                            },
                                            {
                                                y: <?php echo $countcat ?>,
                                                name: "Categories"
                                            }

                                        ]
                                    }]
                                });
                                chart.render();
                            }

                            function explodePie(e) {
                                if (typeof(e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e
                                    .dataSeries.dataPoints[e.dataPointIndex].exploded) {
                                    e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
                                } else {
                                    e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
                                }
                                e.chart.render();

                            }
                            </script>

                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>



                        </div>
                        <br>


                    </div>
                    <br>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
                        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

                    <figure class="highcharts-figure">
                        <div id="container"></div>

                    </figure>

                    <br>
                    <div class="row">
                        <div class="col-4">
                            <!-- <div class="card" style="width:100%;max-width:100%;max-height:251px;">
                            <canvas id="income_chart" style="width:100%;max-width:100%;max-height:251px;">
                            </canvas>
                        </div> -->
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


                <?php include ('dashboard_chart.php'); ?>
            </div>

        </section>

    </div>

    <?php
    
 
    ?>
    <script>
  
    </script>


    <script type="text/javascript" src="../js/sidebar.js?v=1"></script>

    <script>
    var current_date = new Date();

    // Set the time of day to run the code (e.g. midnight)
    var run_time = new Date(current_date.getFullYear(), current_date.getMonth(), current_date.getDate(), 0, 0, 0);

    // Check if it is after the specified time of day
    if (current_date > run_time) {
        // Run the code
        console.log('first code run');

        $.ajax({
            type: "POST",
            url: "fetch/check_expiration.php",

            success: function(data) {
                console.log(data)
            }
        });
        // Set the flag to prevent the code from running again
        var code_ran = true;
    }

    // Check if the code has already run
    if (!code_ran) {
        // Run the code
        console.log('first code again');
        // Set the flag to prevent the code from running again
        var code_ran = true;
    }
    </script>

    <script language="javascript">
    $('.getData').on('click', function() {
        console.log('hello');
        // html2canvas(document.querySelector("#div_print")).then(canvas => {
        //     document.body.appendChild(canvas);
        //     document.print();
        //     // reload the page
        //     location.reload();
        // });
        html2canvas(document.querySelector("#div_print")).then(canvas => {
            var myImage = canvas.toDataURL("image/png");
            var tWindow = window.open("");
            $(tWindow.document.body)
                .html("<img id='Image' src=" + myImage + " style='width:100%;'></img>")
                .ready(function() {
                    tWindow.focus();
                    tWindow.print();
                });
        });


    });
    </script>



    <!--Bootstrap Plugins-->
    <script type="text/javascript" src="../js/notify.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/popper.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>


<?php include('footer.php') ?>

</html>