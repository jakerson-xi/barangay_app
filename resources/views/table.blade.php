<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,
            shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets_header/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_header/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets_header/css/Navbar-With-Button-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="container text-center">
        <div class="row align-items-start">
            <div class="col">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col">
                {{$res}}
            </div>
            <div class="col">
                One of three columns
            </div>
        </div>
    </div>
    <div class="">

    </div>
</body>
<script src=" https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var encodedData = '{{$res}}';
        var decodedData = $('<textarea/>').html(encodedData).text(); // decode HTML entities
        var request_Data = JSON.parse(decodedData);
        var labels = [];
        var data = [];

        for (var i = 0; i < requestData.length; i++) {
            labels.push(requestData[i].request_status);
            data.push(requestData[i].count);
        }
        console.log(data);
    });
    var encodedData = '{{$res}}';
    var decodedData = $('<textarea/>').html(encodedData).text(); // decode HTML entities
    var request_Data = JSON.parse(decodedData);

    var labels = [];
    var data = [];

    for (var i = 0; i < request_Data.length; i++) {
        labels.push(request_Data[i].request_status);
        data.push(request_Data[i].count);
    }
    var ctx = document.getElementById('myChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Request Count',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    // var ctx = document.getElementById('myChart').getContext('2d');
    // var chart = new Chart(ctx, {
    //     type: 'doughnut',
    //     data: {
    //         labels: ['Female', 'Male'],
    //         datasets: [{
    //             label: 'Gender Distribution',
    //             data: [genderData[0].total, genderData[1].total],
    //             backgroundColor: ['pink', 'blue']
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         scales: {
    //             yAxes: [{
    //                 ticks: {
    //                     beginAtZero: true
    //                 }
    //             }]
    //         }
    //     }
    // });
</script>

</html> -->


<div class="card text-center mb-3 ">
    <div class="card-header">
        <div class="d-sm-flex justify-content-between align-items-center ">
            <h3 class="text-dark mb-0">SUBMITTED CONCERN REPORT</h3>
            <select id="co_report_select" class="form-select w-25" aria-label="Default select example">
                <option selected value="co_report_all">Overall report</option>
                <option value="co_report_assign">My report</option>
            </select>
        </div>
    </div>
    <div class="card-body">
        <div id="co_report_all_div">
            <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradios" id="btnForConToday" autocomplete="off" checked>
                <label class="btn btn-outline-dark" for="btnForConToday">All</label>

                <input type="radio" class="btn-check" name="btnradios" id="btnForConAll" autocomplete="off">
                <label class="btn btn-outline-dark" for="btnForConAll">Today</label>
            </div>
            <div id="data-all-con">
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center"><span>PENDING</span></div>
                                        @if($con_count->where('concern_status', 'PENDING')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$con_count->where('concern_status', 'PENDING')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-success py-2" style=" border-left: 5px solid #0dcaf0;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-info fw-bold text-xs mb-1 text-center"><span>Processing</span></div>
                                        @if($con_count->where('concern_status', 'PROCESSING')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$con_count->where('concern_status', 'PROCESSING')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-info py-2" style=" border-left: 5px solid #212529;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-dark  fw-bold text-xs mb-1 text-center"><span>In-progress</span></div>
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto">
                                                @php
                                                $con_pendingCount = 0;
                                                $con_processingCount = 0;
                                                $con_readyForPaymentCount = 0;
                                                $con_DONECount = 0;
                                                $con_DENIEDCount = 0;
                                                @endphp

                                                @foreach ($con_count as $con_countCount)
                                                @switch($con_countCount->concern_status)
                                                @case('PENDING')
                                                @php $con_pendingCount += $con_countCount->count @endphp
                                                @break
                                                @case('PROCESSING')
                                                @php $con_processingCount += $con_countCount->count @endphp
                                                @break
                                                @case('DONE')
                                                @php $con_DONECount += $con_countCount->count @endphp
                                                @break
                                                @case('DENIED')
                                                @php $con_DENIEDCount += $con_countCount->count @endphp
                                                @break
                                                @default
                                                {{-- Do nothing --}}
                                                @endswitch
                                                @endforeach
                                                @php $con_total = $con_pendingCount + $con_processingCount + $con_DONECount + $con_DENIEDCount;@endphp
                                                @if($con_pendingCount + $con_processingCount == 0)
                                                @php $con_totalInProgressCount =100;@endphp

                                                @else
                                                @php $con_totalInProgressCount = (( $con_DONECount + $con_DENIEDCount) / $con_total) *100 ;@endphp

                                                @endif

                                                <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{number_format($con_totalInProgressCount,2)}}%</span></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-dark" aria-valuenow="{{$con_totalInProgressCount}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $con_totalInProgressCount }}%;"><span class="visually-hidden">60%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->

                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-success py-2" style=" border-left: 5px solid #0d6efd;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-primary fw-bold text-xs mb-1 text-center"><span>DONE</span></div>
                                        @if($con_count->where('concern_status', 'DONE')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$con_count->where('concern_status', 'DONE')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-warning py-2" style=" border-left: 5px solid #dc3545;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-danger fw-bold text-xs mb-1 text-center"><span>DENIED</span></div>
                                        @if($con_count->where('concern_status', 'DENIED')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$con_count->where('concern_status', 'DENIED')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="data-today-con" style="display: none;">
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center"><span>PENDING</span></div>
                                        @if($conCountsToday->where('concern_status', 'PENDING')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$conCountsToday->where('concern_status', 'PENDING')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-success py-2" style=" border-left: 5px solid #0dcaf0;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-info fw-bold text-xs mb-1 text-center"><span>Processing</span></div>
                                        @if($conCountsToday->where('concern_status', 'PROCESSING')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$conCountsToday->where('concern_status', 'PROCESSING')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-info py-2" style=" border-left: 5px solid #212529;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-dark  fw-bold text-xs mb-1 text-center"><span>In-progress</span></div>
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto">
                                                @php
                                                $concern_pendingCount = 0;
                                                $concern_processingCount = 0;
                                                $concern_DONECount = 0;
                                                $concern_DENIEDCount = 0;
                                                @endphp

                                                @foreach ($conCountsToday as $conCount)
                                                @switch($conCount->concern_status)
                                                @case('PENDING')
                                                @php $concern_pendingCount += $conCount->count @endphp
                                                @break
                                                @case('PROCESSING')
                                                @php $concern_processingCount += $conCount->count @endphp
                                                @break
                                                @case('DONE')
                                                @php $concern_DONECount += $conCount->count @endphp
                                                @break
                                                @case('DENIED')
                                                @php $concern_DENIEDCount += $conCount->count @endphp
                                                @break
                                                @default
                                                {{-- Do nothing --}}
                                                @endswitch
                                                @endforeach
                                                @php
                                                $concern_total = $concern_pendingCount + $concern_processingCount + $concern_DONECount + $concern_DENIEDCount;
                                                @endphp
                                                @if($concern_pendingCount + $concern_processingCount == 0)
                                                @php $concern_totalInProgressCount = 100 @endphp

                                                @else
                                                @php $concern_totalInProgressCount = (( $concern_DONECount + $concern_DENIEDCount)/$concern_total ) * 100 ; @endphp

                                                @endif

                                                <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{number_format($concern_totalInProgressCount,2)}}%</span></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-dark" aria-valuenow="{{$concern_totalInProgressCount}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $concern_totalInProgressCount }}%;"><span class="visually-hidden">60%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->

                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-success py-2" style=" border-left: 5px solid #0d6efd;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-primary fw-bold text-xs mb-1 text-center"><span>DONE</span></div>
                                        @if($conCountsToday->where('concern_status', 'DONE')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$conCountsToday->where('concern_status', 'DONE')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-warning py-2" style=" border-left: 5px solid #dc3545;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-danger fw-bold text-xs mb-1 text-center"><span>DENIED</span></div>
                                        @if($conCountsToday->where('concern_status', 'DENIED')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$conCountsToday->where('concern_status', 'DENIED')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="co_report_assign_div" style="display:none">
            <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradios_emp" id="btnForConToday_emp" autocomplete="off" checked>
                <label class="btn btn-outline-dark" for="btnForConToday_emp">All</label>

                <input type="radio" class="btn-check" name="btnradios_emp" id="btnForConAll_emp" autocomplete="off">
                <label class="btn btn-outline-dark" for="btnForConAll_emp">Today</label>
            </div>
            <div id="data-all-con">
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center"><span>PENDING</span></div>
                                        @if($con_count_emp->where('concern_status', 'PENDING')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$con_count_emp->where('concern_status', 'PENDING')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-success py-2" style=" border-left: 5px solid #0dcaf0;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-info fw-bold text-xs mb-1 text-center"><span>Processing</span></div>
                                        @if($con_count_emp->where('concern_status', 'PROCESSING')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$con_count_emp->where('concern_status', 'PROCESSING')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-info py-2" style=" border-left: 5px solid #212529;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-dark  fw-bold text-xs mb-1 text-center"><span>In-progress</span></div>
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto">
                                                @php
                                                $con_pendingCount = 0;
                                                $con_processingCount = 0;
                                                $con_readyForPaymentCount = 0;
                                                $con_DONECount = 0;
                                                $con_DENIEDCount = 0;
                                                @endphp

                                                @foreach ($con_count_emp as $con_count_empCount)
                                                @switch($con_count_empCount->concern_status)
                                                @case('PENDING')
                                                @php $con_pendingCount += $con_count_empCount->count @endphp
                                                @break
                                                @case('PROCESSING')
                                                @php $con_processingCount += $con_count_empCount->count @endphp
                                                @break
                                                @case('DONE')
                                                @php $con_DONECount += $con_count_empCount->count @endphp
                                                @break
                                                @case('DENIED')
                                                @php $con_DENIEDCount += $con_count_empCount->count @endphp
                                                @break
                                                @default
                                                {{-- Do nothing --}}
                                                @endswitch
                                                @endforeach
                                                @php $con_total = $con_pendingCount + $con_processingCount + $con_DONECount + $con_DENIEDCount;@endphp
                                                @if($con_pendingCount + $con_processingCount == 0)
                                                @php $con_totalInProgressCount =100;@endphp

                                                @else
                                                @php $con_totalInProgressCount = (( $con_DONECount + $con_DENIEDCount) / $con_total) *100 ;@endphp

                                                @endif

                                                <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{number_format($con_totalInProgressCount,2)}}%</span></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-dark" aria-valuenow="{{$con_totalInProgressCount}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $con_totalInProgressCount }}%;"><span class="visually-hidden">60%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->

                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-success py-2" style=" border-left: 5px solid #0d6efd;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-primary fw-bold text-xs mb-1 text-center"><span>DONE</span></div>
                                        @if($con_count_emp->where('concern_status', 'DONE')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$con_count_emp->where('concern_status', 'DONE')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-warning py-2" style=" border-left: 5px solid #dc3545;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-danger fw-bold text-xs mb-1 text-center"><span>DENIED</span></div>
                                        @if($con_count_emp->where('concern_status', 'DENIED')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$con_count_emp->where('concern_status', 'DENIED')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="data-today-con" style="display: none;">
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center"><span>PENDING</span></div>
                                        @if($conCountsToday_emp->where('concern_status', 'PENDING')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$conCountsToday_emp->where('concern_status', 'PENDING')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-success py-2" style=" border-left: 5px solid #0dcaf0;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-info fw-bold text-xs mb-1 text-center"><span>Processing</span></div>
                                        @if($conCountsToday_emp->where('concern_status', 'PROCESSING')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$conCountsToday_emp->where('concern_status', 'PROCESSING')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-info py-2" style=" border-left: 5px solid #212529;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-dark  fw-bold text-xs mb-1 text-center"><span>In-progress</span></div>
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto">
                                                @php
                                                $concern_pendingCount = 0;
                                                $concern_processingCount = 0;
                                                $concern_DONECount = 0;
                                                $concern_DENIEDCount = 0;
                                                @endphp

                                                @foreach ($conCountsToday_emp as $conCount)
                                                @switch($conCount->concern_status)
                                                @case('PENDING')
                                                @php $concern_pendingCount += $conCount->count @endphp
                                                @break
                                                @case('PROCESSING')
                                                @php $concern_processingCount += $conCount->count @endphp
                                                @break
                                                @case('DONE')
                                                @php $concern_DONECount += $conCount->count @endphp
                                                @break
                                                @case('DENIED')
                                                @php $concern_DENIEDCount += $conCount->count @endphp
                                                @break
                                                @default
                                                {{-- Do nothing --}}
                                                @endswitch
                                                @endforeach
                                                @php
                                                $concern_total = $concern_pendingCount + $concern_processingCount + $concern_DONECount + $concern_DENIEDCount;
                                                @endphp
                                                @if($concern_pendingCount + $concern_processingCount == 0)
                                                @php $concern_totalInProgressCount = 100 @endphp

                                                @else
                                                @php $concern_totalInProgressCount = (( $concern_DONECount + $concern_DENIEDCount)/$concern_total ) * 100 ; @endphp

                                                @endif

                                                <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{number_format($concern_totalInProgressCount,2)}}%</span></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-dark" aria-valuenow="{{$concern_totalInProgressCount}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $concern_totalInProgressCount }}%;"><span class="visually-hidden">60%</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->

                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-success py-2" style=" border-left: 5px solid #0d6efd;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-primary fw-bold text-xs mb-1 text-center"><span>DONE</span></div>
                                        @if($conCountsToday_emp->where('concern_status', 'DONE')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$conCountsToday_emp->where('concern_status', 'DONE')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-4">
                        <div class="card shadow border-start-warning py-2" style=" border-left: 5px solid #dc3545;">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-danger fw-bold text-xs mb-1 text-center"><span>DENIED</span></div>
                                        @if($conCountsToday_emp->where('concern_status', 'DENIED')->isNotEmpty() != TRUE)
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                        @else
                                        <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$conCountsToday_emp->where('concern_status', 'DENIED')->first()->count}}</span></div>
                                        @endif
                                    </div>
                                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
        As of {{date('F j, Y (g:i a)')}}
    </div>
</div>