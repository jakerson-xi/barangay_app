<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>admin</title>

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
        .btn-primary {
            color: #fff;
            background-color: #720602;
            border-color: #720602;
            /*set the color you want here*/
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active,
        .btn-primary.active,
        .open>.dropdown-toggle.btn-primary {
            color: #720602;
            background-color: #fff;
            border-color: #fff;
            /*set the color you want here*/
        }

        .home-content {
            position: fixed;
            height: 100%;
            width: 100%-280px;
            left: 280px;
            right: 0;

        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 280px;
        }
    </style>

</head>

<body>
    <header>
        @include('sweetalert::alert')

        <body>
            
        @foreach($admin_info as $admin)
            <div style="background-color:#720602" class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white">
                <div class="" style="text-align: center;"><img src="https://scontent.fmnl4-2.fna.fbcdn.net/v/t1.6435-9/188520925_3732142266891538_3002780457932936827_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=174925&_nc_eui2=AeFS3hjzWii5y7u-ayLhhvrGLA1Q6hFaIissDVDqEVoiK9tGhzWlK_zl1yMCGBqptRX4uNxWAoIhrkVh4AgGVIXN&_nc_ohc=Ewu9hUjeMHwAX94YxtN&_nc_ht=scontent.fmnl4-2.fna&oh=00_AT_b3A1F1MoaQdqFNSdZdzDD4-j-ZDp6HfvQNoPoTzdOAA&oe=633B1281" class="rounded-circle " style="width: 100px;" alt="Avatar" />
                    <h5 class=""><strong>{{$admin->role}}</strong></h6>
                        <p class="">Brgy. Captain</p>
                </div>
                @endforeach
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <button style="text-align: justify;" type="button" class="btn btn-primary"><i class="bi bi-bar-chart-fill"></i> Dashboard</button>
                    <div class="dropdown">
                        <button style="width:100%;text-align: justify;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-earmark-text-fill"></i> Requests
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Process Document Request</a></li>
                            <li><a class="dropdown-item" href="#">Process Rent Request</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Analytics Report</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button style="width:100%;text-align: justify;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-ticket-perforated-fill"></i> Concerns
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Process Concerns</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Analytics Report</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button style="width:100%;text-align: justify;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-people-fill"></i> Manage Resident Account
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">List of Resident account</a></li>
                            <li><a class="dropdown-item" href="#">Modify Resident account</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li><a class="dropdown-item" href="#">Analytics</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button style="width:100%;text-align: justify;" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-badge-fill"></i></i> Manage Employee Account
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">List of Barangay employee account</a></li>
                            <li><a class="dropdown-item" href="#">Add employee account</a></li>
                            <li><a class="dropdown-item" href="#">Modify employee account</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Analytics Report</a></li>
                        </ul>
                    </div>
                    <button style="text-align: justify;" type="button" class="btn btn-primary"><i class="bi bi-pc-display"></i> Manage Website</button>
                    <button style="text-align: justify;" type="button" class="btn btn-primary"><i class="bi bi-graph-up-arrow"></i></i> Analytics Report</button>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://scontent.fmnl4-2.fna.fbcdn.net/v/t1.6435-9/188520925_3732142266891538_3002780457932936827_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=174925&_nc_eui2=AeFS3hjzWii5y7u-ayLhhvrGLA1Q6hFaIissDVDqEVoiK9tGhzWlK_zl1yMCGBqptRX4uNxWAoIhrkVh4AgGVIXN&_nc_ohc=Ewu9hUjeMHwAX94YxtN&_nc_ht=scontent.fmnl4-2.fna&oh=00_AT_b3A1F1MoaQdqFNSdZdzDD4-j-ZDp6HfvQNoPoTzdOAA&oe=633B1281" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>jdoe</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Account Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
    </header>


    <div class="home-content">
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
        <!-- <div class="mx-3 my-3 rounded p-3 shadow">
            <table id="resident" class="table table-bordered table-hover" style="width:100%">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user_info as $user)

                    @if($user->middle_name == 'N/A')
                    <p hidden>{{$fullname = $user->first_name." ".$user->last_name}}</p>

                    @else
                    <p hidden>{{$fullname = $user->first_name." ".$user->middle_name." ".$user->last_name}}</p>

                    @endif
                    <tr>
                        <td style="text-transform: uppercase;">{{$user->id}}</td>
                        <td style="text-transform: uppercase;">{{$fullname}}</td>
                        <td style="text-transform: uppercase;">{{$user->gender}}</td>
                        <td>
                            <a class="btn btn-outline-secondary" href="deleteUser/{{$user->id}}">Delete</a>
                            <a class="btn btn-outline-secondary" href="viewUser/{{$user->id}}">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#resident').DataTable();

    });
</script>

</html>