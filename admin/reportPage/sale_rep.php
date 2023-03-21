<div class="row mb-4">

    <div class="col-md-4">
        <div class="card shadow border-warning">
            <div class="card-body">
                <center>
                    <h4 style="font-weight: bolder;text-align: center;" class="text-dark">
                        Total Sales Today <br>


                        <?php 
                $current_date = date('F d, Y');
             $total_today  = mysqli_query($con, "SELECT  sum(transaction.total_amount) as total from transaction
             where DATE(datecreated) = CURDATE();");
             $total_today = mysqli_fetch_array($total_today);
              echo  '₱ '.number_format($total_today['total'],2);     
          
             ?>

                    </h4>
                    <?php echo $current_date?>
                </center>
            </div>

        </div>

    </div>

    <div class="col-md-4">
        <div class="card shadow border-success">
            <div class="card-body">
                <center>
                    <h4 style="font-weight: bolder;text-align: center;" class="text-dark">
                        Total Sales this Month <br>


                        <?php 
            $current_month_year = date('F Y');
            $total_month  = mysqli_query($con, "SELECT  sum(transaction.total_amount) as total_amount from transaction
            where  MONTH(datecreated) = MONTH(CURDATE())");
            $total_month = mysqli_fetch_array($total_month);
             echo  '₱ '.number_format($total_month['total_amount'],2);     

            ?>

                    </h4>
                    <?php echo $current_month_year?>
                </center>
            </div>


        </div>

    </div>


    <div class="col-md-4">
        <div class="card shadow border-danger">
            <div class="card-body">
                <center>
                    <h4 style="font-weight: bolder;text-align: center;" class="text-dark">
                        Total Sales this Year <br>


                        <?php 
             $current_year = date('Y');
            $total_year  = mysqli_query($con, "SELECT sum(transaction.total_amount) as total from transaction
             where year(datecreated) = 2023");
            $total_year = mysqli_fetch_array($total_year);
             echo  '₱ '.number_format($total_year['total'],2);     

            ?>

                    </h4>
                    <?php echo $current_year?>
                </center>
            </div>


        </div>

    </div>


</div>

<table id="table-sales_overall" class="table display nowrap" style="width:100%;">
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
 FROM transaction WHERE YEAR(datecreated) = $current_year");        

        ?>

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

</table>
<center>
    <div class="row">
        <div class="col">
            <label><b>Transaction Type </b></label>
            <div class="form-group">
                <select class='form-select' name='category' id='category_filter' style="width: 230px;">
                    <option disabled="disabled" selected>Select Type </option>
                    <option value=''>All</option>
                    <option value='Online'>Online</option>
                    <option value='Walkin'>Walkin</option>
                    <option value='Distributor'>Distributor</option>
                    <!--PHP echo-->
                </select>
            </div>
        </div>

        <div class="col">
            <label><b>Year Filter </b></label>
            <div class="form-group">
                <select class='form-select' name='year' id='year' style="width: 230px;">
                    <option disabled="disabled">Select Year </option>
                    <option selected value='2023'>2023</option>
                    <option value='2022'>2022</option>
                    <option value='2021'>2021</option>

                    <!--PHP echo-->
                </select>
            </div>

        </div>
        <div class="col-3">
            <label><b>Filter: From </b></label>
            <input type="date" id="min" class='form-control' name="min" placeholder="From Date" />
        </div>
        <div class="col-3">
            <label><b> Filter: To </b></label>
            <input type="date" id="max" class='form-control' name="max" placeholder="To Date" />


        </div>
        <div class="col">
            <br>
            <button type="button" class="btn btn-success text-light filterSalesRec" style='width:200px'><i
                    class="fas fa-submit"></i>Confirm Filter </button>

        </div>



    </div>

    <hr>

</center>
<div class="row">
    <div class="col-sm-8">
        <center>
            <h5 style="font-weight: bolder;"> Transaction Record</h5>
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
                $query = "SELECT *,sum(transaction.total_amount) as total_amount FROM transaction  WHERE 1=1";

                // filter by category if specified
                if ($category != '') {
                    $query .= " AND type = '$category'";
                }

                // filter by year if specified
                if ($year != '') {
                    $query .= " AND year(datecreated) = '$year' ";
                }

                // filter by date range if specified

                // filter by date range if specified
                if ($min_date != '' && $max_date != '') {
                    $query .= " AND datecreated BETWEEN '$min_date 00:00:00' AND '$max_date 23:59:59'";
                }
                        $query .= " AND  (status !='cancelled' or status!='Cancelled') GROUP BY tid ";
                // execute the query
                $result = mysqli_query($con, $query);
                            ?>

        <hr>

        <table id='trans_record' class="table table-hover">
            <thead class='table-dark'>
                <tr>
                    <th scope="col">Transaction ID </th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Type</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                  while ($row = mysqli_fetch_array($result)) { ?>

                <tr>
                    <td> <?php echo $row['tid']?> </td>
                    <td> <?php echo $row['datecreated'];?> </td>
                    <td> <?php echo $row['status']?> </td>
                    <td> <?php echo $row['type']?> </td>
                    <td>₱ <?php echo number_format($row['total_amount'],2)?> </td>
                    <td> <button type="button" class="btn btn-success text-light viewTransRecord"
                            style="font-size: 12px"><i class="fas fa-book"></i></button>
                    </td>
                </tr> <?php } ?>
            </tbody>
            <tfoot>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>


            </tfoot>
        </table>

    </div>
    <div class="col-sm-4">
        <center>
            <h5 style="font-weight: bolder;">Sales Trend</h5>
        </center>
        <div class="card" style="width:100%;max-width:100%;max-height:251px;">
            <canvas id="sales_charts" style="width:100%;max-width:100%;max-height:251px;"></canvas>
        </div>

        <hr>

        <?php         $res = mysqli_query($con, "SELECT *, sum(transaction.total_amount) as total_amount,COUNT(*) as count  FROM transaction 
            LEFT JOIN trans_record on trans_record.transaction_id = transaction.tid WHERE 1=1  group by type");?>

        <table id='table-trans_type' class="table table-hover">
            <thead class='table-dark'>
                <tr>
                    <th scope="col">Transaction Type </th>
                    <th scope="col">Number of Transaction</th>
                    <th scope="col">Total</th>

                </tr>
            </thead>
            <tbody>
                <?php 
                       while ($row = mysqli_fetch_array($res)) { ?>
                <tr>

                    <td> <?php echo $row['type']?> </td>
                    <td> <?php echo $row['count']?> </td>
                    <td>₱ <?php echo number_format($row['total_amount'],2)?> </td>

                </tr> <?php } ?>
            </tbody>

        </table>
    </div>
</div>


<script>
function addFilterToURL() {
    // get values from form inputs
    var category = document.getElementById('category_filter').value;
    var year = document.getElementById('year').value;
    var min_date = document.getElementById('min').value;
    var max_date = document.getElementById('max').value;

    // build URL with filters
    var url = 'prod_report.php?tab=2&category=' + category + '&year=' + year + '&min=' + min_date + '&max=' + max_date;

    // update current URL and refresh page
    window.location.href = url;
}

// add event listener to filter button
document.querySelector('.filterSalesRec').addEventListener('click', addFilterToURL);


// get URL parameters
function getURLParameter(name) {
    return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null,
        ''
    ])[1].replace(/\+/g, '%20')) || null;
}

// set form input values to URL parameters
document.getElementById('category_filter').value = getURLParameter('category');
document.getElementById('year').value = getURLParameter('year');
document.getElementById('min').value = getURLParameter('min');
document.getElementById('max').value = getURLParameter('max');
</script>





<!-- Modal View-->
<div class="modal fade" id="viewSalesDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="receivingViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receivingViewLabel">SALE RECORD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm">
                        <label> Transactio ID </label> <br>
                        <input id='s_trans_id' class='form-control' style='font-size:20px;border: none;font-weight:bold'
                            readonly>
                    </div>
                    <div class="col-sm">
                        <label> Date :</label> <br>
                        <input id='s_date' class='form-control' style='font-size:20px;border: none;font-weight:bold'
                            readonly>
                    </div>
                    <div class="col-sm">
                        <label>Transaction Type</label> <br>
                        <input id='s_trans_type' name='voucher' class='form-control'
                            style='font-size:20px;border: none;font-weight:bold' readonly>
                    </div>
                </div>


                <hr>
                <div id='view_sales_rec'> </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return</button>
            </div>

        </div>
    </div>
</div>

<script>
$('.viewTransRecord').on('click', function() {

    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    $('#s_trans_id').val(data[0]);
    $('#s_date').val(data[1]);
    $('#s_trans_type').val(data[3]);

    function fetch_table() {

        var trans_id = (data[0]);
        $.ajax({
            url: "table/sales_record_table.php",
            method: "POST",
            data: {
                trans_id: trans_id,

            },
            success: function(data) {
                $('#view_sales_rec').html(data);
            }
        });
    }
    fetch_table();
    $('#viewSalesDetails').modal('show');


});


sales_charts = document.getElementById("sales_charts");

<?php

$query = "SELECT *,year(date_ordered) as year ,(date_ordered) as date,sum(trans_record.total) as month_total FROM transaction LEFT JOIN trans_record on trans_record.transaction_id = transaction.tid WHERE 1=1";

// filter by category if specified
if ($category != '') {
$query .= " AND type = '$category'";
}

// filter by year if specified
if ($year != '') {
$query .= " AND year(datecreated) = '$year'";
}

// filter by date range if specified
if ($min_date != '' && $max_date != '') {
$query .= " AND datecreated BETWEEN '$min_date' AND '$max_date'";
}

// execute the query
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) { 
      $sale_month[] = $row['date'];
      $sale_amount[] = $row['month_total'];
  }

?>

new Chart(sales_charts, {

    type: 'line',

    data: {
        labels: <?php echo json_encode($sale_month) ?>,
        datasets: [{
                label: 'Sales',
                data: <?php echo json_encode($sale_amount) ?>,
                backgroundColor: '#87CEEB',
                borderColor: '#0000CD',
                borderWidth: 2
            }

        ]
    },
    options: {
        plugins: {
            legend: {
                display: false,

            },
            title: {


                display: true,
                text: 'Sales Trend',
            },
        },
        scales: {
            y: {
                ticks: {
                    display: true
                },
                grid: {
                    display: false
                },
                beginAtZero: true
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>


<script>
datatable = $('#trans_record').DataTable({
    dom: 'Bfrtip',
    buttons: [{
            extend: 'excel',
            title: 'Transaction Records'
        },
        {
            extend: 'pdf',
            title: 'Transaction Records'
        },
        {
            extend: 'print',
            title: 'Transaction Records'
        },
    ],
    drawCallback: function() {
        var api = this.api();
        var sum = 0;
        var formated = 0;
        //to show first th
        $(api.column(3).footer()).html('Total');


        sum = api.column(4, {
            page: 'current'
        }).data().sum();

        //to format this sum
        formated = parseFloat(sum).toLocaleString(undefined, {
            minimumFractionDigits: 2
        });
        $(api.column(4).footer()).html(formated);


    }
});



$('#table-sales_overall').DataTable({
    dom: 'Bfrtip',
    buttons: [{
            extend: 'excel',
            title: 'Total Sales'
        },
        {
            extend: 'pdf',
            title: 'Total Sales'
        },
        {
            extend: 'print',
            title: 'Total Sales'
        },
    ]
});



$('#table-trans_type').DataTable({
    dom: 'Bfrtip',
    buttons: [{
            extend: 'excel',
            title: 'Transaction Records'
        },
        {
            extend: 'pdf',
            title: 'Transaction Records'
        },
        {
            extend: 'print',
            title: 'Transaction Records'
        },
    ],

});
</script>