@include('userDashboard')

<body>
    @foreach($user_info as $user)
    <div class="container overflow-hidden mt-3" id="home">

        <div class="row gx-5">

            <div class="col">
                <div class="p-4 bg-light border mb-3 bg-body rounded shadow border border-dark">
                    <h3 class="">Online Transaction</h3>

                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-4 my-3">
                            <div class="p-3 text-center shadow  bg-body rounded">
                                <i class="bi bi-person-vcard" style="font-size:xx-large;"></i>
                                <p>{{$request_type[0]->request_type_name}}<br>(RESIDENT ID CARD)</p>
                                @if($request_type[0]->isEnabled == '1')
                                <a href="/request-barangay-id" data-bs-toggle="tooltip" data-bs-placement="top" title="REQUEST {{$request_type[0]->request_type_name}}" type="button" class="btn " style="background-color:#e4312b; color:white">Click To Apply</a>
                                @endif
                                @if($request_type[0]->isEnabled == '0')
                                <span data-bs-toggle="tooltip" data-bs-placement="top" Title="REQUESTING {{$request_type[0]->request_type_name}} IS CURRENTLY UNAVAILABLE">
                                    <button type="button" class="btn" style="background-color:#e4312b; color:white" disabled>Unavailable</button>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 my-3">
                            <div class="p-3 text-center shadow p-3  bg-body rounded">
                                <i class="bi bi-bank" style="font-size:xx-large;"></i>
                                <p>{{$request_type[1]->request_type_name}}<br>(CEDULA)</p>
                                @if($request_type[1]->isEnabled == '1')
                                <a href="/request-barangay-cedula" data-bs-toggle="tooltip" data-bs-placement="top" title="REQUEST {{$request_type[1]->request_type_name}}" type="button" class="btn" style="background-color:#e4312b; color:white">Click To Apply</a>
                                @endif
                                @if($request_type[1]->isEnabled == '0')
                                <span data-bs-toggle="tooltip" data-bs-placement="top" Title="REQUESTING {{$request_type[1]->request_type_name}} IS CURRENTLY UNAVAILABLE">
                                    <button type="button" class="btn" style="background-color:#e4312b; color:white" disabled>Unavailable</button>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 my-3">
                            <div class="p-3 text-center shadow p-3  bg-body rounded">
                                <i class="bi bi-card-text" style="font-size:xx-large;"></i>
                                <p>BARANGAY<BR>CLEARANCE</p>
                                @if($request_type[2]->isEnabled == '1')
                                <a href="/request-barangay-clearance" data-bs-toggle="tooltip" data-bs-placement="top" title="REQUEST {{$request_type[2]->request_type_name}}" type="button" class="btn" style="background-color:#e4312b; color:white">Click To Apply</a>
                                @endif
                                @if($request_type[2]->isEnabled == '0')
                                <span data-bs-toggle="tooltip" data-bs-placement="top" Title="REQUESTING {{$request_type[2]->request_type_name}} IS CURRENTLY UNAVAILABLE">
                                    <button type="button" class="btn" style="background-color:#e4312b; color:white" disabled>Unavailable</button>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 my-3">
                            <div class="p-3 text-center shadow p-3  bg-body rounded">
                                <i class="bi bi-card-heading" style="font-size:xx-large;"></i>
                                <p>BARANGAY<br>CERTIFICATION</p>
                                @if($request_type[3]->isEnabled == '1')
                                <a href="/request-barangay-certification" data-bs-toggle="tooltip" data-bs-placement="top" title="REQUEST {{$request_type[3]->request_type_name}}" type="button" class="btn" style="background-color:#e4312b; color:white">Click To Apply</a>
                                @endif
                                @if($request_type[3]->isEnabled == '0')
                                <span data-bs-toggle="tooltip" data-bs-placement="top" Title="REQUESTING {{$request_type[3]->request_type_name}} IS CURRENTLY UNAVAILABLE">
                                    <button type="button" class="btn" style="background-color:#e4312b; color:white" disabled>Unavailable</button>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 my-3">
                            <div class="p-3 text-center shadow p-3  bg-body rounded">
                                <i class="bi bi-buildings" style="font-size:xx-large;"></i>
                                <p>ISSUANCE OF<br>BUSINESS CLEARANCE</p>
                                @if($request_type[4]->isEnabled == '1')
                                <a href="/request-business-clearance" data-bs-toggle="tooltip" data-bs-placement="top" title="REQUEST {{$request_type[4]->request_type_name}}" type="button" class="btn" style="background-color:#e4312b; color:white">Click To Apply</a>
                                @endif
                                @if($request_type[4]->isEnabled == '0')
                                <span data-bs-toggle="tooltip" data-bs-placement="top" Title="REQUESTING {{$request_type[4]->request_type_name}} IS CURRENTLY UNAVAILABLE">
                                    <button type="button" class="btn" style="background-color:#e4312b; color:white" disabled>Unavailable</button>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 my-3">
                            <div class="p-3 text-center shadow p-3  bg-body rounded">
                                <i class="bi bi-ticket-perforated" style="font-size:xx-large;"></i>
                                <p>SUBMIT<br>CONCERN</p>
                                @if($request_type[5]->isEnabled == '1')
                                <a href="/create-concern" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$request_type[5]->request_type_name}}" type="button" class="btn" style="background-color:#e4312b; color:white">Click To Apply</a>
                                @endif
                                @if($request_type[5]->isEnabled == '0')
                                <span data-bs-toggle="tooltip" data-bs-placement="top" Title="{{$request_type[5]->request_type_name}} IS CURRENTLY UNAVAILABLE">
                                    <button type="button" class="btn" style="background-color:#e4312b; color:white" disabled>Unavailable</button>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>

</html>