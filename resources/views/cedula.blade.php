<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resident Dashboard</title>
    <link rel="icon" href="{{asset('assets/imgs/southsignalLogoLeft.png')}}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>User Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="{{asset('css/request.css')}}" rel="stylesheet">
    <style>
        img[src=""] {
            display: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>

</head>

<body style="background-color: rgba(163, 157, 157, 0.37);">
    @include('sweetalert::alert')
    <header>
        <nav class="main-header navbar navbar-expand " style="background-color: #AA0F0A;">
            <div class="container-fluid flex-sm-row">

                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="/userDashboard" class="nav-link text-white font-weight-bold"><i class="bi bi-arrow-left-circle-fill"></i> BACK</a>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <nobr class="nav-link text-white font-weight-bold"><span>ONLINE REQUEST FOR CEDULA</span></nobr>
                    </li>
                </ul>
                <ul class="navbar-nav ">
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <body>
        @foreach($user_info as $user)
        <form id="yourForm" method="post" enctype="multipart/form-data" action="{{url('submit-request')}}" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" name="resident_id" value="{{$user->id}}">
            <input type="hidden" name="request_type_id" value="2">
            <input type="hidden" name="request_type_name" value="BRGY-CED">
            <div class="container overflow-hidden mt-3">
                <div class="shadow p-3 mb-3 bg-body rounded ">
                    <p class="fs-4 fw-semibold text-center">PERSONAL INFORMATION</p>
                    <hr>
                    <div class="row my-3 text-center">
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">First Name: </p><strong>{{$user->first_name}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Middle Name: </p><strong>{{$user->middle_name}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Last Name: </p><strong>{{$user->last_name}}</strong>
                        </div>
                        @if($user->suffix == '')
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Suffix: </p><strong>NONE</strong>
                        </div>
                        @else
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Suffix: </p><strong>{{$user->suffix}}</strong>
                        </div>
                        @endif
                    </div>
                    <div class="row my-3 text-center">
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Gender: </p><strong>{{strtoupper($user->gender)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Date of Birth: </p>
                            <strong>{{date('F j, Y', strtotime($user->birthdate))}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Place of Birth: </p>
                            <strong>{{strtoupper($user->place_birth)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Civil Status: </p>
                            <strong>{{strtoupper($user->marital_status)}}</strong>
                        </div>
                    </div>
                    <div class="row my-3 text-center">
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Room/Flr/Unit No. & Bldg: </p>
                            <strong>{{strtoupper($user->address_unitNo)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">House/Lot & Block No.: </p>
                            <strong>{{strtoupper($user->address_houseNo)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Street: </p><strong>{{strtoupper($user->address_street)}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Subd./ Phase/ Purok: </p>
                            <strong>{{strtoupper($user->address_purok)}}</strong>
                        </div>
                    </div>
                    <div class="row my-3 text-center">
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Email: </p><strong>{{$user->email}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Mobile Number: </p><strong>+63
                                {{strtoupper($user->mobile_num)}}</strong>
                        </div>

                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Valid ID (attached online): </p>
                            <strong>{{$user->valiID_type}}</strong>
                        </div>
                        <div class="col-md-3 mb-2">
                            <p class="fs-6  mb-0">Valid ID Number: </p>
                            <strong>{{strtoupper($user->validID_num)}}</strong>
                        </div>
                    </div>
                    <div class="row my-3 text-center">
                        <div class="col-md-6 mb-2">
                            <p class="fs-6  mb-2">Font Id: </p><img width="400" height="200" src="{{url('residentID/'.$user->validID_front)}}" class="img-fluid" alt="...">
                        </div>
                        <div class="col-md-6 mb-2">
                            <p class="fs-6  mb-2">Back Id: </p> <img width="400" height="200" src="{{url('residentID/'.$user->validID_back)}}" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
                <div class="shadow p-3 mb-3 bg-body rounded ">
                    <p class="fs-4 fw-semibold text-center">OTHER INFORMATION</p>
                    <hr>
                    <div class="row my-3 ">
                        <div class="col-md-6 mb-2 text-center">
                            <p class="fs-6  mb-2 ">Living with Relatives: <span class="text-danger">*</span></p>
                            <select name="live_relatives" class="form-select form-control w-50 mx-auto d-block" aria-label="Default select example" required>
                                <option value="">Select...</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2 text-center">
                            <p class="fs-6  mb-2 ">Type of Residency: <span class="text-danger">*</span></p>
                            <select name="residency_type" class="form-select form-control w-50 mx-auto d-block" aria-label="Default select example" required>
                                <option value="">Select...</option>
                                <option value="House Owner">House Owner</option>
                                <option value="Renter">Renter</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="shadow p-4 mb-3 bg-body rounded ">
                    <p class="fs-4 fw-semibold text-center">REQUEST INFORMATION</p>
                    <hr>
                    <div class="row my-3 ">
                        <div class="col-md-4 mb-2">
                            <label class="text-start mb-2" for="">Type of Application<span class="text-danger">*</span>
                            </label>
                            <select name="request_description" id="applicationType" class="form-select form-control" aria-label="Default select example" required>
                                <option value="">Select...</option>
                                <option value="New">New</option>
                                <option value="Renew">Renew</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-start mb-2" for="">Purpose<span class="text-danger">*</span> </label>
                            <textarea name="request_purpose" class="form-control" id="myTextarea" rows="1" required></textarea>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="text-start mb-2" for="">Price </label>
                            <input class="form-control mb-2" value="Based on your income" type="text" readonly />
                            <input type="hidden" value="100" name="price" />

                            <p class="fw-bolder fs-6 fst-italic  text-danger"><i class="bi bi-exclamation-circle"></i>
                                Payment should be done in barangay office.</p>

                        </div>
                    </div>
                    <div class="" id="upload_id" style="display: none;">
                        <label class="text-start mb-2" for="">Upload your necessary document<span class="text-danger">*</span> </label>
                        <div class="mb-2 me-2">
                            <label for="Image" class="form-label"></label>
                            <input class="form-control me-3 " type="file" id="formFile" name="file" onchange="preview()">
                            <div class="invalid-feedback m-3">
                                Please attach your ID.
                            </div>
                            <div class="text-center">
                                <img id="frame" src="" class="img-fluid " />
                                <div class="text-center">
                                    <button onclick="clearImage()" class="btn mt-3" style="background-color:#AA0F0A; color: white;">Clear</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="shadow p-4 mb-3 bg-body rounded text-center">
                    <div class="form-group mb-2">
                        <nobr> <input onchange="isCheck(this)" type="checkbox" id="agree">&nbsp; <label for="" id="agreeText" style="cursor: pointer;"> I have read,</nobr>
                        <strong>understood</strong>, and <strong>accepted</strong> the
                        <a href="/policy" target="_blank">Privacy Policy</a> and <a href="/terms" target="_blank">Terms
                            & Conditions.</a></label>
                        <br>
                    </div>
                    <div class="text-center">
                        <div class="d-flex justify-content-center mb-3"> <!-- Center the reCAPTCHA elements -->
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                    </div>
                    <button id="btn" type="submit" style="background-color:#AA0F0A; color: white;" class="btn d-block mx-auto " disabled>Request</button>
                </div>
            </div>
            </div>
            @endforeach
        </form>

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('js/cedula.js')}}"> </script>

</html>