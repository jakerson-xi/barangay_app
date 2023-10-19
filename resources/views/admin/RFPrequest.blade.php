@include('admin/adminHeader')
@foreach($admin_info as $user)
@foreach($request as $request)
<style>
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="content mb-4">

    <p class="display-6">
        <a href="/processRequest" id="btn" style="color:#AA0F0A"><i class="bi bi-arrow-left-circle-fill"></i></a>
        <i class="bi bi-file-person"></i> <strong>{{$request->reference_key}}</strong>
    </p>
    <div class="text-center">
        @if($request->request_status == 'PENDING')
        <div class="badge bg-warning text-wrap" style="width: 6rem;">
            PENDING
        </div>
        @endif
        @if($request->request_status == 'DENIED')
        <div class="badge bg-danger text-wrap" style="width: 6rem;">
            DENIED
        </div>
        @endif
        @if($request->request_status == 'READY FOR PAYMENT')
        <div class="badge bg-SUCCESS text-wrap" style="width: 6rem; background-color:#198754">
            READY FOR PAYMENT
        </div>
        @endif
        @if($request->request_status == 'DONE')
        <div class="badge bg-PRIMARY text-wrap" style="width: 6rem;background-color:#0d6efd">
            DONE
        </div>
        @endif
        @if($request->request_status == 'PROCESSING')
        <div class="badge bg-info text-wrap" style="width: 6rem;background-color:#0d6efd">PROCESSING</div>
        @endif
        @if($request->request_status == 'CONFIRMED PAYMENT')
        <div class="badge  text-wrap" style="width: 6rem;background-color:steelblue">PAID</div>
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

            <div class="container overflow-hidden mt-3">
                <div class="shadow p-3 mb-3 bg-body rounded ">
                    <p class="fs-4 fw-semibold text-center">VERIFICATION ID</p>
                    <hr>
                    <div class="row my-3 text-center">
                        <div class="col-md-4 mb-2">
                            <img width="400" height="200" src="{{url('residentID/'.$request->validID_front)}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-md-4 mb-2">
                            <img width="400" height="200" src="{{url('residentID/'.$request->validID_back)}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-md-4 mb-2">
                            <img width="400" height="200" src="{{url('residentID/'.$request->face)}}" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 text-center">
                <a class="link-danger" data-bs-toggle="collapse" href="#REShistoryCollapse" role="button" aria-expanded="false" aria-controls="REShistoryCollapse">
                    Show Resident's Request History
                </a>
            </div>

            <div class=" collapse shadow p-4 mb-3 bg-body rounded text-center" id="REShistoryCollapse">
                <p class="fs-4 fw-semibold text-center">REQUEST HISTORY OF {{$request->first_name. " ". $request->last_name}}</p>
                <hr>
                <table class="table table-hover" ID="transaction">
                    <thead>
                        <tr>
                            <th class="text-center">Ref. Key</th>
                            <th class="text-center">TYPE OF REQUEST</th>
                            <th class="text-center">DATE & TIME</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-center">FEEDBACK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forEach($res_history as $trans)
                        <tr>
                            <td style="text-transform: uppercase;">{{$trans->reference_key}}</td>
                            <td style="text-transform: uppercase; ">{{$trans->request_type_name. " (". $trans->request_description.")"}}</td>
                            <td style="text-transform: uppercase; ">{{$trans->request_date}}</td>
                            <td style="text-transform: uppercase; ">
                                @if($trans->request_status == 'PENDING')
                                <div class="badge bg-warning text-wrap" style="width: 6rem;">
                                    PENDING
                                </div>
                                @endif
                                @if($trans->request_status == 'DENIED')
                                <div class="badge bg-danger text-wrap" style="width: 6rem;">
                                    DENIED
                                </div>
                                @endif
                                @if($trans->request_status == 'READY FOR PAYMENT')
                                <div class="badge bg-success text-wrap" style="width: 6rem;">
                                    READY FOR PAYMENT
                                </div>
                                @endif
                                @if($trans->request_status == 'DONE')
                                <div class="badge bg-primary text-wrap" style="width: 6rem;">
                                    DONE
                                </div>
                                @endif
                                @if($trans->request_status == 'PROCESSING')
                                <div class="badge bg-info text-wrap" style="width: 6rem;">
                                    PROCESSING
                                </div>
                                @endif
                                @if($trans->request_status == 'CONFIRMED PAYMENT' || $trans->request_status == 'PAID')
                                <div class="badge text-wrap" style="width: 6rem; background-color:steelblue">
                                    PAID
                                </div>
                                @endif
                            </td>
                            <td style="" class="w-25">{{$trans->request_message}}</td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($request->request_type_id != 5)
            <div class="shadow p-3 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">OTHER INFORMATION</p>
                <hr>
                <div class="row my-3 ">
                    <div class="col-md-6 mb-2 text-center">
                        <p class="fs-6  mb-2 ">Living with Relatives: <span class="text-danger">*</span></p>
                        <strong>{{strtoupper($request->live_relatives)}}</strong>
                    </div>
                    <div class="col-md-6 mb-2 text-center">
                        <p class="fs-6  mb-2 ">Type of Residency: <span class="text-danger">*</span></p>
                        <strong>{{strtoupper($request->residency_type)}}</strong>
                    </div>
                </div>
            </div>
            @else
            <div class="shadow p-3 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">OTHER INFORMATION</p>
                <hr>
                <div class="row my-3 ">
                    <div class="col-md-6 mb-2 text-center">
                        <p class="fs-6  mb-2 ">Business Name: <span class="text-danger">*</span></p>
                        <strong>{{strtoupper($request->business_name)}}</strong>
                    </div>
                    <div class="col-md-6 mb-2 text-center">
                        <p class="fs-6  mb-2 ">Business Address: <span class="text-danger">*</span></p>
                        <strong>{{strtoupper($request->business_address)}}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="shadow p-4 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">REQUEST INFORMATION</p>
                <hr>
                <div class="row my-3 text-center">
                    <div class="col-md-6 mb-2">
                        <label class="text-start mb-2" for="">Type of Application<span class="text-danger">*</span>
                        </label>
                        <p><strong>{{strtoupper($request->request_description)}}</strong></p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="text-start mb-2" for="">Purpose<span class="text-danger">*</span> </label>
                        <p><strong>{{$request->request_purpose}}</strong></p>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-6 mb-2">
                        <label class="text-start mb-2" for="">Processed by:<span class="text-danger">*</span> </label>
                        <p><strong>{{strtoupper($request->employee_name)}}</strong></p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="text-start mb-2" for="">Date Requested:<span class="text-danger">*</span> </label>
                        <p><strong>{{$request->request_date}}</strong></p>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-12 mb-2">
                        <label class="text-start mb-2" for="">Note:<span class="text-danger">*</span> </label>
                        <p><strong>{{strtoupper($request->request_message)}}</strong></p>
                    </div>

                </div>
                @if($request->request_description != 'New')
                <div class="text-center" id="upload_id">
                    <label class="text-start mb-2" for="">File attached:<span class="text-danger">*</span> </label>
                    <div class="mb-2 me-2">
                        <img width="400" height="200" id="frame" src="{{url('images/'.$request->file)}}" class="img-fluid " />
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
                <p class="fs-4 fw-semibold text-center">REQUEST HISTORY</p>
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
                        @foreach($history as $history)
                        <tr>
                            <td>{{$history->created_at}}</td>
                            <td>{{$history->request_status}}</td>
                            <td>{{$history->processed_by}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            @if($request->request_status == 'CONFIRMED PAYMENT')
            <div class="shadow p-4 mb-3 d-grid gap-2 d-md-block bg-body rounded text-center">
                <p class="fs-4 fw-semibold text-center">RECEIPT</p>
                <hr>
                <div class="container">
                    <div class="preheader" style="display: none;max-width: 0;max-height: 0;overflow: hidden;font-size: 1px;line-height: 1px;color: #fff; opacity: 0;">A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
                    </div>

                    <table border="0" cellpadding="0" cellspacing="0" width="100%">

                        <tr>
                            <td align="center" bgcolor="white">

                            </td>
                        </tr>

                        <tr>
                            <td align="center" bgcolor="white">

                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                                    <tr>
                                        <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;border-top: 3px solid #aa0f0a;border-left: 3px solid #aa0f0a;border-right: 3px solid #aa0f0a;">
                                            <h1 style="margin: 0;font-size: 32px; font-weight: 700; letter-spacing: -1px;line-height: 48px;">
                                                Barangay South Signal Village
                                            </h1>
                                            <p style="margin: 0">Online Receipt Copy</p>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>

                        <tr>
                            <td align="center" bgcolor="white">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">

                                    <tr>
                                        <td align="left" bgcolor="#ffffff" style=" padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px; line-height: 24px; border-left: 3px solid #aa0f0a;border-right: 3px solid #aa0f0a;">
                                            <p style="margin: 0">
                                                Attached is a summary of your recent onsite transaction receipt for your records. For official documentation, kindly ensure you receive an official receipt issued by the barangay.
                                            </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="left" bgcolor="#ffffff" style="padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;font-size: 16px;line-height: 24px;border-left: 3px solid #aa0f0a;border-right: 3px solid #aa0f0a;">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td align="left" bgcolor="#AA0F0A" width="75%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial,sans-serif;font-size: 16px;line-height: 24px;color: white;border-left: 3px solid #aa0f0a;border-right: 3px solid #aa0f0a;">
                                                        <strong>RECEIPT NO. </strong>
                                                    </td>
                                                    <td align="left" bgcolor="#AA0F0A" width="25%" style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial,sans-serif;font-size: 16px;line-height: 24px;color: white;border-left: 3px solid #aa0f0a;border-right: 3px solid #aa0f0a;">
                                                        <strong>{{$data['or']}}</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="75%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial,sans-serif;font-size: 16px;line-height: 24px; ">
                                                        {{$data['document']}} <br />({{$data['type']}}) - <br>
                                                        <strong>{{$data['ref']}}</strong>
                                                    </td>
                                                    <td align="left" width="25%" style="padding: 6px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">

                                                        ₱ {{number_format($data['price'], 2, '.', '')}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="75%" style="padding: 6px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"></td>

                                                    <strong> </strong>
                                        </td>
                                        <td align="left" width="25%" style="padding: 6px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"></td>

                                    </tr>

                                    @if($data['mop'] != 'ONSITE PAYMENT')
                                    <tr>
                                        <td align="left" width="75%" style="padding: 6px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">

                                            Online Payment Service Charge:
                                        </td>
                                        <td align="left" width="25%" style="padding: 6px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">

                                            ₱ {{number_format($data['service'], 2, '.', '')}}
                                        </td>
                                    </tr>

                                    @endif
                                    <tr>
                                        <td align="left" width="75%" style="padding: 6px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">AMOUNT PAID</td>



                                        <td align="left" width="25%" style="padding: 6px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">

                                            ₱ {{number_format($data['paid'], 2, '.', '')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" width="75%" style="padding: 6px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"></td>

                                        <strong> </strong>
                            </td>
                            <td align="left" width="25%" style="padding: 6px 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"></td>

                        </tr>
                        <tr>
                            <td align="left" width="75%" style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-top: 2px dashed #aa0f0a; border-bottom: 2px dashed #aa0f0a;">

                                <strong>CHANGE</strong>
                            </td>
                            <td align="left" width="25%" style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-top: 2px dashed #aa0f0a; border-bottom: 2px dashed #aa0f0a;">

                                <strong>₱ {{$data['change']}}</strong>
                            </td>
                        </tr>
                    </table>
                    </td>
                    </tr>

                    </table>

                    </td>
                    </tr>

                    <tr>
                        <td align="center" bgcolor="white" valign="top" width="100%">

                            <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                                <tr>
                                    <td align="center" valign="top" style="font-size: 0; border-bottom: 3px solid white;border-left: 3px solid #aa0f0a;border-bottom: 3px solid #aa0f0a;border-right: 3px solid #aa0f0a;">
                                        <div style=" display: inline-block; width: 100%;max-width: 50%; min-width: 240px;vertical-align: top;">
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 300px">
                                                <tr>
                                                    <td align="left" valign="top" style="padding-bottom: 36px;padding-left: 36px;font-family: 'Source Sans Pro', Helvetica, Arial,sans-serif;font-size: 16px;line-height: 24px;">
                                                        <p><strong>Payor:</strong></p>
                                                        <p>{{$data['name']}}</p>
                                                        <p><strong>Mode of Payment:</strong></p>
                                                        <p>{{$data['mop']}}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div style="display: inline-block; width: 100%; max-width: 50%; min-width: 240px; vertical-align: top;">

                                            <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 300px">
                                                <tr>
                                                    <td align="left" valign="top" style="padding-bottom: 36px; padding-left: 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">

                                                        <p><strong>Processed by:</strong></p>
                                                        <p>{{$data['process']}}</p>
                                                        <p><strong>Paid on:</strong></p>
                                                        <p>{{$data['date']}}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="white" style="padding: 24px">
                        </td>
                    </tr>
                    </table>
                </div>
            </div>
            @endif

            <div class="shadow p-4 mb-3 d-grid gap-2 d-md-block bg-body rounded text-center">
                <div class="container">
                    <div class="row">
                        @if($request->request_status == 'READY FOR PAYMENT')
                        <div class="col-sm-12">
                            <a data-bs-toggle="modal" data-bs-target="#denied" href="#denied" id="btn" type="submit" type="submit" class="btn  btn-danger">
                                <i class="bi bi-x-circle"></i> Deny the request</a>
                        </div>
                        @endif
                        @if($request->request_status == 'CONFIRMED PAYMENT')
                        <div class="col-sm-12">
                            <a data-bs-toggle="modal" data-bs-target="#processing" href="#processing" id="btn" type="submit" type="submit" class="btn  btn-success">
                                <i class="bi bi-check2-circle"></i> Process the request</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal for re-assign-->


<!-- Modal for Denied-->
<form id="formDeny" method="post" enctype="multipart/form-data" action="{{url('denyrequest')}}" class="needs-validation" novalidate>
    @csrf

    <div class="modal fade" id="denied" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deniedLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-x-circle-fill" style="color: red;"></i> Deny Request</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id" value="{{$request->request_id}}">
                <div class="modal-body">
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
                <h1 class="modal-title fs-5" id="exampleModalLabel"> <i class="bi bi-check-circle-fill" style="color: #198754;"></i> Process Request</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="processingRequest" method="post" enctype="multipart/form-data" action="{{url('readyToClaim')}}" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="alert alert-success">
                        <i class="bi bi-exclamation-circle-fill"></i> Confirm the information.
                    </div>
                    <div class="mb-3">

                        <input type="hidden" name="id" value="{{$request->request_id}}">
                        <label for="exampleFormControlTextarea1" class="form-label">Date confirmed: <span class="text-danger">*</span></label>
                        <input type="text" class="w-100 form-control mb-2" name="issue_on" value="{{date('Y-m-d')}}" readonly>
                        <label for="exampleFormControlTextarea1" class="form-label">Ref. No: <span class="text-danger">*</span></label>
                        <input type="text" name="ref" value="{{$request->ref}}" class="w-100 form-control mb-2" readonly />
                        <label for="exampleFormControlTextarea1" class="form-label">OR. No: <span class="text-danger">*</span></label>
                        <input type="text" name="or" value="{{$request->or_num}}" class="w-100 form-control mb-2" readonly />
                        <label for="exampleFormControlTextarea1" class="form-label">CTC. No: <span class="text-danger">*</span></label>
                        <input type="text" name="ctc" value="{{$request->ctc}}" class="w-100 form-control mb-2" readonly />

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

@endforeach
@endforeach
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
                                    window.location.href = "{{url('processRequest')}}";
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
                                    window.location.href = "{{url('processRequest')}}";
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
                                    window.location.href = "{{url('viewRequest')}}/" + response.key;
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
                                    window.location.href = "{{url('processRequest')}}";
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