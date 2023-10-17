@include('admin/adminHeader')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css">
<style>
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
<style>
    .my-container {
        margin: 2em 4em 2em 4em;
    }

    .details-container {
        margin-top: 2em;
        border-top: 4px solid #AA0F0A;
        box-shadow: 0px 8px 8px 8px rgba(0, 0, 0, 0.2);
        border-radius: 7px;
    }

    .col-4 {
        padding: 2em 5em 0em 5em;
    }

    #payment-number {
        padding-top: 10px;
    }

    .hr-container {
        text-align: center;
    }

    .centered-hr {
        width: 100%;
        /* Set the desired width for the horizontal rule */
        margin: auto;
        padding-bottom: 2em;
        /* Center the horizontal rule */
    }

    .page-title {
        padding: 15px;
    }

    .container-bottom {
        text-align: center;
        padding-top: 3em;

    }

    .page-title {
        padding: 15px;
    }

    .modal-header {
        background-color: #AA0F0A;
        color: white;
    }



    #confirm-payment {
        font-size: 110%;
        background-color: #AA0F0A;
        border: #AA0F0A;
    }

    #confirm-payment:hover {
        background-color: white;
        color: black;
        border: 2px solid #AA0F0A;
    }


    .tooltip-inner {
        font-size: 50px;
        /* Adjust the font size as needed */
    }

    #close-button {
        background-color: white;
        color: #AA0F0A;
        border: 2px solid #AA0F0A;
    }

    #close-button:hover {
        background-color: #AA0F0A;
        border: 2px solid white;
        color: white;
    }

    #proceed-button {
        background-color: #AA0F0A;
        color: white;
        border: 2px solid white;
    }

    #proceed-button:hover {
        background-color: white;
        border: 2px solid #AA0F0A;
        color: #AA0F0A;
    }
</style>
<div class="content my-3">


    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-6">
            <li class="breadcrumb-item"><a href="{{url('listReadyForPayment')}}">All Ready for Payment</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$request->reference_key}}</li>
        </ol>
    </nav>
    <h2 id="payment-number">{{$request->reference_key}}</h2>
    <form class="needs-validation" enctype="multipart/form-data" method="POST" action="{{URL('confirmOnsitePayment')}}" novalidate>
        @csrf
        <input type="hidden" name='reference' value='{{$request->reference_key}}'>
        <div class="container-fluid details-container">
            <div class="row">
                <div class="col-7" style="border-right: 4px solid #AA0F0A;">
                    <div class="ms-3">
                        <h4 class="text-uppercase mt-4">Request Details</h4>
                        <div class="row pt-3 pe-5" style="padding-top: 10px;">
                            <table class="table table-borderless  ms-2 me-3">
                                <tbody>

                                    <tr>
                                        <td><strong>Resident Name: </strong></td>
                                        <td class="text-end">{{$request->first_name . " " .$request->middle_name . " " . $request->last_name}}</td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td><strong>Resident Address: </strong></td>
                                        <td class="text-end">{{$request->address_unitNo." ".$request->address_houseNo." ".$request->address_street}}<br>{{$request->address_purok}} SOUTH SIGNAL VILLAGE</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email: </strong></td>
                                        <td class="text-end">{{$request->email}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Mobile number: </strong></td>
                                        <td class="text-end">{{$request->mobile_num}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Reference Key:</strong></td>
                                        <td class="text-end">{{$request->reference_key}}</td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td><strong>Type of application: </strong></td>
                                        <td class="text-end">{{$request->request_type_name}}<br>({{($request->request_description)}})</td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td><strong>Purpose: </strong></td>
                                        <td class="text-end">{{$request->request_purpose}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date of Request: </strong></td>
                                        <td class="text-end">{{date("F j, Y g:i:s A", strtotime($request->created))}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Proceed by: </strong></td>
                                        <td class="text-end">{{$request->employee_name}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date to claim: </strong></td>
                                        <td class="text-end">{{$request->range_date_claim}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Note: </strong></td>
                                        <td class="text-end">{{$request->request_message}}</td>
                                    </tr>
                                </tbody>
                            </table>



                        </div>
                    </div>

                </div>

                <div class="col-5" style="background-color: rgb(238, 238, 238);">
                    <div class="mx-3">
                        <h4 class="mt-4  text-uppercase">ONSITE PAYMENT</h4>
                        <div class="contact-details mt-4 ">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <td class="align-middle">
                                        <label for="exampleFormControlTextarea1" class="form-label">Ref No: <span class="text-danger">*</span></label>
                                    </td>
                                    <td>
                                        <input name="ref" placeholder="reference number" class="w-100 form-control mb-1" type="number" required style="-webkit-appearance: none; margin: 0;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <label for="exampleFormControlTextarea1" class="form-label">OR. No: <span class="text-danger">*</span></label>
                                    </td>
                                    <td>
                                        <input placeholder="OR number" name="official_receipt" class="w-100 form-control mb-1" type="number" required style="-webkit-appearance: none; margin: 0;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <label for="exampleFormControlTextarea1" class="form-label">CTC. No: <span class="text-danger">*</span></label>
                                    </td>
                                    <td>
                                        <input placeholder="CTC number" name="ctc" class="w-100 form-control mb-1" type="number" required style="-webkit-appearance: none; margin: 0;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>

                                </tr>
                            </table>
                            <table class="table table-borderless mt-0">
                                <tr>
                                    <td class="align-middle">
                                        <label for="exampleFormControlTextarea1" class="form-label">Req. amount: <span class="text-danger">*</span></label>
                                    </td>
                                    <td>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">₱</span>
                                            @if($request->request_type_name == 'COMMUNITY TAX CERTIFICATE')
                                            <input type="text" id="price" name="price" value="{{number_format($request->price, 2, '.', '')}}" class="form-control" placeholder="{{$request->price}}" aria-label="Username" aria-describedby="basic-addon1" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" required>
                                            @elseif($request->price == 0)
                                            <input type="text" id="price" name="price" value="FREE" class="form-control" placeholder="{{$request->price}}" aria-label="Username" aria-describedby="basic-addon1" readonly required>

                                            @else
                                            <input type="text" id="price" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" name="price" value="{{number_format($request->price, 2, '.', '')}}" class="form-control" placeholder="{{$request->price}}" aria-label="Username" aria-describedby="basic-addon1" readonly required>
                                            @endif
                                        </div>
                                    </td>

                                <tr>
                                    <td class="align-middle">
                                        <label jfor="exampleFormControlTextarea1" class="form-label">Payment amount: <span class="text-danger">*</span></label>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">₱</span>
                                            @if($request->request_type_name != 'COMMUNITY TAX CERTIFICATE' && $request->price == 0)
                                            <input type="text" value="FREE" name="amount_paid" id="amount_paid" class=" form-control" placeholder="Payment Amount" aria-label="Username" aria-describedby="basic-addon1" readonly required>
                                            @else
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" name="amount_paid" id="amount_paid" class=" form-control" placeholder="Payment Amount" aria-label="Username" aria-describedby="basic-addon1" required>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <label for="exampleFormControlTextarea1" class="form-label">Change: <span class="text-danger">*</span></label>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">₱</span>
                                            <input type="number" id="change" name="change" value="0.00" class="form-control" placeholder="Payment Amount" aria-label="Username" aria-describedby="basic-addon1" readonly required>
                                        </div>
                                        <div id="change-error" class="text-danger"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <label for="exampleFormControlTextarea1" class="form-label">Description: <span class="text-danger">*</span></label>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <textarea rows="4" type="text" id="description_payment" name="description_payment" class="form-control" placeholder="Description" aria-label="Username" aria-describedby="basic-addon1"></textarea>
                                        </div>
                                        <div id="change-error" class="text-danger"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid container-bottom">
            <!-- <button type="submit" id="proceed-button" class="btn btn-primary">
                Proceed
            </button> -->
            <button type="button" id="proceed-button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal" disabled>
                Proceed
            </button>

        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                        <button type="button" style="background-color: white;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning fade show" role="alert">
                            <strong>Please check the inputs.</strong> You should check in on some of those fields below.
                        </div>
                        <!-- Display the input values here -->
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td><strong>Ref No:</strong></td>
                                    <td><span id="modal-ref"></span></td>
                                </tr>
                                <tr>
                                    <td><strong>OR. No:</strong></td>
                                    <td><span id="modal-or"></span></td>
                                </tr>
                                <tr>
                                    <td><strong>CTC. No:</strong></td>
                                    <td><span id="modal-ctc"></span></td>
                                </tr>
                                <tr>
                                    <td><strong>Req. amount:</strong></td>
                                    <td><span id="modal-amount"></span></td>
                                </tr>
                                <tr>
                                    <td><strong>Payment amount:</strong></td>
                                    <td><span id="modal-payment"></span></td>
                                </tr>
                                <tr>
                                    <td><strong>Change:</strong></td>
                                    <td><span id="modal-change"></span></td>
                                </tr>



                            </tbody>
                        </table>
                        <strong>Description:</strong>
                        <br>
                        <textarea class="form-control mt-2" id="modal-description" readonly></textarea>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm and Proceed</button>
                    </div>
                </div>
            </div>
        </div>

    </form>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.3.0/js/dataTables.dateTime.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {


            // Function to check if the input fields are valid
            function checkInputValidity() {
                var ref = $('input[name="ref"]').val();
                var or = $('input[name="official_receipt"]').val();
                var ctc = $('input[name="ctc"]').val();
                var amount = $('input[name="price"]').val();
                var payment = $('input[name="amount_paid"]').val();
                var change = $('input[name="change"]').val();
                var description = $('textarea[name="description_payment"]').val();


                // Add your validation logic here
                var isValid = true;

                // Example validation: Check if any of the fields are empty
                if (ref.trim() === '' || or.trim() === '' || ctc.trim() === '' || amount.trim() === '' || payment.trim() === '') {
                    isValid = false;
                }
                if (change.trim() < 0) {
                    isValid = false;
                }

                // Enable or disable the "Proceed" button based on validation
                if (isValid) {
                    $('#proceed-button').prop('disabled', false);
                    // Set values in the modal
                    $('#modal-ref').text(ref);
                    $('#modal-or').text(or);
                    $('#modal-ctc').text(ctc);

                    if (amount == 'FREE') {
                        $('#modal-amount').text('FREE');
                        $('#modal-payment').text('FREE');
                    } else {
                        $('#modal-amount').text('₱ ' + amount);
                        $('#modal-payment').text('₱ ' + payment);
                    }

                    $('#modal-description').text(description);
                    $('#modal-change').text('₱ ' + change);
                } else {
                    $('#proceed-button').prop('disabled', true);
                }
            }

            // Check input validity on input or blur events
            $('input, textarea').on('input blur', checkInputValidity);
            $('#amount_paid').on('input', function() {
                // Get the value of "Payment Amount" input
                var amountPaid = parseFloat($(this).val());

                // Get the initial price value (remove the currency symbol and parse as a float)
                var initialPrice = parseFloat(parseFloat($('#price').val()));

                // Calculate the change
                var change = amountPaid - initialPrice;

                // Update the "Change" input field
                $('#change').val(change.toFixed(2));

                // Check if the change is negative
                if (change < 0) {
                    // Change is negative, show an error message or prevent form submission
                    // For example, display an error message
                    $('#change-error').text('Invalid payment amount');
                    $('#amount_paid').addClass('is-invalid');
                } else {
                    // Change is non-negative, clear the error message
                    $('#change-error').text('');
                    $('#amount_paid').removeClass('is-invalid');
                    $('#amount_paid').val(amountPaid.toFixed(2));
                }
            });

        });
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

    </html>