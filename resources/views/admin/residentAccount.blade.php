@include('admin/adminHeader')
@foreach($admin_info as $admin)
@foreach($target_info as $user)


<div class="content mb-4">

    <p class="display-6"><i class="bi bi-file-person"></i> <strong>Resident Employee Information</strong></p>
    <hr style="color: black;">
    <div class="myContainer">
        <div class="my-3 mx-3" id="myProfile">
            <div class="myContainer">
                <div class="card-body">
                    <fieldset class="groupBox">
                        <legend class="goupBoxHeader mt-3">Personal Information</legend>
                        <div class="col-md-12 row mb-2">
                            <div class="form-group  col-md-4">
                                <label for="firstName">First Name</label>
                                <input style="text-transform: uppercase;" id="firstName" name="firstName" type="text" class="form-control" value="{{$user->first_name}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middleName">Middle Name </label>
                                    <input style="text-transform: uppercase;" id="middleName" name="middleName" type="text" class="form-control" value="{{$user->middle_name}}" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastName">Last Name </label>
                                <input style="text-transform: uppercase;" id="lastName" name="lastName" type="text" class="form-control" value="{{$user->last_name}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 row mb-2">
                            <div class="form-group  col-md-3">
                                <label>Suffix</label>
                                <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" value="{{$user->suffix}}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="">Gender</label>
                                <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" value="{{$user->gender}}" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Marital Status</label>
                                <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" value="{{$user->marital_status}}" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Nationality</label>
                                <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" value="{{$user->nationality}}" readonly>
                            </div>
                        </div>

                        <div class="col-md-12 row mb-2">
                            <div class="form-group col-md-6">
                                <label>Birthdate</label>


                                <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" value="{{date('F j, Y', strtotime($user->birthdate))}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Place of Birth</label>
                                <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" value="{{ $user->place_birth}} " readonly>
                            </div>
                        </div>

                        <legend class="goupBoxHeader mt-3">Address (Barangay South SIgnal Village)</legend>
                        <div class="col-md-12 row mb-2">

                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label>Room/Flr/Unit No. & Bldg</label>
                                    <input style="text-transform: uppercase;" type="text" name="unitNo" class="form-control notCapital" value="{{$user->address_unitNo}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label>House/Lot & Block No.</label>
                                    <input style="text-transform: uppercase;" type="text" name="houseNo" class="form-control notCapital" value="{{$user->address_houseNo}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label>Street</label>
                                    <input style="text-transform: uppercase;" type="text" name="street" class="form-control notCapital" value="{{$user->address_street}}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label>Subd./ Phase/ Purok</label>
                                    <input style="text-transform: uppercase;" type="text" name="address" class="form-control notCapital" value="{{$user->address_purok}}" readonly>
                                </div>
                            </div>
                        </div>

                        <legend class="goupBoxHeader">ID Information</legend>
                        <div class="col-md-12 row mb-2">
                            <div class="form-group col-md-6 mb-2">
                                <label>Front ID</label>
                                <div class="input-group">
                                    <img src="{{url('residentID/'.$user->validID_front)}}" class="img-fluid" alt="...">
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="mobile">Back ID</label>
                                <div class="input-group">
                                    <img src="{{url('residentID/'.$user->validID_back)}}" class="img-fluid" alt="...">
                                </div>
                            </div>
                        </div>
                        <legend class="goupBoxHeader">Account Information</legend>

                        <div class="col-md-12 row mb-2">
                            <div class="form-group col-md-6 mb-2">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <input type="text" name="email" class="form-control" value="{{$user->email}}" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="mobile">Mobile Number</label>
                                <div class="input-group">
                                    <div class="input-group-text">+63</div>
                                    <input type="text" class="form-control mobile" id="mobileNumber" value="{{$user->mobile_num}}" readonly>
                                </div>
                            </div>
                            <div class="form-group text-center mt-3">

                            </div>
                        </div>
                </div>
            </div>

        </div>


        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-danger" type="button" href="/listresident"> Back</a>
            @foreach($admin_info as $admin)
            @if($admin->role == 'Administrator')
            <a href="#changePassword" data-bs-toggle="modal" data-bs-target="#changePassword" class="btn btn-danger" style="text-decoration: none;"><i class="bi bi-key-fill"></i> Reset Password</a>
            <form id="deactivateForm{{$user->id}}" method="post" enctype="multipart/form-data" action="{{ url('deact') }}">
                @csrf
                <input name="id" type="hidden" value="{{$user->id}}">
                @if($user->isEnabled == 1 )
                <button type="submit" class="btn btn-danger btn show_confirm" data-toggle="tooltip" title='Deact' data-user-id="{{$user->id}}"><i class="bi bi-trash"></i> Deactivate</button>
                @elseif($user->isEnabled == 0 )
                <button type="submit" class="btn btn-primary btn show_confirm" data-toggle="tooltip" title='Deact' data-user-id="{{$user->id}}"><i class="bi bi-trash"></i> Re activate</button>
                @endif
            </form>
            @endif
            @endforeach
        </div>

    </div>

</div>
<div class="modal fade " id="changePassword" aria-hidden="true" aria-labelledby="changePasswordLabel" tabindex="-1">
    <form method="post" enctype="multipart/form-data" action="{{url('/resetPassword')}}" class="needs-validation" novalidate>
        @csrf
        @foreach($target_info as $user)
        <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
        @endforeach
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Change Password</h5>
                </div>
                <div class="modal-body">
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
                    <script>
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

                        function eye() {
                            const type = document.getElementById('newPassword').getAttribute("type") === "password" ? "text" : "password";
                            document.getElementById('newPassword').setAttribute("type", type);

                            // toggle the icon
                            if (type == 'password') {
                                document.getElementById('eye').classList.add('bi-eye-fill');
                                document.getElementById('eye').classList.remove('bi-eye-slash-fill');
                            } else {
                                document.getElementById('eye').classList.add('bi-eye-slash-fill');
                                document.getElementById('eye').classList.remove('bi-eye-fill');
                            }
                        }

                        function checkConfirmPassword() {
                            var passwords = document.getElementById('newPassword').value;
                            var passwords_conmfirm = document.getElementById('confirmPassword').value;
                            if (passwords != passwords_conmfirm) {
                                document.getElementById('mismatch').style.display = 'block';
                                document.getElementById('confirmPassword').setCustomValidity("Invalid field.");
                            } else {
                                document.getElementById('mismatch').style.display = 'none';
                                document.getElementById('confirmPassword').setCustomValidity("");
                            }
                        }

                        function checkPassword() {
                            var passwords = document.getElementById('newPassword').value;
                            var passwords_conmfirm = document.getElementById('confirmPassword').value;
                            var stregth = 0;

                            if (passwords != passwords_conmfirm) {
                                document.getElementById('mismatch').style.display = 'block';
                                document.getElementById('confirmPassword').setCustomValidity("Invalid field.");
                            } else {
                                document.getElementById('mismatch').style.display = 'none';
                                document.getElementById('confirmPassword').setCustomValidity("");
                            }

                            if (passwords.length >= 8) {
                                document.getElementById('count_check').classList.add('bi-check-circle');
                                document.getElementById('count_check').classList.remove('bi-x-circle');
                                document.getElementById('count').style.color = 'green';
                                stregth += 1;
                            } else {
                                document.getElementById('count_check').classList.remove('bi-check-circle');
                                document.getElementById('count_check').classList.add('bi-x-circle');
                                document.getElementById('count').style.color = ' rgba(192, 1, 1, 0.932)';
                            }

                            if (passwords.match(/([a-z])/) && passwords.match(/([A-Z])/)) {
                                document.getElementById('lower-upper_check').classList.add('bi-check-circle');
                                document.getElementById('lower-upper_check').classList.remove('bi-x-circle');
                                document.getElementById('lower-upper').style.color = 'green';
                                stregth += 1;
                            } else {
                                document.getElementById('lower-upper_check').classList.remove('bi-check-circle');
                                document.getElementById('lower-upper_check').classList.add('bi-x-circle');
                                document.getElementById('lower-upper').style.color = ' rgba(192, 1, 1, 0.932)';
                            }

                            if (passwords.match(/([0-9])/)) {
                                document.getElementById('numbers_check').classList.add('bi-check-circle');
                                document.getElementById('numbers_check').classList.remove('bi-x-circle');
                                document.getElementById('numbers').style.color = 'green';
                                stregth += 1;
                                console.log('NUMBER')
                            } else {
                                document.getElementById('numbers_check').classList.remove('bi-check-circle');
                                document.getElementById('numbers_check').classList.add('bi-x-circle');
                                document.getElementById('numbers').style.color = 'rgba(192, 1, 1, 0.932)';
                            }

                            if (passwords.match(/([!,@,#,$,%,^,&,*,-,_])/)) {
                                document.getElementById('specialChar_check').classList.add('bi-check-circle');
                                document.getElementById('specialChar_check').classList.remove('bi-x-circle');
                                document.getElementById('specialChar').style.color = 'green';
                                stregth += 1;
                                console.log('SPECIAL')
                            } else {
                                document.getElementById('specialChar_check').classList.remove('bi-check-circle');
                                document.getElementById('specialChar_check').classList.add('bi-x-circle');
                                document.getElementById('specialChar').style.color = 'rgba(192, 1, 1, 0.932)';
                            }

                            if (stregth == 4) {
                                console.log(stregth);
                                document.getElementById('progress').classList.add('bg-success');
                                document.getElementById('progress').classList.remove('bg-danger');
                                document.getElementById('newPassword').setCustomValidity("");
                            }
                            if (stregth != 4) {
                                console.log(stregth);
                                document.getElementById('progress').classList.add('bg-danger');
                                document.getElementById('progress').classList.remove('bg-success');
                                document.getElementById('newPassword').setCustomValidity("Invalid field.");
                            }

                        }
                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #AA0F0A; color: white;">Save</button>
                    <button type="reset" class="btn btn-secondary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.show_confirm').click(function(e) {
            e.preventDefault();

            const userId = $(this).data('user-id');

            Swal.fire({
                title: 'Deactivate Account',
                text: 'Please enter your password to deactivate your account:',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Deactivate',
                confirmButtonColor: "#AA0F0A",
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    return fetch('/deact', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({
                                id: userId,
                                password: password
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: 'Account Deactivated',
                                    text: 'Your account has been deactivated.',
                                    icon: 'success',
                                    showCloseButton: false,
                                    showCancelButton: false,
                                    confirmButtonColor: "#AA0F0A",
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.href = "{{url('viewResident')}}/" + userId;
                                    }
                                });

                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message || 'Account deactivation failed. Please check your password.',
                                    icon: 'error',
                                    showCloseButton: false,
                                    showCancelButton: false,
                                    confirmButtonColor: "#AA0F0A",
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.href = "{{url('viewResident')}}/" + userId;
                                    }
                                });

                            }

                        })
                        .catch(error => {
                            console.error('There was an error:', error);
                        });
                }
            });
        });
    });
</script>
@endforeach
@endforeach

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>