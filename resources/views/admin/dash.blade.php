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


    <div class="card text-center mb-3 ">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between align-items-center ">
                <h3 class="text-dark mb-0">REQUESTED DOCUMENT REPORT</h3>
            </div>
        </div>
        <div class="card-body">
            <div id="re_report_all_div">
                <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnForReqToday" autocomplete="off" checked>
                    <label class="btn btn-outline-dark" for="btnForReqToday">All</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnForReqAll" autocomplete="off">
                    <label class="btn btn-outline-dark" for="btnForReqAll">Today</label>
                </div>
                <div id="data-all">
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center"><span>PENDING</span></div>
                                            @if($req_count->where('request_status', 'PENDING')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count->where('request_status', 'PENDING')->first()->count}}</span></div>
                                            @endif
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2 " style=" border-left: 5px solid #0dcaf0;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1 text-center"><span>Processing</span></div>
                                            @if($req_count->where('request_status', 'PROCESSING')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count->where('request_status', 'PROCESSING')->first()->count}}</span></div>
                                            @endif
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2" style=" border-left: 5px solid #198754;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1 text-center"><span>Ready for Payment</span></div>
                                            @if($req_count->where('request_status', 'READY FOR PAYMENT')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count->where('request_status', 'READY FOR PAYMENT')->first()->count}}</span></div>
                                            @endif
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-info py-2" style=" border-left: 5px solid #212529;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-dark  fw-bold text-xs mb-1 text-center"><span>In-progress</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    @php
                                                    $pendingCount = 0;
                                                    $processingCount = 0;
                                                    $readyForPaymentCount = 0;
                                                    $DONECount = 0;
                                                    $DENIEDCount = 0;
                                                    @endphp

                                                    @foreach ($req_count as $requestCount)
                                                    @switch($requestCount->request_status)
                                                    @case('PENDING')
                                                    @php $pendingCount += $requestCount->count @endphp
                                                    @break
                                                    @case('PROCESSING')
                                                    @php $processingCount += $requestCount->count @endphp
                                                    @break
                                                    @case('READY FOR PAYMENT')
                                                    @php $readyForPaymentCount += $requestCount->count @endphp
                                                    @break
                                                    @case('DONE')
                                                    @php $DONECount += $requestCount->count @endphp
                                                    @break
                                                    @case('DENIED')
                                                    @php $DENIEDCount += $requestCount->count @endphp
                                                    @break
                                                    @default
                                                    {{-- Do nothing --}}
                                                    @endswitch
                                                    @endforeach
                                                    @php
                                                    $total = $pendingCount + $processingCount + $readyForPaymentCount + $DONECount + $DENIEDCount;
                                                    @endphp
                                                    @if($pendingCount + $processingCount + $readyForPaymentCount == 0)
                                                    @php $totalInProgressCount = 100; @endphp
                                                    @else
                                                    @php $totalInProgressCount = (( $DONECount + $DENIEDCount) / $total) *100 ; @endphp
                                                    @endif


                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{number_format($totalInProgressCount,2)}}%</span></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-dark" aria-valuenow="{{$totalInProgressCount}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $totalInProgressCount }}%;"><span class="visually-hidden">60%</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                            @if($req_count->where('request_status', 'DONE')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count->where('request_status', 'DONE')->first()->count}}</span></div>
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
                                            @if($req_count->where('request_status', 'DENIED')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count->where('request_status', 'DENIED')->first()->count}}</span></div>
                                            @endif
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="data-today" style="display: none;">
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center"><span>PENDING</span></div>
                                            @if($requestCountsToday->where('request_status', 'PENDING')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday->where('request_status', 'PENDING')->first()->count}}</span></div>
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
                                            @if($requestCountsToday->where('request_status', 'PROCESSING')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday->where('request_status', 'PROCESSING')->first()->count}}</span></div>
                                            @endif
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-success  py-2" style=" border-left: 5px solid green;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1 text-center"><span>Ready for Payment</span></div>
                                            @if($requestCountsToday->where('request_status', 'READY FOR PAYMENT')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday->where('request_status', 'READY FOR PAYMENT')->first()->count}}</span></div>
                                            @endif
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-info py-2" style=" border-left: 5px solid #212529;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-dark  fw-bold text-xs mb-1 text-center"><span>In-progress Request</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    @php
                                                    $pendingCount = 0;
                                                    $processingCount = 0;
                                                    $readyForPaymentCount = 0;
                                                    $DONECount = 0;
                                                    $DENIEDCount = 0;
                                                    @endphp

                                                    @foreach ($requestCountsToday as $requestCount)
                                                    @switch($requestCount->request_status)
                                                    @case('PENDING')
                                                    @php $pendingCount += $requestCount->count @endphp
                                                    @break
                                                    @case('PROCESSING')
                                                    @php $processingCount += $requestCount->count @endphp
                                                    @break
                                                    @case('READY FOR PAYMENT')
                                                    @php $readyForPaymentCount += $requestCount->count @endphp
                                                    @break
                                                    @case('DONE')
                                                    @php $DONECount += $requestCount->count @endphp
                                                    @break
                                                    @case('DENIED')
                                                    @php $DENIEDCount += $requestCount->count @endphp
                                                    @break
                                                    @default
                                                    {{-- Do nothing --}}
                                                    @endswitch
                                                    @endforeach
                                                    @php $total = $pendingCount + $processingCount + $readyForPaymentCount + $DONECount + $DENIEDCount @endphp;
                                                    @if($pendingCount + $processingCount + $readyForPaymentCount == 0)
                                                    @php $totalInProgressCount = 100 ; @endphp
                                                    @else
                                                    @php $totalInProgressCount = (( $DONECount + $DENIEDCount) / $total) *100 ; @endphp
                                                    @endif


                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{$totalInProgressCount}}%</span></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-dark" aria-valuenow="{{$totalInProgressCount}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $totalInProgressCount }}%;"><span class="visually-hidden">60%</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-info py-2" style=" border-left: 5px solid #212529;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-dark  fw-bold text-xs mb-1 text-center"><span>In-progress</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    @php
                                                    $pendingCount = 0;
                                                    $processingCount = 0;
                                                    $readyForPaymentCount = 0;
                                                    $DONECount = 0;
                                                    $DENIEDCount = 0;
                                                    @endphp

                                                    @foreach ($requestCountsToday as $requestCount)
                                                    @switch($requestCount->request_status)
                                                    @case('PENDING')
                                                    @php $pendingCount += $requestCount->count @endphp
                                                    @break
                                                    @case('PROCESSING')
                                                    @php $processingCount += $requestCount->count @endphp
                                                    @break
                                                    @case('READY FOR PAYMENT')
                                                    @php $readyForPaymentCount += $requestCount->count @endphp
                                                    @break
                                                    @case('DONE')
                                                    @php $DONECount += $requestCount->count @endphp
                                                    @break
                                                    @case('DENIED')
                                                    @php $DENIEDCount += $requestCount->count @endphp
                                                    @break
                                                    @default
                                                    {{-- Do nothing --}}
                                                    @endswitch
                                                    @endforeach
                                                    @php
                                                    $total = $pendingCount + $processingCount + $readyForPaymentCount + $DONECount + $DENIEDCount;
                                                    @endphp
                                                    @if($pendingCount + $processingCount + $readyForPaymentCount == 0)
                                                    @php $totalInProgressCount = 100; @endphp
                                                    @else
                                                    @php $totalInProgressCount = (( $DONECount + $DENIEDCount) / $total) *100 ; @endphp
                                                    @endif

                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>{{number_format($totalInProgressCount,2)}}%</span></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-dark" aria-valuenow="{{$totalInProgressCount}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $totalInProgressCount }}%;"><span class="visually-hidden">60%</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                            @if($requestCountsToday->where('request_status', 'DONE')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday->where('request_status', 'DONE')->first()->count}}</span></div>
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
                                            @if($requestCountsToday->where('request_status', 'DENIED')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday->where('request_status', 'DENIED')->first()->count}}</span></div>
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


            <div class="my-3 text-center">
                <a class="btn btn-danger" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-graph-up"></i> Show request statistics
                </a>
            </div>
        </div>
        <div class="card-footer text-muted">
            As of {{date('F j, Y (g:i a)')}}
        </div>
    </div>

    <div class="collapse my-3" id="collapseExample">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h5> Statistics report (# of requests)</h5>
                    </div>
                    <div class="card-body">
                        <div class="btn-group mb-2" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio_stats" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btnradio1">Daily</label>

                            <input type="radio" class="btn-check" name="btnradio_stats" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-info" for="btnradio2">Weekly</label>

                            <input type="radio" class="btn-check" name="btnradio_stats" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-warning" for="btnradio3">Monthly</label>

                            <input type="radio" class="btn-check" name="btnradio_stats" id="btnradio4" autocomplete="off">
                            <label class="btn btn-outline-success" for="btnradio4">Yearly</label>

                        </div>
                        <div id="daily_chart" style="display: block;">
                            <div class=" text-dark fw-bold text-xs mb-1 text-center"><span>Number of Requests (Daily)</span></div>
                            <div style="display: block; margin: 0 auto;">
                                <input id='days' type="hidden" value="{{json_encode([$days])}}">
                                <input id='dayTotals' type="hidden" value="{{json_encode([$dayTotals])}}">
                                <canvas class="chart-canvas" id="request_days"></canvas>
                            </div>
                        </div>

                        <div id="weekly_chart" style="display: none;">
                            <div class=" text-dark fw-bold text-xs mb-1 text-center"><span>Number of Requests (Weekly)</span></div>
                            <div style="display: block; margin: 0 auto;">
                                <input id='weeks' type="hidden" value="{{json_encode([$weeks])}}">
                                <input id='weekTotals' type="hidden" value="{{json_encode([$weekTotals])}}">
                                <canvas class="chart-canvas" id="request_week"></canvas>
                            </div>
                        </div>

                        <div id="monthly_chart" style="display: none;">
                            <div class="text-dark fw-bold text-xs mb-1 text-center"><span>Number of Requests (Monthly)</span></div>
                            <input id='months' type="hidden" value="{{json_encode([$months])}}">
                            <input id='monthTotals' type="hidden" value="{{json_encode([$monthTotals])}}">
                            <div style="display: block; margin: 0 auto;">
                                <canvas class="chart-canvas" id="request_months"></canvas>
                            </div>
                        </div>

                        <div id="yearly_chart" style="display: none;">
                            <div class="text-dark fw-bold text-xs mb-1 text-center"><span>Number of Requests (Yearly)</span></div>
                            <input id='years' type="hidden" value="{{json_encode([$years])}}">
                            <input id='yearTotals' type="hidden" value="{{json_encode([$yearTotals])}}">
                            <div style="display: block; margin: 0 auto;">
                                <canvas class="chart-canvas" id="request_years"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="card text-center">
                    <div class="card-header text-center">
                        <h5> Number of requests per type (%)</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <input id='street' type="hidden" value="{{json_encode([$street])}}">
                            <input id='streetTotals' type="hidden" value="{{json_encode([$streetTotals])}}">
                            <div class=" text-dark fw-bold text-xs mb-1 text-center"><span># of requests per type</span></div>

                            <div style="display: block; margin: 0 auto;">
                                <canvas class="chart-canvas" id="req_type_pie"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="card text-center mb-3 ">
        <div class="card-header">
            <div class="d-sm-flex justify-content-between align-items-center ">
                <h3 class="text-dark mb-0">SUBMITTED CONCERN REPORT</h3>

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


            <div class="my-3 text-center">
                <a class="btn btn-danger" data-bs-toggle="collapse" href="#collapse_con" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-graph-up"></i> Show concern statistics
                </a>
            </div>
        </div>
        <div class="card-footer text-muted">
            As of {{date('F j, Y (g:i a)')}}
        </div>
    </div>

    <div class="collapse mb-3" id="collapse_con">
        <div class="card">
            <div class="card-header text-center">
                <h5> Statistics report (# of concerns)</h5>
            </div>
            <div class="card-body">
                <div class="btn-group mb-2" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio_cons" id="btnradio1_cons" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="btnradio1_cons">Daily</label>

                    <input type="radio" class="btn-check" name="btnradio_cons" id="btnradio2_cons" autocomplete="off">
                    <label class="btn btn-outline-info" for="btnradio2_cons">Weekly</label>

                    <input type="radio" class="btn-check" name="btnradio_cons" id="btnradio3_cons" autocomplete="off">
                    <label class="btn btn-outline-warning" for="btnradio3_cons">Monthly</label>

                    <input type="radio" class="btn-check" name="btnradio_cons" id="btnradio4_cons" autocomplete="off">
                    <label class="btn btn-outline-success" for="btnradio4_cons">Yearly</label>

                </div>
                <div id="daily_chart_cons" style="display: block;">
                    <div class=" text-dark fw-bold text-xs mb-1 text-center"><span>Number of Requests (Daily)</span></div>
                    <div style="display: block; margin: 0 auto;">
                        <input id='days_con' type="hidden" value="{{json_encode([$days_con])}}">
                        <input id='dayTotals_con' type="hidden" value="{{json_encode([$dayTotals_con])}}">
                        <canvas class="chart-canvas" id="cons_daily"></canvas>
                    </div>
                </div>

                <div id="weekly_chart_cons" style="display: none;">
                    <div class=" text-dark fw-bold text-xs mb-1 text-center"><span>Number of Requests (Weekly)</span></div>
                    <div style="display: block; margin: 0 auto;">
                        <input id='weeks_con' type="hidden" value="{{json_encode([$weeks_con])}}">
                        <input id='weekTotals_con' type="hidden" value="{{json_encode([$weekTotals_con])}}">
                        <canvas class="chart-canvas" id="cons_weekly"></canvas>
                    </div>
                </div>

                <div id="monthly_chart_cons" style="display: none;">
                    <div class="text-dark fw-bold text-xs mb-1 text-center"><span>Number of Requests (Monthly)</span></div>
                    <input id='months_con' type="hidden" value="{{json_encode([$months_con])}}">
                    <input id='monthTotals_con' type="hidden" value="{{json_encode([$monthTotals_con])}}">
                    <div style="display: block; margin: 0 auto;">
                        <canvas class="chart-canvas" id="cons_monthly"></canvas>
                    </div>
                </div>

                <div id="yearly_chart_cons" style="display: none;">
                    <div class="text-dark fw-bold text-xs mb-1 text-center"><span>Number of Requests (Yearly)</span></div>
                    <input id='years_con' type="hidden" value="{{json_encode([$years_con])}}">
                    <input id='yearTotals_con' type="hidden" value="{{json_encode([$yearTotals_con])}}">
                    <div style="display: block; margin: 0 auto;">
                        <canvas class="chart-canvas" id="cons_yearly"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="card text-center">
                <div class="card-header text-center">
                    <h5> Number of concern per type (%)</h5>
                </div>
                <div class="card-body">
                    <div>
                        <input id='concern_type' type="hidden" value="{{json_encode([$concern_type])}}">
                        <input id='concern_type_count' type="hidden" value="{{json_encode([$concern_type_count])}}">
                        <div class=" text-dark fw-bold text-xs mb-1 text-center"><span># of concern per type</span></div>

                        <div style="display: block; margin: 0 auto;">
                            <canvas class="chart-canvas" id="con_type_pie"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>







<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    var ctx_chart_con = document.getElementById('con_type_pie');
    var lab_con = document.getElementById('concern_type').value;
    var data_con = document.getElementById('concern_type_count').value;

    var data = JSON.parse(data_con.slice(1, -1));
    var total = data.reduce(function(sum, value) {
        return sum + value;
    }, 0);

    var percentages = data.map(function(value) {
        return Math.round(value / total * 100);
    });

    var myChart_ctx_con = new Chart(ctx_chart_con, {
        type: 'doughnut',
        data: {
            labels: JSON.parse(lab_con.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: percentages,
                backgroundColor: [
                    // yellow with 70% opacity
                    'rgba(40, 167, 69, 0.7)', // green with 70% opacity
                    'rgba(111, 66, 193, 0.7)', // purple with 70% opacity
                    'rgba(23, 162, 184, 0.7)', // teal with 70% opacity
                    'rgba(253, 126, 20, 0.7)', // orange with 70% opacity

                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)', // red with 70% opacity
                    'rgba(255, 193, 7, 0.7)',
                    'rgba(102, 16, 242, 0.7)', // indigo with 70% opacity
                ],
                borderColor: [
                    'rgba(40, 167, 69, 0.7)', // green with 70% opacity
                    'rgba(111, 66, 193, 0.7)', // purple with 70% opacity
                    'rgba(23, 162, 184, 0.7)', // teal with 70% opacity
                    'rgba(253, 126, 20, 0.7)', // orange with 70% opacity

                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)', // red with 70% opacity
                    'rgba(255, 193, 7, 0.7)',
                    'rgba(102, 16, 242, 0.7)', // indigo with 70% opacity

                ],
                borderWidth: 1
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.labels[tooltipItem.index] || '';
                        if (label) {
                            label += ': ';
                        }
                        label += Math.round(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]) + '%';
                        return label;
                    }
                }
            },
            scales: {
                yAxes: [{



                }]
            }
        }
    });

    myChart_ctx_con.canvas.parentNode.style.height = '400px';
    myChart_ctx_con.canvas.parentNode.style.width = '400px';
    myChart_ctx_con.canvas.parentNode.style.display = 'block';
    myChart_ctx_con.canvas.parentNode.style.margin = '0 auto';
</script>

<script>
    let btnradio1_cons = document.getElementById('btnradio1_cons');
    let btnradio2_cons = document.getElementById('btnradio2_cons');
    let btnradio3_cons = document.getElementById('btnradio3_cons');
    let btnradio4_cons = document.getElementById('btnradio4_cons');
    let daily_chart_cons = document.getElementById('daily_chart_cons');
    let weekly_chart_cons = document.getElementById('weekly_chart_cons');
    let monthly_chart_cons = document.getElementById('monthly_chart_cons');
    let yearly_chart_cons = document.getElementById('yearly_chart_cons');

    btnradio1_cons.addEventListener('click', function() {
        daily_chart_cons.style.display = 'block'; // show the All data div
        weekly_chart_cons.style.display = 'none';
        monthly_chart_cons.style.display = 'none';
        yearly_chart_cons.style.display = 'none';
    });

    btnradio2_cons.addEventListener('click', function() {
        daily_chart_cons.style.display = 'none'; // show the All data div
        weekly_chart_cons.style.display = 'block';
        monthly_chart_cons.style.display = 'none';
        yearly_chart_cons.style.display = 'none';
    });
    btnradio3_cons.addEventListener('click', function() {
        daily_chart_cons.style.display = 'none'; // show the All data div
        weekly_chart_cons.style.display = 'none';
        monthly_chart_cons.style.display = 'block';
        yearly_chart_cons.style.display = 'none';
    });
    btnradio4_cons.addEventListener('click', function() {
        daily_chart_cons.style.display = 'none'; // show the All data div
        weekly_chart_cons.style.display = 'none';
        monthly_chart_cons.style.display = 'none';
        yearly_chart_cons.style.display = 'block';
    });
</script>

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
    var ctx_chart_years = document.getElementById('request_years');
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
    var ctx_chart_years_con = document.getElementById('cons_yearly');
    var lab_years_con = document.getElementById('years_con').value;
    var data_years_con = document.getElementById('yearTotals_con').value;
    var myChart_ctx_years_con = new Chart(ctx_chart_years_con, {
        type: 'bar',
        data: {
            labels: JSON.parse(lab_years_con.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(data_years_con.slice(1, -1)),
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

    myChart_ctx_years_con.canvas.parentNode.style.height = '400px';
    myChart_ctx_years_con.canvas.parentNode.style.width = '750px';
    myChart_ctx_years_con.canvas.parentNode.style.display = 'block';
    myChart_ctx_years_con.canvas.parentNode.style.margin = '0 auto';
</script>

<script>
    var ctx_chart_days = document.getElementById('request_days');
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
                        text: 'Number of requests'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                yAxes: [{
                    animation: false,
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
    var ctx_chart_days_con = document.getElementById('cons_daily');
    var lab_days_con = document.getElementById('days_con').value;
    var data_days_con = document.getElementById('dayTotals_con').value;
    var myChart_ctx_days_con = new Chart(ctx_chart_days_con, {
        type: 'bar',
        data: {
            labels: JSON.parse(lab_days_con.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(data_days_con.slice(1, -1)),
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
                        text: 'Number of concerns'
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
    myChart_ctx_days_con.canvas.parentNode.style.height = '400px';
    myChart_ctx_days_con.canvas.parentNode.style.width = '750px';
    myChart_ctx_days_con.canvas.parentNode.style.display = 'block';
    myChart_ctx_days_con.canvas.parentNode.style.margin = '0 auto';
</script>

<script>
    var ctx_chart_week = document.getElementById('request_week');
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
                        text: 'Number of requests'
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
    var ctx_chart_week_con = document.getElementById('cons_weekly');
    var lab_week_con = document.getElementById('weeks_con').value;
    var data_week_con = document.getElementById('weekTotals_con').value;
    var myChart_ctx_week_con = new Chart(ctx_chart_week_con, {
        type: 'bar',
        data: {
            labels: JSON.parse(lab_week_con.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(data_week_con.slice(1, -1)),
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
                        text: 'Number of requests'
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
    myChart_ctx_week_con.canvas.parentNode.style.height = '400px';
    myChart_ctx_week_con.canvas.parentNode.style.width = '750px';
    myChart_ctx_week_con.canvas.parentNode.style.display = 'block';
    myChart_ctx_week_con.canvas.parentNode.style.margin = '0 auto';
</script>

<script>
    var ctx_chart_month = document.getElementById('request_months');
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
    var ctx_chart_month_con = document.getElementById('cons_monthly');
    var lab_month_con = document.getElementById('months_con').value;
    var data_month_con = document.getElementById('monthTotals_con').value;
    var myChart_ctx_month_con = new Chart(ctx_chart_month_con, {
        type: 'bar',
        data: {
            labels: JSON.parse(lab_month_con.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: JSON.parse(data_month_con.slice(1, -1)),
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
    myChart_ctx_month_con.canvas.parentNode.style.height = '400px';
    myChart_ctx_month_con.canvas.parentNode.style.width = '750px';
    myChart_ctx_month_con.canvas.parentNode.style.display = 'block';
    myChart_ctx_month_con.canvas.parentNode.style.margin = '0 auto';
</script>


<script>
    var ctx_chart_street = document.getElementById('req_type_pie');
    var lab_street = document.getElementById('street').value;
    var data_street = document.getElementById('streetTotals').value;

    var data = JSON.parse(data_street.slice(1, -1));
    var total = data.reduce(function(sum, value) {
        return sum + value;
    }, 0);

    var percentages = data.map(function(value) {
        return Math.round(value / total * 100);
    });

    var myChart_ctx_street = new Chart(ctx_chart_street, {
        type: 'doughnut',
        data: {
            labels: JSON.parse(lab_street.slice(1, -1)),
            datasets: [{
                label: 'Number of Resident',
                data: percentages,
                backgroundColor: [
                    // yellow with 70% opacity
                    'rgba(40, 167, 69, 0.7)', // green with 70% opacity
                    'rgba(111, 66, 193, 0.7)', // purple with 70% opacity
                    'rgba(23, 162, 184, 0.7)', // teal with 70% opacity
                    'rgba(253, 126, 20, 0.7)', // orange with 70% opacity

                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)', // red with 70% opacity
                    'rgba(255, 193, 7, 0.7)',
                    'rgba(102, 16, 242, 0.7)', // indigo with 70% opacity
                ],
                borderColor: [
                    'rgba(40, 167, 69, 0.7)', // green with 70% opacity
                    'rgba(111, 66, 193, 0.7)', // purple with 70% opacity
                    'rgba(23, 162, 184, 0.7)', // teal with 70% opacity
                    'rgba(253, 126, 20, 0.7)', // orange with 70% opacity

                    'rgba(0, 123, 255, 0.7)', // blue with 70% opacity
                    'rgba(220, 53, 69, 0.7)', // red with 70% opacity
                    'rgba(255, 193, 7, 0.7)',
                    'rgba(102, 16, 242, 0.7)', // indigo with 70% opacity

                ],
                borderWidth: 1
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.labels[tooltipItem.index] || '';
                        if (label) {
                            label += ': ';
                        }
                        label += Math.round(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]) + '%';
                        return label;
                    }
                }
            },
            scales: {
                yAxes: [{



                }]
            }
        }
    });

    myChart_ctx_street.canvas.parentNode.style.height = '400px';
    myChart_ctx_street.canvas.parentNode.style.width = '400px';
    myChart_ctx_street.canvas.parentNode.style.display = 'block';
    myChart_ctx_street.canvas.parentNode.style.margin = '0 auto';
</script>

<script>
    const reportSelect = document.querySelector('#report_select');
    const reportAllDiv = document.querySelector('#re_report_all_div');
    const reportAssignDiv = document.querySelector('#re_report_assign_div');

    reportSelect.addEventListener('change', () => {
        if (reportSelect.value === 're_report_all') {
            reportAllDiv.style.display = 'block';
            reportAssignDiv.style.display = 'none';
        } else if (reportSelect.value === 're_report_assign') {
            reportAllDiv.style.display = 'none';
            reportAssignDiv.style.display = 'block';
        }
    });
</script>
<script>
    const co_reportSelect = document.querySelector('#co_report_select');
    const co_reportAllDiv = document.querySelector('#co_report_all_div');
    const co_reportAssignDiv = document.querySelector('#co_report_assign_div');

    co_reportSelect.addEventListener('change', () => {
        if (co_reportSelect.value === 'co_report_all') {
            co_reportAllDiv.style.display = 'block';
            co_reportAssignDiv.style.display = 'none';
        } else if (co_reportSelect.value === 'co_report_assign') {
            co_reportAllDiv.style.display = 'none';
            co_reportAssignDiv.style.display = 'block';
        }
    });
</script>
<script>
    function flipCards() {
        $('#card1').toggleClass('flip-card');
        $('#card2').toggleClass('flip-card');
    }
    let btnAll_con = document.getElementById('btnForConToday');
    let btnToday_con = document.getElementById('btnForConAll');
    let dataAllDiv_con = document.getElementById('data-all-con');
    let dataTodayDiv_con = document.getElementById('data-today-con');

    btnAll_con.addEventListener('click', function() {
        dataAllDiv_con.style.display = 'block'; // show the All data div
        dataTodayDiv_con.style.display = 'none'; // hide the Today data div
    });

    btnToday_con.addEventListener('click', function() {
        dataAllDiv_con.style.display = 'none'; // hide the All data div
        dataTodayDiv_con.style.display = 'block'; // show the Today data div
    });
</script>
<script>
    let btnAll = document.getElementById('btnForReqToday');
    let btnToday = document.getElementById('btnForReqAll');
    let dataAllDiv = document.getElementById('data-all');
    let dataTodayDiv = document.getElementById('data-today');

    btnAll.addEventListener('click', function() {
        dataAllDiv.style.display = 'block'; // show the All data div
        dataTodayDiv.style.display = 'none'; // hide the Today data div
    });

    btnToday.addEventListener('click', function() {
        dataAllDiv.style.display = 'none'; // hide the All data div
        dataTodayDiv.style.display = 'block'; // show the Today data div
    });
</script>

@endforeach
<script>
    $('.flip-container').click(function() {
        $(this).toggleClass('flipped');
    });
</script>

</html>