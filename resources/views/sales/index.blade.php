<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sales Graphs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.1.1/dist/chart.min.js" integrity="sha256-lISRn4x2bHaafBiAb0H5C7mqJli7N0SH+vrapxjIz3k=" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
    <style>
        body {
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center">Sales Graphs</h1>
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="myChart1" width="200" height="200"></canvas><br>
                            <canvas id="myChart" width="200" height="200"></canvas><br>
                            <canvas id="myChart2" width="200" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    var groupM = new Array();
    var x = <?php echo json_encode($groupFM); ?>;
    var y = <?php echo json_encode($groupMM); ?>;
    groupM.push(x);
    groupM.push(y);
    var groupN = new Array();
    var xx = <?php echo json_encode($groupFN); ?>;
    var yy = <?php echo json_encode($groupMN); ?>;
    groupN.push(xx);
    groupN.push(yy);
    var year = ['Member','Normal'];
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Female',
            backgroundColor: "rgba(255, 99, 132, 0.2)",
            data: groupM
        }, {
            label: 'Male',
            backgroundColor: "rgba(54, 162, 235, 1)",
            data: groupN
        }]
    };
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Count'
                    }
                },
                y: [{
                    title: {
                        display: true,
                        text: 'Product line'
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var prods = <?php echo json_encode($prod); ?>;;
    var val = <?php echo json_encode($nb); ?>;
    var DataChart = {
        labels: prods,
        datasets: [{
            label: 'Revenue brut ',
            backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
            borderColor: [ 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)' ],
            data: val,
            fill: false,
            axis: 'y',
            borderWidth: 1,
        }, ]
    };
    var myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: DataChart,
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Count'
                    },    
                },
                y: {
                    title: {
                        display: true,
                        text: 'Product line'
                    },
                }
            }
        },
    });

    var groupM = new Array();
    var male = <?php echo json_encode($totalRatM); ?>;
    var female = <?php echo json_encode($totalRatF); ?>;
    groupM.push(male);
    groupM.push(female);
    var label3 = ['Female','Male'];
    var ChartData = {
        labels: label3,
        datasets: [{
            label: 'Average rating by gender',
            backgroundColor: ["rgba(255, 99, 132, 0.2)", "rgba(54, 162, 235, 1)"],
            data: groupM
        }, ]
    };
    var ctx2 = document.getElementById('myChart2').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: ChartData,
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Gender'
                    },
                    stacked: true,
                },
                y: [{
                    title: {
                        display: true,
                        text: 'Count'
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>