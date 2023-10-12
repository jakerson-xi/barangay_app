@include('admin/adminHeader')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css">

<div class="content my-3">
    <p class="display-6"><i class="bi bi-credit-card-2-front-fill"></i> <strong>Process Online Payment Request </strong></p>
    <hr style="color: black;">

    <div class="my-3">
        <a style="text-decoration: none;color: inherit;" class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="bi bi-funnel-fill"></i> Filter
        </a>
    </div>


    <div class="collapse mt-3" id="collapseExample">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <label for="exampleInputEmail1" class="form-label ">Payment Method:</label>
                    <div class="md-flex mb-3 col">
                        <select id="docTypeDrop" class="form-select form-select-sm w-50" aria-label="Default select example">
                            <option value='' selected>All</option>
                            <option value="GCASH">Gcash</option>
                            <option value="GRAB_PAY">Grab Pay</option>
                            <option value="PAYMAYA">Paymaya</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 text-center">
                    <table border="0" cellspacing="5" cellpadding="5">
                        <tbody>
                            <tr>
                                <td>Minimum date:</td>
                                <td><input class="form-control" type="text" id="min" name="min"></td>
                            </tr>
                            <tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-6 text-center">
                    <table border="0" cellspacing="5" cellpadding="5">
                        <tbody>
                            <tr>
                                <td>Maximum date:</td>
                                <td><input class="form-control" type="text" id="max" name="max"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <table id="resident" class="table table-bordered table-hover" style="width:100%">
        <thead class="table-dark">

            <tr>
                <th class="text-center align-middle">Request Key</th>
                <th class="text-center align-middle">Payment Reference Key</th>
                <th class="text-center align-middle">Name</th>
                <th class="text-center align-middle">Method</th>
                <th class="text-center align-middle">Date</th>
                <th class="text-center align-middle">Req. Amount</th>
                <th class="text-center align-middle">Service Charge</th>
                <th class="text-center align-middle">Total Amount</th>
                <th class="text-center align-middle">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($request as $request)
            <tr>
                <td style="text-transform: uppercase;">{{$request->reference_key}}</td>
                <td>
                    <a href="paymongo_details/{{$request->payment_ref}}" target="_blank" type="submit">
                        {{$request->payment_ref}}
                    </a>
                </td>
                <td style="text-transform: uppercase;">{{$request->first_name. " ".$request->last_name}}</td>
                <td style="text-transform: uppercase;">{{$request->payment_method}}</td>
                <td style="text-transform: uppercase;">{{$request->payment_created_at}}</td>
                <td style="text-transform: uppercase" class="text-center">₱ {{number_format($request->request_price, 2, '.', '')}}</td>
                <td style="text-transform: uppercase" class="text-center">₱ {{number_format($request->service_charge, 2, '.', '')}}</td>
                <td style="text-transform: uppercase" class="text-center fw-bold ">₱ {{$request->service_charge + $request->request_price}}</td>
                <td style="text-transform: uppercase; " class="text-center">
                    <a href="" type="submit" class="btn btn-success btn-sm"><i class="bi bi-check2-circle"></i> Confirm</a>
                </td>
            </tr>
            @endforeach
        <tfoot>
            <tr>
                <th colspan="5" class="text-center">TOTAL:</th> <!-- Empty cells for the first 5 columns -->
                <th class="text-center align-middle" id="total-req-amount"></th>
                <th class="text-center align-middle" id="total-service-charge"></th>
                <th class="text-center align-middle" id="total-total-amount"></th>
                <th></th> <!-- Empty cell for the last column -->
            </tr>
        </tfoot>
        </tbody>


    </table>
    <hr style="color: black;">
</div>


</body>
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
<style>
    .hide-column {
        display: none;
    }
</style>
<script>
    var minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = minDate.val();
            var max = maxDate.val();
            var date = new Date(data[4]);

            if (
                (min === null && max === null) ||
                (min === null && date <= max) ||
                (min <= date && max === null) ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        }
    );
    $(document).ready(function() {

        minDate = new DateTime($('#min'), {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'MMMM Do YYYY'
        });
        // Refilter the table
        var table = $('#resident').DataTable({

            "search": {
                regex: true
            },
            responsive: true,
            order: [
                [4, 'desc']
            ],
            buttons: [{
                extend: 'excel',
                className: 'btn btn-warning mt-3 me-1 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as Excel',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE ONLINE PAYMENT LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE ONLINE PAYMENT LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                },

            }, {
                extend: 'pdf',
                className: 'btn btn-warning mt-3 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as PDF',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE ONLINE PAYMENT LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE ONLINE PAYMENT LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }]
        });

        // Update the total sums when the table is redrawn (due to filtering)
        var totalReqAmount = 0;
        var totalServiceCharge = 0;
        var totalTotalAmount = 0;

        table.rows().every(function() {
            var data = this.data();
            var reqAmount = parseFloat(data[5].replace('₱', '').replace(/,/g, ''));
            var serviceCharge = parseFloat(data[6].replace('₱', '').replace(/,/g, ''));
            var totalAmount = reqAmount + serviceCharge;

            totalReqAmount += reqAmount;
            totalServiceCharge += serviceCharge;
            totalTotalAmount += totalAmount;
        });

        // Update the initial total sum cells in the footer
        $('#total-req-amount').text('₱ ' + totalReqAmount.toFixed(2));
        $('#total-service-charge').text('₱ ' + totalServiceCharge.toFixed(2));
        $('#total-total-amount').text('₱ ' + totalTotalAmount.toFixed(2));

        // Add the DataTables event listener to handle updates during filtering
        table.on('draw', function() {
            totalReqAmount = 0;
            totalServiceCharge = 0;
            totalTotalAmount = 0;

            table.rows({
                search: 'applied'
            }).every(function() {
                var data = this.data();
                var reqAmount = parseFloat(data[5].replace('₱', '').replace(/,/g, ''));
                var serviceCharge = parseFloat(data[6].replace('₱', '').replace(/,/g, ''));
                var totalAmount = reqAmount + serviceCharge;

                totalReqAmount += reqAmount;
                totalServiceCharge += serviceCharge;
                totalTotalAmount += totalAmount;
            });

            // Update the total sum cells in the footer after filtering
            $('#total-req-amount').text('₱ ' + totalReqAmount.toFixed(2));
            $('#total-service-charge').text('₱ ' + totalServiceCharge.toFixed(2));
            $('#total-total-amount').text('₱ ' + totalTotalAmount.toFixed(2));
        });

        $('#min, #max').on('change', function() {
            table.draw();

        });

        table.buttons().container()
            .appendTo('#resident_wrapper .col-md-6:eq(0)');
        $('.filter-checkbox').on('change', function() {
            filterDataTable();

        });
        $('#docTypeDrop').on('change', function() {
            if (this.value == "") {
                table.columns(3).search('').draw();


            } else {
                table.columns(3).search("^" + this.value + "$", true, false, true).draw();

            }

        });

        function filterDataTable() {
            var values = [];
            $('.filter-checkbox:checked').each(function() {
                values.push($(this).val());
            });

            table.column(5).search(values.join('|'), true, false).draw();

        }

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.3.0/js/dataTables.dateTime.min.js"></script>


</html>