<?php 
session_start();
include '../connections/connect.php';

if(!isset($_SESSION['admin_id'])){
  header('location:../log/signin.php');
}
 ?>
 <?php include 'head.php' ?>
<?php include 'navbar.php' ?>
<!DOCTYPE html>
<html>


<body style="background-color: white">
    <div class="wrapper">
<br><br>

    <section class="home-section">
        
    
                <div class="container-fluid">

                    <h5 style="font-weight: bolder;">SALES</h5>
                    <hr>
                    <div class="card shadow-sm" style="">
                        <div class="card-body">



                            <script>
                            window.onload = function() {

                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light2",
                                    title: {
                                        text: ""
                                    },
                                    data: [{
                                        type: "line",
                                        indexLabelFontSize: 16,
                                        dataPoints: [

                                            /* { y: 414},
                                             { y: 520, indexLabel: "\u2191 highest",markerColor: "red", markerType: "triangle" },
                                             { y: 460 },
                                             { y: 450 },
                                             { y: 500 },
                                             { y: 480 },
                                             { y: 480 },
                                             { y: 410 , indexLabel: "\u2193 lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
                                             { y: 500 },
                                             { y: 480 },*/
                                            <?php 
          $stats = " select * from trans_record  ";
                      $gstat = mysqli_query($con,$stats); 
                   
                  
                       while($st = mysqli_fetch_array($gstat)){
                      ?> {
                                                y: <?php echo $st['total'] ?>
                                            },
                                            <?php
                       }
                

       ?>



                                        ]
                                    }]
                                });
                                chart.render();

                            }
                            </script>

                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>




                        </div>

                    </div>

                    <div class="card shadow-sm mt-3">
                        <div class="card-body">

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">

                                        <div class="row">
                                            <div class="col-sm-5"><input type="date" id="d1" name=""
                                                    class="form-control"></div>
                                            <div class="col-sm-1">To</div>

                                            <div class="col-sm-5"> <input type="date" id="d2" name=""
                                                    class="form-control"></div>

                                        </div>



                                    </div>
                                    <div class="col-md-2"></div>

                                </div>



                            </div>

                            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script type="text/javascript">
                            $(document).ready(function() {
                                $('#d2').change(function() {
                                    var d1 = $('#d1').val();
                                    var d2 = $(this).val();

                                    if (d1 == '') {
                                        Swal.fire(
                                            'Invalid Selection',
                                            'Please fill all fields on filtering',
                                            'error'
                                        )
                                    } else {

                                        window.location.href = 'sales.php?sort&d1=' + d1 + '&d2=' + d2;


                                    }
                                })
                            });
                            </script>



                        </div>

                    </div>

                    <div class="card shadow-sm mt-3">
                        <div class="card-body">

                            <div class="container">

                                <?php 
  if(isset($_GET['sort'])){
    $d1 = $_GET['d1'];
    $d2 = $_GET['d2'];
      ?>
                                <h6 style="font-weight: bolder;" id="defaultsort"> Sorting from
                                    <?php echo date('F j, Y',strtotime($d1))  ?> to
                                    <?php echo date('F j, Y',strtotime($d2))  ?> </h6>

                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order_no</th>
                                                <th scope="col">Date-Ordered</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Amount Paid</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
    date_default_timezone_set('Asia/Manila'); 
    $datenow = date('Y-m-d');
          $getorders = " select * from trans_record where  date_ordered BETWEEN '$d1' AND '$d2' ";
                      $gettingor = mysqli_query($con,$getorders); 
                      $countorders= mysqli_num_rows($gettingor);
                     //  $get_id =  mysqli_insert_id($con); 
                   if ($countorders>=1){
                  
                       while($row = mysqli_fetch_array($gettingor)){
                        $user = $row['user_id'];
                        $pid = $row['prod_id'];
                        $total[] = $row['total'];
                
                                              $disc = $row['disc'];
                      ?>
                                            <tr>
                                                <th scope="row"><?php echo 'MN_'.$row['order_id'] ?></th>
                                                <td><?php echo date('F j,Y',strtotime($row['date_ordered'])) ?></td>
                                                <td><?php
                        $gettingusername = " select * from accounts where user_id = '$user'  ";
                                    $guser = mysqli_query($con,$gettingusername); 
                                  
                                
                                     while($ue = mysqli_fetch_array($guser)){
                                      echo $ue['name'].' '.$ue['lastname'];
                                     }
                              
                     ?></td>
                                                <td>
                                                    <?php 
                          $gettingproduct = " select * from product where prod_id = '$pid' ";
                                      $gprod = mysqli_query($con,$gettingproduct); 
                                   
                                  
                                       while($pp = mysqli_fetch_array($gprod)){
                                        echo $pp['name'];
                                       }
                                
                       ?>
                                                </td>
                                                <td><?php echo $row['quantity'] ?></td>
                                                <td>₱<?php echo $row['total'] ?></td>
                                                <td>₱<?php echo $row['total'] ?></td>
                                            </tr>

                                            <tr>

                                                <?php
                       }

                       ?>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                              
                                                
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <h6 style="font-weight: bold; float: right;">TOTAL:</h6>
                                                </td>
                                                <td>
                                                    <h5 style="font-weight: bold; "> ₱
                                                        <?php 
                              if(isset($total)){
                               
                                   if(isset($disc)){
                                       if(isset($dfee)){
                                     echo array_sum($total) - $disc;
                                  }else {
                                    echo array_sum($total) - $disc;


                                  }
                                      }else {
                                        
                                         if(isset($dfee)){
                                     echo array_sum($total);
                                  }else {
                                    echo array_sum($total);


                                  }
                                      }
                                  
                              }else {
                                echo '0';
                              }
                               ?>


                                                    </h5>
                                                </td>


                                            </tr>
                                            <?php
                }else {
                  ?>

                                            <tr>
                                                <td colspan="7">
                                                    <h6 style="text-align: center;font-weight: bolder;">No orders yet..
                                                    </h6>
                                                </td>
                                            </tr>

                                            <?php
                }

     ?>




                                        </tbody>
                                    </table>
                                </div>
                                <?php
  }else {
    ?>
                                <h6 id="defaultsort"> As of today <?php echo date('F j, Y') ?></h6>

                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order_no</th>
                                                <th scope="col">Date-Ordered</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Amount Paid</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
    date_default_timezone_set('Asia/Manila'); 
    $datenow = date('Y-m-d');
          $getorders = " select * from trans_record where date_ordered = '$datenow'  ";
                      $gettingor = mysqli_query($con,$getorders); 
                      $countorders= mysqli_num_rows($gettingor);
                     //  $get_id =  mysqli_insert_id($con); 
                   if ($countorders>=1){
                  
                       while($row = mysqli_fetch_array($gettingor)){
                        $user = $row['user_id'];
                        $pid = $row['prod_id'];
                        $total[] = $row['total'];
                          $dfee = $row['dfee'];
                                              $disc = $row['disc'];
                      ?>
                                            <tr>
                                                <th scope="row"><?php echo 'MN_'.$row['order_id'] ?></th>
                                                <td><?php echo date('F j,Y',strtotime($row['date_ordered'])) ?></td>
                                                <td><?php
                        $gettingusername = " select * from accounts where user_id = '$user'  ";
                                    $guser = mysqli_query($con,$gettingusername); 
                                  
                                
                                     while($ue = mysqli_fetch_array($guser)){
                                      echo $ue['name'].' '.$ue['lastname'];
                                     }
                              
                     ?></td>
                                                <td>
                                                    <?php 
                          $gettingproduct = " select * from product where prod_id = '$pid' ";
                                      $gprod = mysqli_query($con,$gettingproduct); 
                                   
                                  
                                       while($pp = mysqli_fetch_array($gprod)){
                                        echo $pp['name'];
                                       }
                                
                       ?>
                                                </td>
                                                <td><?php echo $row['quantity'] ?></td>
                                                <td>₱<?php echo $row['total'] ?></td>
                                                <td>₱<?php echo $row['total'] ?></td>
                                            </tr>

                                            <tr>

                                                <?php
                       }

                       ?>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                
                                                
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <h6 style="font-weight: bold; float: right;">TOTAL:</h6>
                                                </td>
                                                <td>
                                                    <h5 style="font-weight: bold; "> ₱
                                                        <?php 
                              if(isset($total)){
                               
                                   if(isset($disc)){
                                       if(isset($dfee)){
                                     echo array_sum($total)- $disc;
                                  }else {
                                    echo array_sum($total) - $disc;


                                  }
                                      }else {
                                        
                                         if(isset($dfee)){
                                     echo array_sum($total);
                                  }else {
                                    echo array_sum($total);


                                  }
                                      }
                                  
                              }else {
                                echo '0';
                              }
                               ?>


                                                    </h5>
                                                </td>


                                            </tr>
                                            <?php
                }else {
                  ?>

                                            <tr>
                                                <td colspan="7">
                                                    <h6 style="text-align: center;font-weight: bolder;">No orders yet..
                                                    </h6>
                                                </td>
                                            </tr>

                                            <?php
                }

     ?>




                                        </tbody>
                                    </table>
                                </div>
                                <?php
  }


 ?>

                            </div>


                        </div>

                    </div>

                    <p><br><br></p>


                </div>



            </div>





        </section>

    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript" src="../js/sidebar.js?v=1"></script>




    <!--Bootstrap Plugins-->
    <script type="text/javascript" src="../js/notify.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/popper.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>

</html>