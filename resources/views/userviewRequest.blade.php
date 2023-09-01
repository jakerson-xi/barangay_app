<html lang="en">


<head>

    <meta charset="UTF-8">
    <script src="{{asset('js/footer.js')}}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BARANGAY SOUTH SIGNAL VILLAGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>User Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="{{asset('css/userDashboard.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
@foreach($request as $request)

<body style="background-color: rgba(163, 157, 157, 0.37);">

    <script src="{{asset('js/userDashboard.js')}}"></script>
    @include('sweetalert::alert')
    <header>
        <nav class="main-header navbar navbar-expand " style="background-color: #AA0F0A;">
            <div class="container-fluid flex-sm-row">
                <ul class="navbar-nav">
                    
                    <nobr class="nav-link text-white font-weight-bold"><span><a href="/transactionhistory" style="color:white"><i class="bi bi-arrow-left-circle-fill"></i></a> {{$request->reference_key}}</span></nobr>
                </ul>


                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <li class="nav-item ml-3">
                        <img class="nav-link img-circle " src="{{asset('assets/imgs/southsignalLogoLeft.png')}}" alt="" style="padding: 0px;width: 50px ;">
                    </li>
                    <li class="nav-item">
                        <nobr class="nav-link text-white font-weight-bold"><span>BARANGAY SOUTH SIGNAL VILLAGE</span></nobr>
                    </li>
                    </li>
                </ul>


            </div>
        </nav>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

            <div class="offcanvas-header">

                @foreach($user_info as $user)
                @if($user->middle_name == '')
                <p hidden>{{$fullname = $user->first_name." ".$user->last_name}}</p>
                <h3 style="text-transform: uppercase;" class="offcanvas-title" id="offcanvasNavbarLabel">{{$fullname}}</h3>
                @else
                <p hidden>{{$fullname = $user->first_name." ".$user->middle_name[0].". ".$user->last_name}}</p>
                <h3 style="text-transform: uppercase;" class="offcanvas-title" id="offcanvasNavbarLabel">{{$fullname}}</h3>
                @endif
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">


                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <hr>
                    <li class="nav-item">
                        <button style="width: 100%; text-align: left;" class="btn" type="submit" onclick="changeTab(value);" value="home" data-bs-dismiss="offcanvas" aria-label="Close">
                            <a href="userDashboard" value="home" class="nav-link active" aria-current="page"><svg style="font-size: 20px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                    <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                                </svg> Home</a>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button style="width: 100%; text-align: left;" class="btn" type="submit" onclick="changeTab(value);" value="myProfile" data-bs-dismiss="offcanvas" aria-label="Close">
                            <a href="userDashboardProfile" aria-current="page" class="nav-link"><svg style="font-size: 20px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                </svg> My Profile</a>
                        </button>

                    </li>
                    <li class="nav-item">
                        <button style="width: 100%; text-align: left;" class="btn" type="submit" onclick="" value="" data-bs-dismiss="offcanvas" aria-label="Close">
                            <a class="nav-link" href="transactionhistory"><svg style="font-size: 20px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                </svg> Track Requests/Track Concern</a>
                        </button>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <button style="width: 100%; text-align: left;" type="button" class="btn" data-bs-toggle="modal" data-bs-target="#dataPrivacy">
                            <a class="nav-link"><svg style="font-size: 20px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
                                    <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                    <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                </svg> Data Policy</a>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button data-bs-toggle="modal" data-bs-target="#terms" style="width: 100%; text-align: left;" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
                            <a class="nav-link" href="#"><svg style="font-size: 20px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z" />
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                                </svg> Terms & Conditions</a>
                        </button>
                    </li>
                    <hr>

                    <li class="nav-item">
                        <a class="nav-link  text-nowrap ms-3" id="logout" href="{{url('/signout')}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg> Sign out</a>
                    </li>
                </ul>

            </div>
            <div style="background-color: #AA0F0A; color: white;">
                <h6 class="my-3 mx-3">Philippine Standard Time: <br><span id="clock"></span></h6>
            </div>

        </div>
    </header>



  <!--DATA POLICY-->
  <div class="modal fade" id="dataPrivacy" tabindex="-1" aria-labelledby="dataPrivacyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="text-align: center;" class="modal-title" id="exampleModalLabel">Draft Policy on Open Data for the Barangay South Signal Village</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-2">
            <img src="{{asset('assets/imgs/southsignal.png')}}" alt="logo" width="100">
          </div>
          <p>At Barangay South Signal Village, we recognize the importance of protecting your personal data and privacy. We are committed to maintaining the confidentiality and limiting any disclosure of your information in accordance with local laws. This Privacy Policy outlines how we collect, use, share, and protect your personal information when you use our web app.</h3>
          <h5>Your Rights and Preferences</h5>
          <p>As an individual, you have certain rights under applicable law with regard to your personal data. These include:</p>
          <ul>
            <li>Right of Access - the right to request access to your personal data and be informed about the processing of your personal data;</li>
            <li>Right to Erasure - the right to request the deletion of your personal data;</li>
            <li>Right to Restrict Processing - the right to request the restriction of processing of your personal data;</li>
            <li>Right to Object - the right to object to the processing of your personal data;</li>
            <li>Right to Data Portability - the right to receive your personal data in a structured, commonly used, and machine-readable format.</li>
          </ul>

          <h5>How we Collect your Personal Data</h5>
          <p>We collect your personal data in the following ways:</p>
          <p> These are the following data needed upon registering, with the corresponding purpose:</p>
          <ul>
            <li>Full Name – to properly identify the right person when conducting the registration.</li>
            <li>Suffix – to know if person have any suffix in their name.</li>
            <li>Gender – to classify the person based on their sexuality on birth.</li>
            <li>Civil Status – to describe a person’s relationship with a significant other.</li>
            <li>Nationality – legal identification of a person in international law and distinguished from citizenship.</li>
            <li>Birthdate – used for proper identification and in case multiple persons have the same name.</li>
            <li>Age – to determine the age of the person.</li>
            <li>Place of Birth – to know where the person was born in.</li>
            <li>Address – to determine the exact location of the person by the authorities.</li>
            <li>Valid ID – to validate all the information set by the user.</li>
            <li>ID Number – to ensure that no two people within the system share the same number.</li>
            <li>Email – for the system to have an option to have different identification aside from mobile number.</li>
            <li>Mobile Number – used for unique identification in the system and for the user to be contacted if needed by the barangay officials.</li>
          </ul>

          <h5>What do we use your Personal Data for?</h5>
          <p>We use your personal data to provide and improve our services to you. This includes:</p>
          <ul>
            <li>To communicate with you about our services and provide customer support.</li>
            <li>To process transactions to our services.</li>
            <li>To improve our services and develop new features.</li>
            <li>To comply with legal obligations.</li>
          </ul>

          <h5>Sharing your Personal Data</h5>
          <p>We do not sell, rent, or lease your personal information to third parties without your consent. We may share your personal data with third-party service providers who help us operate our web app or provide services to you. These service providers are required to maintain the confidentiality and security of your personal data. </p>
          <p>We may also disclose your personal data if required by law, court order, or other legal processes or if we have a good faith belief that such disclosure is necessary to protect our rights or property or the safety of others. </p>
          <h5>Data Retention and Deletion </h5>
          <p>We keep your personal data only for as long as necessary to provide you with our services and for legitimate and essential business purposes, such as complying with legal obligations and resolving disputes. We will securely delete or anonymize your personal data when it is no longer needed for these purposes. </p>
          <h5>Keeping your Data Safe </h5>
          <p>We take appropriate technical and organizational measures to protect your personal data against unauthorized or unlawful processing, accidental loss, destruction, or damage. We also implement access controls, encryption, and retention policies to protect your personal data. </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" style="background-color: #AA0F0A; color:white" data-bs-dismiss="modal">Done</button>
        </div>
      </div>
    </div>
  </div>
  <!--TERMS AND CONDITION-->
  <div class="modal fade" id="terms" tabindex="-1" aria-labelledby="termsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="text-align: center;" class="modal-title" id="exampleModalLabel">Terms and Conditions for the Barangay South Signal Village</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="text-center mb-2">
            <img src="{{asset('assets/imgs/southsignal.png')}}" alt="logo" width="100">
          </div>
          <p>I hereby authorize the Barangay South Signal Village of Taguig City, to collect and process the data indicated herein for my personal information. I also understand that my personal information is protected by RA 10173 or Data Privacy Act of 2012. The Barangay South Signal Village reserves the right, at its sole discretion, to change, modify, add or remove portions of these Terms and Conditions, at any time. It is your responsibility to check these Terms and Conditions periodically for changes. Your continued use of the South Signal Village Web Application following the posting of changes will mean that you accept and agree to the changes.  </p>
        <p><em>(Pinahihintulutan ko ang Barangay South Signal Village ng Lungsod ng Taguig upang makolekta at iproseso and datos na ipinahihiwatig dito para sa aking personal na impormasyon. Naiintindihan ko na ang aking personal na impormasyon ay protektado ng RA 10173 o Data Privacy Act of 2012. Ang Barangay South Signal Village ay may karapatan, sa kanilang tanging pagpapasya, na baguhin, magdagdag o magtanggal ng bahagi ng mga Kondisyon at Tuntunin na ito, anumang oras. Ito ay iyong pananagutan na paulit-ulit na suriin ang mga Kondisyon at Tuntunin na ito para sa mga pagbabago. Ang patuloy mong paggamit ng South Signal Village Web Application matapos maipaskil ang mga pagbabago ay nangangahulugan na tinatanggap at sumasang-ayon ka sa mga pagbabago.) </em></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" style="background-color: #AA0F0A; color:white" data-bs-dismiss="modal">Done</button>
        </div>
      </div>
    </div>
  </div>
    @foreach($user_info as $user)

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <div class="my-3 mx-3" id="myProfile">
        <div class="content mb-4">
            <div class="myContainer">
                <div class="container overflow-hidden mt-3">
                    <div class="shadow p-3 mb-3 bg-body rounded ">
                        <p class="display-6 text-center"><i class="bi bi-file-person"></i> <strong>{{$request->reference_key}}</strong></p>
                        <div class="text-center mb-3">
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
                        </div>
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
                                <p class="fs-6  mb-0">Date of Birth: </p><strong>{{date('F j, Y', strtotime($request->birthdate))}}</strong>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">Place of Birth: </p><strong>{{strtoupper($request->place_birth)}}</strong>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">Civil Status: </p><strong>{{strtoupper($request->marital_status)}}</strong>
                            </div>
                        </div>
                        <div class="row my-3 text-center">
                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">Room/Flr/Unit No. & Bldg: </p><strong>{{strtoupper($request->address_unitNo)}}</strong>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">House/Lot & Block No.: </p><strong>{{strtoupper($request->address_houseNo)}}</strong>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">Street: </p><strong>{{strtoupper($request->address_street)}}</strong>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">Subd./ Phase/ Purok: </p><strong>{{strtoupper($request->address_purok)}}</strong>
                            </div>
                        </div>
                        <div class="row my-3 text-center">
                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">Email: </p><strong>{{$request->email}}</strong>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">Mobile Number: </p><strong>+63 {{strtoupper($request->mobile_num)}}</strong>
                            </div>

                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">Valid ID (attached online): </p><strong>{{$request->valiID_type}}</strong>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="fs-6  mb-0">Valid ID Number: </p><strong>{{strtoupper($request->validID_num)}}</strong>
                            </div>
                        </div>
                        <div class="row my-3 text-center">
                            <div class="col-md-6 mb-2">
                                <p class="fs-6  mb-2">Font Id: </p><img width="400" height="200" src="{{url('residentID/'.$request->validID_front)}}" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-6 mb-2">
                                <p class="fs-6  mb-2">Back Id: </p> <img width="400" height="200" src="{{url('residentID/'.$request->validID_back)}}" class="img-fluid" alt="...">
                            </div>
                        </div>
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
                                <label class="text-start mb-2" for="">Type of Application<span class="text-danger">*</span> </label>
                                <p><strong>{{strtoupper($request->request_description)}}</strong></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="text-start mb-2" for="">Purpose<span class="text-danger">*</span> </label>
                                <p><strong>{{$request->request_purpose}}</strong></p>
                            </div>
                        </div>
                        <div class="row my-3 text-center">
                            <div class="col-md-6 mb-2">
                                <label class="text-start mb-2" for="">Assigned to:<span class="text-danger">*</span> </label>
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
                    @if(!is_null($request->pdf_file))
                    <div class="  shadow p-4 mb-3 bg-body rounded text-center">
                        <p class="fs-4 fw-semibold text-center">FILE</p>
                        <hr>
                        <object data="{{url('wordsDocsFormat/'.$request->pdf_file)}}" type="application/pdf" width="400" height="500">
                            <p>PDF file could not be displayed. <a href="path/to/your/file.pdf">Download</a> it instead.</p>
                        </object>
                        <br>
                        <a href="{{url('wordsDocsFormat/'.$request->pdf_file)}}" target="_blank" id="btn" type="submit" class="btn mt-3" style="background-color:#428BCA; color: white;">
                            <i class="bi bi-file-pdf-fill"></i> View full</a>

                    </div>
                    @endif
                    <div class="shadow p-4 mb-3 bg-body rounded text-center">
                        <a href="/transactionhistory" id="btn" type="submit" style="background-color:#AA0F0A; color: white;" class="btn d-block mx-auto w-25">DONE</a>
                    </div>
                </div>
            </div>




        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>
    // Set the URL of the PDF file
    var url = "{{url('wordsDocsFormat/'.$request->pdf_file)}}";

    // Load the PDF file
    pdfjsLib.getDocument(url).promise.then(function(pdf) {
        // Get the first page of the PDF file
        pdf.getPage(1).then(function(page) {
            // Set the scale of the PDF preview
            var scale = 1.5;
            // Get the viewport of the PDF page at the specified scale
            var viewport = page.getViewport({
                scale: scale
            });
            // Set the canvas element to the size of the viewport
            var canvas = document.createElement('canvas');
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            // Get the context of the canvas element
            var context = canvas.getContext('2d');
            // Render the PDF page on the canvas element
            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            page.render(renderContext).promise.then(function() {
                // Add the canvas element to the PDF preview container
                var previewContainer = document.getElementById('pdf-preview');
                previewContainer.appendChild(canvas);
            });
        });
    });
</script>
@endforeach
</div>

@endforeach


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/userProfile.js')}}"></script>

</body>

</html>