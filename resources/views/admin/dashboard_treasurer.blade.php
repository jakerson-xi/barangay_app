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
    <div class="card ">
        <div class="card-header">
            <h3>TRANSACTION REPORTS</h3>
        </div>
        <div class="card-body ">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="daily-tab" data-bs-toggle="tab" data-bs-target="#daily-tab-pane" type="button" role="tab" aria-controls="daily-tab-pane" aria-selected="true">Daily</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="weekly-tab" data-bs-toggle="tab" data-bs-target="#weekly-tab-pane" type="button" role="tab" aria-controls="weekly-tab-pane" aria-selected="false">Weekly</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly-tab-pane" type="button" role="tab" aria-controls="monthly-tab-pane" aria-selected="false">Monthly</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="yearly-tab" data-bs-toggle="tab" data-bs-target="#yearly-tab-pane" type="button" role="tab" aria-controls="yearly-tab-pane" aria-selected="false">Yearly</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="daily-tab-pane" role="tabpanel" aria-labelledby="daily-tab" tabindex="0">
                    <div class="row pt-5">
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #198754; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-success fw-bold text-xs mb-1 text-center">
                                        <span>Total Income</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($dailyTotal, 2, '.', '')}}</span></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #0d6efd; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1 text-center">
                                        <span>Online Payment Transactions</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($dailyTotal_online, 2, '.', '')}}</span></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #dc3545; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-danger fw-bold text-xs mb-1 text-center">
                                                <span>Onsite Payment Transactions</span>
                                            </div>
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($dailyTotal_onsite, 2, '.', '')}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #ffc107; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center">
                                        <span>Ready for Payment</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$dailyRFP}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="weekly-tab-pane" role="tabpanel" aria-labelledby="weekly-tab" tabindex="0">
                    <div class="row pt-5">
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #198754; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-success fw-bold text-xs mb-1 text-center">
                                        <span>Total Income</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($weeklyTotal, 2, '.', '')}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #0d6efd; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1 text-center">
                                        <span>Online Payment Transactions</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($weeklyTotal_online, 2, '.', '')}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #dc3545; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-danger fw-bold text-xs mb-1 text-center">
                                        <span>Onsite Payment Transactions</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($weeklyTotal_onsite, 2, '.', '')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #ffc107; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center">
                                        <span>Ready for Payment</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$weeklyRFP}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="monthly-tab-pane" role="tabpanel" aria-labelledby="monthly-tab" tabindex="0">
                    <div class="row pt-5">
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #198754; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-success fw-bold text-xs mb-1 text-center">
                                        <span>Total Income</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($monthlyTotal, 2, '.', '')}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #0d6efd; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1 text-center">
                                        <span>Online Payment Transactions</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($monthlyTotal_online, 2, '.', '')}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #dc3545; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-danger fw-bold text-xs mb-1 text-center">
                                        <span>Onsite Payment Transactions</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($monthlyTotal_onsite, 2, '.', '')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #ffc107; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center">
                                        <span>Ready for Payment</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$monthlyRFP}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="yearly-tab-pane" role="tabpanel" aria-labelledby="yearly-tab" tabindex="0">
                    <div class="row pt-5">
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #198754; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-success fw-bold text-xs mb-1 text-center">
                                        <span>Total Income</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($yearlyTotal, 2, '.', '')}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #0d6efd; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-info fw-bold text-xs mb-1 text-center">
                                        <span>Online Payment Transactions</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($yearlyTotal_online, 2, '.', '')}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #dc3545; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-danger fw-bold text-xs mb-1 text-center">
                                        <span>Onsite Payment Transactions</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>₱ {{number_format($yearlyTotal_onsite, 2, '.', '')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mb-4">
                            <div class="card text-center py-2" style="border-left: 5px solid #ffc107; border-radius: 8px;">
                                <div class="card-body">
                                    <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center">
                                        <span>Ready for Payment</span>
                                    </div>
                                    <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$yearlyRFP}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="payment-statistics text-center mb-4">
            <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="bi bi-graph-up"></i> Show Transactions Statistics
            </button>
        </div>
        <div class="card-footer text-muted text-center">
            As of {{ date('F j, Y g:i A', time())}}
        </div>
    </div>

    <div class="collapse mt-3" id="collapseExample">
        <div class="card">
            <div class="card-header text-center">
                <h4>Transaction Report (Category per Timestamp)</h4>
            </div>
            <div class="card-body m-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="income-tab" data-bs-toggle="tab" data-bs-target="#income-tab-pane" type="button" role="tab" aria-controls="income-tab-pane" aria-selected="true">Income</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="online-tab" data-bs-toggle="tab" data-bs-target="#online-tab-pane" type="button" role="tab" aria-controls="online-tab-pane" aria-selected="false">Online
                            Payment</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="onsite-tab" data-bs-toggle="tab" data-bs-target="#onsite-tab-pane" type="button" role="tab" aria-controls="onsite-tab-pane" aria-selected="false">Onsite
                            Payment</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="income-tab-pane" role="tabpanel" aria-labelledby="income-tab" tabindex="0">
                        <div class="row pt-2 m-3">
                            <div class="col-2 text-center">
                                <div class="d-flex align-items-start">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link active" id="v-pills-daily-tab" data-bs-toggle="pill" data-bs-target="#v-pills-daily" type="button" role="tab" aria-controls="v-pills-daily" aria-selected="true">Daily</button>
                                        <button class="nav-link" id="v-pills-weekly-tab" data-bs-toggle="pill" data-bs-target="#v-pills-weekly" type="button" role="tab" aria-controls="v-pills-weekly" aria-selected="false">Weekly</button>
                                        <button class="nav-link" id="v-pills-monthly-tab" data-bs-toggle="pill" data-bs-target="#v-pills-monthly" type="button" role="tab" aria-controls="v-pills-monthly" aria-selected="false">Monthly</button>
                                        <button class="nav-link" id="v-pills-yearly-tab" data-bs-toggle="pill" data-bs-target="#v-pills-yearly" type="button" role="tab" aria-controls="v-pills-yearly" aria-selected="false">Yearly</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="card">
                                    <div class="tab-content p-3" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-daily" role="tabpanel" aria-labelledby="v-pills-daily-tab" tabindex="0">
                                            <div class="card-title text-center">
                                                <h4>Total Income per Day</h4>
                                                <canvas id="dailyIncomeChart"></canvas>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-weekly" role="tabpanel" aria-labelledby="v-pills-weekly-tab" tabindex="0">
                                            <div class="card-title text-center">
                                                <h4>Total Income per Week</h4>
                                                <canvas id="weeklyIncomeChart"></canvas>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-monthly" role="tabpanel" aria-labelledby="v-pills-monthly-tab" tabindex="0">
                                            <div class="card-title text-center">
                                                <h4>Total Income per Month</h4>
                                                <canvas id="monthlyIncomeChart"></canvas>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-yearly" role="tabpanel" aria-labelledby="v-pills-yearly-tab" tabindex="0">
                                            <div class="card-title text-center">
                                                <h4>Total Income per Year</h4>
                                                <canvas id="yearlyIncomeChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="onsite-tab-pane" role="tabpanel" aria-labelledby="onsite-tab" tabindex="0">
                        <div class="row pt-2 m-3">
                            <div class="col-3">
                                <div class="d-flex align-items-start">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link active" id="v-pills-daily-tab" data-bs-toggle="pill" data-bs-target="#v-pills-daily-onsite" type="button" role="tab" aria-controls="v-pills-daily-onsite" aria-selected="true">Daily</button>
                                        <button class="nav-link" id="v-pills-weekly-tab" data-bs-toggle="pill" data-bs-target="#v-pills-weekly-onsite" type="button" role="tab" aria-controls="v-pills-weekly-onsite" aria-selected="false">Weekly</button>
                                        <button class="nav-link" id="v-pills-monthly-tab" data-bs-toggle="pill" data-bs-target="#v-pills-monthly-onsite" type="button" role="tab" aria-controls="v-pills-monthly-onsite" aria-selected="false">Monthly</button>
                                        <button class="nav-link" id="v-pills-yearly-tab" data-bs-toggle="pill" data-bs-target="#v-pills-yearly-onsite" type="button" role="tab" aria-controls="v-pills-yearly-onsite" aria-selected="false">Yearly</button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-daily-onsite" role="tabpanel" aria-labelledby="v-pills-daily-tab" tabindex="0">
                                        <div class="card-title text-center">
                                            <h4>Total Onsite Payment per Day</h4>
                                            <canvas id="dailyOnsiteChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-weekly-onsite" role="tabpanel" aria-labelledby="v-pills-weekly-tab" tabindex="0">
                                        <div class="card-title text-center">
                                            <h4>Total Onsite Payment per Week</h4>
                                            <canvas id="weeklyOnsiteChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-monthly-onsite" role="tabpanel" aria-labelledby="v-pills-monthly-tab" tabindex="0">
                                        <div class="card-title text-center">
                                            <h4>Total Onsite Payment per Month</h4>
                                            <canvas id="monthlyOnsiteChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-yearly-onsite" role="tabpanel" aria-labelledby="v-pills-yearly-tab" tabindex="0">
                                        <div class="card-title text-center">
                                            <h4>Total Onsite Payment per Year</h4>
                                            <canvas id="yearlyOnsiteChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="online-tab-pane" role="tabpanel" aria-labelledby="online-tab" tabindex="0">
                        <div class="row pt-2 m-3">
                            <div class="col-3">
                                <div class="d-flex align-items-start">
                                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link active" id="v-pills-daily-tab" data-bs-toggle="pill" data-bs-target="#v-pills-daily-online" type="button" role="tab" aria-controls="v-pills-daily-online" aria-selected="true">Daily</button>
                                        <button class="nav-link" id="v-pills-weekly-tab" data-bs-toggle="pill" data-bs-target="#v-pills-weekly-online" type="button" role="tab" aria-controls="v-pills-weekly-online" aria-selected="false">Weekly</button>
                                        <button class="nav-link" id="v-pills-monthly-tab" data-bs-toggle="pill" data-bs-target="#v-pills-monthly-online" type="button" role="tab" aria-controls="v-pills-monthly-online" aria-selected="false">Monthly</button>
                                        <button class="nav-link" id="v-pills-yearly-tab" data-bs-toggle="pill" data-bs-target="#v-pills-yearly-online" type="button" role="tab" aria-controls="v-pills-yearly-online" aria-selected="false">Yearly</button>
                                    </div>

                                </div>
                            </div>
                            <div class="col-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-daily-online" role="tabpanel" aria-labelledby="v-pills-daily-tab" tabindex="0">
                                        <div class="card-title text-center">
                                            <h4>Total Online Payments per Day</h4>
                                            <canvas id="dailyOnlineChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-weekly-online" role="tabpanel" aria-labelledby="v-pills-weekly-tab" tabindex="0">
                                        <div class="card-title text-center">
                                            <h4>Total Online Payments per Week</h4>
                                            <canvas id="weeklyOnlineChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-monthly-online" role="tabpanel" aria-labelledby="v-pills-monthly-tab" tabindex="0">
                                        <div class="card-title text-center">
                                            <h4>Total Online Payments per Month</h4>
                                            <canvas id="monthlyOnlineChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-yearly-online" role="tabpanel" aria-labelledby="v-pills-yearly-tab" tabindex="0">
                                        <div class="card-title text-center">
                                            <h4>Total Online Payments per Year</h4>
                                            <canvas id="yearlyOnlineChart"></canvas>
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
    <div class="card mt-3">
        <div class="card-header text-center">
            <h4>Onsite Payment vs. Online Payment</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6" style="display: block; margin: 0 auto;">
                    <h5 class="text-center">Online Payment vs. Onsite Payment</h5>
                    <canvas id="onsiteVsOnlineChart"></canvas>
                </div>
                <div class="col-6" style="display: block; margin: 0 auto;">
                    <h6 class="text-center"># of Payment per Mode of Online Payment</h6>
                    <canvas id="onlinePieChart"></canvas>
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
    let doughnutChart = document.getElementById('onsiteVsOnlineChart')
    let mydoughnutChart = new Chart(doughnutChart, {
        type: 'doughnut',
        data: {
            labels: [
                'Onsite Payment',
                'Online Payment',
            ],
            datasets: [{
                data: ['{{$onsiteNum}}', '{{$onlineNum}}']
            }, ],
            backgroundColor: [
                'rgb(255,0,0)',
                'rgb(54, 162, 235)'
            ],
            borderWidth: 5,
            borderRadius: 10,
            hoverOffset: 4
        },
        animation: false,
    });
    mydoughnutChart.canvas.parentNode.style.height = "400px"
    mydoughnutChart.canvas.parentNode.style.width = "400px"

    let pieChart = document.getElementById('onlinePieChart')
    let myPieChart = new Chart(pieChart, {
        type: 'pie',
        data: {
            labels: [
                'GCash', 'Maya', 'GrabPay'
            ],
            datasets: [{
                data: ['{{$onlinePayment[0]->method_count}}',
                    '{{$onlinePayment[2]->method_count}}',
                    '{{$onlinePayment[1]->method_count}}'
                ]
            }],
            backgroundColor: [
                'rgb(255,0,0)',
                'rgb(54, 162, 235)',
                'rgb(0,255,0)'
            ]

        }
    });
    myPieChart.canvas.parentNode.style.height = "400px"
    myPieChart.canvas.parentNode.style.width = "400px"
</script>
<script>
  
    let dailyIncomeChart = document.getElementById('dailyIncomeChart')
    let incomeChartDaily = new Chart(dailyIncomeChart, {
        type: 'bar',
        data: {
            labels:  @json($labels),
            datasets: [{
                label: "Total Income per Day",
                data: @json($data),
                backgroundColor: [
                    'rgb(25, 135, 84)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }],
        },
        options: {
            animation: false,
        }
    })
    let weeklyIncomeChart = document.getElementById('weeklyIncomeChart')
    let incomeChartWeekly = new Chart(weeklyIncomeChart, {
        type: 'bar',
        data: {
            labels: @json($labels_week),
            datasets: [{
                label: "Total Income per Week",
                data: @json($data_week),
                backgroundColor: [
                    'rgb(25, 135, 84)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }],

        },
        options: {
            animation: false,
        }
    })
    let monthlyIncomeChart = document.getElementById('monthlyIncomeChart')
    let incomeChartMonthly = new Chart(monthlyIncomeChart, {
        type: 'bar',
        data: {
            labels:@json($label_month),
            datasets: [{
                label: "Total Income per Month",
                data: @json($data_month),
                backgroundColor: [
                    'rgb(25, 135, 84)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
    let yearlyIncomeChart = document.getElementById('yearlyIncomeChart')
    let incomeChartYearly = new Chart(yearlyIncomeChart, {
        type: 'bar',
        data: {
            labels:@json($label_year),
            datasets: [{
                label: "Total Income per Year",
                data: @json($data_year),
                backgroundColor: [
                    'rgb(25, 135, 84)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
</script>
<script>
    let dailyOnsiteChart = document.getElementById('dailyOnsiteChart')
    let onsiteChartDaily = new Chart(dailyOnsiteChart, {
        type: 'bar',
        data: {
            labels: @json( $labels_day_onsite),
            datasets: [{
                label: "Total Onsite Payment per Day",
                data:@json( $data_day_onsite),
                backgroundColor: [
                    'rgb(220,53,69)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
    let weeklyOnsiteChart = document.getElementById('weeklyOnsiteChart')
    let onsiteChartWeekly = new Chart(weeklyOnsiteChart, {
        type: 'bar',
        data: {
            labels: @json($labels_week_onsite),
            datasets: [{
                label: "Total Onsite Payment per Week",
                data: @json($data_week_onsite),
                backgroundColor: [
                    'rgb(220,53,69)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
    let monthlyOnsiteChart = document.getElementById('monthlyOnsiteChart')
    let onsiteChartMonthly = new Chart(monthlyOnsiteChart, {
        type: 'bar',
        data: {
            labels: @json($label_month_onsite),
            datasets: [{
                label: "Total Onsite Payment per Month",
                data: @json($data_month_onsite),
                backgroundColor: [
                    'rgb(220,53,69)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
    let yearlyOnsiteChart = document.getElementById('yearlyOnsiteChart')
    let onsiteChartYearly = new Chart(yearlyOnsiteChart, {
        type: 'bar',
        data: {
            labels:@json( $label_year_onsite),
            datasets: [{
                label: "Total Onsite Payment per Year",
                data:@json( $data_year_onsite),
                backgroundColor: [
                    'rgb(220,53,69)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
</script>
<script>
    let dailyOnlineChart = document.getElementById('dailyOnlineChart')
    let onlineChartDaily = new Chart(dailyOnlineChart, {
        type: 'bar',
        data: {
            labels: @json($labels_online),
            datasets: [{
                label: "Total Online Payment per Day",
                data:@json($data_online),
                backgroundColor: [
                    'rgb(13, 110, 253)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
    let weeklyOnlineChart = document.getElementById('weeklyOnlineChart')
    let onlineChartWeekly = new Chart(weeklyOnlineChart, {
        type: 'bar',
        data: {
            labels: @json($labels_week_online),
            datasets: [{
                label: "Total Online Payment per Week",
                data: @json($data_week_online),
                backgroundColor: [
                    'rgb(13, 110, 253)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
    let monthlyOnlineChart = document.getElementById('monthlyOnlineChart')
    let onlineChartMonthly = new Chart(monthlyOnlineChart, {
        type: 'bar',
        data: {
            labels: @json($label_month_online),
            datasets: [{
                label: "Total Online Payment per Month",
                data:@json($data_month_online),
                backgroundColor: [
                    'rgb(13, 110, 253)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
    let yearlyOnlineChart = document.getElementById('yearlyOnlineChart')
    let onlineChartYearly = new Chart(yearlyOnlineChart, {
        type: 'bar',
        data: {
            labels:@json($label_year_online),
            datasets: [{
                label: "Total Online Payment per Year",
                data: @json($data_year_online),
                backgroundColor: [
                    'rgb(13, 110, 253)'
                ],
                borderColor: [
                    'rgb(0,0,0)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            animation: false,
        }
    })
</script>

@endforeach


</html>