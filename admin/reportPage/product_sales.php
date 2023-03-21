<style>
#table-prod_trends th,
td {
    font-size: 13px;
}
</style>

<center>
    <h5 style="font-weight: bolder;">Product Trend</h5>
</center>

<?php

        $retail = mysqli_query($con,"SELECT YEAR(date_ordered) AS year,MONTHNAME(date_ordered) AS month,name,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'January' THEN total END) AS JAN,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'February' THEN total END) AS FEB,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'March' THEN total END) AS MAR,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'April' THEN total END) AS APR,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'May' THEN total END) AS MAY,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'June' THEN total END) AS JUNE,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'July' THEN total END) AS JULY,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'August' THEN total END) AS AUG,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'September' THEN total END) AS SEP,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'October' THEN total END) AS OCT,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'November' THEN total END) AS NOV,
        MAX(CASE WHEN MONTHNAME(date_ordered) = 'December' THEN total END) AS DECE
        FROM trans_record   LEFT JOIN product on trans_record.prod_id = product.prod_id
        WHERE YEAR(date_ordered) = 2023 GROUP BY product.name");        
        ?>

<div class="table-responsive">
    <table id="table-prod_trends" class="table display ">
        <thead class="table-warning">
            <tr>
                <th>Product</th>
                <th>January</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>May</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Aug</th>
                <th>Sept</th>
                <th>Oct</th>
                <th>Nov</th>
                <th>Dec</th>

            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($retail)) { ?>
            <tr>
                <td><?php echo $row['name']?></td>
                <td>₱<?php echo number_format((float)$row['JAN'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['FEB'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['MAR'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['APR'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['MAY'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['JUNE'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['JULY'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['AUG'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['SEP'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['OCT'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['NOV'], 2, '.', ',');?></td>
                <td>₱<?php echo number_format((float)$row['DECE'], 2, '.', ',');?></td>



            </tr>
            <?php } ?>
        </tbody>
        <tfoot>

            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tfoot>
    </table>
    <!-- end table -->

</div>
<hr>
<div style="width:auto;height: 400px">
    <canvas id="product_sales_bar"></canvas>
</div>
<hr>
<div class="row">
    <div class="col-sm-8">

        <center>
            <h5 style="font-weight: bolder;">Production Record</h5>
        </center>


        <div class="table-responsive">
            <?php $results  = mysqli_query($con, " SELECT * FROM `product` 
                                LEFT JOIN category ON product.cat_id =  category.cat_id
                                LEFT JOIN photo ON product.prod_id =  photo.prod_id"); ?>
            <table id="table-prodrecord" class="table table-hover" style="width:100%;">
                <thead class="table-warning">
                    <tr style='font-size:14px'>
                        <th hidden>prod_id</th>
                        <th>Barcode</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Cost</th>
                        <th>Price</th>
                        <th>Total Stock</th>

                        <th>Action</th>


                    </tr>
                </thead>
                <tbody style='font-size:40px'>
                    <?php while ($row = mysqli_fetch_array($results)) {
                                            if ($row['ingredients']== ','){
                                                $row['ingredients'] = 'N/A';
                                            } 

                                            $prod_id =$row['prod_id'];
                                            $sql  = mysqli_query($con, "SELECT production_log.prod_id, sum(production_log.qty_remaining) AS quantity
                                                FROM production_log
                                                LEFT JOIN product ON product.prod_id = production_log.prod_id
                                                WHERE production_log.prod_id='$prod_id' and production_log.status ='ACTIVE' or production_log.status ='LOW'");
                                                $arr = mysqli_fetch_array($sql);
                                            ?>
                    <tr>
                        <td hidden><?php echo $row['prod_id']; ?></td>
                        <td><?php echo $row['barcode']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['category_name']; ?></td>
                        <td><?php echo $row['cost']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td>

                            <?php echo  (empty($arr['quantity'])) ? "0" : $arr['quantity']; ?>

                        </td>

                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success btn-sm text-light btnViewProdDetails"
                                    style="font-size: 12px"><i class="fas fa-eye"></i></button>

                            </div>

                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>

        </div>


        <center>
            <h5 style="font-weight: bolder;">Stock-out Record</h5>
        </center>


        <div class="table-responsive" id='table-stock_record'>
            <?php $results  = mysqli_query($con, " SELECT * FROM `transaction` 
                                LEFT JOIN trans_record on transaction.tid = trans_record.transaction_id
                                LEFT JOIN product ON trans_record.prod_id =  product.prod_id"); ?>
            <table id="stockout_table" class="table table-hover" style="width:100%;">
                <thead class="table-warning">
                    <tr style='font-size:14px'>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Barcode</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Transaction Type</th>


                    </tr>
                </thead>
                <tbody style='font-size:40px'>
                    <?php while ($row = mysqli_fetch_array($results)) {
                                       
                                            ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td><?php echo $row['date_ordered']; ?></td>
                        <td><?php echo $row['barcode']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo number_format($row['total'],2); ?></td>
                        <td><?php echo $row['type']; ?></td>

                    </tr>

                    <?php } ?>
                </tbody>

            </table>

        </div>



        <!-- end column -->
    </div>
    <div class="col-sm-4">
        <center>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label><b>Filter: From </b></label>
                    <input type="date" id="prod_min" class='form-control' name="min" placeholder="From Date" />
                </div>
                <div class="col-md-4">
                    <label><b> Filter: To </b></label>
                    <input type="date" id="prod_max" class='form-control' name="max" placeholder="To Date" />


                </div>
                <div class="col-md-2">
                    <br>
                    <button type="button" class="btn btn-success text-light filterTopProd" style='width:120px'><i
                            class="fas fa-submit"></i> Filter </button>

                </div>
            </div>

            <hr>
            <h5 style="font-weight: bolder;">Top Selling Product</h5> <br>
        </center>
        <?php

// set default values for filters
$category = '';
$year = '';
$min_date = '';
$max_date = '';

// get values from form input if present
if (isset($_GET['category'])) {
$category = $_GET['category'];
}
if (isset($_GET['year'])) {
$year = $_GET['year'];
}
if (isset($_GET['min'])) {
$min_date = $_GET['min'];
}
if (isset($_GET['max'])) {
$max_date = $_GET['max'];
}

// set up query to select transactions
$query = "SELECT  date_ordered,trans_record.prod_id,name,sum(quantity) as qty FROM trans_record 
LEFT JOIN product on trans_record.prod_id = product.prod_id 
WHERE 1=1";



// filter by date range if specified

// filter by date range if specified
if ($min_date != '' && $max_date != '') {
$query .= " AND date_ordered BETWEEN '$min_date 00:00:00' AND '$max_date 23:59:59'";
}
 $query .= " GROUP by product.name";
// execute the query
$result = mysqli_query($con, $query);
     ?>


        <table class="table table-hover">
            <thead class='table-warning'>
                <tr>
                    <th scope="col">Product </th>
                    <th scope="col">Date </th>
                    <th scope="col">Quantity Sold</th>
                </tr>
            </thead> <?php 
                                         while ($row = mysqli_fetch_array($result)) { ?> <tbody>
                <tr>
                    <td> <?php echo $row['name']?> </td>
                    <td> <?php echo $row['date_ordered']?> </td>
                    <td> <?php echo $row['qty']?> </td>
                </tr> <?php } ?>
            </tbody>
        </table>

        <?php


$min_date = '';
$max_date = '';

// get values from form input if present

if (isset($_GET['min'])) {
$min_date = $_GET['min'];
}
if (isset($_GET['max'])) {
$max_date = $_GET['max'];
}

// set up query to select transactions
$query1 = "SELECT datetime,name,SUM(user_rating) as sum, COUNT(*) as count, 
FROM_UNIXTIME(datetime, '%Y-%m-%d') AS date_formatted
from review_table LEFT JOIN product on review_table.prod_id = product.prod_id
WHERE 1=1";
// filter by date range if specified
if ($min_date != '' && $max_date != '') {
    $query1 .= " AND FROM_UNIXTIME(datetime, '%Y-%m-%d') BETWEEN '$min_date' AND '$max_date' ";
}

$query1 .= " GROUP by product.name";

// execute the query
$sides1 = mysqli_query($con, $query1);

     ?>




        <center>
            <h5 style="font-weight: bolder;">Top Rated Product</h5>
        </center>
        <?php 
                   
            // $side = mysqli_query($con, "SELECT datetime,name,SUM(user_rating) as sum, COUNT(*) as count from review_table LEFT JOIN product on review_table.prod_id = product.prod_id
            // group by name");
                ?>
        <table class="table table-hover">
            <thead class='table-warning'>
                <tr>
                    <th scope="col">Product </th>
                    <th scope="col">Date </th>
                    <th scope="col">Rating</th>
                </tr>
            </thead> <?php 
                      while ($row = mysqli_fetch_array($sides1)) {
                        $sum = $row['sum'];
                        $count = $row['count'];
                        $avg_rating = $sum / $count;?> <tbody>
                <tr>
                    <td> <?php echo $row['name']?> </td>
                    <td> <?php echo date("Y-m-d", $row['datetime']); ?> </td>
                    <td> <?php echo number_format($avg_rating,2)?> </td>
                </tr> <?php } ?>
            </tbody>
        </table>


    </div>
</div>

<?php include('modal/production_modal.php')?>


<script>
function addFilterToURL() {

    var min_date = document.getElementById('prod_min').value;
    var max_date = document.getElementById('prod_max').value;

    // build URL with filters
    var url = 'prod_report.php?tab=3&min=' + min_date + '&max=' + max_date;

    // update current URL and refresh page
    window.location.href = url;
}

// add event listener to filter button
document.querySelector('.filterTopProd').addEventListener('click', addFilterToURL);


// get URL parameters
function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null,
        ''
    ])[1].replace(/\+/g, '%20')) || null;
}

// set form input values to URL parameters

document.getElementById('prod_min').value = getURLParameter('min');
document.getElementById('prod_max').value = getURLParameter('max');
</script>





<script>
$('#table-prod_trends').DataTable({
    dom: 'Bfrtip',
    buttons: [{
            extend: 'excel',
            title: ' Product Trend'
        },
        {
            extend: 'pdf',
            title: ' Product Trend'
        },
        {
            extend: 'print',
            title: ' Product Trend'
        },
    ],
    drawCallback: function() {
        var api = this.api();


        var formated = 0;
        $(api.column(0).footer()).html('Total');


        jan = api.column(1, {
            page: 'current'
        }).data().sum();

        feb = api.column(2, {
            page: 'current'
        }).data().sum();
        mar = api.column(3, {
            page: 'current'
        }).data().sum();
        apr = api.column(4, {
            page: 'current'
        }).data().sum();
        may = api.column(5, {
            page: 'current'
        }).data().sum();
        jun = api.column(6, {
            page: 'current'
        }).data().sum();

        jul = api.column(7, {
            page: 'current'
        }).data().sum();
        aug = api.column(8, {
            page: 'current'
        }).data().sum();
        sept = api.column(9, {
            page: 'current'
        }).data().sum();

        oct = api.column(10, {
            page: 'current'
        }).data().sum();
        nov = api.column(11, {
            page: 'current'
        }).data().sum();

        dec = api.column(12, {
            page: 'current'
        }).data().sum();
        //to format this sum


        formated_jan = parseFloat(jan).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });

        formated_feb = parseFloat(feb).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });
        formated_mar = parseFloat(mar).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });

        formated_apr = parseFloat(apr).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });
        formated_may = parseFloat(may).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });

        formated_jun = parseFloat(jun).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });


        formated_jul = parseFloat(jul).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });


        formated_aug = parseFloat(aug).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });

        formated_sept = parseFloat(sept).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });
        formated_oct = parseFloat(oct).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });
        formated_nov = parseFloat(nov).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });
        formated_dec = parseFloat(dec).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });


        $(api.column(1).footer()).html(formated_jan);
        $(api.column(2).footer()).html(formated_feb);
        $(api.column(3).footer()).html(formated_mar);
        $(api.column(4).footer()).html(formated_apr);
        $(api.column(5).footer()).html(formated_may);
        $(api.column(6).footer()).html(formated_jun);
        $(api.column(7).footer()).html(formated_jul);
        $(api.column(8).footer()).html(formated_aug);
        $(api.column(9).footer()).html(formated_sept);
        $(api.column(10).footer()).html(formated_oct);
        $(api.column(11).footer()).html(formated_nov);
        $(api.column(12).footer()).html(formated_dec);

    }

});



$('#table-prodrecord').DataTable({
    dom: 'Bfrtip',
    buttons: [{
            extend: 'excel',
            title: ' Production Record '
        },
        {
            extend: 'pdf',
            title: ' Production Record '
        },
        {
            extend: 'print',
            title: ' Production Record '
        },
    ],

});

$('#stockout_table').DataTable({
    dom: 'Bfrtip',
    buttons: [{
            extend: 'excel',
            title: ' Stockout Record'
        },
        {
            extend: 'pdf',
            title: ' Stockout Record'
        },
        {
            extend: 'print',
            title: ' Stockout Record'
        },
    ],
});


$('#production_table').on('click', '.btnViewProdDetails', function() {


    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();
    $('#viewProductionDetails').modal('show');
    $('#p_name').val(data[2]);
    $('#p_category').val(data[3]);
    $('#p_cost').val(data[4]);
    $('#p_price').val(data[5]);

    function fetch_table() {
        var prod_id = data[0].replace(/\s/g, '');
        $.ajax({
            url: "table/production_details.php",
            method: "POST",
            data: {
                prod_id: prod_id,

            },
            success: function(data) {
                $('#view_prod_history').html(data);
            }
        });
    }
    fetch_table();
});

// get the table data
</script>
<?php
  // First, get the data from the database and store it in an array
  $data = array();
  $retail = mysqli_query($con,"SELECT YEAR(date_ordered) AS year,MONTH(date_ordered) AS month,name,total
        FROM trans_record LEFT JOIN product on trans_record.prod_id = product.prod_id
        WHERE YEAR(date_ordered) = 2023 order by MONTH(date_ordered)");
  while ($row = mysqli_fetch_array($retail)) {
      $key = $row['name'] . '_' . $row['month'];
      $data[$key] = $row['total'];
  }    
?>
<script>
var data = <?php echo json_encode($data); ?>;
var months = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var labels = months.slice(1, 13).map(function(month) {
  return month;
});

var datasets = [];
Object.keys(data).forEach(function(key, index) {
    var parts = key.split('_');
    var product = parts[0];
    var month = parseInt(parts[1]);

    if (!datasets.some(dataset => dataset.label === product)) {
        var color = 'rgba(' + (index * 50 % 255) + ',' + (index * 100 % 255) + ',' + (index * 150 % 255) + ', 0.8)';
        datasets.push({
            label: product,
            data: [],
            backgroundColor: color,
            borderColor: color,
            borderWidth: 1
        });
    }

    var dataset = datasets.find(dataset => dataset.label === product);
    dataset.data[month - 1] = data[key];
});

var config = {
    type: 'bar',
    data: {
        labels: labels,
        datasets: datasets
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value, index, values) {
                        return '₱' + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Month'
                }
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            title: {
                display: true,
                text: 'Sales by Month'
            },
            legend: {
                display: true,
                position: 'bottom'
            }
        }
    }
};

var myChart = new Chart(document.getElementById('product_sales_bar'), config);
</script>