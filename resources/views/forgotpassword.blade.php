<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BARANGAY SOUTH SIGNAL VILLAGE</title>
    <link rel="icon" href="{{asset('assets/imgs/southsignalLogoLeft.png')}}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{asset('css/head.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <style>
        body {
            background-color: #AA0F0A;

        }
    </style>
</head>

<body>

    <div class="container d-flex flex-column ">
        <div class="row align-items-center justify-content-center
          min-vh-100">
            <div class="col-12 col-md-8 col-lg-4">

                <div class="text-center mb-2">
                    <img src="{{asset('assets/imgs/southsignalLogoLeft.png')}}" alt="Barangay South SIgnal Village Logo" class="rounded float-center" alt="southsignal" style="width: 125px ;">
                    <h4 class="d-inline-block align-text-top font-weight-bold text-light " style="font-weight: bold;">BARANGAY SOUTH SIGNAL VILLAGE </h4>

                </div>
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5>Forgot Password?</h5>
                            <p class="mb-2">Enter your registered email to reset the password
                            </p>
                        </div>
                        <form id="yourForm" method="post" enctype="multipart/form-data" action="{{url('forgetpassword')}}" class="needs-validation" novalidate>
                            <div class="mb-3">
                                @csrf
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Enter Your Email" required="">
                                <div class="invalid-feedback">
                                    Please enetr your email.
                                </div>
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-danger">
                                    Reset Password
                                </button>
                            </div>
                            <span>Don't have an account? <a href="/login">sign in</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<script>
    // Get the form element
    const form = document.getElementById("yourForm");

    // Listen for the submit event
    form.addEventListener("submit", function(event) {

        console.log('hello');
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

                if (response.message == 'error') {
                    $("#loadingModal").modal("hide");
                    Swal.fire({
                        title: "<h4>INVALID EMAIL</h4>",
                        icon: "error",
                        text: 'The email you entered is not registered.',
                        showCloseButton: false,
                        showCancelButton: false,
                        confirmButtonColor: "#AA0F0A",
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "/home";
                        }
                    });
                } else {
                    // Hide the modal
                    $("#loadingModal").modal("hide");
                    Swal.fire({
                        title: "<h4>EMAIL CONFIRMED</h4>",
                        icon: "success",
                        text: 'Please check your email to reset ypur password.',
                        showCloseButton: false,
                        showCancelButton: false,
                        confirmButtonColor: "#AA0F0A",
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "/home";
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
</script>
<script>
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

</html>