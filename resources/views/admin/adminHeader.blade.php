<!doctype html>
<html lang="en">
@foreach($admin_info as $admin)

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>{{$admin->role}} Dashboard </title>
    <link rel="icon" href="{{asset('assets/imgs/southsignalLogoLeft.png')}}" type="image/png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-1.9.1.min.js">
        function clock() {
            const timeDisplay = document.getElementById("clock");
            const dateString = new Date().toLocaleString();
            const formattedString = dateString.replace(", ", " - ");
            timeDisplay.textContent = formattedString;
        }

        setInterval(clock, 1000);
    </script>
    <style>
        .img-container {
            height: 350px;
            /* Set the fixed height for the image container */
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .img-container img {
            object-fit: cover;
            /* Maintain aspect ratio and cover the container */
            width: 100%;
            height: 100%;
        }

        .btn-primary1 {
            color: #fff;
            background-color: #720602;
            border-color: #720602;
            /*set the color you want here*/
        }

        .btn-primary1:hover,
        .btn-primary1:focus,
        .btn-primary1:active,
        .btn-primary1.active,
        .open>.dropdown-toggle.btn-primary1 {
            color: #720602;
            background-color: #fff;
            border-color: #fff;
            /*set the color you want here*/
        }

        .top_nav {
            position: fixed;
            top: 0px;
            width: 100%-280px;
            left: 280px;
            right: 0;
            z-index: 2;

        }


        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 280px;
            z-index: 2;
        }

        .groupBox {
            border: 2.5px solid lightgray;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
            padding-top: 2px;
            border-radius: 10px;

        }

        .goupBoxHeader {
            margin-top: 10px;
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

        .content {
            position: relative;
            width: 100%;
            padding-top: 65px;
            /* Use the topbar's height + something more? */
            padding-left: 315px;
            /* Use the sidebar's width + something more? */
            padding-right: 25px;
            /* Set box-sizing to border-box, to ensure the content block stays within the window, and not expand due to padding */
            box-sizing: border-box;
            -webkit-box-sizing: border-box;

        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>
    <header>
        @include('sweetalert::alert')
        <div style="background-color:#720602" class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white">
            <div class="" style="text-align: center;"><img src="{{url('adminID/'.$admin->profilePic)}}" class="rounded-circle " style="width: 100px;" alt="Avatar" />
                <h5 class=""><strong>{{$admin->first_name." ".$admin->last_name}}</strong></h6>
                    <p class="">{{$admin->role}}</p>
            </div>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">

                <a href="{{url('dashboard')}}" style="text-align: justify;" type="button" class="btn btn-primary1"><i class="bi bi-bar-chart-fill"></i> Dashboard</a>

                @if($admin->role == 'Barangay Secretary' || $admin->role == 'Request Manager')
                <div class="dropdown">
                    <button style="width:100%;text-align: justify;" class="btn btn-primary1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-file-earmark-text-fill"></i> Requests
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                        @if($admin->role == 'Barangay Secretary')
                        <li><a class="dropdown-item" href="{{url('requestType')}}">Manage Services</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @endif
                        <li><a class="dropdown-item" href="{{url('view-request-list')}}">View Document Requests</a></li>
                        <li><a class="dropdown-item" href="{{url('processRequest')}}">Process Document Request</a></li>
                    </ul>
                </div>
                @endif
                @if($admin->role == 'Barangay Secretary' || $admin->role == 'Concern Manager')
                <div class="dropdown">
                    <button style="width:100%;text-align: justify;" class="btn btn-primary1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-ticket-perforated-fill"></i> Concern
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{url('view-concern-list')}}">View Concerns</a></li>
                        <li><a class="dropdown-item" href="{{url('processConcern')}}">Process Concern</a></li>
                    </ul>
                </div>
                @endif
                @if($admin->role == 'Barangay Captain' )
                <div class="dropdown">
                    <button style="width:100%;text-align: justify;" class="btn btn-primary1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-database-fill-lock"></i> Barangay Data Report
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{url('listresident')}}">List of Resident account</a></li>
                        <li><a class="dropdown-item" href="{{url('deactlistresident')}}">Deactivated Resident account</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{url('listbarangayemployee')}}">List of Barangay employee account</a></li>
                        <li><a class="dropdown-item" href="{{url('deactlistbarangayemployee')}}">Deactivated Employee Account</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="{{url('view-request-list')}}">View Document Requests</a></li>
                        <li><a class="dropdown-item" href="{{url('view-concern-list')}}">View Concerns</a></li>
                    </ul>
                </div>
                @endif
                @if($admin->role == 'Barangay Secretary' || $admin->role == 'Administrator')
                <div class="dropdown">
                    <button style="width:100%;text-align: justify;" class="btn btn-primary1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people-fill"></i> Manage Resident Account
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{url('listresident')}}">List of Resident account</a></li>
                        <li><a class="dropdown-item" href="{{url('deactlistresident')}}">Deactivated Resident account</a></li>
                    </ul>
                </div>
                @endif
                @if($admin->role == 'Barangay Treasurer')
                <a href="{{url('listConfirmPayment')}}" style="text-align: justify;" type="button" class="btn btn-primary1"><i class="bi bi-list-task"></i> List of Payment</a>

                <div class="dropdown">
                    <button style="width:100%;text-align: justify;" class="btn btn-primary1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-cash-stack"></i> Manage Payment
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                        <!-- <li><a class="dropdown-item" href="{{url('dashboard')}}">List of Payment</a></li>
                        <hr class="dropdown-divider"> -->
                        <li><a class="dropdown-item" href="{{url('listReadyForPayment')}}">Process Onsite Payment Request</a></li>
                        <li><a class="dropdown-item" href="{{url('listOnlinePayment')}}">Process Online Payment Request</a></li>
                    </ul>
                </div>
                @endif
                @if($admin->role == 'Administrator')
                <div class="dropdown">
                    <button style="width:100%;text-align: justify;" class="btn btn-primary1 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-badge-fill"></i></i> Manage Employee Account
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{url('listbarangayemployee')}}">List of Barangay employee account</a></li>
                        <li><a class="dropdown-item" href="{{url('addbarangayemployee')}}">Add employee account</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="deactlistbarangayemployee">Deactivated Employee Account</a></li>

                    </ul>
                </div>

                <a href="manageWebApp" style="text-align: justify;" type="button" class="btn btn-primary1"><i class="bi bi-gear-wide-connected"></i> Manage Website</a>
                @endif
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{url('adminID/'.$admin->profilePic)}}" alt="" width="32" height="32" class="rounded-circle me-2">
                    @if($admin->middle_name == 'N/A')
                    <p hidden>{{$initial=Strtolower($admin->first_name[0]."".$admin->middle_name[0]."".$admin->last_name[0])}}</p>
                    @else
                    <p hidden>{{$initial=Strtolower($admin->first_name[0]."".$admin->last_name[0])}}</p>
                    @endif
                    <strong>{{$initial}}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{url('myAccount')}}">Account Setting</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{url('signout')}}">Sign out</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div class="top_nav">
        <nav class="main-header navbar navbar-expand " style="background-color: #720602;">
            <div class="container-fluid flex-sm-row">
                <ul class="navbar-nav">
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <li class="nav-item ml-3">
                        <img class="nav-link img-circle " src="imgs/SOUTHSIGNAL LOGO.png" alt="" style="padding: 0px;width: 50px ;">
                    </li>
                    <li class="nav-item">
                        <nobr class="nav-link text-white font-weight-bold"><span>BARANGAY SOUTH SIGNAL VILLAGE</span></nobr>
                    </li>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
    @endforeach