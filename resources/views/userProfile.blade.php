@include('userDashboard')
@foreach($user_info as $user)
<style>
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
</style>
<div class="my-3 mx-3" id="myProfile">
  <div class="myContainer">
    <div class="card-body">
      <fieldset class="groupBox p-4 bg-light border mb-2 bg-body rounded shadow border border-dark">
        <legend class="goupBoxHeader mt-3">Personal Information</legend>
        <div class="col-md-12 row mb-2">
          <div class="form-group  col-md-4">
            <label for="firstName">First Name</label>
            <input style="text-transform: uppercase;" id="firstName" name="firstName" type="text" class="form-control" placeholder="{{$user->first_name}}" readonly>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="middleName">Middle Name </label>
              <input style="text-transform: uppercase;" id="middleName" name="middleName" type="text" class="form-control" placeholder="{{$user->middle_name}}" readonly>
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="lastName">Last Name </label>
            <input style="text-transform: uppercase;" id="lastName" name="lastName" type="text" class="form-control" placeholder="{{$user->last_name}}" readonly>
          </div>
        </div>
        <div class="col-md-12 row mb-2">
          <div class="form-group  col-md-3">
            <label>Suffix</label>
            <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" placeholder="{{$user->suffix}}" readonly>
          </div>
          <div class="col-md-3">
            <label for="">Gender</label>
            <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" placeholder="{{$user->gender}}" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Marital Status</label>
            <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" placeholder="{{$user->marital_status}}" readonly>
          </div>
          <div class="form-group col-md-3">
            <label>Nationality</label>
            <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" placeholder="{{$user->nationality}}" readonly>
          </div>
        </div>

        <div class="col-md-12 row mb-2">
          <div class="form-group col-md-6">
            <label>Birthdate</label>


            <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" placeholder="{{date('F j, Y', strtotime($user->birthdate))}}" readonly>
          </div>
          <div class="form-group col-md-6">
            <label>Place of Birth</label>
            <input style="text-transform: uppercase;" class="form-control" name="suffix" id="suffix" type="text" placeholder="{{ $user->place_birth}} " readonly>
          </div>
        </div>

        <legend class="goupBoxHeader mt-3">Address (Barangay South SIgnal Village)</legend>
        <div class="col-md-12 row mb-2">

          <div class="col-sm-6 mb-2">
            <div class="form-group">
              <label>Room/Flr/Unit No. & Bldg</label>
              <input style="text-transform: uppercase;" type="text" name="unitNo" class="form-control notCapital" placeholder="{{$user->address_unitNo}}" readonly>
            </div>
          </div>
          <div class="col-sm-6 mb-2">
            <div class="form-group">
              <label>House/Lot & Block No.</label>
              <input style="text-transform: uppercase;" type="text" name="houseNo" class="form-control notCapital" placeholder="{{$user->address_houseNo}}" readonly>
            </div>
          </div>
          <div class="col-sm-6 mb-2">
            <div class="form-group">
              <label>Street</label>
              <input style="text-transform: uppercase;" type="text" name="street" class="form-control notCapital" placeholder="{{$user->address_street}}" readonly>
            </div>
          </div>
          <div class="col-sm-6 mb-2">
            <div class="form-group">
              <label>Zone/Purok</label>
              <input style="text-transform: uppercase;" type="text" name="address" class="form-control notCapital" placeholder="{{$user->address_purok}}" readonly>
            </div>
          </div>
        </div>

        <legend class="goupBoxHeader">ID Information</legend>
        <div class="col-md-12 row mb-2 text-center">
          <div class="form-group col-md-6 mb-2">
            <label class="mb-3">Front ID</label>
            <div class="input-group text-center">
              <img width="400" height="200" src="{{url('residentID/'.$user->validID_front)}}" class="img-fluid " alt="...">
            </div>
          </div>
          <div class="form-group col-md-6 mb-2">
            <label class="mb-3">Back ID</label>
            <div class="input-group text-center">
              <img width="400" height="200" src="{{url('residentID/'.$user->validID_back)}}" class="img-fluid" alt="...">
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <button data-bs-toggle="modal" data-bs-target="#changeID" type="button" class="btn" style="width:30%; background-color: #AA0F0A; color: white;">
              Update ID</button>
          </div>
        </div>
        <legend class="goupBoxHeader">Account Information</legend>

        <div class="col-md-12 row mb-2">
          <div class="form-group col-md-6 mb-2">
            <label>Email Address</label>
            <div class="input-group">
              <input type="text" name="email" class="form-control" placeholder="{{$user->email}}" readonly>
              <a data-bs-toggle="modal" data-bs-target="#changeEmail" href="changeEmail" style="background-color: #AA0F0A; color: white; text-decoration: none;" class="input-group-text">UPDATE EMAIL</a>
            </div>
          </div>
          <div class="form-group col-md-6 mb-2">
            <label for="mobile">Mobile Number</label>
            <div class="input-group">
              <div class="input-group-text">+63</div>
              <input type="text" class="form-control mobile" id="mobileNumber" placeholder="{{$user->mobile_num}}" readonly>
              <a data-bs-toggle="modal" data-bs-target="#changeMobileNumber" href="changeMobileNumber" style="background-color: #AA0F0A; color: white; text-decoration: none;" class="input-group-text">UPDATE NUMBER</a>
            </div>
          </div>
          <div class="form-group text-center mt-3">
            <button data-bs-toggle="modal" data-bs-target="#changePassword" type="button" class="btn" style="width:30%; background-color: #AA0F0A; color: white;">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
              </svg> Change Password</button>
          </div>
        </div>
    </div>
  </div>

  @endforeach



  <div class="modal fade " id="changeMobileNumber" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <form method="post" enctype="multipart/form-data" action="{{url('/changeNumber')}}" class="needs-validation" novalidate>
      @csrf
      @foreach($user_info as $user)
      <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
      @endforeach
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Enter yout new mobile number</h5>
          </div>
          <div class="modal-body">
            <div class="input-group">
              <div class="input-group-text">+63</div>
              <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" name="number" class="form-control" maxlength="10" minlength="10" class="form-control mobile" placeholder="9xxxxxxxxx" required>
              <div class="invalid-feedback">
                Input your mobile number.
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" style="background-color: #AA0F0A; color: white;">Save</button>
            <button type="reset" class="btn btn-secondary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </div>

      </div>
  </div>
  </form>
</div>

<!-- MODAL FOR CHANGE PASSWORD -->
<div class="modal fade " id="changePassword" aria-hidden="true" aria-labelledby="changePasswordLabel" tabindex="-1">
  <form method="post" enctype="multipart/form-data" action="{{url('/changePassword')}}" class="needs-validation" novalidate>
    @csrf
    @foreach($user_info as $user)
    <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
    @endforeach<div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Change Password</h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="oldPassword" class="form-label">Old Password</label>
            <input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="Enter your old password" required>
            <div class="invalid-feedback">
              Input your old password
            </div>
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
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" style="background-color: #AA0F0A; color: white;">Save</button>
          <button type="reset" class="btn btn-secondary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </div>
      </div>
    </div>
  </form>
</div>




<!-- MODAL FOR CHANGE EMAIL -->
<div class="modal fade " id="changeEmail" aria-hidden="true" aria-labelledby="changeEmailLabel" tabindex="-1">
  <form method="post" enctype="multipart/form-data" action="{{url('/modifyEmail')}}" class="needs-validation" novalidate>
    @csrf
    @foreach($user_info as $user)
    <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
    @endforeach
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Change Email Adddress</h5>
        </div>
        <div class="modal-body">
          <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
          <div class="invalid-feedback">
            Input your new email address
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" style="background-color: #AA0F0A; color: white;">Save</button>
          <button type="reset" class="btn btn-secondary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </div>
      </div>
    </div>
  </form>
</div>

<!-- MODAL FOR UPDATING ID -->
<div class="modal fade " id="changeID" aria-hidden="true" aria-labelledby="changeIDLabel" tabindex="-1">
  <form method="post" enctype="multipart/form-data" action="{{url('/updateID')}}" class="needs-validation" novalidate>
    @csrf
    @foreach($user_info as $user)
    <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
    @endforeach
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Update Valid ID</h5>
        </div>
        <div class="modal-body">
          <div class="col-md-12 row mb-2">
            <div class="form-group col-md-6 mb-2">
              <label>Choose Valid ID.<span class="text-danger">*</span></label>
              <select class="form-control" name="type_validID" id="type_validID" required>
                <option value="">Valid ID</option>
                <option value="Philippine passport">Philippine passport</option>
                <option value="Driver’s license">Driver’s license</option>
                <option value="SSS UMID Card">SSS UMID Card</option>
                <option value="PhilHealth ID">PhilHealth ID</option>
                <option value="TIN Card">TIN Card</option>
                <option value="Postal ID">Postal ID</option>
                <option value="Voter’s ID">Voter’s ID</option>
                <option value="Professional Regulation Commission ID">Professional Regulation Commission ID</option>
                <option value="Senior Citizen ID">Senior Citizen ID</option>
                <option value="OFW ID">OFW ID</option>
                <option value="Student ID">Student ID</option>
              </select>
              <div class="invalid-feedback">
                Please select ID to upload.
              </div>
            </div>
            <div class="form-group col-md-6 mb-2">
              <label for="validID_num">ID Number<span class="text-danger">*</span></label>
              <div class="input-group">
                <input style="text-transform: uppercase;" type="text" class="form-control mobile" name="validID_num" id="validID_num" placeholder="ID Number" required>
                <div class="invalid-feedback">
                  Please input your ID number.
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 row mb-2">
            <div class="form-group col-md-6 mb-2">
              <div class="">
                <legend class="goupBoxHeader">Front ID</legend>
                <div class="mb-5">
                  <label for="Image" class="form-label"></label>
                  <input class="form-control" type="file" id="formFile" name="formFile" onchange="preview()" required>
                  <div class="invalid-feedback">
                    Please attach your ID.
                  </div>
                  <div class="text-center">
                    <button onclick="clearImage()" class="btn mt-3" style="background-color:#AA0F0A; color: white;">Clear</button>
                  </div>
                </div>

                <img id="frame" src="" class="img-fluid" />
              </div>
            </div>

            <div class="form-group col-md-6 mb-2">
              <div class="">
                <legend class="goupBoxHeader">Back ID</legend>
                <div class="mb-5">
                  <label for="Image" class="form-label"></label>
                  <input class="form-control" type="file" id="formFile_2" name="formFile_2" onchange="preview_2()" required>
                  <div class="invalid-feedback">
                    Please attach your ID.
                  </div>
                  <div class="text-center">
                    <button onclick="clearImage_2()" class="btn mt-3" style="background-color:#AA0F0A; color: white;">Clear</button>
                  </div>

                </div>
                <img id="frame_2" src="" class="img-fluid" />
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" style="background-color: #AA0F0A; color: white;">Save</button>
            <button type="reset" class="btn btn-secondary" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </div>
      </div>
  </form>
</div>

</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/userProfile.js')}}"></script>

</body>

</html>