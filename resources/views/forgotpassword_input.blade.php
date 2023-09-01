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
                    <img src="{{asset('assets/imgs/southsignalLogoLeft.png')}}" alt="Barangay South SIgnal Village Logo" class="rounded float-center " alt="southsignal" style="width: 125px ;">
                    <h4 class="d-inline-block align-text-top font-weight-bold text-light" style="font-weight: bold;">BARANGAY SOUTH SIGNAL VILLAGE </h4>

                </div>
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5>Reset Password</h5>
                            <p class="mb-2">Please enter your new password
                            </p>
                        </div>
                        <form id="yourForm" method="post" enctype="multipart/form-data" action="{{url('changing_password')}}" class="needs-validation" novalidate>
                            <div class="mb-3">
                                @csrf
                                <input type="hidden" id="email" class="form-control" name="email" value="{{$email}}" readonly>
                                <input type="hidden" id="key" class="form-control" name="key" value="{{$key}}" readonly>
                                <div class="invalid-feedback">
                                    Please enetr your email.
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input onkeyup="checkPassword();" type="password" name="newPassword" id="newPassword" class="form-control" placeholder="Enter your new password" required>
                                        <button onclick="eye();" type="button" class="input-group-text " id='togglePassword'><i id='eye' class="bi bi-eye-fill"></i></button>
                                    </div>
                                    <div class="progress mt-1" style="height: 5px;">
                                        <div id="progress" class="progress-bar bg-danger" role="progressbar" aria-label="Example 1px high" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span id="lower-upper" style="color: rgba(192, 1, 1, 0.932);">
                                                <i id="lower-upper_check" class="bi bi-x-circle">&nbsp;Uppercase and Lowercase</i>
                                            </span>
                                        </li>
                                        <li>
                                            <span id="numbers" style="color: rgba(192, 1, 1, 0.932);">
                                                <i id="numbers_check" class="bi bi-x-circle">&nbsp;Number(0-9)</i>
                                            </span>
                                        </li>
                                        <li>
                                            <span id="specialChar" style="color: rgba(192, 1, 1, 0.932);">
                                                <i id="specialChar_check" class="bi bi-x-circle">&nbsp;Special Character (!@#$%^&*_-)</i>
                                            </span>
                                        </li>
                                        <li>
                                            <span id="count" style="color: rgba(192, 1, 1, 0.932);">
                                                <i id="count_check" class="bi bi-x-circle">&nbsp;Atleast 8 characters</i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                    <input onkeyup="checkConfirmPassword();" type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm your new password" required>
                                    <div id="mismatch" class="invalid-feedback" style="display:none">
                                        Your confirm password is not match with your inputted password.
                                    </div>
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
    function eye() {
        const type =
            document.getElementById("newPassword").getAttribute("type") ===
            "password" ?
            "text" :
            "password";
        document.getElementById("newPassword").setAttribute("type", type);

        // toggle the icon
        if (type == "password") {
            document.getElementById("eye").classList.add("bi-eye-fill");
            document.getElementById("eye").classList.remove("bi-eye-slash-fill");
        } else {
            document.getElementById("eye").classList.add("bi-eye-slash-fill");
            document.getElementById("eye").classList.remove("bi-eye-fill");
        }
    }

    function checkConfirmPassword() {
        var passwords = document.getElementById("newPassword").value;
        var passwords_conmfirm = document.getElementById("confirmPassword").value;
        if (passwords != passwords_conmfirm) {
            document.getElementById("mismatch").style.display = "block";
            document
                .getElementById("confirmPassword")
                .setCustomValidity("Invalid field.");
        } else {
            document.getElementById("mismatch").style.display = "none";
            document.getElementById("confirmPassword").setCustomValidity("");
        }
    }

    function checkPassword() {
        var passwords = document.getElementById("newPassword").value;
        var passwords_conmfirm = document.getElementById("confirmPassword").value;
        var stregth = 0;

        if (passwords != passwords_conmfirm) {
            document.getElementById("mismatch").style.display = "block";
            document
                .getElementById("confirmPassword")
                .setCustomValidity("Invalid field.");
        } else {
            document.getElementById("mismatch").style.display = "none";
            document.getElementById("confirmPassword").setCustomValidity("");
        }

        if (passwords.length >= 8) {
            document.getElementById("count_check").classList.add("bi-check-circle");
            document.getElementById("count_check").classList.remove("bi-x-circle");
            document.getElementById("count").style.color = "green";
            stregth += 1;
        } else {
            document
                .getElementById("count_check")
                .classList.remove("bi-check-circle");
            document.getElementById("count_check").classList.add("bi-x-circle");
            document.getElementById("count").style.color =
                " rgba(192, 1, 1, 0.932)";
        }

        if (passwords.match(/([a-z])/) && passwords.match(/([A-Z])/)) {
            document
                .getElementById("lower-upper_check")
                .classList.add("bi-check-circle");
            document
                .getElementById("lower-upper_check")
                .classList.remove("bi-x-circle");
            document.getElementById("lower-upper").style.color = "green";
            stregth += 1;
        } else {
            document
                .getElementById("lower-upper_check")
                .classList.remove("bi-check-circle");
            document
                .getElementById("lower-upper_check")
                .classList.add("bi-x-circle");
            document.getElementById("lower-upper").style.color =
                " rgba(192, 1, 1, 0.932)";
        }

        if (passwords.match(/([0-9])/)) {
            document
                .getElementById("numbers_check")
                .classList.add("bi-check-circle");
            document
                .getElementById("numbers_check")
                .classList.remove("bi-x-circle");
            document.getElementById("numbers").style.color = "green";
            stregth += 1;
            console.log("NUMBER");
        } else {
            document
                .getElementById("numbers_check")
                .classList.remove("bi-check-circle");
            document.getElementById("numbers_check").classList.add("bi-x-circle");
            document.getElementById("numbers").style.color =
                "rgba(192, 1, 1, 0.932)";
        }

        if (passwords.match(/([!,@,#,$,%,^,&,*,-,_])/)) {
            document
                .getElementById("specialChar_check")
                .classList.add("bi-check-circle");
            document
                .getElementById("specialChar_check")
                .classList.remove("bi-x-circle");
            document.getElementById("specialChar").style.color = "green";
            stregth += 1;
            console.log("SPECIAL");
        } else {
            document
                .getElementById("specialChar_check")
                .classList.remove("bi-check-circle");
            document
                .getElementById("specialChar_check")
                .classList.add("bi-x-circle");
            document.getElementById("specialChar").style.color =
                "rgba(192, 1, 1, 0.932)";
        }

        if (stregth == 4) {
            console.log(stregth);
            document.getElementById("progress").classList.add("bg-success");
            document.getElementById("progress").classList.remove("bg-danger");
            document.getElementById("newPassword").setCustomValidity("");
        }
        if (stregth != 4) {
            console.log(stregth);
            document.getElementById("progress").classList.add("bg-danger");
            document.getElementById("progress").classList.remove("bg-success");
            document
                .getElementById("newPassword")
                .setCustomValidity("Invalid field.");
        }
    }

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