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
    <hr style="color: black;">
    <div class="shadow p-3 mb-3 bg-body rounded ">
        <div class="myContainer">
            <div class="container overflow-hidden mt-3">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">SUBMITTED CONCERN REPORT (ALL)</h3>
                </div>
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
        </div>
    </div>
    <div class="shadow p-3 mb-3 bg-body rounded ">
        <div class="myContainer">
            <div class="container overflow-hidden mt-3">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">SUBMITTED CONCERN REPORT ({{ $admin->first_name .' '. $admin->last_name}})</h3>
                </div>
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