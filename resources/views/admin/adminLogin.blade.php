<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Admin Login</title>
    <link rel="icon" href="{{asset('assets/imgs/southsignalLogoLeft.png')}}" type="image/png">
</head>

<body style="background-color: #720602;">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100 mt-2">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <!-- <div class="text-center my-5">
						<img src="imgs/southsignal.png" alt="logo" width="100">
					</div> -->
                    <div class="card shadow-lg my-5">
                        <div class="card-body p-5">
                            <div class="text-center">
                                <img src="{{asset('assets/imgs/southsignal.png')}}" alt="logo" width="100">
                            </div>
                            <h1 class="fs-4 card-title fw-bold mt-3 text-center">ADMIN PORTAL</h1>
                            <hr>
                            <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                            @include('sweetalert::alert')
                            <form form method="post" enctype="multipart/form-data" action="{{url('loginAdmin')}}" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">E-mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="d-flex justify-content-center mb-3"> <!-- Center the reCAPTCHA elements -->
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mb-3">
                                    <button style="background-color: #9b0904;color: white;" class="btn" type="submit">Login</button>
                                </div>
                            </form>
                            <hr>
                        </div>

                    </div>
                    <div class="text-center mt-5" style="color:white">
                        Copyright &copy; 2022 &mdash; BARANGAY SOUTH SIGNAL VILLAGE
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/login.js"></script>
</body>

</html>