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
                        <button data-bs-toggle="modal" data-bs-target="#terms" style="width: 100%; text-align: left;" class="btn" data-bs-dismiss="offcanvas" aria-label="Close">
                            <a class="nav-link" href="#"><svg style="font-size: 20px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z" />
                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                                </svg> Terms & Conditions</a>
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
    <div class="modal fade" id="dataPrivacy" tabindex="-1" aria-labelledby="dataPrivacyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="text-align: center;" class="modal-title" id="exampleModalLabel">Draft Policy on Open Data for the Barangay South Signal Village</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>WHEREAS, much of the data collected by the Barangay South Signal Village (hereafter, “the Taguig City”) is stored in ways which impede the ability to aggregate, analyze and synthesize it to better allocate public resources; and
                        <br><br>WHEREAS, access to public information promotes a higher level of civic engagement and allows citizens to provide valuable feedback to government officials regarding local issues; and
                        <br><br>WHEREAS, every citizen has the right to prompt, efficient service from the government; and
                        <br><br>WHEREAS, the thoughtful implementation of an open data program improves provision of services, increases transparency and access to public information, and enhances coordination and efficiencies among departments, partner organizations and citizens; and
                        <br><br>WHEREAS, one goal of an Open Data policy is to proactively provide information currently sought through public records requests, thereby saving the Taguig City time and money; and
                        <br><br>WHEREAS, in commitment to the spirit of Open Government, the Taguig City will consider public information to be open by default and will proactively publish data and data containing information, consistent with relevant public records law; and
                        <br><br>WHEREAS, information technologies, including web-based and other Internet applications and services, are an essential means for Open Government, and good government generally; and
                        <br><br>WHEREAS, by publishing structured standardized data in machine readable formats the Taguig City seeks to encourage the local software community to develop software applications and tools to collect, organize, and share public record data in new and innovative ways; and
                        <br><br>WHEREAS, the protection of privacy, confidentiality and security will be maintained as a paramount priority while also advancing the government’s transparency and accountability through open data.
                        <br><br>NOW, THEREFORE, BE IT RESOLVED by the Barangay Captain of the Barangay South Signal Village that:
                        <br><br>
                    <h6>Section 1: Definitions</h6>
                    <p>WHEREAS, much of the data collected by the Barangay South Signal Village (hereafter, “the Taguig City”) is stored in ways which impede the ability to aggregate, analyze and synthesize it to better allocate public resources; and
                        <br><br>a. “Data” means statistical, factual, quantitative, or qualitative information that is maintained or created by or on behalf of a Taguig City agency. This definition is inclusive of software source code developed or maintained by or on behalf of the Taguig City.
                        <br><br>b. “Open data” means data that is available online, in an open format, with no legal encumbrances on use or reuse, and is available for all to access and download in full without fees [or a requirement of registration]. “Legal encumbrance” includes federal copyright protections and other, non-statutory legal limitations on how or under what conditions a dataset may be used. This definition is also inclusive of any software source code made available online (“open source software”).
                        <br><br>c. “Open format” means any widely accepted, nonproprietary, platform-independent, machine-readable data format, which permits automated processing of such data and facilitates analysis and search capabilities.
                        <br><br>d. “Dataset” means a named collection of related records, with the collection containing data organized or formatted in a specific or prescribed way, often in tabular form.
                        <br><br>e. “Protected information” means any dataset or portion thereof to which an agency may deny access pursuant to the [state or city public records statute] or any other law or rule or regulation.
                        <br><br>f. “Sensitive information” means any data which, if published by the Taguig City online, could raise privacy, confidentiality or security concerns or have the potential to jeopardize public health, safety or welfare to an extent that is greater than the potential public benefit of publishing that data.
                        <br><br>g. “Publishable data” means data which is not protected or sensitive and which has been prepared for release to the public.
                    </p>
                    <br><br>
                    <h6>Section 2: Open Data Program</h6>
                    WHEREAS, much of the data collected by the Barangay South Signal Village (hereafter, “the Taguig City”) is stored in ways which impede the ability to aggregate, analyze and synthesize it to better allocate public resources; and
                    <br><br>a. the Taguig City commits to develop and implement practices that will allow it to:
                    <br><br>
                    <p class="ms-3">1. Proactively release all publishable Taguig City data, making it freely available in appropriately varied and useful open formats, using an open license with no restrictions on use or reuse, and fully accessible to the broadest range of users to use for varying purposes;
                        <br><br>2. Publish high quality, updated data with documentation (metadata) and permanence to encourage maximum use;
                        <br><br>3. Provide or support access to free, historical archives of all released Taguig City data;
                        <br><br>4. Measure the effectiveness of datasets made available through the Open Data Program by connecting open data efforts to the Taguig City’s programmatic priorities;
                        <br><br>5. Minimize limitations on the disclosure of public information while appropriately safeguarding protected and sensitive information; and
                        <br><br>6. Support innovative uses of the Taguig City’s publishable data by agencies, the public, and other partners.
                    </p>
                    b. The development and implementation of these practices shall be overseen by the Barangay Captain, reporting to the Barangay Captain [or to the Barangay Captain’s designee].
                    <br><br>c. The requirements of this Order shall apply to any Taguig City department, office, administrative unit, commission, board, advisory committee or other division of Taguig City government (“agency”), including the records of third party agency contractors that create or acquire information, records, or data on behalf of a Taguig City agency.
                    <br><br>d. Appropriate funding shall be made available to achieve the goals of this program.
                    <br><br>
                    <h6>Section 3: Governance</h6>
                    a. Implementation of the Open Data Program will be overseen by the Barangay Captain, who will work with the Taguig City’s departments and agencies to:
                    <br><br>
                    <p class="ms-3">1. For each Taguig City agency, identify and publish appropriate contact information for a lead open data coordinator who will be responsible for managing that agency’s participation in the Open Data Program;
                        <br><br>2. Oversee the creation of a comprehensive inventory of datasets held by each Taguig City agency which is published to the central open data location and is regularly updated;
                        <br><br>3. Develop and implement a process for determining the relative level of risk and public benefit associated with potentially sensitive, non-protected information so as to make a determination about whether and how to publish it;
                        <br><br>4. Develop and implement a process for prioritizing the release of datasets which takes into account new and existing signals of interest from the public (such as the frequency of public records requests), the Taguig City's programmatic priorities, existing opportunities for data use in the public interest, and cost;
                        <br><br>5. Proactively consult with members of the public, agency staff, journalists, researchers, and other stakeholders to identify the datasets which will have the greatest benefit to Taguig City residents if published in a high quality manner;
                        <br><br>6. Establish processes for publishing datasets to the central open data location, including processes for ensuring that datasets are high quality, up-to-date, are in use-appropriate formats, and exclude protected and sensitive information;
                        <br><br>7. Ensure that appropriate metadata is provided for each dataset in order to facilitate its use;
                        <br><br>8. Develop and oversee a routinely updated, public timeline for new dataset publication; and
                        <br><br>9. Make recommendations for historical document inclusion,define a schedule for approved historical document publication
                    </p>
                    b. In order to increase and improve use of the Taguig City’s open data, the Barangay Captain will actively encourage agency and public participation through providing regular opportunities for feedback and collaboration.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color: #AA0F0A; color:white" data-bs-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="terms" tabindex="-1" aria-labelledby="termsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="text-align: center;" class="modal-title" id="exampleModalLabel">Terms and Conditions for the Barangay South Signal Village</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
                    <dl>
                        <dt>Definition list</dt>
                        <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</dd>
                        <dt>Lorem ipsum dolor sit amet</dt>
                        <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</dd>
                    </dl>
                    <dl>
                        <dt>Definition list</dt>
                        <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</dd>
                        <dt>Lorem ipsum dolor sit amet</dt>
                        <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</dd>
                    </dl>
                    <dl>
                        <dt>Definition list</dt>
                        <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</dd>
                        <dt>Lorem ipsum dolor sit amet</dt>
                        <dd>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" style="background-color: #AA0F0A; color:white" data-bs-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>

    <body>
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
    </body>
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

</html>