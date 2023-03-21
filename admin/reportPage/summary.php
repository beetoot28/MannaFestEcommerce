<div class="row">
    <div class="col-sm-10">
        <center>
            <h5 style="font-weight: bolder;">Sales Report</h5>
        </center>


        <?php

     $retail = mysqli_query($con,"SELECT YEAR(datecreated) AS year,MONTHNAME(datecreated) AS month,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'January' THEN total_amount END) AS JAN,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'February' THEN total_amount END) AS FEB,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'March' THEN total_amount END) AS MAR,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'April' THEN total_amount END) AS APR,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'May' THEN total_amount END) AS MAY,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'June' THEN total_amount END) AS JUNE,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'July' THEN total_amount END) AS JULY,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'August' THEN total_amount END) AS AUG,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'September' THEN total_amount END) AS SEP,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'October' THEN total_amount END) AS OCT,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'November' THEN total_amount END) AS NOV,
     SUM(CASE WHEN MONTHNAME(datecreated) = 'December' THEN total_amount END) AS DECE
        FROM transaction WHERE YEAR(datecreated) = 2023 ");        

        ?>
        <table id="sales_summary_table" class="table" style="width:100%;">

            <thead class='table-dark' style="width:100%;font-size: 13px;">
                <tr>

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
            <tbody style="width:100%;font-size: 14px;">
                <?php while ($row = mysqli_fetch_array($retail)) { ?>
                <tr>

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
            </tfoot>
        </table>

        <!-- product sales -->
        <center>
            <h5 style="font-weight: bolder;">Product Trend</h5>
        </center>

        <table id="table-prod_trend" class="table display ">
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

            <thead class='table-dark'>
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
            <tbody style="width:100%;font-size: 14px;">
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
        <!-- end INCOME CHART -->
        <div style="width:auto;height: 400px">
            <canvas id="summary_product_sales_bar"></canvas>
        </div>



        <!-- chart -->
        <div class="row">
            <div class="col-sm-6">

                <div class="card" style="width:100%;max-width:100%;max-height:251px;">
                    <canvas id="purchase_chart" style="width:100%;max-width:100%;max-height:251px;">
                    </canvas>
                </div>

            </div>
            <div class="col-sm-6">

                <div class="card" style="width:100%;max-width:100%;max-height:210px;">
                    <canvas id="inventory_chart" style="width:100%;max-width:100%;max-height:251px;"></canvas>
                </div>

            </div>
        </div>

    </div>
    <div class="col-sm-2">

        <center>
            <h5 style="font-weight: bolder;">Top Selling Product</h5>
        </center>
        <?php 
                   
           $side = mysqli_query($con, "SELECT trans_record.prod_id,name,sum(quantity) as qty from trans_record
            LEFT JOIN product on trans_record.prod_id = product.prod_id group by name");?>
        <table class="table table-hover">
            <thead class='table-warning'>
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

        <center>
            <h5 style="font-weight: bolder;">Website Visits</h5>
        </center>

        <?php 
                   
                   $web_traffic = mysqli_query($con,"SELECT device_type, COUNT(*) AS visitors_today, DATE(date) AS visit_date FROM traffic_log GROUP BY device_type, DATE(date)");?>
        <table id='table-traffic' class="table table-hover">
            <thead class='table-warning'>
                <tr>
                    <th scope="col">Date </th>
                    <th scope="col">Device </th>
                    <th scope="col">Traffic</th>
                </tr>
            </thead> <?php 
                    while ($row = mysqli_fetch_array($web_traffic)) { ?> <tbody>
                <tr>
                    <td> <?php echo $row['visit_date']?> </td>
                    <td> <?php echo $row['device_type']?> </td>
                    <td> <?php echo $row['visitors_today']?> </td>
                </tr> <?php } ?>
            </tbody>
        </table>



    </div>
</div>

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
    type: 'line',
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

var myChart = new Chart(document.getElementById('summary_product_sales_bar'), config);
</script>





<script>
$('#sales_summary_table').DataTable({
    dom: 'Bfrtip',
    "ordering": false,
    "searching": false,
    "paging": false,
    buttons: [{
            extend: 'excel',
            title: ' Sales Report This Year'
        },
        {
            extend: 'pdf',
            title: ' Sales Report This Year'
        },
        {
            extend: 'print',
            title: ' Sales Report This Year'
        },
    ],


    drawCallback: function() {
        var api = this.api();


        var formated = 0;

        jan = api.column(0, {
            page: 'current'
        }).data().sum();

        feb = api.column(1, {
            page: 'current'
        }).data().sum();
        mar = api.column(2, {
            page: 'current'
        }).data().sum();
        apr = api.column(3, {
            page: 'current'
        }).data().sum();
        may = api.column(4, {
            page: 'current'
        }).data().sum();
        jun = api.column(5, {
            page: 'current'
        }).data().sum();

        jul = api.column(6, {
            page: 'current'
        }).data().sum();
        aug = api.column(7, {
            page: 'current'
        }).data().sum();
        sept = api.column(8, {
            page: 'current'
        }).data().sum();

        oct = api.column(9, {
            page: 'current'
        }).data().sum();
        nov = api.column(10, {
            page: 'current'
        }).data().sum();

        dec = api.column(11, {
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


        $(api.column(0).footer()).html('Total :  ' + formated_jan);
        $(api.column(1).footer()).html(formated_feb);
        $(api.column(2).footer()).html(formated_mar);
        $(api.column(3).footer()).html(formated_apr);
        $(api.column(4).footer()).html(formated_may);
        $(api.column(5).footer()).html(formated_jun);
        $(api.column(6).footer()).html(formated_jul);
        $(api.column(7).footer()).html(formated_aug);
        $(api.column(8).footer()).html(formated_sept);
        $(api.column(9).footer()).html(formated_oct);
        $(api.column(10).footer()).html(formated_nov);
        $(api.column(11).footer()).html(formated_dec);

    }
});
</script>



<script>
$('#table-prod_trend').DataTable({
    dom: 'Bfrtip',
    "ordering": false,
    "searching": false,
    "paging": false,
    buttons: [{
            extend: 'excel',
            title: 'Product Sales Total'
        },
        {
            extend: 'pdf',
            title: 'Product Sales Total'
        },
        {
            extend: 'print',
            title: 'Product Sales Total'
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
</script>