@include('admin/adminHeader')
@foreach($admin_info as $admin)
@foreach($target_info as $target)


<div class="content mb-4">

    <p class="display-6"><i class="bi bi-file-person"></i> <strong>Barangay Employee Information</strong></p>
    <hr style="color: black;">
    <div class="myContainer">
        <div class="" style="text-align: center;">
            <img src="{{url('adminID/'.$target->profilePic)}}" class="rounded-circle mb-3" style="width: 100px;" alt="Avatar" />
            <h5 class=""><strong>{{$target->first_name." ".$target->last_name}}</strong></h5>
            <p class="">{{$target->role}}
                @if($target->isEnabled == 1 )
                <span class="badge text-bg-success">Active</span>
                @elseif($target->isEnabled == 0)
                <span class="badge text-bg-danger">Inactive</span>
                @endif
            </p>
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

    </div>


    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-danger me-md-2 " type="button" href="/listbarangayemployee"><i class="bi bi-check-circle-fill"></i> Done</a>
        @if($admin->role == 'Administrator')
        <a class="btn btn-danger me-md-2 " type="button" href="{{ route('editEmployee', $target->id) }}"><i class="bi bi-pencil-square"></i> Edit</a>

        <form id="deactivateForm{{$target->id}}" method="post" enctype="multipart/form-data" action="{{ url('deact') }}">
            @csrf
            <input name="id" type="hidden" value="{{$target->id}}">
            @if($target->isEnabled == 1 )
            <button type="submit" class="btn btn-danger btn show_confirm" data-toggle="tooltip" title='Deact' data-user-id="{{$target->id}}"><i class="bi bi-trash"></i> Deactivate</button>
            @elseif($target->isEnabled == 0 )
            <button type="submit" class="btn btn-primary btn show_confirm" data-toggle="tooltip" title='Deact' data-user-id="{{$target->id}}"><i class="bi bi-trash"></i> Re activate</button>
            @endif
        </form>
        @endif
    </div>

</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

@endforeach
@endforeach
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
                                        window.location.href = "/viewEmployee/" + userId;
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
                                        window.location.href = "/viewEmployee/" + userId;
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>