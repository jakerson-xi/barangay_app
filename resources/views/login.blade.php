<html lang="en">
<!--HEADER -->
@include('head')

<h1 class="display-6 text-center fw-bolder my-3">LOG-IN</h1>
<div class="myContainers">
    <div class="card-body">

        <div class="text-center" style="text-align: center;">
            <img src="{{asset('assets/imgs/southsignalLogoLeft.png')}}" class="img-fluid" alt="...">
        </div>

        <form method="post" enctype="multipart/form-data" action="{{url('loginUser')}}" class="mt-4 px-xl-5 mb-4 mx-2 needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                <div class="invalid-feedback">
                    Please input valid email address.
                </div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Please enter your password" required>
                <div class="invalid-feedback">
                    Please input password.
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Checkbox -->
                <a href="/forgetpasswordpage" target="_blank" class="text-body" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="We will need to verify your account">Forgot password?</a>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
            </div>

            <button type="submit" style="background-color: #AA0F0A; color: white;" class="btn">Login</button>

            <div class="text-center text-lg-start mt-3">
                <p class="small fw-bold pt-1 mb-0">Don't have an account?
                    <!-- <a href="registration" class="link-danger">Register</a> -->
                    <a href="#askingLegal" data-bs-toggle="modal" data-target="#askingLegal" class="link-danger">Register</a>
                </p>
            </div>
        </form>
    </div>
</div>


<!-- Modal for asking 18 years old-->
<div class="modal fade" id="askingLegal" tabindex="-1" aria-labelledby="askingLegalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-circle"></i> Confirm Age Requirement</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-2">
                    <img src="{{asset('assets/imgs/southsignal.png')}}" alt="logo" width="100">
                </div>
                <p class="m-2">
                    This barangay online service is only available to users who are <strong>18 years old and above</strong>. By registering for this app, you confirm that you are of legal age. If you are not yet 18 years old, please do not proceed with registration. <br><br>Thank you for your understanding.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#dataPrivacy" data-bs-toggle="modal" data-target="#dataPrivacy" style="background-color: #AA0F0A; color:white" class="btn ">Yes, I'm 18 years old and above</a>
            </div>
        </div>
    </div>
</div>


<!-- modal for data privacy -->
<div class="modal  " id="dataPrivacy" tabindex="-1" aria-labelledby="dataPrivacyLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Privacy Policy for Barangay South Signal Village Web App </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="{{asset('assets/imgs/southsignal.png')}}" alt="logo" width="100">
                </div>
                <dl>
                    <dt>Introduction</dt>
                    <dd>At Barangay South Signal Village, we recognize the importance of protecting your personal data and privacy. We are committed to maintaining the confidentiality and limiting any disclosure of your information in accordance with local laws. This Privacy Policy outlines how we collect, use, share, and protect your personal information when you use our web app. </dd>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="registration" class="btn" style="background-color: #AA0F0A; color:white">Accept</a>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('js/validation.js')}}"></script>

<!-- FOOTER-->
@include('footer')