@include('admin/adminHeader')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css">
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
</style>
<div class="content my-3">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-6">
                <li class="breadcrumb-item"><a href="{{url('listOnlinePayment')}}">All Payments</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$payment->payment_ref}}</li>
            </ol>
        </nav>
        <h2 id="payment-number">{{$payment->payment_ref}}</h2>
        <div class="container-fluid details-container">
            <div class="row">
                <div class="col-4">
                    <h4>Payment Details</h4>
                    <div class="row pt-3 ">
                        <table class="table  table-borderless ms-2">
                            <tbody>
                                <tr>
                                    <td>Gross Amount:</td>
                                    <td>
                                        <p class="text-end">
                                            ₱ {{number_format($payment->request_price, 2, '.', '')}}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fees <i class="bi bi-info-circle-fill" data-toggle="tooltip" title="Paymongo Service Charge" sty></i>
                                        : </td>
                                    <td>
                                        <p class="text-end ">
                                            ₱ {{number_format($payment->service_charge, 2, '.', '')}}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr style="width:100%">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">
                                        <p class="fw-semibold fs-5 ">Total Amount: </p>
                                    </td>
                                    <td class="align-middle">
                                        <p id="total-amount" class="fw-semibold fs-5 text-end">

                                            ₱ {{number_format($payment->service_charge + $payment->request_price, 2, '.', '')}}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <div class="col-6">
                            <p>Gross Amount:</p>
                            <p>Fees
                                <i class="bi bi-info-circle-fill" data-toggle="tooltip" title="Paymongo Service Charge" sty></i>
                            </p>


                        </div>
                        <div class="col-6" style="text-align: end;">
                            <p id="gross-amount">
                                PHP "Gross Amount"
                            </p>
                            <p id="fees-amount"> - PHP "Fees Amount"</p>

                        </div>
                        <div class="hr-container">
                            <hr class="">
                        </div>
                        <div class="col-6">
                            <p class="fw-semibold fs-5">Total Amount: </p>
                        </div>
                        <div class="col-6" style="text-align: end;">
                            <p id="total-amount" class="fw-semibold fs-5">
                                PHP "Total Amount"
                            </p>
                        </div> -->
                        <hr>
                        <div class="row mb-5" style="padding-top: 10px;">
                            @if($payment->payment_method == "gcash")
                            <!-- <h4 id="payment-method" class="pb-2">GCASH</h4> -->
                            <img src="https://assets-global.website-files.com/60c6db70dedd88514dfdf8e9/6149e904ea884776b634fd9d_GCash_Horizontal%20-%20Full%20Blue%20(Transparent).png" class="img-thumbnail" alt="...">

                            @elseif($payment->payment_method == "paymaya")
                            <!-- <h4 id="payment-method" class="pb-2">MAYA</h4> -->
                            <img src="https://assets-global.website-files.com/60c6db70dedd88514dfdf8e9/62ff6cd412d11d5bb2b55342_maya-logo.png" class="img-thumbnail" alt="...">
                            @else
                            <!-- <h4 id="payment-method" class="pb-2">GRAB PAY</h4> -->
                            <img src="https://assets-global.website-files.com/60c6db70dedd88514dfdf8e9/6149e904ea8847973534fda6_GCash_Horizontal---Full-Blue-(Transparent).png" class="img-thumbnail" alt="...">
                            @endif

                            <p class=" fst-italic mt-3" style="font-size: 12px;">Paid on: {{date("F j, Y g:i:s A", strtotime($payment->payment_date))}}</p>
                            <!-- <div class="col-2 pt-2">
                            <p>Paid on:</p>
                        </div>
                        <div class="col-10  pt-2" style="text-align: end;">
                            <p id="payment-date">

                            {{date("F j, Y g:i:s A", strtotime($payment->payment_date))}}
                       
                            </p>
                        </div> -->
                        </div>
                    </div>
                </div>

                <div class="col-5 " style="border-right: 4px solid #AA0F0A;">
                    <h4 class="mt-4">Request Details</h4>
                    <div class="row pt-3 pe-5" style="padding-top: 10px;">
                        <table class="table table-borderless  ms-2 me-3">
                            <tbody>
                                <tr>
                                    <td><strong>Reference Key:</strong></td>
                                    <td class="text-end">{{$payment->reference_key}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Resident Name: </strong></td>
                                    <td class="text-end">{{$payment->first_name . " " .$payment->middlet_name . " " . $payment->last_name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Type of application: </strong></td>
                                    <td class="text-end">{{$payment->request_type_name}} <br>({{$payment->request_description}})</td>
                                </tr>
                                <tr>
                                    <td><strong>Date of Request: </strong></td>
                                    <td class="text-end">{{date("F j, Y g:i:s A", strtotime($payment->request_date))}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <div class="col-6">
                            <p>Reference Key: </p>
                            <p>Resident Name: </p>
                            <p>Type of application: </p>
                            <p>Date of Request: </p>

                        </div>
                        <div class="col-6" style="text-align: end;">
                            <p id="reference-key">"Reference Key"</p>
                            <p id="resident-name">"Resident Name"</p>
                            <p id="application-type">"Type of application"</p>
                            <p id="request-date">"Date of Request"</p>

                        </div> -->
                        <div class="hr-container">
                            <hr class="">
                        </div>


                    </div>
                </div>
                <div class="col-3 " style="background-color: rgb(238, 238, 238);">
                
                    <div class="ms-3">
                        <h4 class="mt-4">Billing Details</h4>
                        <h5 id="resident-name" class="mt-4">{{($billing['name'])}}</h5>
                    </div>
                    <div class="contact-details mt-4 ms-3">
                        <i class="bi bi-envelope-at-fill" id="customer-email"> {{($billing['email'])}}</i>
                        <br>
                        <br>
                        <i class="bi bi-telephone-fill" id="contact-num"> {{($billing['phone'])}}</i>
                    </div>
              
                </div>
            </div>
        </div>
        <div class="container-fluid container-bottom">
            <button id="confirm-payment" type="btn" class="btn btn-primary">Confirm</button>
        </div>
    
</div>

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


</html>