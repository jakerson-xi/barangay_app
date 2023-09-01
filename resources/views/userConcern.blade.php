<html lang="en">
@foreach($user_info as $user)

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resident Dashboard | {{$user->first_name." ".$user->last_name}}</title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <style>
        input::placeholder {
            color: gray;
        }
    </style>
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
                        <nobr class="nav-link text-white font-weight-bold"><span>CONCERN</span></nobr>
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

        <form id="yourForm" method="post" enctype="multipart/form-data" action="{{url('submit-concern')}}" class="needs-validation" novalidate>
            @csrf
            <input type="hidden" name="resident_id" value="{{$user->id}}">
            <div class="container overflow-hidden mt-3">
                <div class="shadow p-4 mb-3 bg-body rounded ">
                    <p class="fs-4 fw-semibold text-center">SUBMIT CONCERN</p>
                    <hr>
                    <div class="row my-3 ">
                        <div class="col-md-12 mb-2">
                            <label class="text-start mb-2" for="">Type of Concern<span class="text-danger">*</span> </label>
                            <select name="concern_type" id="concern_type" class="form-select form-control" aria-label="Default select example" required>
                                <option value="">Select...</option>
                                <option value="Infrastructure">Infrastructure (Infrastraktura) (e.g electricity, water, street lights, etc.)</option>
                                <option value="Transportation">Transportation (Transportasyon)</option>
                                <option value="Environmental">Environmental (Pangkalikasan) </option>
                                <option value="Health & Sanitation">Health & Sanitation (Pangkalusugan)</option>
                                <option value="Safety & Security">Safety & Security (Pangkaligtasan)</option>
                                <option value="Social Welfare">Social Welfare (barangay assistance)</option>
                                <option value="Resident Account">Resident Account</option>
                                <option value="Others">Others (at iba pa)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row my-3 ">
                        <div class="col-md-12 mb-2">
                            <label class="text-start mb-2" for="">Title:<span class="text-danger">*</span> </label>
                            <input name="concern_title" class="form-control" id="concern_title" rows="1" placeholder="(e.g. No lights in street Manghinayang, Walang dumadaan na truck ng basura)" required>
                        </div>
                    </div>
                    <div class="row my-3 ">
                        <div class="col-md-12 mb-2">
                            <label class="text-start mb-2" for="">Description:<span class="text-danger">*</span> </label>
                            <textarea name="concern_description" class="form-control" id="concern_description" rows="3" placeholder="Tell us more about your concern (Ibahagi sa amin nang mas detalyado ang tungkol sa iyong concern...)" required></textarea>
                        </div>
                    </div>

                    <div class="" id="upload_id">
                        <label class="text-start mb-2" for="">Upload a picture of your concern to help us better understand and recognize the issue. <br><em>Mag-upload ng larawan ng iyong alalahanin upang matulungan kami na mas maunawaan at makilala ang isyu.</em></label>
                        <div class="mb-2 me-2">
                            <label for="Image" class="form-label"></label>
                            <input class="form-control me-3 " type="file" id="formFile" name="file" onchange="preview()">
                            <div class="invalid-feedback m-3">
                                Please attach your ID.
                            </div>
                            <div class="text-center">
                                <img id="frame" src="" class="img-fluid mt-3" />
                                <div class="text-center">
                                    <button onclick="clearImage()" class="btn mt-3" style="background-color:#AA0F0A; color: white;">Clear</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="shadow p-4 mb-3 bg-body rounded text-center">
                    <div class="form-group mb-2">
                        <nobr> <input onchange="isCheck(this)" type="checkbox" id="agree">&nbsp; <label for="" id="agreeText" style="cursor: pointer;"> I have read,</nobr> <strong>understood</strong>, and <strong>accepted</strong> the
                        <a href="" target="_blank">Privacy Policy</a> and <a href="" target="_blank">Terms & Conditions.</a></label>
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
    <script src="{{asset('js/concern.js')}}"> </script>
    <script>
        function clearImage() {
            document.getElementById("formFile").value = null;
            frame.src = "";
            frame.width = "";
            frame.height = "";
        }

        // Get the form element
        const form = document.getElementById("yourForm");

        // Listen for the submit event
        form.addEventListener("submit", function(event) {
            if (!form.checkValidity()) {
                // If the form is not valid, show the validation errors

                event.preventDefault();
                return;
            }
            event.preventDefault(); // Prevent the form from being submitted normally

            // Show the modal
            $("#loadingModal").modal("show");

            // Get the form data
            const formData = new FormData(form);

            // Make the AJAX request
            $.ajax({
                type: "POST",
                url: form.action,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Hide the modal
                    $("#loadingModal").modal("hide");
                    //     Swal.fire({
                    //         title: "<h4>YOUR CONCERN IS SUCCESSFULY SUBMITTED</h4>",
                    //         icon: "success",
                    //         html: response.message,
                    //         showCloseButton: false,
                    //         showCancelButton: false,
                    //         confirmButtonColor: "#AA0F0A",
                    //     }).then((result) => {
                    //         if (result.value) {
                    //             window.location.href = "/userDashboard";
                    //         }
                    //     });
                    // },
                    
                    if (response.success === 'true') {
                        Swal.fire({
                            title: "<h4>YOUR CONCERN IS SUCCESSFULY SUBMITTED</h4>",
                            icon: "success",
                            html: response.message,
                            showCloseButton: false,
                            showCancelButton: false,
                            confirmButtonColor: "#AA0F0A",
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/userDashboard";
                            }
                        });
                    }
                    else if(response.success === "Fail") {
                        Swal.fire({
                            title: "<h4>FAIL</h4>",
                            icon: "error",
                            html: response.message,
                            showCloseButton: false,
                            showCancelButton: false,
                            confirmButtonColor: "#AA0F0A",
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/userDashboard";
                            }
                        });
                    }
                    else {
                        Swal.fire({
                            title: "<h4>CAPTCHA ERROR</h4>",
                            icon: "error",
                            html: response.message,
                            showCloseButton: false,
                            showCancelButton: false,
                            confirmButtonColor: "#AA0F0A",
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/userDashboard";
                            }
                        });
                    }
                },
                error: function(error) {
                    // Hide the modal
                    $("#loadingModal").modal("hide");

                    // Handle the error (e.g. show an error message)
                },
            });
        });
        const fileInput = document.querySelector("#formFile");

        fileInput.addEventListener("change", function() {
            const file = fileInput.files[0];
            const acceptedImageTypes = ["image/jpeg", "image/png"];

            if (!acceptedImageTypes.includes(file.type)) {
                Swal.fire({
                    title: "Invalid file type",
                    text: "Please select an image file (JPEG, PNG).",
                    icon: "error",
                    confirmButtonColor: "#d33",
                });
                fileInput.value = "";
                frame.src = "";
            }
        });
        var textarea = document.getElementById("concern_description");
        textarea.addEventListener("input", resizeTextarea);
    </script>

</html>