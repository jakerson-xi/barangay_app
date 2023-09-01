@include('admin/adminHeader')
@foreach($admin_info as $target)
<style>
    .dropdown-toggle::after {
        display: none;

    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
<div class="content">
    <p class="display-6"><i class="bi bi-person-circle"></i> <strong>My Account</strong></p>
    <hr style="color: black;">
    <div class="" style="text-align: center;">
        <div class="dropdown">
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;background-color:transparent">
                <img src="{{url('adminID/'.$target->profilePic)}}" class="rounded-circle mb-2" style="width: 100px; height: 100px; position: relative;" alt="Avatar" />
            </button>

            <ul class="dropdown-menu dropdown-menu-dark">
                <a class="dropdown-item" href="#changeProfilePic" data-bs-toggle="modal" data-bs-target="#changeProfilePic">Change Profile Picture</a>
            </ul>
        </div>
        <h5 class=""><strong>{{$target->first_name." ".$target->last_name}}</strong></h5>
        <p class="">{{$target->role}}</p>
        <div class="card-body my-3">
            <fieldset class="groupBox">
                <legend class="goupBoxHeader">Employee's Personal Information</legend>
                <div class="col-md-12 row mb-2">
                    <div class="form-group  col-md-4">
                        <label for="first_name">First Name </label>
                        <input id="first_name" name="first_name" type="text" class="form-control text-center" value="{{$target->first_name}}" readonly>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input id="middle_name" name="middle_name" type="text" class="form-control text-center" value="{{$target->middle_name}}" readonly>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" name="last_name" type="text" class="form-control text-center" value="{{$target->last_name}}" readonly>
                    </div>

                </div>

                <div class="col-md-12 row mb-2">
                    <div class="form-group  col-md-3">
                        <label>Suffix</label>
                        <input class="form-control text-center" name="suffix" id="suffix" value="{{$target->suffix}}" readonly>

                    </div>
                    <div class="col-md-3">
                        <label for="">Gender</label>
                        <input id="gender" name="gender" class="form-control text-center" value="{{$target->gender}}" readonly>

                    </div>
                    <div class="form-group col-md-3">
                        <label>Marital Status</label>
                        <input class="form-control text-center" name="marital_status" id="marital_status" value="{{$target->marital_status}}" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Nationality</label>
                        <input class="form-control text-center" id="nationality" name="nationality" value="{{$target->nationality}}" readonly>
                    </div>
                </div>

                <div class="col-md-12 row mb-2">
                    <div class="form-group col-md-6">
                        <label>Birthdate</label>
                        <input type="text" id="birthdate" name="birthdate" class="form-control text-center" value="{{date('m/d/Y', strtotime($target->birthdate))}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Place of Birth</label>
                        <input type="text" id="place_birth" NAME="place_birth" class="form-control text-center" value="{{$target->place_birth}}" readonly />
                    </div>
                </div>

                <legend class="goupBoxHeader mt-3">Address</legend>
                <div class="col-md-12 row mb-2">

                    <div class="">
                        <div class="form-group">
                            <label>Complete Address</label>
                            <input type="text" name="address_unitNo" id="address_unitNo" class="form-control text-center" value="{{ucwords(strtolower($target->address_unitNo)).' '.ucwords(strtolower($target->address_houseNo)).' '.ucwords(strtolower($target->address_street)).' '.ucwords(strtolower($target->address_purok)).' Barangay South Signal Village Taguig City'}}" readonly>
                        </div>
                    </div>
                </div>

                <legend class="goupBoxHeader mt-3">Account Information</legend>
                <div class="col-md-12 row mb-2">

                    <div class="form-group col-md-4 mb-2">
                        <label>Employee ID</label>
                        <input type="text" id="validID_num" name="validID_num" class="form-control text-center" value="{{$target->validID_num}}" readonly>
                    </div>
                    <div class="form-group col-md-4 mb-2">
                        <label>Email Address</label>
                        <input type="text" id="email" name="email" class="form-control text-center" value="{{$target->email}}" readonly>
                    </div>
                    <div class="form-group col-md-4 mb-2">
                        <label for="mobile">Mobile Number</label>
                        <div class="input-group">
                            <input type="text" maxlength="10" minlength="10" name="mobile_num" id="mobile_num" class="mobile form-control text-center" value="{{'+63 '.$target->mobile_num}}" readonly>
                        </div>
                    </div>
                </div>
        </div>
        </fieldset>
    </div>
    <div class="d-grid gap-2 d-md-block mb-3 ">
        <a class="btn btn-danger" type="button" href="admin/dashboard">Back</a>

        <button data-bs-toggle="modal" data-bs-target="#changeMobileNumber" class="btn btn-danger float-end mx-1" type="button"><i class="bi bi-phone-fill"></i> Change Mobile Number</button>
        <button data-bs-toggle="modal" data-bs-target="#changeEmail" class="btn btn-danger float-end mx-1" type="button"><i class="bi bi-envelope-fill"></i> Change Email</button>
        <button data-bs-toggle="modal" data-bs-target="#changePassword" class="btn btn-danger float-end mx-1" type="button"><i class="bi bi-key-fill"></i> Change Password</button>
    </div>
</div>
</div>

<!-- Update Mobile -->
<div class="modal fade " id="changeMobileNumber" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">
        <form method="post" enctype="multipart/form-data" action="{{url('/modifyAdminMobile')}}" class="needs-validation">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{$target->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Enter yout new mobile number</h5>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <div class="input-group-text">+63</div>
                        <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" name="number" class="form-control" maxlength="10" minlength="10" class="form-control mobile" placeholder="New Mobile Number">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #AA0F0A; color: white;">Save</button>
                    <button type="reset" class="btn btn-secondary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </form>
    </div>

</div>
<!-- MODAL FOR CHANGE PASSWORD -->
<div class="modal fade " id="changePassword" aria-hidden="true" aria-labelledby="changePasswordLabel" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Change Password</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <form method="post" enctype="multipart/form-data" action="{{url('/modifyAdminPassword')}}" class="needs-validation" novalidate>
                        @csrf

                        <input type="hidden" name="user_id" id="user_id" value="{{$target->id}}">
                        <label for="oldPassword" class="form-label">Old Password</label>
                        <input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="Enter your old password" required>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="background-color: #AA0F0A; color: white;">Save</button>
                <button type="reset" class="btn btn-secondary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FOR CHANGE EMAIL -->
<div class="modal fade " id="changeEmail" aria-hidden="true" aria-labelledby="changeEmailLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Change Email Adddress</h5>
            </div>
            <form method="post" enctype="multipart/form-data" action="{{url('/modifyAdminEmail')}}" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="user_id" id="user_id" value="{{$target->id}}">

                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
                    <div class="invalid-feedback">
                        Please enter your email.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #AA0F0A; color: white;">Save</button>
                    <button type="reset" class="btn btn-secondary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- Change Profile Pic -->
<div class="modal fade " id="changeProfilePic" aria-hidden="true" aria-labelledby="changeProfilePicLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Change Profile Pic</h5>
            </div>
            <form method="post" enctype="multipart/form-data" action="{{url('/changeProfilePic')}}" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{$target->id}}">
                <div class="modal-body text-center">
                    <div class="col-md-12 row mb-2">
                        <div class="form-group col-md-12 mb-2">
                            <div class="text-center">
                                <legend class="goupBoxHeader">Front ID</legend>
                                <div class="mb-5">
                                    <label for="Image" class="form-label"></label>
                                    <input class="form-control" type="file" id="profilePic" name="profilePic" onchange="preview()" required>
                                    <div class="invalid-feedback">
                                        Please upload your profile picture.
                                    </div>
                                    <div class="text-center">
                                        <button onclick="clearImage()" class="btn mt-3" style="background-color:#AA0F0A; color: white;">Clear</button>
                                    </div>
                                </div>
                                <img id="frame" src="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #AA0F0A; color: white;">Save</button>
                    <button type="reset" class="btn btn-secondary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>
        @endforeach
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        </body>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{asset('js/account.js')}}"></script>

        </html>