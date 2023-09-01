@include('admin/adminHeader')
@foreach($admin_info as $admin)
@if($admin->role == 'Administrator')
<form method="post" enctype="multipart/form-data" action="{{url('registerAdmin')}}" class="needs-validation" novalidate>
    @csrf
    <div class="content my-3 ">
        <p class="display-6"><i class="bi bi-person-fill-add"></i> <strong>Add Barangay Employee</strong></p>
        <div class="myContainer">
            <div class="card-body my-3">
                <fieldset class="groupBox">
                    <legend class="goupBoxHeader">Employee's Personal Information</legend>
                    <div class="col-md-12 row mb-2">
                        <div class="form-group  col-md-4">
                            <label for="first_name">First Name <span class="text-danger">*</span> </label>
                            <input id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middle_name">Middle Name <span class="text-danger">*</span> </label>
                                <input id="middle_name" name="middle_name" type="text" class="form-control" placeholder="Middle Name" required>
                                <div class="form-check">
                                    <input onchange="hideMiddleName(this);" class="form-check-input" type="checkbox" id="checkMiddleName">
                                    <label class="form-check-label" for="checkMiddleName">
                                        No Middle Name?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_name">Last Name <span class="text-danger">*</span> </label>
                            <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name" required>
                        </div>

                    </div>

                    <div class="col-md-12 row mb-2">
                        <div class="form-group  col-md-3">
                            <label>Suffix</label>
                            <select class="form-control" name="suffix" id="suffix" required>
                                <option value="">Suffix</option>
                                <option value="">None</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Jr. II">Jr. II</option>
                                <option value="Sr.">Sr.</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                                <option value="VI">VI</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Gender <span class="text-danger">*</span></label>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Marital Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="marital_status" id="marital_status" required>
                                <option value="">Marital Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Separated">Separated</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nationality <span class="text-danger">*</span></label>
                            <select class="form-control" id="nationality" name="nationality">
                                <option value="FILIPINO">FILIPINO</option>
                                <option value="AFGHAN">AFGHAN</option>
                                <option value="ALBANIAN">ALBANIAN</option>
                                <option value="ALGERIAN">ALGERIAN</option>
                                <option value="AMERICAN">AMERICAN</option>
                                <option value="ANDORRAN">ANDORRAN</option>
                                <option value="ANGOLAN">ANGOLAN</option>
                                <option value="ANTIGUANS">ANTIGUANS</option>
                                <option value="ARGENTINEAN">ARGENTINEAN</option>
                                <option value="ARMENIAN">ARMENIAN</option>
                                <option value="AUSTRALIAN">AUSTRALIAN</option>
                                <option value="AUSTRIAN">AUSTRIAN</option>
                                <option value="AZERBAIJANI">AZERBAIJANI</option>
                                <option value="BAHAMIAN">BAHAMIAN</option>
                                <option value="BAHRAINI">BAHRAINI</option>
                                <option value="BANGLADESHI">BANGLADESHI</option>
                                <option value="BARBADIAN">BARBADIAN</option>
                                <option value="BARBUDANS">BARBUDANS</option>
                                <option value="BATSWANA">BATSWANA</option>
                                <option value="BELARUSIAN">BELARUSIAN</option>
                                <option value="BELGIAN">BELGIAN</option>
                                <option value="BELIZEAN">BELIZEAN</option>
                                <option value="BENINESE">BENINESE</option>
                                <option value="BHUTANESE">BHUTANESE</option>
                                <option value="BOLIVIAN">BOLIVIAN</option>
                                <option value="BOSNIAN">BOSNIAN</option>
                                <option value="BRAZILIAN">BRAZILIAN</option>
                                <option value="BRITISH">BRITISH</option>
                                <option value="BRUNEIAN">BRUNEIAN</option>
                                <option value="BULGARIAN">BULGARIAN</option>
                                <option value="BURKINABE">BURKINABE</option>
                                <option value="BURMESE">BURMESE</option>
                                <option value="BURUNDIAN">BURUNDIAN</option>
                                <option value="CAMBODIAN">CAMBODIAN</option>
                                <option value="CAMEROONIAN">CAMEROONIAN</option>
                                <option value="CANADIAN">CANADIAN</option>
                                <option value="CAPE VERDEAN">CAPE VERDEAN</option>
                                <option value="CENTRAL AFRICAN">CENTRAL AFRICAN</option>
                                <option value="CHADIAN">CHADIAN</option>
                                <option value="CHILEAN">CHILEAN</option>
                                <option value="CHINESE">CHINESE</option>
                                <option value="COLOMBIAN">COLOMBIAN</option>
                                <option value="COMORAN">COMORAN</option>
                                <option value="CONGOLESE">CONGOLESE</option>
                                <option value="COSTA RICAN">COSTA RICAN</option>
                                <option value="CROATIAN">CROATIAN</option>
                                <option value="CUBAN">CUBAN</option>
                                <option value="CYPRIOT">CYPRIOT</option>
                                <option value="CZECH">CZECH</option>
                                <option value="DANISH">DANISH</option>
                                <option value="DJIBOUTI">DJIBOUTI</option>
                                <option value="DOMINICAN">DOMINICAN</option>
                                <option value="DUTCH">DUTCH</option>
                                <option value="EAST TIMORESE">EAST TIMORESE</option>
                                <option value="ECUADOREAN">ECUADOREAN</option>
                                <option value="EGYPTIAN">EGYPTIAN</option>
                                <option value="EMIRIAN">EMIRIAN</option>
                                <option value="EQUATORIAL GUINEAN">EQUATORIAL GUINEAN
                                </option>
                                <option value="ERITREAN">ERITREAN</option>
                                <option value="ESTONIAN">ESTONIAN</option>
                                <option value="ETHIOPIAN">ETHIOPIAN</option>
                                <option value="FIJIAN">FIJIAN</option>
                                <option value="FINNISH">FINNISH</option>
                                <option value="FRENCH">FRENCH</option>
                                <option value="GABONESE">GABONESE</option>
                                <option value="GAMBIAN">GAMBIAN</option>
                                <option value="GEORGIAN">GEORGIAN</option>
                                <option value="GERMAN">GERMAN</option>
                                <option value="GHANAIAN">GHANAIAN</option>
                                <option value="GREEK">GREEK</option>
                                <option value="GRENADIAN">GRENADIAN</option>
                                <option value="GUATEMALAN">GUATEMALAN</option>
                                <option value="GUINEA-BISSAUAN">GUINEA-BISSAUAN</option>
                                <option value="GUINEAN">GUINEAN</option>
                                <option value="GUYANESE">GUYANESE</option>
                                <option value="HAITIAN">HAITIAN</option>
                                <option value="HERZEGOVINIAN">HERZEGOVINIAN</option>
                                <option value="HONDURAN">HONDURAN</option>
                                <option value="HUNGARIAN">HUNGARIAN</option>
                                <option value="ICELANDER">ICELANDER</option>
                                <option value="INDIAN">INDIAN</option>
                                <option value="INDONESIAN">INDONESIAN</option>
                                <option value="IRANIAN">IRANIAN</option>
                                <option value="IRAQI">IRAQI</option>
                                <option value="IRISH">IRISH</option>
                                <option value="ISRAESLI">ISRAELI</option>
                                <option value="ITALIAN">ITALIAN</option>
                                <option value="IVORIAN">IVORIAN</option>
                                <option value="JAMAICAN">JAMAICAN</option>
                                <option value="JAPANESE">JAPANESE</option>
                                <option value="JORDANIAN">JORDANIAN</option>
                                <option value="KAZAKHSTANI">KAZAKHSTANI</option>
                                <option value="KENYAN">KENYAN</option>
                                <option value="KITTIAN AND NEVISIAN">KITTIAN AND NEVISIAN
                                </option>
                                <option value="KUWAITI">KUWAITI</option>
                                <option value="KYRGYZ">KYRGYZ</option>
                                <option value="LAOTIAN">LAOTIAN</option>
                                <option value="LATVIAN">LATVIAN</option>
                                <option value="LEBANESE">LEBANESE</option>
                                <option value="LIBERIAN">LIBERIAN</option>
                                <option value="LIBYAN">LIBYAN</option>
                                <option value="LIECHTENSTEINER">LIECHTENSTEINER</option>
                                <option value="LITHUANIAN">LITHUANIAN</option>
                                <option value="LUXEMBOURGER">LUXEMBOURGER</option>
                                <option value="MACEDONIAN">MACEDONIAN</option>
                                <option value="MALAGASY">MALAGASY</option>
                                <option value="MALAWIAN">MALAWIAN</option>
                                <option value="MALAYSIAN">MALAYSIAN</option>
                                <option value="MALDIVAN">MALDIVAN</option>
                                <option value="MALIAN">MALIAN</option>
                                <option value="MALTESE">MALTESE</option>
                                <option value="MARSHALLESE">MARSHALLESE</option>
                                <option value="MAURITANIAN">MAURITANIAN</option>
                                <option value="MAURITIAN">MAURITIAN</option>
                                <option value="MEXICAN">MEXICAN</option>
                                <option value="MICRONESIAN">MICRONESIAN</option>
                                <option value="MOLDOVAN">MOLDOVAN</option>
                                <option value="MONACAN">MONACAN</option>
                                <option value="MONGOLIAN">MONGOLIAN</option>
                                <option value="MOROCCAN">MOROCCAN</option>
                                <option value="MOSOTHO">MOSOTHO</option>
                                <option value="MOTSWANA">MOTSWANA</option>
                                <option value="MOZAMBICAN">MOZAMBICAN</option>
                                <option value="NAMIBIAN">NAMIBIAN</option>
                                <option value="NAURUAN">NAURUAN</option>
                                <option value="NEPALESE">NEPALESE</option>
                                <option value="NEW ZEALANDER">NEW ZEALANDER</option>
                                <option value="NI-VANUATU">NI-VANUATU</option>
                                <option value="NICARAGUAN">NICARAGUAN</option>
                                <option value="NIGERIEN">NIGERIEN</option>
                                <option value="NORTH KOREAN">NORTH KOREAN</option>
                                <option value="NORTHERN IRISH">NORTHERN IRISH</option>
                                <option value="NORWEGIAN">NORWEGIAN</option>
                                <option value="OMANI">OMANI</option>
                                <option value="PAKISTANI">PAKISTANI</option>
                                <option value="PALAUAN">PALAUAN</option>
                                <option value="PANAMANIAN">PANAMANIAN</option>
                                <option value="PAPUA NEW GUINEAN">PAPUA NEW GUINEAN</option>
                                <option value="PARAGUAYAN">PARAGUAYAN</option>
                                <option value="PERUVIAN">PERUVIAN</option>
                                <option value="POLISH">POLISH</option>
                                <option value="PORTUGUESE">PORTUGUESE</option>
                                <option value="QATARI">QATARI</option>
                                <option value="ROMANIAN">ROMANIAN</option>
                                <option value="RUSSIAN">RUSSIAN</option>
                                <option value="RWANDAN">RWANDAN</option>
                                <option value="SAINT LUCIAN">SAINT LUCIAN</option>
                                <option value="SALVADORAN">SALVADORAN</option>
                                <option value="SAMOAN">SAMOAN</option>
                                <option value="SAN MARINESE">SAN MARINESE</option>
                                <option value="SAO TOMEAN">SAO TOMEAN</option>
                                <option value="SAUDI">SAUDI</option>
                                <option value="SCOTTISH">SCOTTISH</option>
                                <option value="SENEGALESE">SENEGALESE</option>
                                <option value="SERBIAN">SERBIAN</option>
                                <option value="SEYCHELLOIS">SEYCHELLOIS</option>
                                <option value="SIERRA LEONEAN">SIERRA LEONEAN</option>
                                <option value="SINGAPOREAN">SINGAPOREAN</option>
                                <option value="SLOVAKIAN">SLOVAKIAN</option>
                                <option value="SLOVENIAN">SLOVENIAN</option>
                                <option value="SOLOMON ISLANDER">SOLOMON ISLANDER</option>
                                <option value="SOMALI">SOMALI</option>
                                <option value="SOUTH AFRICAN">SOUTH AFRICAN</option>
                                <option value="SOUTH KOREAN">SOUTH KOREAN</option>
                                <option value="SPANISH">SPANISH</option>
                                <option value="SRI LANKAN">SRI LANKAN</option>
                                <option value="SUDANESE">SUDANESE</option>
                                <option value="SURINAMER">SURINAMER</option>
                                <option value="SWAZI">SWAZI</option>
                                <option value="SWEDISH">SWEDISH</option>
                                <option value="SWISS">SWISS</option>
                                <option value="SYRIAN">SYRIAN</option>
                                <option value="TAIWANESE">TAIWANESE</option>
                                <option value="TAJIK">TAJIK</option>
                                <option value="TANZANIAN">TANZANIAN</option>
                                <option value="THAI">THAI</option>
                                <option value="TOGOLESE">TOGOLESE</option>
                                <option value="TONGAN">TONGAN</option>
                                <option value="TRINIDADIAN OR TOBAGONIAN">TRINIDADIAN OR
                                    TOBAGONIAN</option>
                                <option value="TUNISIAN">TUNISIAN</option>
                                <option value="TURKISH">TURKISH</option>
                                <option value="TUVALUAN">TUVALUAN</option>
                                <option value="UGANDAN">UGANDAN</option>
                                <option value="UKRAINIAN">UKRAINIAN</option>
                                <option value="URUGUAYAN">URUGUAYAN</option>
                                <option value="UZBEKISTANI">Uzbekistani</option>
                                <option value="VENEZUELAN">VENEZUELAN</option>
                                <option value="VIETNAMESE">VIETNAMESE</option>
                                <option value="WELSH">WELSH</option>
                                <option value="YEMENITE">YEMENITE</option>
                                <option value="ZAMBIAN">ZAMBIAN</option>
                                <option value="ZIMBABWEAN">ZIMBABWEAN</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 row mb-2">
                        <div class="form-group col-md-6">
                            <label>Birthdate <span class="text-danger">*</span></label>
                            <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Place of Birth <span class="text-danger">*</span></label>
                            <input type="text" id="place_birth" NAME="place_birth" class="form-control form-control" placeholder="(City/Municipality), (Province)" required />
                        </div>
                    </div>

                    <legend class="goupBoxHeader mt-3">Address (Barangay South Signal Village)</legend>
                    <div class="col-md-12 row mb-2">

                        <div class="col-sm-6 mb-2">
                            <div class="form-group">
                                <label>Room/Flr/Unit No. & Bldg</label>
                                <input type="text" name="address_unitNo" id="address_unitNo" class="form-control notCapital" placeholder="Room/Flr/Unit No. & Bldg">
                            </div>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <div class="form-group">
                                <label>House/Lot & Block No.</label>
                                <input type="text" name="address_houseNo" id="address_houseNo" class="form-control notCapital" placeholder="House/Lot & Block No." required>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <div class="form-group">
                                <label>Street <span class="text-danger">*</span> </label>
                                <input type="text" id="address_street" name="address_street" class="form-control notCapital" placeholder="Street" required>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <div class="form-group">
                                <label>Zone/Purok</label>
                                <input type="text" id="address_purok" name="address_purok" class="form-control notCapital" placeholder="Subd./ Phase/ Purok">
                            </div>
                        </div>
                    </div>


                </fieldset>
            </div>

            <div class="card-body my-3">
                <fieldset class="groupBox">
                    <legend class="goupBoxHeader">Account Information</legend>

                    <div class="col-md-12 row mb-2">

                        <div class="form-group col-md-4 mb-2">
                            <label>Employee ID<span class="text-danger">*</span></label>
                            <input type="text" id="validID_num" name="validID_num" class="form-control" placeholder="Employee ID" required>
                        </div>
                        <div class="form-group col-md-4 mb-2">
                            <label>Email Address<span class="text-danger">*</span></label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="form-group col-md-4 mb-2">
                            <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="text" maxlength="10" minlength="10" class="form-control mobile" name="mobile_num" id="mobile_num" placeholder="Mobile Number" required>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 row mb-2">
                        <div class="form-group col-md-6">
                            <label>Password<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input onkeyup="checkPassword();" type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                <button onclick="eye();" type="button" class="input-group-text " id='togglePassword'><i id='eye' class="bi bi-eye-fill"></i></button>
                            </div>
                            <div class="invalid-feedback">
                                Please input password.
                            </div>
                            <div class="progress mt-1" style="height: 5px;">
                                <div id="progress" class="progress-bar bg-danger" role="progressbar" aria-label="Example 1px high" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="invalid-feedback">
                                Please input valid password.
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
                        <div class="form-group col-md-6">
                            <label>Confirm Password<span class="text-danger">*</span></label>
                            <input onchange="checkConfirmPassword();" type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                            <div class="invalid-feedback">
                                Please Confirm Password.
                            </div>
                            <div id="mismatch" class="invalid-feedback" style="display:none">
                                Your confirm password is not match with your inputted password.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 row mb-2">
                        <div class="form-group col-md-6">
                            <label>Select Role<span class="text-danger">*</span></label>
                            <select name="role" class="form-select" aria-label="Default select example" required>
                                <option selected value="">Select</option>
                                <option value="Barangay Captain">Barangay Captain</option>
                                <option value="Barangay Secretary">Barangay Secretary</option>
                                <option value="Request Manager">Barangay Request Manager</option>
                                <option value="Concern Manager">Barangay Concern Manager</option>
                                <option value="Administrator">Administrator</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="">
                                <label>Upload Photo</label>

                                <label for="Image" class="form-label"></label>
                                <input class="form-control" type="file" id="profilePic" name="profilePic" onchange="preview_2()" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <img id="frame_2" src="" class="img-fluid " style="width: 150px;" />
                        <div class="text-center">
                            <button type="button" onclick="clearImage_2()" class="btn mt-2" style="background-color:#AA0F0A; color: white;">Clear</button>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="card-footer" style="text-align:center ;">

                <button type="submit" class="btn" style="background-color: #AA0F0A; color: white;" data-bs-toggle="modal" data-bs-target="#exampleModal">Create Account</button>
            </div>
        </div>
    </div>
</form>
@endif
@endforeach
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
   
</script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('js/addEmployee.js')}}"></script>
</html>