@include('admin/adminHeader')



<div class="content my-3">

    <p class="display-6"><i class="bi bi-gear-wide-connected"></i> <strong>Manage Web Application</strong></p>
    <hr style="color: black;">


    <div class="row mb-3">
        <div class="col-4">
            <div class="card shadow p-3 mb-5 bg-body-tertiary rounded" style="">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-images"></i> Edit homepage banner</h5>
                    <hr>
                    <p class="card-text">Upload three images for the announcements in the banner at the homepage</p>
                    <a data-bs-toggle="modal" data-bs-target="#updateBanner" href="#updateBanner" class="btn btn-danger"><i class="bi bi-pencil-square"></i> Edit banner</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow p-3 mb-5 bg-body-tertiary rounded" style="">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-pass"></i> Edit demography</h5>
                    <hr>
                    <p class="card-text">Update the demography information in the <strong>About Us</strong> page</p>
                    <a data-bs-toggle="modal" data-bs-target="#updateDemography" href="#updateDemography" class="btn btn-danger"><i class="bi bi-pencil-square"></i> Edit demogrphy</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow p-3 mb-5 bg-body-tertiary rounded" style="">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-telephone"></i> Edit contacts</h5>
                    <hr>
                    <p class="card-text">Update the contact information in the <strong>Contact page</strong>. </p>
                    <a data-bs-toggle="modal" data-bs-target="#updateContact" href="#updateContact" class="btn btn-danger"><i class="bi bi-pencil-square"></i> Edit contact information</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-people"></i> Update the Barangay Officials</h5>
                    <hr>
                    <p class="card-text">
                        Update the barangay officials in the About Us page (name & picture): Barangay Captain, Barangay Kagawads, Barangay SK, and the Barangay Secretary.
                    </p>
                    <a data-bs-toggle="modal" data-bs-target="#updateBarOfficial" href="#updateBarOfficial" class="btn btn-danger"><i class="bi bi-pencil-square"></i> Update Barangay Officials</a>
                </div>
            </div>
        </div>

    </div>


</div>


<!-- Modal for updating barangay officials-->
<form method="post" enctype="multipart/form-data" action="{{url('updateOfficial')}}" class="needs-validation" novalidate>
    @csrf
    <div class="modal fade" id="updateBarOfficial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateBarOfficialLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-people"></i> Update the Barangay Officials</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @foreach($web_info as $officials)
                    @if($officials->id == 1 )
                    <div class="row">
                        <div class="col-12">
                            <div class="h5">
                                Baragay Captain
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="exampleInputEmail1" class="form-label">Full name:</label>
                            <input value="{{$officials->content}}" type="text" name="off_{{$officials->id}}_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="col-6">
                            <label for="formFile" class="form-label">Upload image</label>
                            <input class="form-control" name="off_{{$officials->id}}_pic" type="file" accept=".png,.jpg,.jpeg" id="formFile">
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <hr>
                    <div class="col-12">
                        <div class="h5">
                            Baragay Kagawad
                        </div>
                    </div>
                    @foreach($web_info as $officials)
                    @if($officials->id < 11 && $officials->id != 1 && $officials->id != 10 && $officials->id != 9)
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="exampleInputEmail1" class="form-label">Committee:</label>
                                <input value="{{$officials->type}}" type="text" name="{{$officials->id}}_type" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                            </div>
                            <div class="col-4">
                                <label for="exampleInputEmail1" class="form-label">Full name:</label>
                                <input value="{{$officials->content}}" type="text" name="off_{{$officials->id}}_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="col-4">
                                <label for="formFile" class="form-label">Upload image</label>
                                <input class="form-control" name="off_{{$officials->id}}_pic" type="file" accept=".png,.jpg,.jpeg" id="formFile">
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <hr>
                        <div class="col-12">
                            <div class="h5">
                                Baragay SK
                            </div>
                        </div>
                        @foreach($web_info as $officials)
                        @if($officials->id == 9)
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="exampleInputEmail1" class="form-label">Committee:</label>
                                <input value="{{$officials->type}}" type="text" name="{{$officials->id}}_type" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                            </div>
                            <div class="col-4">
                                <label for="exampleInputEmail1" class="form-label">Full name:</label>
                                <input value="{{$officials->content}}" type="text" name="off_{{$officials->id}}_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="col-4">
                                <label for="formFile" class="form-label">Upload image</label>
                                <input class="form-control" name="off_{{$officials->id}}_pic" type="file" accept=".png,.jpg,.jpeg" id="formFile">
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <hr>
                        <div class="col-12">
                            <div class="h5">
                                Baragay Secretary
                            </div>
                        </div>
                        @foreach($web_info as $officials)
                        @if($officials->id == 10)
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="exampleInputEmail1" class="form-label">Full name:</label>
                                <input value="{{$officials->content}}" type="text" name="off_{{$officials->id}}_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="col-6">
                                <label for="formFile" class="form-label">Upload image</label>
                                <input class="form-control" name="off_{{$officials->id}}_pic" type="file" accept=".png,.jpg,.jpeg" id="formFile">
                            </div>
                        </div>
                        @endif
                        @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Save changes</button>
                </div>


            </div>
        </div>

    </div>
</form>

<!-- Modal for updating demography-->
<form method="post" enctype="multipart/form-data" action="{{url('updateDemography')}}" class="needs-validation" novalidate>
    @csrf
    <div class="modal fade" id="updateDemography" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDemographyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pass"></i> Update Demography</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach($web_info as $demo)
                    @if($demo->id >= 11 && $demo->id <=17) <div class="row mb-2 mx-1">
                        <label for="exampleFormControlInput1" class="form-label"><strong>{{$demo->type}}</strong></label>
                        <input name="dem_{{$demo->id}}" type="number" class="form-control mb-2" id="exampleFormControlInput1" value="{{$demo->content}}">
                </div>
                @endif
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Save changes</button>
            </div>


        </div>
    </div>

    </div>
</form>

<!-- Modal for updating demography-->
<form method="post" enctype="multipart/form-data" action="{{url('updateContact')}}" class="needs-validation" novalidate>
    @csrf
    <div class="modal fade" id="updateContact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDemographyLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pass"></i> Update Demography</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach($web_info as $demo)
                    @if($demo->id >= 18 && $demo->id <=25) <div class="row mb-2 mx-1">
                        <label for="exampleFormControlInput1" class="form-label"><strong>{{$demo->type}}</strong></label>
                        <input name="con_{{$demo->id}}" type="number" class="form-control mb-2" id="exampleFormControlInput1" value="{{$demo->content}}">
                </div>
                @endif
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Save changes</button>
            </div>
        </div>
    </div>

    </div>
</form>

<form method="post" enctype="multipart/form-data" action="{{url('updateBanner')}}" class="needs-validation" novalidate>
@csrf
    <div class="modal fade" id="updateBanner" tabindex="-1" aria-labelledby="updateDemographyLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-pass"></i> Update Banner</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Attention!</h4>
                        <p>The ideal dimension for the banner image is 1899 x 546 pixels (width x height).</p>
                        <hr>
                        <p class="mb-0">Please ensure that your image meets these dimensions for optimal display.</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @foreach($web_info as $ban)
                    @if($ban->id >= 28 && $ban->id <= 31 ) <div class="card my-3">
                        <div class="card-header">
                            BANNER {{($ban->id) - 27}}
                        </div>
                        <div class="card-body text-center ">
                            <img src="{{asset($ban->content)}}" class="d-block w-100 my-3" alt="..." data-bs-toggle="modal" data-bs-target="#myModal">
                            <a data-bs-toggle="collapse" href="#collapseExample{{$ban->id}}" class="btn btn-danger">Update Banner # {{($ban->id) - 27}}</a>
                            <div class="collapse my-3" id="collapseExample{{$ban->id}}">
                                <div class="card card-body">
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="imageInput{{$ban->id}}" id="banner[]" accept="image/*">
                                        <button class="btn btn-outline-secondary clear-image" type="button" data-bannerid="{{$ban->id}}">Clear</button>
                                    </div>

                                    <div id="imagePreview{{$ban->id}}"></div>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
                @endforeach

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Done</button>
            </div>
        </div>
    </div>
</form>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $("input[id='banner[]']").change(function(e) {
            var bannerId = $(this).attr('name').replace('imageInput', '');
            var img = URL.createObjectURL(e.target.files[0]);
            $("#imagePreview" + bannerId).html("<img src='" + img + "' class='img-fluid'>");
        });

        $(".clear-image").click(function() {
            var bannerId = $(this).data('bannerid');
            $("#imageInput" + bannerId).val("");
            $("#imagePreview" + bannerId).html("");
        });
    });
</script>
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