@include('admin/adminHeader')
@foreach($admin_info as $user)
@foreach($request as $request)


<div class="content mb-4">

    <p class="display-6"><i class="bi bi-file-person"></i> <strong>{{$request->reference_key}}</strong></p>
    <div class="text-center">
        @if($request->request_status == 'PENDING')
        <div class="badge bg-warning text-wrap" style="width: 6rem;">
            PENDING
        </div>
        @endif
        @if($request->request_status == 'DENIED')
        <div class="badge bg-danger text-wrap" style="width: 6rem;">
            DENIED
        </div>
        @endif
        @if($request->request_status == 'READY FOR PAYMENT')
        <div class="badge bg-SUCCESS text-wrap" style="width: 6rem; background-color:#198754">
            READY FOR PAYMENT
        </div>
        @endif
        @if($request->request_status == 'DONE')
        <div class="badge bg-PRIMARY text-wrap" style="width: 6rem;background-color:#0d6efd">
            DONE
        </div>
        @endif
        @if($request->request_status == 'PROCESSING')
        <div class="badge bg-info text-wrap" style="width: 6rem;background-color:#0d6efd">PROCESSING</div>
        @endif
    </div>

    <div class="myContainer">
        <div class="container overflow-hidden mt-3">
            <div class="shadow p-3 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">PERSONAL INFORMATION</p>
                <hr>
                <div class="row my-3 text-center">
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">First Name: </p><strong>{{$request->first_name}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Middle Name: </p><strong>{{$request->middle_name}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Last Name: </p><strong>{{$request->last_name}}</strong>
                    </div>
                    @if($user->suffix == '')
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Suffix: </p><strong>NONE</strong>
                    </div>
                    @else
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Suffix: </p><strong>{{$request->suffix}}</strong>
                    </div>
                    @endif
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Gender: </p><strong>{{strtoupper($request->gender)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Date of Birth: </p><strong>{{date('F j, Y', strtotime($request->birthdate))}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Place of Birth: </p><strong>{{strtoupper($request->place_birth)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Civil Status: </p><strong>{{strtoupper($request->marital_status)}}</strong>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Room/Flr/Unit No. & Bldg: </p><strong>{{strtoupper($request->address_unitNo)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">House/Lot & Block No.: </p><strong>{{strtoupper($request->address_houseNo)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Street: </p><strong>{{strtoupper($request->address_street)}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Subd./ Phase/ Purok: </p><strong>{{strtoupper($request->address_purok)}}</strong>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Email: </p><strong>{{$request->email}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Mobile Number: </p><strong>+63 {{strtoupper($request->mobile_num)}}</strong>
                    </div>

                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Valid ID (attached online): </p><strong>{{$request->valiID_type}}</strong>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="fs-6  mb-0">Valid ID Number: </p><strong>{{strtoupper($request->validID_num)}}</strong>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-6 mb-2">
                        <p class="fs-6  mb-2">Font Id: </p><img width="400" height="200" src="{{url('residentID/'.$request->validID_front)}}" class="img-fluid" alt="...">
                    </div>
                    <div class="col-md-6 mb-2">
                        <p class="fs-6  mb-2">Back Id: </p> <img width="400" height="200" src="{{url('residentID/'.$request->validID_back)}}" class="img-fluid" alt="...">
                    </div>
                </div>
            </div>
            @if($request->request_type_id != 5)
            <div class="shadow p-3 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">OTHER INFORMATION</p>
                <hr>
                <div class="row my-3 ">
                    <div class="col-md-6 mb-2 text-center">
                        <p class="fs-6  mb-2 ">Living with Relatives: <span class="text-danger">*</span></p>
                        <strong>{{strtoupper($request->live_relatives)}}</strong>
                    </div>
                    <div class="col-md-6 mb-2 text-center">
                        <p class="fs-6  mb-2 ">Type of Residency: <span class="text-danger">*</span></p>
                        <strong>{{strtoupper($request->residency_type)}}</strong>
                    </div>
                </div>
            </div>
            @else
            <div class="shadow p-3 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">OTHER INFORMATION</p>
                <hr>
                <div class="row my-3 ">
                    <div class="col-md-6 mb-2 text-center">
                        <p class="fs-6  mb-2 ">Business Name: <span class="text-danger">*</span></p>
                        <strong>{{strtoupper($request->business_name)}}</strong>
                    </div>
                    <div class="col-md-6 mb-2 text-center">
                        <p class="fs-6  mb-2 ">Business Address: <span class="text-danger">*</span></p>
                        <strong>{{strtoupper($request->business_address)}}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="shadow p-4 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">REQUEST INFORMATION</p>
                <hr>
                <div class="row my-3 text-center">
                    <div class="col-md-6 mb-2">
                        <label class="text-start mb-2" for="">Type of Application<span class="text-danger">*</span> </label>
                        <p><strong>{{strtoupper($request->request_description)}}</strong></p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="text-start mb-2" for="">Purpose<span class="text-danger">*</span> </label>
                        <p><strong>{{$request->request_purpose}}</strong></p>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-6 mb-2">
                        <label class="text-start mb-2" for="">Assigned to:<span class="text-danger">*</span> </label>
                        <p><strong>{{strtoupper($request->employee_name)}}</strong></p>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="text-start mb-2" for="">Date Requested:<span class="text-danger">*</span> </label>
                        <p><strong>{{$request->request_date}}</strong></p>
                    </div>
                </div>
                <div class="row my-3 text-center">
                    <div class="col-md-12 mb-2">
                        <label class="text-start mb-2" for="">Note:<span class="text-danger">*</span> </label>
                        <p><strong>{{strtoupper($request->request_message)}}</strong></p>
                    </div>

                </div>
                @if($request->request_description != 'New')
                <div class="text-center" id="upload_id">
                    <label class="text-start mb-2" for="">File attached:<span class="text-danger">*</span> </label>
                    <div class="mb-2 me-2">
                        <img width="400" height="200" id="frame" src="{{url('images/'.$request->file)}}" class="img-fluid " />
                    </div>
                </div>
                @endif
            </div>
            <div class="mb-3 text-center">
                <a class="link-danger" data-bs-toggle="collapse" href="#historyCollapse" role="button" aria-expanded="false" aria-controls="historyCollapse">
                    Show history of this request
                </a>
            </div>

            <div class=" collapse shadow p-4 mb-3 bg-body rounded text-center" id="historyCollapse">
                <p class="fs-4 fw-semibold text-center">REQUEST HISTORY</p>
                <hr>
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Processed by</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $history)
                        <tr>
                            <td>{{$history->created_at}}</td>
                            <td>{{$history->request_status}}</td>
                            <td>{{$history->processed_by}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(!is_null($request->pdf_file))
            <div class="  shadow p-4 mb-3 bg-body rounded text-center">
                <p class="fs-4 fw-semibold text-center">FILE</p>
                <hr>
                <object data="{{url('wordsDocsFormat/'.$request->pdf_file)}}" type="application/pdf" width="400" height="500">
                    <p>PDF file could not be displayed. <a href="path/to/your/file.pdf">Download</a> it instead.</p>
                </object>
                <br>
                <a href="{{url('wordsDocsFormat/'.$request->pdf_file)}}" target="_blank" id="btn" type="submit" class="btn " style="background-color:#428BCA; color: white;">
                    <i class="bi bi-file-pdf-fill"></i> View full</a>

            </div>

            @endif
            <div class="shadow p-4 mb-3 bg-body rounded text-center">
                <a href="/view-request-list" id="btn" type="submit" style="background-color:#AA0F0A; color: white;" class="btn d-block mx-auto w-25">DONE</a>
            </div>
        </div>
    </div>




</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>
    // Set the URL of the PDF file
    var url = "{{url('wordsDocsFormat/'.$request->pdf_file)}}";

    // Load the PDF file
    pdfjsLib.getDocument(url).promise.then(function(pdf) {
        // Get the first page of the PDF file
        pdf.getPage(1).then(function(page) {
            // Set the scale of the PDF preview
            var scale = 1.5;
            // Get the viewport of the PDF page at the specified scale
            var viewport = page.getViewport({
                scale: scale
            });
            // Set the canvas element to the size of the viewport
            var canvas = document.createElement('canvas');
            canvas.width = viewport.width;
            canvas.height = viewport.height;
            // Get the context of the canvas element
            var context = canvas.getContext('2d');
            // Render the PDF page on the canvas element
            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            page.render(renderContext).promise.then(function() {
                // Add the canvas element to the PDF preview container
                var previewContainer = document.getElementById('pdf-preview');
                previewContainer.appendChild(canvas);
            });
        });
    });
</script>
@endforeach
@endforeach