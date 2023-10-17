@include('admin/adminHeader')
@foreach($admin_info as $user)
@foreach($request as $request)

<style>
    .timeline-1 {
        border-left: 3px solid black;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        background: #F5EAEA;
        margin: 0 auto;
        position: relative;
        padding: 50px;
        list-style: none;
        text-align: left;
        max-width: 40%;
    }

    @media (max-width: 767px) {
        .timeline-1 {
            max-width: 98%;
            padding: 25px;
        }
    }

    .timeline-1 .event {
        border-bottom: 1px dashed #000;
        padding-bottom: 25px;
        margin-bottom: 25px;
        position: relative;
    }

    @media (max-width: 767px) {
        .timeline-1 .event {
            padding-top: 30px;
        }
    }

    .timeline-1 .event:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border: none;
    }

    .timeline-1 .event:before,
    .timeline-1 .event:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline-1 .event:before {
        left: -207px;
        content: attr(data-date);
        text-align: right;
        font-weight: 100;
        font-size: 0.9em;
        min-width: 120px;
    }

    @media (max-width: 767px) {
        .timeline-1 .event:before {
            left: 0px;
            text-align: left;
        }
    }

    .timeline-1 .event:after {
        -webkit-box-shadow: 0 0 0 3px black;
        box-shadow: 0 0 0 3px black;
        left: -55.8px;
        background: #fff;
        border-radius: 50%;
        height: 9px;
        width: 9px;
        content: "";
        top: 5px;
    }

    @media (max-width: 767px) {
        .timeline-1 .event:after {
            left: -31.8px;
        }
    }
</style>
<div class="content mb-4">

    <p class="display-6">
        <a href="/processRequest" id="btn" style="color:#AA0F0A"><i class="bi bi-arrow-left-circle-fill"></i></a>
        <i class="bi bi-file-person"></i> <strong>{{$request->reference_key}}</strong>
    </p>
    <div class="text-center">
        @if($request->concern_status == 'PENDING')
        <div class="badge bg-warning text-wrap" style="width: 6rem;">
            PENDING
        </div>
        @endif
        @if($request->concern_status == 'DENIED')
        <div class="badge bg-danger text-wrap" style="width: 6rem;">
            DENIED
        </div>
        @endif
        @if($request->concern_status == 'READY FOR PAYMENT')
        <div class="badge bg-SUCCESS text-wrap" style="width: 6rem; background-color:#198754">
            READY FOR PAYMENT
        </div>
        @endif
        @if($request->concern_status == 'DONE')
        <div class="badge bg-PRIMARY text-wrap" style="width: 6rem;background-color:#0d6efd">
            DONE
        </div>
        @endif
        @if($request->concern_status == 'PROCESSING')
        <div class="badge bg-info text-wrap" style="width: 6rem;background-color:#0d6efd">PROCESSING</div>
        @endif
    </div>

    <div class="myContainer">
        <div class="container overflow-hidden mt-3">
            <div class="shadow p-3 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">PERSONAL INFORMATION</p>
                <hr>
                <div class="row my-3 text-center">
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">First Name: </p><strong>{{$request->first_name}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Middle Name: </p><strong>{{$request->middle_name}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Last Name: </p><strong>{{$request->last_name}}</strong>
                    </div>
                    @if($user->suffix == '')
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Suffix: </p><strong>NONE</strong>
                    </div>
                    @else
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Suffix: </p><strong>{{$request->suffix}}</strong>
                    </div>
                    @endif
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Gender: </p><strong>{{strtoupper($request->gender)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Date of Birth: </p>
                        <strong>{{date('F j, Y', strtotime($request->birthdate))}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Place of Birth: </p><strong>{{strtoupper($request->place_birth)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Civil Status: </p>
                        <strong>{{strtoupper($request->marital_status)}}</strong>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Room/Flr/Unit No. & Bldg: </p>
                        <strong>{{strtoupper($request->address_unitNo)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">House/Lot & Block No.: </p>
                        <strong>{{strtoupper($request->address_houseNo)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Street: </p><strong>{{strtoupper($request->address_street)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Subd./ Phase/ Purok: </p>
                        <strong>{{strtoupper($request->address_purok)}}</strong>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Email: </p><strong>{{$request->email}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Mobile Number: </p><strong>+63
                            {{strtoupper($request->mobile_num)}}</strong>
                    </div>

                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Valid ID (attached online): </p><strong>{{$request->valiID_type}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Valid ID Number: </p>
                        <strong>{{strtoupper($request->validID_num)}}</strong>
                    </div>
                </div>
            </div>
            <div class="shadow p-3 mb-3 bg-body rounded ">

                <p class="fs-4 fw-semibold text-center">ID INFORMATION</p>
                <hr>
                <div class="row my-3 text-center">
                    <div class="col-md-4 mb-2 img-container">
                        <img src="{{url('residentID/'.$request->validID_front)}}" class="img-fluid" alt="Front ID">
                    </div>
                    <div class="col-md-4 mb-2 img-container">
                        <img src="{{url('residentID/'.$request->validID_back)}}" class="img-fluid" alt="Back ID">
                    </div>
                    <div class="col-md-4 mb-2 img-container">
                        <img src="{{url('residentID/'.$request->face)}}" class="img-fluid" alt="Face Photo">
                    </div>
                </div>
            </div>
            <div class="mb-3 text-center">
                <a class="link-danger" data-bs-toggle="collapse" href="#REShistoryCollapse" role="button" aria-expanded="false" aria-controls="REShistoryCollapse">
                    Show Resident's Submitted Concern's History
                </a>
            </div>

            <div class=" collapse shadow p-4 mb-3 bg-body rounded text-center" id="REShistoryCollapse">
                <p class="fs-4 fw-semibold text-center">SUBMITTED CONCERN HISTORY OF {{$request->first_name. " ". $request->last_name}}</p>
                <hr>
                <table class="table table-hover" ID="transaction">
                    <thead>
                        <tr>
                            <th class="text-center">Ref. Key</th>
                            <th class="text-center">TYPE OF CONCERN</th>
                            <th class="text-center">TITLE OF CONCERN</th>
                            <th class="text-center">DATE & TIME</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forEach($res_history as $trans)
                        @if($trans->reference_key != $request->reference_key)
                        <tr>
                            <td style="text-transform: uppercase;">{{$trans->reference_key}}</td>
                            <td style="text-transform: uppercase; ">{{$trans->concern_type}}</td>
                            <td style="text-transform: uppercase; ">{{$trans->concern_title}}</td>
                            <td style="text-transform: uppercase; ">{{$trans->concern_created_at}}</td>
                            <td style="text-transform: uppercase; ">
                                @if($trans->concern_status == 'PENDING')
                                <div class="badge bg-warning text-wrap" style="width: 6rem;">
                                    PENDING
                                </div>
                                @endif
                                @if($trans->concern_status == 'DENIED')
                                <div class="badge bg-danger text-wrap" style="width: 6rem;">
                                    DENIED
                                </div>
                                @endif
                                @if($trans->concern_status == 'READY FOR PAYMENT')
                                <div class="badge bg-success text-wrap" style="width: 6rem;">
                                    READY FOR PAYMENT
                                </div>
                                @endif
                                @if($trans->concern_status == 'DONE')
                                <div class="badge bg-primary text-wrap" style="width: 6rem;">
                                    DONE
                                </div>
                                @endif
                                @if($trans->concern_status == 'PROCESSING')
                                <div class="badge bg-info text-wrap" style="width: 6rem;">
                                    PROCESSING
                                </div>
                                @endif
                            </td>
                            <td style="" class="w-25">
                                <a target="_blank" href="/viewconcern/{{$trans->reference_key}}" type="submit" class="btn btn-dark btn-sm"><i class="bi bi-eye-fill"></i> View</a>
                            </td>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="shadow p-3 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">CONCERN INFORMATION</p>
                <hr>
                <div class="row my-3 ">
                    <div class="col-md-3 mb-2 text-center">
                    </div>
                    <div class="col-md-6 mb-2 text-center">
                        <label class="text-start mb-2" for=""><strong>Type of Concern:</strong></label>
                        <p class="text-justify">{{$request->concern_type}}</p>
                    </div>
                    <div class="col-md-3 mb-2 text-center">
                    </div>
                </div>
                <div class="row my-3 ">
                    <div class="col-md-12 mb-2 text-center">
                        <label class="text-start mb-2 text-center" for=""><strong>Title:</strong></label>
                        <p class="text-justify">{{$request->concern_title}}</p>
                    </div>
                </div>
                <div class="row my-3 ">
                    <div class="col-md-12 mb-2">
                        <div class="text-center">
                            <label class="text-start mb-2 text-center"><strong>Description:</strong></label>
                        </div>
                        <div class="text-justify">
                            <p class="mx-2 text-center">{!! nl2br(html_entity_decode($request->concern_description)) !!}</p>
                        </div>
                    </div>
                </div>
                @if($request->concern_photo != "")
                <div class="row my-3 ">
                    <div class="col-md-12 mb-2">
                        <div class="text-center">
                            <label class="text-start mb-2 text-center"><strong>Attached file:</strong></label>
                        </div>
                        <div class="text-center">
                            <img width="400" height="200" src="{{url('concerns/'.$request->concern_photo)}}" class="img-fluid" alt="...">

                        </div>
                    </div>
                </div>
                @endif
            </div>


            <div class="mb-3 text-center">
                <a class="link-danger" data-bs-toggle="collapse" href="#historyCollapse" role="button" aria-expanded="false" aria-controls="historyCollapse">
                    Show History
                </a>
            </div>

            <div class=" collapse shadow p-4 mb-3 bg-body rounded text-center" id="historyCollapse">
                <p class="fs-4 fw-semibold text-center">CONCERN HISTORY</p>
                <hr>
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Processed by</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $his)
                        <tr>
                            <td>{{$his->created_at}}</td>
                            <td>{{$his->concern_update_status}}</td>
                            <td>{{$his->employee_name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="shadow p-4 mb-3 bg-body rounded text-center">
                <p class="fs-4 fw-semibold text-center">Concern History</p>
                <hr>
                <div id="content">
                    <ul class="timeline-1 text-black">
                        <li class="event" data-date="{{date('M j, Y (g:i a)', strtotime($request->created_at))}}">
                            <h4 class="mb-3">Submitted Concern: </h4>
                            <p>{{$request->concern_title}}</p>
                        </li>
                        @foreach($history as $history)
                        @if( $history->concern_update_status != "PENDING")
                        <li class="event" data-date="{{date('M j, Y (g:i a)', strtotime($history->created_at))}}">
                            <h4 class="mb-3">{{$history->concern_update_title}}</h4>
                            <p>{{$history->concern_update_description}}</p>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="shadow p-4 mb-3 d-grid gap-2 d-md-block bg-body rounded text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <a data-bs-toggle="modal" data-bs-target="#reAssign" href="#reAssign" id="btn" type="submit" class="btn w-25 btn-warning">Re-assign</a>
                        </div>
                        <div class="col-sm-6">
                            <div class="dropup-center dropup">
                                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Process
                                </button>
                                <ul class="dropdown-menu">
                                    <li>

                                        <a data-bs-toggle="modal" data-bs-target="#updatingConcern" href="#updatingConcern" id="btn" type="submit" class=" dropdown-item  btn-success">
                                            <i class="bi bi-pencil-square" style="color: gray;"></i> Update Request</a>
                                    </li>
                                    <li> <a data-bs-toggle="modal" data-bs-target="#denied" href="#denied" id="btn" type="submit" class=" dropdown-item  btn-success">
                                            <i class="bi bi-x-circle-fill" style="color: red;"></i> Deny Request</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a data-bs-toggle="modal" data-bs-target="#processing" href="#processing" id="btn" type="submit" class=" dropdown-item  btn-success">
                                            <i class="bi bi-check-circle-fill" style="color: #198754;"></i> Close Concern</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal for re-assign-->
<div class="modal fade" id="reAssign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reAssignLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-triangle-fill"></i>
                    Re-assigning this CONCERN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to proceed with re-assigning this CONCERN?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="/reassignconcern/{{$request->concern_id}}" type="button" class="btn btn-warning">Save
                    changes</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Denied-->
<form id="formDeny" method="post" enctype="multipart/form-data" action="{{url('denyconcern')}}" class="needs-validation" novalidate>
    @csrf

    <div class="modal fade" id="denied" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deniedLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-x-circle-fill" style="color: red;"></i> Deny Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id" value="{{$request->concern_id}}">
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-diamond-fill"></i> Attention: This modal is intended for denying the submitted concern.
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Reason/s to deny:</label>
                        <textarea name="note" class="form-control" id="exampleFormControlTextarea1" placeholder="Please state why this request will be denied." rows="5" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal for Accepted-->

<div class="modal fade" id="processing" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="processingLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> <i class="bi bi-check-circle-fill" style="color: #198754;"></i> Close Concern</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="processingRequest" method="post" enctype="multipart/form-data" action="{{url('closeConcern')}}" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-diamond-fill"></i> Attention: This form is intended for closing the submitted concern. Please confirm that you wish to proceed with closing the concern.
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="id" value="{{$request->concern_id}}">
                        <label for="exampleFormControlTextarea1" class="form-label">Title:</label>
                        <input name="title" class="form-control" placeholder="CONCERN DONE" value="CONCERN DONE" id="exampleFormControlTextarea1" rows="5" required>
                        <label for="exampleFormControlTextarea1" class="form-label">Details:</label>
                        <textarea name="details" class="form-control" id="exampleFormControlTextarea1" rows="5" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Updated the concern-->
<div class="modal fade" id="updatingConcern" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updatingConcernLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> <i class="bi bi-pencil-square" style="color: gray;"></i> Update Concern</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updating_Concern" method="post" enctype="multipart/form-data" action="{{url('updateConcern')}}" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="id" value="{{$request->concern_id}}">
                        <label for="exampleFormControlTextarea1" class="form-label">Title:</label>
                        <input name="title" class="form-control" id="exampleFormControlTextarea1" rows="5" required>
                        <label for="exampleFormControlTextarea1" class="form-label">Details:</label>
                        <textarea name="details" class="form-control" id="exampleFormControlTextarea1" rows="5" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Concern</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-body text-center my-3">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                </div>
                <p class="mt-3">Please wait...</p>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


<!-- Datepicker -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;
    $('input[name="daterange"]').daterangepicker({
        "startDate": today,
        "minDate": today,
        "applyButtonClasses": "btn-success",

    });
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transaction').DataTable({
            language: {
                emptyTable: "No Transaction yet."
            },
            responsive: true,
            order: [
                [3, 'asc']
            ]
        });
    });
    // Get the form element
    const form = document.getElementById("formDeny");
    // Listen for the submit event
    form.addEventListener("submit", function(event) {
        if (!form.checkValidity()) {
            // If the form is not valid, show the validation errors

            event.preventDefault();
            return;
        }
        event.preventDefault(); // Prevent the form from being submitted normally
        $("#denied").modal("hide");
        swal({
            closeOnClickOutside: false,
            dangerMode: true,
            buttons: true,
            title: "INPUT CREDENTIALS",
            content: {
                element: "input",
                attributes: {
                    placeholder: "Type your password",
                    type: "password",
                },
            },
        }).then((value) => {

            if (value == "") {
                swal({
                    dangerMode: true,
                    title: "INVALID CREDENTIALS",
                    icon: "error",
                });
            } else if (value.dismiss == 'cancel') {
                swal({
                    dangerMode: true,
                    title: "cancel",
                    icon: "error",
                })
            } else {
                //Show the modal
                $("#loadingModal").modal("show");

                // Get the form data
                const formData = new FormData(form);
                // Make the AJAX request
                formData.append('password', value)
                $.ajax({
                    type: "POST",
                    url: form.action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#loadingModal").modal("hide");
                        if (response.message == 'Correct') {
                            Swal.fire({
                                title: "<h4>The request is successfully denied</h4>",
                                icon: "success",
                                html: "<p>Email successfully sent</p>",
                                showCloseButton: false,
                                showCancelButton: false,
                                confirmButtonColor: "#AA0F0A",
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "/processConcern";
                                }
                            });
                        } else {
                            $("#loadingModal").modal("hide");
                            Swal.fire({
                                title: "<h4>INVALID CREDENTIAL</h4>",
                                icon: "warning",
                                showCloseButton: false,
                                showCancelButton: false,
                                confirmButtonColor: "#AA0F0A",
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "/process-concern-pending/" + '{{$request->concern_id}}';
                                }
                            });

                        }
                        // Hide the modal
                        $("#loadingModal").modal("hide");


                    },
                    error: function(error) {
                        // Hide the modal
                        alert('wrong password');
                        $("#loadingModal").modal("hide");
                        // Handle the error (e.g. show an error message)
                    },
                });


            }

        });

    });

    const forms = document.getElementById("processingRequest");
    // Listen for the submit event
    forms.addEventListener("submit", function(event) {
        if (!forms.checkValidity()) {
            // If the form is not valid, show the validation errors

            event.preventDefault();
            return;
        }
        event.preventDefault(); // Prevent the form from being submitted normally
        $("#processing").modal("hide");
        swal({
            closeOnClickOutside: false,
            dangerMode: true,
            buttons: true,
            title: "INPUT CREDENTIALS",
            content: {
                element: "input",
                attributes: {
                    placeholder: "Type your password",
                    type: "password",
                },
            },
        }).then((value) => {

            if (value == "") {
                swal({
                    dangerMode: true,
                    title: "INVALID CREDENTIALS",
                    icon: "error",
                });
            } else if (value.dismiss == 'cancel') {
                swal({
                    dangerMode: true,
                    title: "cancel",
                    icon: "error",
                })
            } else {
                //Show the modal
                $("#loadingModal").modal("show");

                // Get the form data
                const formData = new FormData(forms);
                // Make the AJAX request
                formData.append('password', value)
                $.ajax({
                    type: "POST",
                    url: forms.action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#loadingModal").modal("hide");
                        if (response.message == 'Correct') {
                            Swal.fire({
                                title: "<h4>The request is successfully accepted</h4>",
                                icon: "success",
                                html: "<p>Email successfully sent and status updated</p>",
                                showCloseButton: false,
                                showCancelButton: false,
                                confirmButtonColor: "#AA0F0A",
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "/processConcern";
                                }
                            });
                        } else {
                            $("#loadingModal").modal("hide");
                            Swal.fire({
                                title: "<h4>INVALID CREDENTIAL</h4>",
                                icon: "warning",
                                showCloseButton: false,
                                showCancelButton: false,
                                confirmButtonColor: "#AA0F0A",
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "/process-concern-pending/" + '{{$request->concern_id}}';
                                }
                            });

                        }
                        // Hide the modal
                        $("#loadingModal").modal("hide");

                    },
                    error: function(error) {
                        // Hide the modal
                        alert('wrong password');
                        $("#loadingModal").modal("hide");
                        // Handle the error (e.g. show an error message)
                    },
                });


            }

        });

    });

    // Get the form element
    const form_concern = document.getElementById("updating_Concern");
    // Listen for the submit event
    form_concern.addEventListener("submit", function(event) {
        if (!form_concern.checkValidity()) {
            // If the form is not valid, show the validation errors

            event.preventDefault();
            return;
        }
        event.preventDefault(); // Prevent the form from being submitted normally
        $("#updatingConcern").modal("hide");
        swal({
            closeOnClickOutside: false,
            dangerMode: true,
            buttons: true,
            title: "INPUT CREDENTIALS",
            content: {
                element: "input",
                attributes: {
                    placeholder: "Type your password",
                    type: "password",
                },
            },
        }).then((value) => {

            if (value == "") {
                swal({
                    dangerMode: true,
                    title: "INVALID CREDENTIALS",
                    icon: "error",
                });
            } else if (value.dismiss == 'cancel') {
                swal({
                    dangerMode: true,
                    title: "cancel",
                    icon: "error",
                })
            } else {
                //Show the modal
                $("#loadingModal").modal("show");

                // Get the form data
                const formData = new FormData(form_concern);
                // Make the AJAX request
                formData.append('password', value)
                $.ajax({
                    type: "POST",
                    url: form_concern.action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $("#loadingModal").modal("hide");
                        if (response.message == 'Correct') {
                            Swal.fire({
                                title: "<h4>The concern is successfully updated</h4>",
                                icon: "success",
                                html: "<p>Email successfully sent</p>",
                                showCloseButton: false,
                                showCancelButton: false,
                                confirmButtonColor: "#AA0F0A",
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{url('process_concern_pending')}}/" + '{{$request->concern_id}}';
                                }
                            });
                        } else {
                            $("#loadingModal").modal("hide");
                            Swal.fire({
                                title: "<h4>INVALID CREDENTIAL</h4>",
                                icon: "warning",
                                showCloseButton: false,
                                showCancelButton: false,
                                confirmButtonColor: "#AA0F0A",
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "{{url('process_concern_pending')}}/" + '{{$request->concern_id}}';
                                }
                            });

                        }
                        // Hide the modal
                        $("#loadingModal").modal("hide");


                    },
                    error: function(error) {
                        // Hide the modal
                        alert('wrong password');
                        $("#loadingModal").modal("hide");
                        // Handle the error (e.g. show an error message)
                    },
                });


            }

        });

    });
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endforeach
@endforeach