@include('admin/adminHeader')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<div class="content my-3">
    <p class="display-6"><i class="bi bi-people-fill"></i> <strong>Active Resident Account</strong></p>
    <hr style="color: black;">
    <div class="alert alert-primary" role="alert">
        <i class="bi bi-info-circle-fill"></i> This page is intended to display the list of active resident accounts. It is not intended for any other purpose, such as modifying resident accounts.
    </div>
    <div class="my-3">
        <a class="" style="text-decoration: none;color: inherit;" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="bi bi-funnel-fill"></i>Show filter
        </a>
        <div class="collapse mt-3" id="collapseExample">
            <div class="row">
                <div class="col-6">

                    <label for="exampleInputEmail1" class="form-label ">Gender Filter</label>
                    <select id="genderdrop" class="form-select form-select-sm  w-25" aria-label="Default select example">
                        <option value='' selected>All</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                </div>
                <div class="col-6">

                    <label for="exampleInputEmail1" class="form-label ">Street Filter</label>
                    <select id="streetdrop" class="form-select form-select-sm  w-75" aria-label="Default select example">
                        <option value='' selected>All</option>
                        <option value='A. Bonifacio'>A. Bonifacio</option>
                        <option value='Abad'>Abad</option>
                        <option value='Aguirre'>Aguirre</option>
                        <option value='Airforce Road'>Airforce Road</option>
                        <option value='Airforce Road Extn.'>Airforce Road Extn.</option>
                        <option value='Army Road'>Army Road</option>
                        <option value='Atis '>Atis </option>
                        <option value='Banaba'>Banaba</option>
                        <option value='Bayanihan Road'>Bayanihan Road</option>
                        <option value='Caliao'>Caliao</option>
                        <option value='Camia'>Camia</option>
                        <option value='Col. Ballecer'>Col. Ballecer</option>
                        <option value='Col. Ballecer Extn.'>Col. Ballecer Extn.</option>
                        <option value='Col. Gervacio'>Col. Gervacio</option>
                        <option value='Convergence'>Convergence</option>
                        <option value='Daisy'>Daisy</option>
                        <option value='Directo'>Directo</option>
                        <option value='E. Rodriguez'>E. Rodriguez</option>
                        <option value='Espedilla'>Espedilla</option>
                        <option value='Everlasting'>Everlasting</option>
                        <option value='Friendship'>Friendship</option>
                        <option value='Gen. Aguinaldo'>Gen. Aguinaldo</option>
                        <option value='Gen. del Pilar'>Gen. del Pilar</option>
                        <option value='Gen. Espino'>Gen. Espino</option>
                        <option value='Gen. Luna'>Gen. Luna</option>
                        <option value='Gen. Malvar'>Gen. Malvar</option>
                        <option value='Gen. Mc Arthur'>Gen. Mc Arthur</option>
                        <option value='GHQ Road'>GHQ Road</option>
                        <option value='Gumamela'>Gumamela</option>
                        <option value='Hechanova'>Hechanova</option>
                        <option value='Herbs'>Herbs</option>
                        <option value='Ilang-Ilang'>Ilang-Ilang</option>
                        <option value='J.P. Laurel '>J.P. Laurel </option>
                        <option value='Jasmin'>Jasmin</option>
                        <option value='Luzon'>Luzon</option>
                        <option value='Manalili'>Manalili</option>
                        <option value='Manggahan'>Manggahan</option>
                        <option value='Manggahan Extn.'>Manggahan Extn.</option>
                        <option value='Martinez'>Martinez</option>
                        <option value='Mayor Tanyag'>Mayor Tanyag</option>
                        <option value='Napocor'>Napocor</option>
                        <option value='Navy Road'>Navy Road</option>
                        <option value='Orchid'>Orchid</option>
                        <option value='Palma'>Palma</option>
                        <option value='Pamela'>Pamela</option>
                        <option value='Pardiñas'>Pardiñas</option>
                        <option value='PC Road'>PC Road</option>
                        <option value='PNP Road'>PNP Road</option>
                        <option value='Pres. Garcia'>Pres. Garcia</option>
                        <option value='Pres. Laurel'>Pres. Laurel</option>
                        <option value='Pres. M.L. Quezon'>Pres. M.L. Quezon</option>
                        <option value='Pres. Macapagal'>Pres. Macapagal</option>
                        <option value='Pres. Magsaysay'>Pres. Magsaysay</option>
                        <option value='Pres. Magsaysay Extn.'>Pres. Magsaysay Extn.</option>
                        <option value='Pres. Osmeña'>Pres. Osmeña</option>
                        <option value='Pres. Quirino'>Pres. Quirino</option>
                        <option value='Pres. Roxas'>Pres. Roxas</option>
                        <option value='Pres.Quirino Extn.'>Pres.Quirino Extn.</option>
                        <option value='Providencia Ext.'>Providencia Ext.</option>
                        <option value='Quintar'>Quintar</option>
                        <option value='Ranger'>Ranger</option>
                        <option value='Sto. Niño'>Sto. Niño</option>
                        <option value='Visayas'>Visayas</option>
                    </select>

                </div>
            </div>

        </div>
    </div>



    <table id="resident" class="table table-bordered table-hover" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center" style="width: 30%">Address</th>
                <th class="text-center">Gender</th>
                <th class="text-center">Age</th>
                <th class="text-center">Email</th>
                <th class="text-center">View</th>
                @foreach($admin_info as $admin)
                @if($admin->role == 'Administrator')
                <th class="text-center">Deact</th>
                @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($list_info as $user)

            @if($user->middle_name == 'N/A')
            <p hidden>{{$fullname = $user->first_name." ".$user->last_name}}</p>

            @else
            <p hidden>{{$fullname = $user->first_name." ".$user->middle_name." ".$user->last_name}}</p>

            @endif



            <p hidden>
                {{ $age = \Carbon\Carbon::parse($user->birthdate)->age;}}
            </p>
            <p hidden>{{$address = $user->address_unitNo." ".$user->address_houseNo." ".$user->address_street." ".$user->address_purok}}</p>
            <tr>
                <td style="text-transform: uppercase;">{{$user->id}}</td>
                <td>{{ucwords(strtolower($fullname))." ".$user->suffix}}</td>
                <td>{{ucwords(strtolower($address))}} South Signal Village, Taguig City</td>
                <td style="text-transform: uppercase;">{{$user->gender}}</td>
                <td style="text-transform: uppercase;">{{$age}}</td>
                <td class="text-lowercase" style="text-transform: uppercase;">{{$user->email}}</td>
                <td class="text-center">

                    <a href="viewResident/{{$user->id}}" type="submit" class="btn btn-success btn-sm"><i class="bi bi-eye-fill"></i> View</a>
                </td>
                @foreach($admin_info as $admin)
                @if($admin->role == 'Administrator')
                <td class="text-center">
                    <form id="deactivateForm{{$user->id}}" method="post" enctype="multipart/form-data" action="{{ url('deact') }}">
                        @csrf
                        <input name="id" type="hidden" value="{{$user->id}}">
                        <!-- <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Deact'><i class="bi bi-trash"></i> Deactivate</button> -->
                        <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Deact' data-user-id="{{$user->id}}"><i class="bi bi-trash"></i> Deactivate</button>
                    </form>

                </td>
                @endif
                @endforeach
            </tr>

            </tr>
            @endforeach
        </tbody>
    </table>
    <hr style="color: black;">
</div>


@foreach($admin_info as $admin)

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">

</script>
<script>

</script>
@endforeach
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
                                        window.location.href = "{{url('listresident')}}";
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
                                        window.location.href = "{{url('listresident')}}";
                                    }
                                });

                            }

                        })
                        .catch(error => {
                            console.error('There was an error:', error);
                        });
                }
            }).then((result) => {
                window.location.href = "{{url('listresident')}}";
            });;
        });
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#resident').DataTable({
            responsive: true,
            order: [
                [1, 'asc']
            ],
            buttons: [{
                extend: 'excel',
                className: 'btn btn-warning mt-3 me-1 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as Excel',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE RESIDENT LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE RESIDENT LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }, {
                extend: 'pdf',
                className: 'btn btn-warning mt-3 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as PDF',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE RESIDENT LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE RESIDENT LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }]
        });

        $('#genderdrop').on('change', function() {
            if (this.value == "") {
                table.columns(3).search('').draw();
            } else {
                table.columns(3).search("^" + this.value + "$", true, false, true).draw();
            }
        });
        $('#streetdrop').on('change', function() {
            var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
            );

            table.column(2).search(val ? val : '', true, false).draw();
        });

        table.buttons().container()
            .appendTo('#resident_wrapper .col-md-6:eq(0)');


    });
</script>

</html>