<script>
sales_trend = document.getElementById("sales_trend");
purchase_chart = document.getElementById("purchase_chart");
inventory_chart = document.getElementById("inventory_chart");
income_chart = document.getElementById("income_chart");
gross_chart = document.getElementById("gross_chart");
opex_chart = document.getElementById("opex_chart");
shrinkage_chart = document.getElementById("shrinkage_chart");
web_traffic = document.getElementById("web_traffic");

<?php 
$currentMonth = date("m");
$currentDay = date("d");
$currentYear = date("Y");

$today = $currentYear.
"-".$currentMonth.
"-".$currentDay;


   $sales_count = mysqli_query($con,"SELECT year(date_ordered) as year ,MONTHNAME(date_ordered) as monthname,sum(trans_record.total) as month_total from transaction LEFT JOIN trans_record ON transaction.tid = trans_record.transaction_id  WHERE year(date_ordered)='$currentYear'  group by month(date_ordered) ORDER BY date_ordered");        
   if($sales_count->num_rows > 0) {
     foreach($sales_count as $data) {
         $sale_month[] = $data['monthname'];
         $sale_amount['data'][] = number_format($data['month_total'],2);
     }
 }

 $top_selling = mysqli_query($con," SELECT trans_record.prod_id,name,sum(quantity) as qty from trans_record LEFT JOIN product on trans_record.prod_id = product.prod_id group by name ");        
 if($top_selling->num_rows > 0) {
   foreach($top_selling as $data) {
       $top_prod[] = $data['name'];
       $top_qty[] = $data['qty'];
   }
}


$inv_cost_selling= mysqli_query($con,"SELECT sum(cost*quantity) as total_cost,sum(price * quantity) as selling_total FROM `product_quantity` JOIN product ON product.prod_id = product_quantity.prod_id WHERE quantity > 0");        
if($inv_cost_selling->num_rows > 0) {
  foreach($inv_cost_selling as $data) {
      $inv_cost = $data['total_cost'];
      $inv_selling= $data['selling_total'];
  }
}




?>


new Chart(sales_trend, {

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



new Chart(purchase_chart, {

    type: 'bar',

    data: {
        labels: ['Inventory Cost', 'Selling Cost'],
        datasets: [{
            label: 'Sales',
            data: [<?php echo ($inv_cost) ?>, <?php echo ($inv_selling) ?>],
            backgroundColor: [
                '#84A7D0', '#8F1103'
            ],
            borderColor: '#025454',
            borderWidth: 2
        }]
    },
    options: {
        indexAxis: 'y',
        plugins: {
            legend: {
                position: 'right',
                display: false,
            },
            title: {
                display: true,
                text: 'Inventory Cost'
            }
        },
        scales: {
            y: {
                ticks: {
                    display: true,
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


new Chart(inventory_chart, {
    options: {
        "responsive": true,
        "maintainAspectRatio": false,
        plugins: {
            legend: {
                position: 'left',
            },
            title: {
                display: true,
                text: 'Inventory Breakdown',
            },
        },
    },
    type: 'pie', //Declare the chart type 
    data: {
        labels: <?php echo json_encode($top_prod) ?>,
        datasets: [{
            label: 'Top Selling Products',
            data: <?php echo json_encode($top_qty) ?>,
            backgroundColor: [
                '#556B2F', '#B0E0E6', '#191970', '#ADFF2F'
            ],
            hoverOffset: 4
        }]
    },
});

// EXPENSE
new Chart(income_chart, {

    type: 'bar', //Declare the chart type 
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                label: 'Sales',
                data: [72, 79, 73, 75, 82, 93, 93, 104, 106, 108, 107, 105],
                backgroundColor: '#800006'
            },
            {
                label: 'COGS',
                data: [62, 69, 63, 65, 62, 70, 72, 79, 82, 85, 82, 83],
                backgroundColor: '#A64800'
            },
            {
                label: 'opex',
                data: [24, 25, 25, 24, 24, 24, 25, 23, 23, 25, 24, 23],
                backgroundColor: '#ADB200'
            },
            {
                label: 'Net Income',
                data: [14, 15, 15, 14, 12, 12, 12, 11, 13, 19, 22, 23],
                backgroundColor: '#CC008B'
            }
        ]
    },

    options: {
        "responsive": true,
        "maintainAspectRatio": false,
        plugins: {
            legend: {
                position: 'bottom',
            },
            title: {
                display: true,
                text: 'Financial Performance',
            },
        },
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                grid: {
                    display: false
                },
                ticks: {
                    display: true
                }
            }
        },
    },
});




new Chart(gross_chart, {

    type: 'bar', //Declare the chart type 
    data: {
        labels: ['Breads', 'Cake', 'Biscuit', 'Other'],
        datasets: [{
            label: 'Gross Profit Margin',
            data: [.7, .19, .3, .5],
            borderColor: '#262600',
            borderWidth: .5,
            backgroundColor: '#994C00',
            type: 'bar',
            order: 0
        }, ]
    },

    options: {
        maintainAspectRatio: false,
        indexAxis: 'y',
        plugins: {


            legend: {
                position: false,
            },
            title: {
                display: true,
                text: 'Gross Profit Margin',
            },
        },
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                grid: {
                    display: false
                },
                ticks: {
                    display: true
                }
            }
        },
    },
});

new Chart(opex_chart, {
    options: {
        "responsive": true,
        "maintainAspectRatio": false,
        plugins: {
            legend: {
                position: 'left',
            },
            title: {
                display: true,
                text: 'Operating Expenses Breakdown',
            },
        },
    },
    type: 'pie', //Declare the chart type 
    data: {
        labels: [
            'Biscuit',
            'Breads',
            'Cake',
            'Other',

        ],
        datasets: [{
            label: 'Opex',
            data: [30, 50, 70, 10],
            backgroundColor: [
                '#8F431F', '#8F1103', '#B75A0D', '#D51918', '#D47D14', '#FB412C', '#F0A200',
                '#F67E7D', '#FDD750', '#A56758', '#F78A05', '#81483D', '#B87F48'
            ],
            hoverOffset: 4
        }]
    },
});


// area chart

new Chart(shrinkage_chart, {
    type: 'line',
    data: {
        labels: ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5", "Week 6", "Week 7", "Week 8", "Week 9",
            "Week 10", "Week 4", "Week 5", "Week 6", "Week 7", "Week 8", "Week 9", "Week 10"
        ],
        datasets: [{
                label: 'Shrinkage', // Name the series
                data: [500, 50, 2424, 14040, 6000, 12141, 10111, 4544, 3000, 47, 5555, 6811, 2424,
                    14040, 6000, 12141, 10111, 4544, 3000, 47, 5555, 6811
                ], // Specify the data values array
                fill: true,
                borderColor: '#191970', // Add custom color border (Line)
                backgroundColor: '#4682B4', // Add custom color background (Points and Fill)
                borderWidth: 1 // Specify bar border width
            },

        ]
    },
    options: {
        responsive: true, // Instruct chart js to respond nicely.
        maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
        plugins: {
            legend: {
                position: 'false',
            },
            title: {
                display: true,
                text: 'Weekly Shrinkage',
            },
        },

        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                grid: {
                    display: true
                },
                ticks: {
                    display: true
                }
            }
        }
    }
});


<?php
// area chart
$web_traffic = mysqli_query($con,
    "SELECT COUNT(*) AS log_count, DATE(date) AS log_date FROM traffic_log GROUP BY DATE(date) ");
if ($web_traffic -> num_rows > 0) {
    foreach($web_traffic as $data) {
        $log_date = $data['log_date'];
        $log_count = $data['log_count'];
    }
}
?>



new Chart(web_traffic, {

    type: 'line',

    data: {
        labels: <?php echo json_encode($log_date) ?>,
        datasets: [{
                label: 'Date',
                data: <?php echo json_encode($log_count) ?>,
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
                text: 'Web Traffic',
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