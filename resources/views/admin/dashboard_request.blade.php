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
                    <h3 class="text-dark mb-0">REQUESTED DOCUMENT REPORT (ALL)</h3>
                </div>
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
        </div>
    </div>
    <div class="shadow p-3 mb-3 bg-body rounded ">
        <div class="myContainer">
            <div class="container overflow-hidden mt-3">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">REQUESTED DOCUMENT REPORT ({{ $admin->first_name .' '. $admin->last_name}})</h3>
                </div>
                <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio_" id="btnForReqToday_emp" autocomplete="off" checked>
                    <label class="btn btn-outline-dark" for="btnForReqToday_emp">All</label>

                    <input type="radio" class="btn-check" name="btnradio_" id="btnForReqAll_emp" autocomplete="off">
                    <label class="btn btn-outline-dark" for="btnForReqAll_emp">Today</label>
                </div>
                <div id="data-all_emp">
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center"><span>PENDING</span></div>
                                            @if($req_count_emp->where('request_status', 'PENDING')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count_emp->where('request_status', 'PENDING')->first()->count}}</span></div>
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
                                            @if($req_count_emp->where('request_status', 'PROCESSING')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count_emp->where('request_status', 'PROCESSING')->first()->count}}</span></div>
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
                                            @if($req_count_emp->where('request_status', 'READY FOR PAYMENT')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count_emp->where('request_status', 'READY FOR PAYMENT')->first()->count}}</span></div>
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

                                                    @foreach ($req_count_emp as $requestCount)
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
                                            @if($req_count_emp->where('request_status', 'DONE')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count_emp->where('request_status', 'DONE')->first()->count}}</span></div>
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
                                            @if($req_count_emp->where('request_status', 'DENIED')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$req_count_emp->where('request_status', 'DENIED')->first()->count}}</span></div>
                                            @endif
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="data-today_emp" style="display: none;">
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2" style=" border-left: 5px solid #ffc107;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1 text-center"><span>PENDING</span></div>
                                            @if($requestCountsToday_emp->where('request_status', 'PENDING')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday_emp->where('request_status', 'PENDING')->first()->count}}</span></div>
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
                                            @if($requestCountsToday_emp->where('request_status', 'PROCESSING')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday_emp->where('request_status', 'PROCESSING')->first()->count}}</span></div>
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
                                            @if($requestCountsToday_emp->where('request_status', 'READY FOR PAYMENT')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday_emp->where('request_status', 'READY FOR PAYMENT')->first()->count}}</span></div>
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

                                                    @foreach ($requestCountsToday_emp as $requestCount)
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
                                            @if($requestCountsToday_emp->where('request_status', 'DONE')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday_emp->where('request_status', 'DONE')->first()->count}}</span></div>
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
                                            @if($requestCountsToday_emp->where('request_status', 'DENIED')->isNotEmpty() != TRUE)
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>0</span></div>
                                            @else
                                            <div class="text-dark fw-bold h5 mb-0 text-center"><span>{{$requestCountsToday_emp->where('request_status', 'DENIED')->first()->count}}</span></div>
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
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<script>
    let btnAll_emp = document.getElementById('btnForReqToday_emp');
    let btnToday_emp = document.getElementById('btnForReqAll_emp');
    let dataAllDiv_emp = document.getElementById('data-all_emp');
    let dataTodayDiv_emp = document.getElementById('data-today_emp');

    btnAll_emp.addEventListener('click', function() {
        dataAllDiv_emp.style.display = 'block'; // show the All data div
        dataTodayDiv_emp.style.display = 'none'; // hide the Today data div
    });

    btnToday_emp.addEventListener('click', function() {
        dataAllDiv_emp.style.display = 'none'; // hide the All data div
        dataTodayDiv_emp.style.display = 'block'; // show the Today data div
    });
</script>
@endforeach
<script>
    $('.flip-container').click(function() {
        $(this).toggleClass('flipped');
    });
</script>

</html>