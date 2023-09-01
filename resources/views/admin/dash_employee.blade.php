@include('admin/adminHeader')
@foreach($admin_info as $admin)
<style>
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
    <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-back"></i> Report
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/admin/dashboard">Services Report</a></li>
            <li><a class="dropdown-item" href="/dashboard-resident">Resident Report</a></li>
            <li><a class="dropdown-item" href="/dashboard-employee">Employee Report</a></li>
        </ul>
    </div>
    <hr style="color: black;">


    <div class="myContainer">
        <div class="container overflow-hidden mt-3">
            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">Employee Report</h3>
            </div>

            <div class="row">
                <div class="col-md-6 col-xl-3 mb-4">
                    <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                        <div class="card-body">
                            <div class="row align-items-center no-gutters">
                                <div class="col me-2">
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1 "><span>Barangay Employee Account</span></div>
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
                                    <div class="text-uppercase text-success fw-bold text-xs mb-1 "><span>Active Barangay Employee</span></div>
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
                                    <div class="text-uppercase text-danger fw-bold text-xs mb-1 "><span>Inactive Barangay Employee</span></div>
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
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1 "><span>Barangay Employee List</span></div>
                                    <a data-bs-toggle="collapse" href="#visit_analytics" class="link-dark">Click here <i class="bi bi-arrow-right-circle-fill"></i></a>
                                </div>
                                <div class="col-auto"><i class="bi bi-person-lines-fill h2 w-bold text-xs mb-1"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xl-12 mb-4 collapse" id="visit_analytics">

                    <div class="card text-center">
                        <div class="card-header">
                            List of Barangay Employee
                        </div>
                        <div class="card-body">
                            <table id="employee" class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Employee ID</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">View</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list_info as $admin)

                                    @if($admin->middle_name == 'N/A')
                                    <p hidden>{{$fullname = strtolower($admin->first_name." ".$admin->last_name)}}</p>

                                    @else
                                    <p hidden>{{$fullname = strtolower($admin->first_name)." ".strtolower($admin->middle_name)." ".strtolower($admin->last_name)}}</p>

                                    @endif
                                    <tr>
                                        <td style="text-transform: uppercase;">{{$admin->validID_num}}</td>
                                        <td style>{{ucwords($fullname)." ".$admin->suffix}}</td>
                                        <td style="text-transform: uppercase;">{{$admin->role}}</td>
                                        <td class="text-lowercase" style="text-transform: uppercase;">{{$admin->email}}</td>
                                        <td class="text-center">

                                            <a href="/viewEmployee/{{$admin->id}}" class="btn btn-success btn-sm"><i class="bi bi-eye-fill"></i> View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-muted">
                            As of {{date('F j, Y (g:i a)')}}
                        </div>
                    </div>


                </div>
            </div>

            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                <h3 class="text-dark mb-0">Employee Stats</h3>
            </div>

            <div id="stats">

                <div class="row">
                    <div class="col-md-12 col-xl-6 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #dc3545;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-danger fw-bold text-xs mb-4 "><span>Requests Progress</span></div>
                                        @foreach($requests as $requests)
                                        <h6 class="text-dark mb-2">{{$requests->employee_name}} ({{number_format($requests->computation, 2, '.', '')}}%)</h6>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-danger" role="progressbar" aria-label="Info example" style="width: {{$requests->computation}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>

                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #198754;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-success fw-bold text-xs mb-4 "><span>Concerns Progress</span></div>
                                        @foreach($concerns as $concerns)
                                        <h6 class="text-dark mb-2">{{$concerns->concern_processed_by}} ({{number_format($concerns->computation, 2, '.', '')}}%)</h6>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-success" role="progressbar" aria-label="Info example" style="width: {{$concerns->computation}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
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

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
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
<script>
    $(document).ready(function() {
        var table = $('#employee').DataTable({
            responsive: true,
            order: [
                [0, 'asc']
            ],
            buttons: [{
                extend: 'excel',
                className: 'btn btn-warning mt-3 me-1 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as Excel',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE EMPLOYEE LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE EMPLOYEE LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }, {
                extend: 'pdf',
                className: 'btn btn-warning mt-3 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as PDF',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE EMPLOYEE LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE EMPLOYEE LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }]
        });

        table.buttons().container()
            .appendTo('#employee_wrapper .col-md-6:eq(0)');
    });
</script>


@endforeach

</html>