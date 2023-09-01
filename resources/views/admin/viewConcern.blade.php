@include('admin/adminHeader')
@foreach($admin_info as $user)
@foreach($request as $request)

<style>
    .timeline-1 {
        border-left: 3px solid black;
        border-bottom-right-radius: 4px;
        border-top-right-radius: 4px;
        background: #F5EAEA;
        margin: 0 auto;
        position: relative;
        padding: 50px;
        list-style: none;
        text-align: left;
        max-width: 40%;
    }

    @media (max-width: 767px) {
        .timeline-1 {
            max-width: 98%;
            padding: 25px;
        }
    }

    .timeline-1 .event {
        border-bottom: 1px dashed #000;
        padding-bottom: 25px;
        margin-bottom: 25px;
        position: relative;
    }

    @media (max-width: 767px) {
        .timeline-1 .event {
            padding-top: 30px;
        }
    }

    .timeline-1 .event:last-of-type {
        padding-bottom: 0;
        margin-bottom: 0;
        border: none;
    }

    .timeline-1 .event:before,
    .timeline-1 .event:after {
        position: absolute;
        display: block;
        top: 0;
    }

    .timeline-1 .event:before {
        left: -207px;
        content: attr(data-date);
        text-align: right;
        font-weight: 100;
        font-size: 0.9em;
        min-width: 120px;
    }

    @media (max-width: 767px) {
        .timeline-1 .event:before {
            left: 0px;
            text-align: left;
        }
    }

    .timeline-1 .event:after {
        -webkit-box-shadow: 0 0 0 3px black;
        box-shadow: 0 0 0 3px black;
        left: -55.8px;
        background: #fff;
        border-radius: 50%;
        height: 9px;
        width: 9px;
        content: "";
        top: 5px;
    }

    @media (max-width: 767px) {
        .timeline-1 .event:after {
            left: -31.8px;
        }
    }
</style>
<div class="content mb-4">

    <p class="display-6"><i class="bi bi-file-person"></i> <strong>{{$request->reference_key}}</strong></p>
    <div class="text-center">
        @if($request->concern_status == 'PENDING')
        <div class="badge bg-warning text-wrap" style="width: 6rem;">
            PENDING
        </div>
        @endif
        @if($request->concern_status == 'DENIED')
        <div class="badge bg-danger text-wrap" style="width: 6rem;">
            DENIED
        </div>
        @endif
        @if($request->concern_status == 'DONE')
        <div class="badge bg-PRIMARY text-wrap" style="width: 6rem;background-color:#0d6efd">
            DONE
        </div>
        @endif
        @if($request->concern_status == 'PROCESSING')
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
            <div class="shadow p-3 mb-3 bg-body rounded ">
                <p class="fs-4 fw-semibold text-center">CONCERN INFORMATION</p>
                <hr>
                <div class="row my-3 ">
                    <div class="col-md-3 mb-2 text-center">
                    </div>
                    <div class="col-md-6 mb-2 text-center">
                        <label class="text-start mb-2" for=""><strong>Type of Concern:</strong></label>
                        <p class="text-justify">{{$request->concern_type}}</p>
                    </div>
                    <div class="col-md-3 mb-2 text-center">
                    </div>
                </div>
                <div class="row my-3 ">
                    <div class="col-md-12 mb-2 text-center">
                        <label class="text-start mb-2 text-center" for=""><strong>Title:</strong></label>
                        <p class="text-justify">{{$request->concern_title}}</p>
                    </div>
                </div>
                <div class="row my-3 ">
                    <div class="col-md-12 mb-2">
                        <div class="text-center">
                            <label class="text-start mb-2 text-center"><strong>Description:</strong></label>
                        </div>
                        <div class="text-center">
                            <p class="mx-2">{!! nl2br(html_entity_decode($request->concern_description)) !!}</p>
                        </div>
                    </div>
                </div>
                @if($request->concern_photo != "")
                <div class="row my-3 ">
                    <div class="col-md-12 mb-2">
                        <div class="text-center">
                            <label class="text-start mb-2 text-center"><strong>Attached file:</strong></label>
                        </div>
                        <div class="text-center">
                            <img width="400" height="200" src="{{url('concerns/'.$request->concern_photo)}}" class="img-fluid" alt="...">

                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="shadow p-4 mb-3 bg-body rounded text-center">
                <p class="fs-4 fw-semibold text-center">Concern History</p>
                <hr>
                <div id="content">
                    <ul class="timeline-1 text-black">
                        <li class="event" data-date="{{date('M j, Y (g:i a)', strtotime($request->created_at))}}">
                            <h4 class="mb-3">Submitted Concern: </h4>
                            <p>{{$request->concern_title}}</p>
                        </li>
                        @foreach($history as $history)
                        @if( $history->concern_update_status != "PENDING")
                        <li class="event" data-date="{{date('M j, Y (g:i a)', strtotime($history->created_at))}}">
                            <h4 class="mb-3">{{$history->concern_update_title}}</h4>
                            <p>{{$history->concern_update_description}}</p>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="shadow p-4 mb-3 bg-body rounded text-center">
                <a href="/view-concern-list" id="btn" type="submit" style="background-color:#AA0F0A; color: white;" class="btn d-block mx-auto w-25">DONE</a>
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