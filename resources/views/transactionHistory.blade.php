<html lang="en">


<head>
    @foreach($user_info as $user)
    <meta charset="UTF-8">
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <title>Resident Dashboard | {{$user->first_name." ".$user->last_name}}</title>
    <link rel="icon" href="{{asset('assets/imgs/southsignalLogoLeft.png')}}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
        .groupBoxHeader {
            padding: 0.2em 0.5em;
            border: 1px solid rgb(255, 255, 255);
            font-size: 100%;
            text-align: center;
            width: auto;
            border-radius: 6px;
            background-color: rgba(192, 1, 1, 0.932);
            color: white;
            font-weight: bold;
            margin-top: 5%;
            margin-bottom: 5%;

        }

        .custom-modal .nav-tabs .nav-link {
            background-color: rgba(191, 190, 190, 0);
            /* Change to your desired background color */
            border-color: rgba(191, 190, 190, 0);
            color: black;
            /* Change to your desired text color */
        }

        .custom-modal .nav-tabs .nav-link.active {
            background-color: rgba(192, 1, 1, 0.932);
            border-color: rgba(192, 1, 1, 0.932);
            /* Change to your desired background color */
            /* Change to your desired text color */
            color: white;
        }

        .custom-modal .nav-link:hover {
            background-color: rgba(192, 1, 1, 0.932);
            border-color: rgba(192, 1, 1, 0.932);
            color: white;
        }

        .custom-modal p {
            text-align: justify;
            margin: 2px;
        }
    </style>
    <style>
        .form-control::placeholder {
            /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: black;
            opacity: 1;
            /* Firefox */
        }

        .form-control:-ms-input-placeholder {
            /* Internet Explorer 10-11 */
            color: black;
        }

        .form-control::-ms-input-placeholder {
            /* Microsoft Edge */
            color: black;
        }

        @media screen and (min-width:992px) {
            .navbar-collapse {
                flex-grow: 0;
            }

            .container-fluid.my-container-fluid {
                justify-content: center;
            }

            .topnav a {
                float: left;
                display: block;
                color: black;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
                border-bottom: 3px solid transparent;
            }

            .topnav a:hover {
                border-bottom: 3px solid rgb(255, 255, 255);
            }

            .topnav a.active {
                border-bottom: 3px solid rgb(255, 255, 255);
            }

            .myContainer {
                border: 3px red;
                width: auto;
                margin: 0 auto;
                padding: 10px;



            }

        }

        .no-spin::-webkit-inner-spin-button,
        .no-spin::-webkit-outer-spin-button {
            -webkit-appearance: none !important;
            margin: 0 !important;
        }

        .no-spin {
            -moz-appearance: textfield !important;
        }

        .groupBox {
            border: 2.5px solid black;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
            padding-top: 2px;
            border-radius: 10px;
            background-color: white;

        }

        .goupBoxHeader {
            padding: 0.2em 0.5em;
            border: 1px solid rgb(255, 255, 255);
            font-size: 100%;
            text-align: center;
            width: 50%;
            border-radius: 6px;
            background-color: rgba(192, 1, 1, 0.932);
            color: white;
            font-weight: bold;
            margin-left: 25%;

        }
    </style>


</head>

<body style="background-color: rgba(163, 157, 157, 0.37);">

    <script type="text/javascript">
        function clock() {
            const timeDisplay = document.getElementById("clock");
            const dateString = new Date().toLocaleString();
            const formattedString = dateString.replace(", ", " - ");
            timeDisplay.textContent = formattedString;
        }

        setInterval(clock, 1000);
    </script>
    @include('sweetalert::alert')
    <header>
        <nav class="main-header navbar navbar-expand " style="background-color: #AA0F0A;">
            <div class="container-fluid flex-sm-row">

                <ul class="navbar-nav">

                    <li class="nav-item">
                        <button onclick="clock()" style="border-color: white; background-color:#AA0F0A" class="navbar-brand" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                            <svg style="background-color:#AA0F0A; color: white;" xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-justify" viewBox="0 0 15 15">
                                <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                            </svg>
                    </li>
                    <li class="nav-item">

                        @if($user->middle_name == '')
                        <p hidden>{{$fullname = $user->first_name." ".$user->last_name}}</p>
                        <nobr style="text-transform: uppercase;" class="nav-link text-white font-weight-bold"><span>{{$user->last_name. ", ".$user->first_name}}</span></nobr>
                        @else
                        <p hidden>{{$fullname = $user->first_name." ".$user->middle_name." ".$user->last_name}}</p>
                        <nobr style="text-transform: uppercase;" class="nav-link text-white font-weight-bold"><span>{{$user->last_name. ", ".$user->first_name." ".$user->middle_name}}</span></nobr>
                        @endif
                        @endforeach
                    </li>

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
                                </svg> Track Requests/Track Concerns</a>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button style="width: 100%; text-align: left;" class="btn" type="submit" onclick="" value="" data-bs-dismiss="offcanvas" aria-label="Close">
                            <a class="nav-link" href="payment"><i style="font-size: 20px;" class="bi bi-cash"></i> Payment</a>
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
                        <button data-bs-toggle="modal" data-bs-target="#dataPrivacy" style="width: 100%; text-align: left;" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
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
    <div class="modal " id="dataPrivacy" tabindex="-1" aria-labelledby="dataPrivacyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content custom-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsConditionsLabel" style="text-align: center;">Privacy Policy of
                        Barangay South Signal Village </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body " style="width: auto;">
                    <div class="text-center">
                        <img src="{{asset('assets/imgs/southsignal.png')}}" alt="logo" width="100">
                    </div>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-english-tab" data-bs-toggle="tab" data-bs-target="#nav-english" type="button" role="tab" aria-controls="nav-english" aria-selected="true">English</button>
                            <button class="nav-link" id="nav-tagalog-tab" data-bs-toggle="tab" data-bs-target="#nav-tagalog" type="button" role="tab" aria-controls="nav-tagalog" aria-selected="false">Tagalog</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-english" role="tabpanel" aria-labelledby="nav-english-tab" tabindex="0">
                            <h3 class="groupBoxHeader">Introduction</h3>
                            <div>
                                <p>At Barangay South Signal Village, we recognize the importance of protecting yourpersonal data and privacy. We are committed to maintaining the confidentiality and limiting any disclosure of your information in accordance with local laws. This Privacy Policy outlines how we collect, use, share, and protect your personal information when you use our web app.</p>
                            </div>
                            <hr style="background-color: #AA0F0A;">
                            <h3 class="groupBoxHeader">Your Rights and Preferences</h3>
                            <div>
                                <p>As an individual, you have certain rights under applicable law with regard to your
                                    personal data.
                                    These
                                    include:</p>
                                <ul>
                                    <li>Right of Access - the right to request access to your personal data and be
                                        informed about the
                                        processing
                                        of your personal data;</li>
                                    <li>Right to Erasure - the right to request the deletion of your personal data;</li>
                                    <li>Right to Restrict Processing - the right to request the restriction of
                                        processing of your personal
                                        data;
                                    </li>
                                    <li>Right to Object - the right to object to the processing of your personal data;
                                    </li>
                                    <li>Right to Data Portability - the right to receive your personal data in a
                                        structured, commonly
                                        used, and
                                        machine-readable format.</li>
                                </ul>
                            </div>
                            <hr style="background-color: #AA0F0A;">
                            <h3 class="groupBoxHeader">How we Collect your Personal Data</h3>
                            <div>
                                <p>We collect your personal data in the following ways:</p>
                                <p> These are the following data needed upon registering, with the corresponding
                                    purpose:</p>
                                <ul>
                                    <li>Full Name – to properly identify the right person when conducting the
                                        registration.</li>
                                    <li>Suffix – to know if person have any suffix in their name.</li>
                                    <li>Gender – to classify the person based on their sexuality on birth.</li>
                                    <li>Civil Status – to describe a person’s relationship with a significant other.
                                    </li>
                                    <li>Nationality – legal identification of a person in international law and
                                        distinguished from
                                        citizenship.
                                    </li>
                                    <li>Birthdate – used for proper identification and in case multiple persons have the
                                        same name.</li>
                                    <li>Age – to determine the age of the person.</li>
                                    <li>Place of Birth – to know where the person was born in.</li>
                                    <li>Address – to determine the exact location of the person by the authorities.</li>
                                    <li>Valid ID – to validate all the information set by the user.</li>
                                    <li>ID Number – to ensure that no two people within the system share the same
                                        number.</li>
                                    <li>Email – for the system to have an option to have different identification aside
                                        from mobile
                                        number.</li>
                                    <li>Mobile Number – used for unique identification in the system and for the user to
                                        be contacted if
                                        needed
                                        by the barangay officials.</li>
                                </ul>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">What do we use your Personal Data for?</h3>
                            <div>
                                <p>We use your personal data to provide and improve our services to you. This includes:
                                </p>
                                <ul>
                                    <li>To communicate with you about our services and provide customer support.</li>
                                    <li>To process transactions to our services.</li>
                                    <li>To improve our services and develop new features.</li>
                                    <li>To comply with legal obligations.</li>
                                </ul>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">Sharing your Personal Data</h3>
                            <div>
                                <p>We do not sell, rent, or lease your personal information to third parties without
                                    your consent. We
                                    may share
                                    your personal data with third-party service providers who help us operate our web
                                    app or provide
                                    services to
                                    you. These service providers are required to maintain the confidentiality and
                                    security of your
                                    personal
                                    data. </p>
                                <p>We may also disclose your personal data if required by law, court order, or other
                                    legal processes or
                                    if we
                                    have a good faith belief that such disclosure is necessary to protect our rights or
                                    property or the
                                    safety
                                    of others. </p>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">Data Retention and Deletion </h3>
                            <div>
                                <p>We keep your personal data only for as long as necessary to provide you with our
                                    services and for
                                    legitimate
                                    and essential business purposes, such as complying with legal obligations and
                                    resolving disputes. We
                                    will
                                    securely delete or anonymize your personal data when it is no longer needed for
                                    these purposes. </p>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">Keeping your Data Safe </h3>
                            <div>
                                <p>We take appropriate technical and organizational measures to protect your personal
                                    data against
                                    unauthorized
                                    or unlawful processing, accidental loss, destruction, or damage. We also implement
                                    access controls,
                                    encryption, and retention policies to protect your personal data. </p>
                            </div>
                        </div>
                        <!--Nav Tab Tagalog-->
                        <div class="tab-pane fade" id="nav-tagalog" role="tabpanel" aria-labelledby="nav-tagalog-tab" tabindex="0">
                            <h3 class="groupBoxHeader">Panimula</h3>
                            <div>
                                <p>Sa Barangay South Signal Village, kami ay kumikilala sa kahalagahan ng pagprotekta sa
                                    iyong
                                    personal
                                    na
                                    datos at
                                    privacy. Kami ay mayroong pangako na panatilihing konpidensyal ang iyong impormasyon
                                    at limitahan
                                    ang
                                    anumang pagpapahayag ng iyong
                                    impormasyon ayon sa mga lokal na batas. Ang Polisiya ng Privacy na ito ay
                                    naglalayong ipakita kung
                                    paano
                                    namin kinokolekta, ginagamit, ini-share, at
                                    iniingatan ang iyong personal na impormasyon kapag ginagamit mo ang aming web app.
                                </p>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">Ang Iyong Mga Karapatan at mga Nais</h3>
                            <div>
                                <p>Bilang isang indibidwal, mayroon kang mga karagdagang karapatan sa ilalim ng mga
                                    naaangkop na batas
                                    kaugnay
                                    ng iyong personal na datos. Ito ay kasama ang mga sumusunod:</p>
                                <ul>
                                    <li>Karapatan sa Pag-access - ang karapatan na humiling ng pag-access sa iyong
                                        personal na datos at
                                        maabisuhan tungkol sa pagproseso ng iyong personal na datos;</li>
                                    <li>Karapatan sa Pagbura - ang karapatan na humiling ng pagtanggal ng iyong personal
                                        na datos;
                                    </li>
                                    <li>Karapatan sa Pagpigil ng Paggamit - ang karapatan na humiling ng pagpigil sa
                                        paggamit ng iyong
                                        personal na datos;
                                    </li>
                                    <li>Karapatan sa Pagtutol - ang karapatan na tumutol sa pagproseso ng iyong personal
                                        na datos;</li>
                                    <li>Karapatan sa Portabilidad ng Datos - ang karapatan na matanggap ang iyong
                                        personal na datos sa
                                        isang
                                        makabuluhang, karaniwang ginagamit, at may kakayahang basahin ng makina na
                                        format.</li>
                                </ul>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">Paano namin Kinokolekta ang Iyong Personal na Datos</h3>
                            <div>
                                <p>Kinokolekta namin ang iyong personal na datos sa mga sumusunod na paraan:</p>
                                <p> Ito ang mga sumusunod na mga datos na kinakailangan sa pagpaparehistro, kasama ang
                                    karampatang
                                    layunin
                                    nito:</p>
                                <ul>
                                    <li>Buong Pangalan – upang wastong kilalanin ang tamang tao sa pagpaparehistro.</li>
                                    <li>Suffix – upang malaman kung may salaysay ang pangalan ng isang tao.</li>
                                    <li>Kasarian – upang uriin ang isang tao batay sa kanilang kasarian noong sila ay
                                        ipinanganak.</li>
                                    <li>Katayuan Sibil – upang ilarawan ang relasyon ng isang tao sa kanilang kasintahan
                                        o kasama sa
                                        buhay
                                    </li>
                                    <li>Nasyonalidad – legal na pagkakakilanlan ng isang tao sa batas pang-internasyonal
                                        na iba sa
                                        pagkamamamayan.
                                    </li>
                                    <li>Petsa ng Kapanganakan – ginagamit para sa tamang pagkilala at sa mga
                                        pagkakataong maraming tao
                                        ang
                                        may parehong pangalan.</li>
                                    <li>Edad – upang malaman ang edad ng isang tao.</li>
                                    <li>Lugar ng Kapanganakan – upang malaman kung saan isinilang ang tao.</li>
                                    <li>Tirahan – upang matukoy ng mga awtoridad ang eksaktong lokasyon ng isang tao.
                                    </li>
                                    <li> Valid ID – upang tiyakin ang lahat ng impormasyon na ibinigay ng gumagamit.
                                    </li>
                                    <li>ID Number – upang tiyakin na walang dalawang tao sa loob ng sistema ang may
                                        parehong numero.
                                    </li>
                                    <li>Email – para sa sistema na magkaroon ng opsiyon na iba't-ibang paraan ng
                                        pagkakakilanlan bukod
                                        sa
                                        numero ng mobile.</li>
                                    <li>Mobile Number – ginagamit para sa pambihirang pagkakakilanlan sa sistema at
                                        upang makontak ang
                                        user
                                        kung kinakailangan ng mga opisyal ng barangay</li>
                                </ul>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">Para sa Anong Layunin Namin Ginagamit ang Iyong Personal na
                                Datos?
                            </h3>
                            <div>
                                <p>Ginagamit namin ang iyong personal na datos upang magbigay at mapabuti ang aming mga
                                    serbisyo sa
                                    iyo.
                                    Ito ay kasama ang mga sumusunod:</p>
                                <ul>
                                    <li>Upang makipag-ugnayan sa iyo tungkol sa aming mga serbisyo at magbigay ng
                                        suporta sa mga
                                        customer.
                                    </li>
                                    <li>Upang ma-proseso ang mga transaksyon sa aming mga serbisyo..</li>
                                    <li>Upang mapabuti ang aming mga serbisyo at gumawa ng mga bagong feature.</li>
                                    <li>Upang sumunod sa mga legal na obligasyon.</li>
                                </ul>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">Pagbabahagi ng Iyong Personal na Datos</h3>
                            <div>
                                <p>Hindi namin ibinebenta, inuupa, o inirerentahan ang iyong personal na impormasyon sa
                                    mga third
                                    parties
                                    nang walang iyong pahintulot. Maaring ibahagi namin ang iyong personal na datos sa
                                    mga
                                    third-party service provider na tumutulong sa amin sa pagpapatakbo ng aming web app
                                    o nagbibigay ng
                                    serbisyo sa iyo. Kinakailangang panatilihing konpidensyal at ligtas ng mga service
                                    provider na ito
                                    ang
                                    iyong personal na datos. </p>
                                <p>Maari rin naming ilantad ang iyong personal na datos kung kinakailangan ng batas,
                                    court order, o
                                    iba
                                    pang legal na proseso, o kung kami ay may matino at marerespetadong paniniwala na
                                    ang ganitong
                                    paglantad
                                    ay kinakailangan upang protektahan ang aming mga karapatan o ari-arian o ang
                                    kaligtasan ng iba. </p>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">Pag-iingat at Pagtanggal ng Datos </h3>
                            <div>
                                <p>Ipinag-iingat namin ang iyong personal na datos hangga't kinakailangan lamang upang
                                    maipagkaloob
                                    ang
                                    aming mga serbisyo at para sa mga lehitimo at mahahalagang layunin ng negosyo, tulad
                                    ng pagsunod sa
                                    mga
                                    legal na obligasyon at pagresolba ng mga alituntunin. Secured naming tatanggalin o
                                    ipapa-anonimisa
                                    ang
                                    iyong personal na datos kapag hindi na ito kinakailangan para sa mga layuning ito.
                                </p>
                            </div>
                            <hr style="background-color: white;">
                            <h3 class="groupBoxHeader">Paagpapanatili ng Kaligtasan ng Inyong Datos </h3>
                            <div>
                                <p>Kami ay gumagamit ng angkop na mga teknikal at organisasyonal na hakbang upang
                                    protektahan ang
                                    inyong
                                    personal na datos laban sa hindi awtorisadong o labag sa batas na pagproseso,
                                    aksidental na
                                    pagkawala,
                                    pagkasira, o pinsala. Kami rin ay nagpapatupad ng mga kontrol sa pag-access,
                                    pag-e-encrypt, at mga
                                    patakaran sa retensyon upang protektahan ang inyong personal na datos </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="background-color: #AA0F0A; color:white" data-bs-dismiss="modal">Accept</button>

                </div>
            </div>
        </div>
    </div>
    <!--TERMS AND CONDITION-->
    <div class="modal" id="terms" tabindex="-1" aria-labelledby="termsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content custom-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsLabel" style="text-align: center">
                        Terms & Conditions of Barangay South Signal Village
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="width: auto">
                    <div class="text-center">
                        <img src="{{asset('assets/imgs/southsignal.png')}}" alt="logo" width="100">
                    </div>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-english-tab" data-bs-toggle="tab" data-bs-target="#nav-english" type="button" role="tab" aria-controls="nav-english" aria-selected="true">
                                English
                            </button>
                            <button class="nav-link" id="nav-tagalog-tab" data-bs-toggle="tab" data-bs-target="#nav-tagalog" type="button" role="tab" aria-controls="nav-tagalog" aria-selected="false">
                                Tagalog
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-english" role="tabpanel" aria-labelledby="nav-english-tab" tabindex="0">
                            <h3 class="groupBoxHeader">Introduction</h3>
                            <div>
                                <p class="m-2">
                                    I hereby authorize the Barangay South Signal Village of
                                    Taguig City, to collect and process the data indicated
                                    herein for my personal information. I also understand that
                                    my personal information is protected by RA 10173 or Data
                                    Privacy Act of 2012. The Barangay South Signal Village
                                    reserves the right, at its sole discretion, to change,
                                    modify, add or remove portions of these Terms and
                                    Conditions, at any time. It is your responsibility to check
                                    these Terms and Conditions periodically for changes. Your
                                    continued use of the South Signal Village Web Application
                                    following the posting of changes will mean that you accept
                                    and agree to the changes.
                                </p>
                            </div>
                        </div>
                        <!--Nav Tab Tagalog-->
                        <div class="tab-pane fade" id="nav-tagalog" role="tabpanel" aria-labelledby="nav-tagalog-tab" tabindex="0">
                            <h3 class="groupBoxHeader">Panimula</h3>
                            <div>
                                <p class="m-2">
                                    Pinahihintulutan ko ang Barangay South Signal Village ng
                                    Lungsod ng Taguig upang makolekta at iproseso and datos na
                                    ipinahihiwatig dito para sa aking personal na impormasyon.
                                    Naiintindihan ko na ang aking personal na impormasyon ay
                                    protektado ng RA 10173 o Data Privacy Act of 2012. Ang
                                    Barangay South Signal Village ay may karapatan, sa kanilang
                                    tanging pagpapasya, na baguhin, magdagdag o magtanggal ng
                                    bahagi ng mga Kondisyon at Tuntunin na ito, anumang oras.
                                    Ito ay iyong pananagutan na paulit-ulit na suriin ang mga
                                    Kondisyon at Tuntunin na ito para sa mga pagbabago. Ang
                                    patuloy mong paggamit ng South Signal Village Web
                                    Application matapos maipaskil ang mga pagbabago ay
                                    nangangahulugan na tinatanggap at sumasang-ayon ka sa mga
                                    pagbabago.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <a href="registration" class="btn" style="background-color: #aa0f0a; color: white">Accept</a>
                </div>
            </div>
        </div>
    </div>


    @foreach($user_info as $user)
    <!-- REQUEST -->
    <div class="container overflow-hidden mt-3">
        <div class="row gx-5">
            <div class="col">
                <div class="p-4 bg-light border mb-3 bg-body rounded shadow border border-dark">
                    <div class="accordion accordion-flush" id="requestAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOneRequest">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <h3><i class="bi bi-folder2-open"></i> Request Transaction History</h3>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOneRequest" data-bs-parent="#requestAccordion">
                                <div class="accordion-body">
                                    <div class="table-responsive">
                                        <table id="transaction" class="table table-bordered table-hover " style="width:100%">
                                            <thead class="" style="background-color: #AA0F0A; color:white">
                                                <tr>
                                                    <th class="text-center">Ref. Key</th>
                                                    <th class="text-center">TYPE OF REQUEST</th>
                                                    <th class="text-center">DATE & TIME</th>
                                                    <th class="text-center">STATUS</th>
                                                    <th class="text-center">Action:</th>
                                                    <th class="text-center" style="display: none;">no.</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forEach($transaction as $trans)

                                                <tr>
                                                    <td style="text-transform: uppercase;">{{$trans->reference_key}}</td>
                                                    <td style="text-transform: uppercase; ">{{$trans->request_type_name. " (". $trans->request_description.")"}}</td>
                                                    <td style="text-transform: uppercase; ">{{$trans->request_date}}</td>
                                                    <td class="text-center" style="text-transform: uppercase; ">
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
                                                        <div class="badge bg-SUCCESS text-wrap" style="width: 6rem;">
                                                            READY FOR PAYMENT
                                                        </div>
                                                        @endif
                                                        @if($trans->request_status == 'DONE')
                                                        <div class="badge bg-PRIMARY text-wrap" style="width: 6rem;">
                                                            DONE
                                                        </div>
                                                        @endif
                                                        @if($trans->request_status == 'PROCESSING')
                                                        <div class="badge bg-info text-wrap" style="width: 6rem;">
                                                            PROCESSING
                                                        </div>
                                                        @endif
                                                        @if($trans->request_status == 'PAID')
                                                        <div class="badge  text-wrap" style="width: 6rem; background-color:steelblue">
                                                        <i class="bi bi-check-circle-fill"></i> PAID
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="viewRequestdoc/{{$trans->reference_key}}" type="button" class="btn btn-dark"><i class="bi bi-eye-fill"></i> View</a>
                                                    </td>
                                                    <td style="display: none;">
                                                        @if($trans->request_status == 'PENDING')
                                                        1
                                                        @endif
                                                        @if($trans->request_status == 'DENIED')
                                                        5
                                                        @endif
                                                        @if($trans->request_status == 'READY FOR PAYMENT')
                                                        3
                                                        @endif
                                                        @if($trans->request_status == 'DONE')
                                                        4
                                                        @endif
                                                        @if($trans->request_status == 'PROCESSING')
                                                        2
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- CONCERN -->
    <div class="container overflow-hidden mt-3">
        <div class="row gx-5">
            <div class="col">
                <div class="p-4 bg-light border mb-3 bg-body rounded shadow border border-dark">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <h3><i class="bi bi-question-octagon"></i> Concern History</h3>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <table id="concern" class="table table-bordered table-hover " style="width:100%">
                                        <thead class="" style="background-color: #AA0F0A; color:white">
                                            <tr>
                                                <th class="text-center">Ref. Key</th>
                                                <th class="text-center">TYPE OF CONCERN</th>
                                                <th class="text-center">CONCERN TITLE</th>
                                                <th class="text-center">DATE & TIME</th>
                                                <th class="text-center">STATUS</th>
                                                <th class="text-center">Action:</th>
                                                <th class="text-center" style="display: none;">no.</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forEach($concern as $concern)

                                            <tr>
                                                <td style="text-transform: uppercase;">{{$concern->reference_key}}</td>
                                                <td style="text-transform: uppercase; ">{{$concern->concern_type}}</td>
                                                <td style="text-transform: uppercase; ">{{$concern->concern_title}}</td>
                                                <td style="text-transform: uppercase; ">{{$concern->concern_created_at}}</td>
                                                <td class="text-center" style="text-transform: uppercase; ">
                                                    @if($concern->concern_status == 'PENDING')
                                                    <div class="badge bg-warning text-wrap" style="width: 6rem;">
                                                        PENDING
                                                    </div>
                                                    @endif
                                                    @if($concern->concern_status == 'DENIED')
                                                    <div class="badge bg-danger text-wrap" style="width: 6rem;">
                                                        DENIED
                                                    </div>
                                                    @endif
                                                    @if($concern->concern_status == 'READY FOR PAYMENT')
                                                    <div class="badge bg-SUCCESS text-wrap" style="width: 6rem;">
                                                        READY FOR PAYMENT
                                                    </div>
                                                    @endif
                                                    @if($concern->concern_status == 'DONE')
                                                    <div class="badge bg-PRIMARY text-wrap" style="width: 6rem;">
                                                        DONE
                                                    </div>
                                                    @endif
                                                    @if($concern->concern_status == 'PROCESSING')
                                                    <div class="badge bg-info text-wrap" style="width: 6rem;">
                                                        PROCESSING
                                                    </div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="viewConcernuser/{{$concern->reference_key}}" type="button" class="btn btn-dark"><i class="bi bi-eye-fill"></i> View</a>
                                                </td>
                                                <td style="display: none;">
                                                    @if($concern->concern_status == 'PENDING')
                                                    1
                                                    @endif
                                                    @if($concern->concern_status == 'DENIED')
                                                    5
                                                    @endif
                                                    @if($concern->concern_status == 'READY FOR PAYMENT')
                                                    3
                                                    @endif
                                                    @if($concern->concern_status == 'DONE')
                                                    4
                                                    @endif
                                                    @if($concern->concern_status == 'PROCESSING')
                                                    2
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#transaction').DataTable({
                language: {
                    emptyTable: "No Transaction yet."
                },
                responsive: true,
                order: [
                    [5, 'asc']
                ]
            });
        });
        $(document).ready(function() {
            $('#concern').DataTable({
                language: {
                    emptyTable: "No Transaction yet."
                },
                responsive: true,
                order: [
                    [5, 'asc']
                ]
            });
        });
    </script>
</body>

</html>