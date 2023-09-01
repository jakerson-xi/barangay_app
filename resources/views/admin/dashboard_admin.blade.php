@include('admin/adminHeader')
@foreach($admin_info as $admin)
<style>
    .chart-canvas {
        height: 400px;
        /* Set the desired height for the charts */
    }

    /* Flip container */
    .flip-container {
        perspective: 1000px;
    }

    /* Flipper */
    .flipper {
        position: static;
        transform-style: preserve-3d;
        transition: transform 0.6s;
        transform-origin: center;

    }

    /* Front side */
    .front {
        /* position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #ccc;*/
        backface-visibility: hidden;
    }

    /* Back side */
    .back {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #f00;
        transform: rotateY(180deg);
        backface-visibility: hidden;
    }

    /* Flipped state */
    .flip-container.flipped .flipper {
        transform: rotateY(180deg);
    }
</style>
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<div class="content">

    <p class="display-6"><i class="bi bi-speedometer2"></i> <strong>Dashboard</strong></p>
    <hr style="color: black;">
    <div class="shadow p-3 mb-3 bg-body rounded ">
        <div class="myContainer">
            <div class="container overflow-hidden mt-3">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Resident Report</h3>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-warning fw-bold text-xs mb-1 "><span>Registered Resident</span></div>
                                        <div class="text-dark fw-bold h5 mb-0 "><span>{{$num_res}}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="bi bi-people-fill h2 w-bold text-xs mb-1"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #198754;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-success fw-bold text-xs mb-1 "><span>Active Resident Account</span></div>
                                        <div class="text-dark fw-bold h5 mb-0 "><span>{{$num_res_active}}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="bi bi-person-check-fill h2 w-bold text-xs mb-1"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #dc3545;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-danger fw-bold text-xs mb-1 "><span>Inactive Resident Account</span></div>
                                        <div class="text-dark fw-bold h5 mb-0 "><span>{{$num_res_inactive}}</span></div>
                                    </div>
                                    <div class="col-auto"><i class="bi bi-person-fill-dash h2 w-bold text-xs mb-1"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #0dcaf0;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-info fw-bold text-xs mb-1 "><span>Web App Visitor</span></div>
                                        <div class="text-dark fw-bold h5 mb-0 "><span>{{$visit_num}}</span></div>
                                        <a data-bs-toggle="collapse" href="#visit_analytics" class="link-dark">Click here <i class="bi bi-arrow-right-circle-fill"></i></a>
                                    </div>
                                    <div class="col-auto"><i class="bi bi-person-lines-fill h2 w-bold text-xs mb-1"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xl-12 mb-4 collapse" id="visit_analytics">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btnradio1">Daily</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-info" for="btnradio2">Weekly</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-warning" for="btnradio3">Monthly</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                            <label class="btn btn-outline-success" for="btnradio4">Yearly</label>
                        </div>

                        <div id="daily_chart" style="display: block;">
                            <div class=" text-dark fw-bold text-xs mb-1 text-center"><span>Web App Visitor (Daily)</span></div>
                            <input id='days' type="hidden" value="{{json_encode([$days])}}">
                            <input id='dayTotals' type="hidden" value="{{json_encode([$dayTotals])}}">
                            <div style="display: block; margin: 0 auto;">
                                <canvas class="chart-canvas" id="visit_days"></canvas>
                            </div>
                        </div>

                        <div id="weekly_chart" style="display: none;">
                            <div class=" text-dark fw-bold text-xs mb-1 text-center"><span>Web App Visitor (Weekly)</span></div>
                            <input id='weeks' type="hidden" value="{{json_encode([$weeks])}}">
                            <input id='weekTotals' type="hidden" value="{{json_encode([$weekTotals])}}">
                            <div style="display: block; margin: 0 auto;">
                                <canvas class="chart-canvas" id="visit_week"></canvas>
                            </div>
                        </div>

                        <div id="monthly_chart" style="display: none;">
                            <div class="text-dark fw-bold text-xs mb-1 text-center"><span>Web App Visitor (Monthly)</span></div>
                            <input id='months' type="hidden" value="{{json_encode([$months])}}">
                            <input id='monthTotals' type="hidden" value="{{json_encode([$monthTotals])}}">
                            <div style="display: block; margin: 0 auto;">
                                <canvas class="chart-canvas" id="visit_months"></canvas>
                            </div>
                        </div>

                        <div id="yearly_chart" style="display: none;">
                            <div class="text-dark fw-bold text-xs mb-1 text-center"><span>Web App Visitor (Yearly)</span></div>
                            <input id='years' type="hidden" value="{{json_encode([$years])}}">
                            <input id='yearTotals' type="hidden" value="{{json_encode([$yearTotals])}}">
                            <div style="display: block; margin: 0 auto;">
                                <canvas class="chart-canvas" id="visit_years"></canvas>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Resident Demography <i class="bi bi-chevron-down"></i></h3>
                </div>

                <div id="stats" >
                    <div class="row">
                        <input id='agesss' type="hidden" value="{{json_encode([$data_age])}}">
                        <div class="col-md-12 col-xl-6">
                            <div class=" text-dark fw-bold text-xs  text-center"><span>Gender</span></div>
                            <canvas class="chart-canvas" id="gender"></canvas>
                        </div>
                        <div class="col-md-12 col-xl-6 ">
                            <div class=" text-dark fw-bold text-xs  text-center"><span>Age</span></div>
                            <canvas class="chart-canvas" id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="row">
                        <input id='agesss' type="hidden" value="{{json_encode([$data_age])}}">
                        <div class="col-md-12 col-xl-12 ">
                            <input id='street' type="hidden" value="{{json_encode([$street])}}">
                            <input id='streetTotals' type="hidden" value="{{json_encode([$streetTotals])}}">
                            <div class=" text-dark fw-bold text-xs mb-1 text-center"><span>Street</span></div>
                            <canvas class="chart-canvas" id="streets"></canvas>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>




</div>
<script>
  
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src=" https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let btnradio1 = document.getElementById('btnradio1');
    let btnradio2 = document.getElementById('btnradio2');
    let btnradio3 = document.getElementById('btnradio3');
    let btnradio4 = document.getElementById('btnradio4');
    let daily_chart = document.getElementById('daily_chart');
    let weekly_chart = document.getElementById('weekly_chart');
    let monthly_chart = document.getElementById('monthly_chart');
    let yearly_chart = document.getElementById('yearly_chart');

    btnradio1.addEventListener('click', function() {
        daily_chart.style.display = 'block'; // show the All data div
        weekly_chart.style.display = 'none';
        monthly_chart.style.display = 'none';
        yearly_chart.style.display = 'none';
    });

    btnradio2.addEventListener('click', function() {
        daily_chart.style.display = 'none'; // show the All data div
        weekly_chart.style.display = 'block';
        monthly_chart.style.display = 'none';
        yearly_chart.style.display = 'none';
    });
    btnradio3.addEventListener('click', function() {
        daily_chart.style.display = 'none'; // show the All data div
        weekly_chart.style.display = 'none';
        monthly_chart.style.display = 'block';
        yearly_chart.style.display = 'none';
    });
    btnradio4.addEventListener('click', function() {
        daily_chart.style.display = 'none'; // show the All data div
        weekly_chart.style.display = 'none';
        monthly_chart.style.display = 'none';
        yearly_chart.style.display = 'block';
    });
</script>


<script>
    var ctx = document.getElementById('gender');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                label: '%',
                data: ['{{$male}}', '{{ $female}}'],
                backgroundColor: [
                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)', // Solid blue color for female segment
                ],
                borderColor: [
                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)',
                ],
                borderWidth: 1
            }]
        },
        options: {

            height: 300,
            // set the chart height to 300 pixels,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    myChart.canvas.parentNode.style.height = '500px';
    myChart.canvas.parentNode.style.width = '400px';
</script>

<script>
    var ctx_chart = document.getElementById('myChart');
    var val = document.getElementById('agesss').value;
    var myChart_ctx = new Chart(ctx_chart, {
        type: 'bar',
        data: {
            labels: ["18-29", "30-39", "40-49", "50-59", "60-69", "70+"],
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(val.slice(1, -1)),
                backgroundColor: [
                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)', // red with 70% opacity
                    'rgba(255, 193, 7, 0.7)', // yellow with 70% opacity
                    'rgba(40, 167, 69, 0.7)', // green with 70% opacity
                    'rgba(111, 66, 193, 0.7)', // purple with 70% opacity
                    'rgba(23, 162, 184, 0.7)', // teal with 70% opacity
                    'rgba(253, 126, 20, 0.7)', // orange with 70% opacity
                    'rgba(102, 16, 242, 0.7)', // indigo with 70% opacity
                ],
                borderColor: [
                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)', // red with 70% opacity
                    'rgba(255, 193, 7, 0.7)', // yellow with 70% opacity
                    'rgba(40, 167, 69, 0.7)', // green with 70% opacity
                    'rgba(111, 66, 193, 0.7)', // purple with 70% opacity
                    'rgba(23, 162, 184, 0.7)', // teal with 70% opacity
                    'rgba(253, 126, 20, 0.7)', // orange with 70% opacity
                    'rgba(102, 16, 242, 0.7)', // indigo with 70% opacity
                ],
                borderWidth: 1
            }]
        },
        options: {

            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Number of resident/s'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Ages'
                    }
                },
                yAxes: [{

                    ticks: {
                        beginAtZero: true,
                        stepSize: 1, // set step size to 1 to display whole numbers
                        callback: function(value) { // add a callback function to format tick labels
                            if (Number.isInteger(value)) {
                                return value.toFixed(0); // display whole numbers without decimal places
                            }
                        }
                    },
                    max: function(context) { // set max value using a function to add 5 to highest data point
                        var max = context.chart.data.datasets[0].data.reduce(function(a, b) {
                            return Math.max(a, b);
                        });
                        return Math.ceil(max / 5) * 5;
                    }

                }]
            }
        }
    });
    myChart_ctx.canvas.parentNode.style.height = '500px';
    myChart_ctx.canvas.parentNode.style.width = '700px';
</script>

<script>
    var ctx_chart_days = document.getElementById('visit_days');
    var lab_days = document.getElementById('days').value;
    var data_days = document.getElementById('dayTotals').value;
    var myChart_ctx_days = new Chart(ctx_chart_days, {
        type: 'bar',
        data: {
            labels: JSON.parse(lab_days.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(data_days.slice(1, -1)),
                backgroundColor: [
                    '#007bff',
                ],
                borderColor: [
                    '#343a40',

                ],
                borderWidth: 1
            }]
        },
        options: {
            animation: false,
            height: 100, // set the chart height to 300 pixels
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Number of resident/s'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                yAxes: [{

                    ticks: {
                        beginAtZero: true,
                        stepSize: 1, // set step size to 1 to display whole numbers
                        callback: function(value) { // add a callback function to format tick labels
                            if (Number.isInteger(value)) {
                                return value.toFixed(0); // display whole numbers without decimal places
                            }
                        }
                    },
                    max: function(context) { // set max value using a function to add 5 to highest data point
                        var max = context.chart.data.datasets[0].data.reduce(function(a, b) {
                            return Math.max(a, b);
                        });
                        return Math.ceil(max / 5) * 5;
                    }

                }]
            }
        }
    });

    myChart_ctx_days.canvas.parentNode.style.height = '400px';
    myChart_ctx_days.canvas.parentNode.style.width = '750px';
    myChart_ctx_days.canvas.parentNode.style.display = 'block';
    myChart_ctx_days.canvas.parentNode.style.margin = '0 auto';
</script>

<script>
    var ctx_chart_week = document.getElementById('visit_week');
    var lab_week = document.getElementById('weeks').value;
    var data_week = document.getElementById('weekTotals').value;
    var myChart_ctx_week = new Chart(ctx_chart_week, {
        type: 'bar',
        data: {
            labels: JSON.parse(lab_week.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(data_week.slice(1, -1)),
                backgroundColor: [
                    '#17a2b8',
                ],
                borderColor: [
                    '#343a40',

                ],
                borderWidth: 1
            }]
        },
        options: {
            animation: false,
            height: 100, // set the chart height to 300 pixels
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Number of resident/s'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Weekly'
                    }
                },
                yAxes: [{

                    ticks: {
                        beginAtZero: true,
                        stepSize: 1, // set step size to 1 to display whole numbers
                        callback: function(value) { // add a callback function to format tick labels
                            if (Number.isInteger(value)) {
                                return value.toFixed(0); // display whole numbers without decimal places
                            }
                        }
                    },
                    max: function(context) { // set max value using a function to add 5 to highest data point
                        var max = context.chart.data.datasets[0].data.reduce(function(a, b) {
                            return Math.max(a, b);
                        });
                        return Math.ceil(max / 5) * 5;
                    }

                }]
            }
        }
    });

    myChart_ctx_week.canvas.parentNode.style.height = '400px';
    myChart_ctx_week.canvas.parentNode.style.width = '750px';
    myChart_ctx_week.canvas.parentNode.style.display = 'block';
    myChart_ctx_week.canvas.parentNode.style.margin = '0 auto';
</script>

<script>
    var ctx_chart_month = document.getElementById('visit_months');
    var lab_month = document.getElementById('months').value;
    var data_month = document.getElementById('monthTotals').value;
    var myChart_ctx_month = new Chart(ctx_chart_month, {
        type: 'bar',
        data: {
            labels: JSON.parse(lab_month.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(data_month.slice(1, -1)),
                backgroundColor: [
                    '#ffc107',
                ],
                borderColor: [
                    '#343a40',

                ],
                borderWidth: 1
            }]
        },
        options: {
            animation: false,
            height: 100, // set the chart height to 300 pixels
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Number of resident/s'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                },
                yAxes: [{

                    ticks: {
                        beginAtZero: true,
                        stepSize: 1, // set step size to 1 to display whole numbers
                        callback: function(value) { // add a callback function to format tick labels
                            if (Number.isInteger(value)) {
                                return value.toFixed(0); // display whole numbers without decimal places
                            }
                        }
                    },
                    max: function(context) { // set max value using a function to add 5 to highest data point
                        var max = context.chart.data.datasets[0].data.reduce(function(a, b) {
                            return Math.max(a, b);
                        });
                        return Math.ceil(max / 5) * 5;
                    }

                }]
            }
        }
    });

    myChart_ctx_month.canvas.parentNode.style.height = '400px';
    myChart_ctx_month.canvas.parentNode.style.width = '750px';
    myChart_ctx_month.canvas.parentNode.style.display = 'block';
    myChart_ctx_month.canvas.parentNode.style.margin = '0 auto';
</script>

<script>
    var ctx_chart_years = document.getElementById('visit_years');
    var lab_years = document.getElementById('years').value;
    var data_years = document.getElementById('yearTotals').value;
    var myChart_ctx_years = new Chart(ctx_chart_years, {
        type: 'bar',
        data: {
            labels: JSON.parse(lab_years.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(data_years.slice(1, -1)),
                backgroundColor: [
                    '#28a745',
                ],
                borderColor: [
                    '#343a40',

                ],
                borderWidth: 1
            }]
        },
        options: {
            animation: false,
            height: 100, // set the chart height to 300 pixels
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Number of resident/s'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Years'
                    }
                },
                yAxes: [{

                    ticks: {
                        beginAtZero: true,
                        stepSize: 1, // set step size to 1 to display whole numbers
                        callback: function(value) { // add a callback function to format tick labels
                            if (Number.isInteger(value)) {
                                return value.toFixed(0); // display whole numbers without decimal places
                            }
                        }
                    },
                    max: function(context) { // set max value using a function to add 5 to highest data point
                        var max = context.chart.data.datasets[0].data.reduce(function(a, b) {
                            return Math.max(a, b);
                        });
                        return Math.ceil(max / 5) * 5;
                    }

                }]
            }
        }
    });

    myChart_ctx_years.canvas.parentNode.style.height = '400px';
    myChart_ctx_years.canvas.parentNode.style.width = '750px';
    myChart_ctx_years.canvas.parentNode.style.display = 'block';
    myChart_ctx_years.canvas.parentNode.style.margin = '0 auto';
</script>


<script>
    var ctx_chart_street = document.getElementById('streets');
    var lab_street = document.getElementById('street').value;
    var data_street = document.getElementById('streetTotals').value;
    var myChart_ctx_street = new Chart(ctx_chart_street, {
        type: 'bar',
        data: {
            labels: JSON.parse(lab_street.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(data_street.slice(1, -1)),
                backgroundColor: [
                    // yellow with 70% opacity
                    'rgba(40, 167, 69, 0.7)', // green with 70% opacity
                    'rgba(111, 66, 193, 0.7)', // purple with 70% opacity
                    'rgba(23, 162, 184, 0.7)', // teal with 70% opacity
                    'rgba(253, 126, 20, 0.7)', // orange with 70% opacity
                    'rgba(102, 16, 242, 0.7)', // indigo with 70% opacity
                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)', // red with 70% opacity
                    'rgba(255, 193, 7, 0.7)',
                ],
                borderColor: [
                    // yellow with 70% opacity
                    'rgba(40, 167, 69, 0.7)', // green with 70% opacity
                    'rgba(111, 66, 193, 0.7)', // purple with 70% opacity
                    'rgba(23, 162, 184, 0.7)', // teal with 70% opacity
                    'rgba(253, 126, 20, 0.7)', // orange with 70% opacity
                    'rgba(102, 16, 242, 0.7)', // indigo with 70% opacity
                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)', // red with 70% opacity
                    'rgba(255, 193, 7, 0.7)',

                ],
                borderWidth: 1
            }]
        },
        options: {

            height: 100, // set the chart height to 300 pixels
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Number of resident/s'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Street name'
                    }
                },
                yAxes: [{

                    ticks: {
                        beginAtZero: true,
                        stepSize: 1, // set step size to 1 to display whole numbers
                        callback: function(value) { // add a callback function to format tick labels
                            if (Number.isInteger(value)) {
                                return value.toFixed(0); // display whole numbers without decimal places
                            }
                        }
                    },
                    max: function(context) { // set max value using a function to add 5 to highest data point
                        var max = context.chart.data.datasets[0].data.reduce(function(a, b) {
                            return Math.max(a, b);
                        });
                        return Math.ceil(max / 5) * 5;
                    }

                }]
            }
        }
    });


    myChart_ctx_street.canvas.parentNode.style.width = '800px';
    myChart_ctx_street.canvas.parentNode.style.display = 'block';
    myChart_ctx_street.canvas.parentNode.style.margin = '0 auto';
</script>
@endforeach


</html>