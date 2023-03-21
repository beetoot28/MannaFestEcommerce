<script>
    inventory_chart = document.getElementById("inventory_chart");
    income_chart = document.getElementById("income_chart");
    gross_chart = document.getElementById("gross_chart");
    opex_chart = document.getElementById("opex_chart");
    shrinkage_chart = document.getElementById("shrinkage_chart");

  


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
            labels: [
                'Bread',
                'Biscuit',
                'Cake',
                'Others',
          
            ],
            datasets: [{
                label: 'Inventory Breakdown',
                data: [30, 50, 70, 87],
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
    </script>