@include('admin/adminHeader')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

<div class="content my-3">
    <p class="display-6"><i class="bi bi-person-workspace"></i> <strong>Active Barangay Employee</strong></p>
    <hr style="color: black;">
    @include('sweetalert::alert')
    @foreach($admin_info as $user)
    <table id="employee" class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th class="text-center">Employee ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Role</th>
                <th class="text-center">Email</th>
                <th class="text-center">View</th>
                @if($user->role == 'Administrator')
                <th class="text-center">Deact</th>
                @endif()
            </tr>
        </thead>
        <tbody>
            @foreach($list_info as $admin)

            @if($admin->middle_name == 'N/A')
            <p hidden>{{$fullname = strtolower($admin->first_name." ".$admin->last_name)}}</p>

            @else
            <p hidden>{{$fullname = strtolower($admin->first_name)." ".strtolower($admin->middle_name)." ".strtolower($admin->last_name)}}</p>

            @endif
            <tr>
                <td style="text-transform: uppercase;">{{$admin->validID_num}}</td>
                <td style>{{ucwords($fullname)." ".$admin->suffix}}</td>
                <td style="text-transform: uppercase;">{{$admin->role}}</td>
                <td class="text-lowercase" style="text-transform: uppercase;">{{$admin->email}}</td>
                <td class="text-center">

                    <a href="/viewEmployee/{{$admin->id}}" class="btn btn-success btn-sm"><i class="bi bi-eye-fill"></i> View</a>
                </td>
                @if($user->role == 'Administrator')
                <td class="text-center">

                    <!-- <form method="post" enctype="multipart/form-data" action="{{url('deact_admin')}}">
                        @csrf
                        <input name="id" type="hidden" value="{{$admin->id}}">
                        <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Deact'><i class="bi bi-trash"></i> Deactivate</button>
                    </form> -->

                    <form id="deactivateForm{{$admin->id}}" method="post" enctype="multipart/form-data" action="{{ url('deact') }}">
                        @csrf
                        <input name="id" type="hidden" value="{{$admin->id}}">
                        <!-- <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Deact'><i class="bi bi-trash"></i> Deactivate</button> -->
                        <button type="submit" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Deact' data-user-id="{{$admin->id}}"><i class="bi bi-trash"></i> Deactivate</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach

    <hr style="color: black;">
</div>
@foreach($admin_info as $admin)

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

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

<script>
    $(document).ready(function() {
        var table = $('#employee').DataTable({
            responsive: true,
            order: [
                [0, 'asc']
            ],
            buttons: [{
                extend: 'excel',
                className: 'btn btn-warning mt-3 me-1 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as Excel',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE EMPLOYEE LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE EMPLOYEE LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }, {
                extend: 'pdf',
                className: 'btn btn-warning mt-3 border border-secondary',
                text: '<i class="bi bi-download"></i> Download as PDF',
                filename: 'BARANGAY SOUTH SIGNAL VILLAGE EMPLOYEE LIST',
                title: 'BARANGAY SOUTH SIGNAL VILLAGE EMPLOYEE LIST',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            }]
        });

        table.buttons().container()
            .appendTo('#employee_wrapper .col-md-6:eq(0)');
    });
</script>
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
                                        window.location.href = "{{url('listbarangayemployee')}}";
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
                                        window.location.href = "{{url('listbarangayemployee')}}";
                                    }
                                });

                            }

                        })
                        .catch(error => {
                            console.error('There was an error:', error);
                        });
                }
            }).then((result) => {
                window.location.href = "{{url('listbarangayemployee')}}";
            });;
        });
    });
</script>

</html>