@include('admin/adminHeader')
@foreach($admin_info as $admin)
<div class="content ">

    <p class="display-6 mt-4"><i class="bi bi-pencil-square"></i> <strong>Manage Services</strong></p>
    <hr style="color: black;">
    <div class="alert alert-info" role="alert">
    <i class="bi bi-info-circle"></i> Please note that this page is intended for activating and deactivating the services provided in the web app. Please ensure that you only make changes if you have the necessary permissions and authority to do so.
    </div>
    <div class=>
        <form method="post" enctype="multipart/form-data" action="{{url('updateRequestType')}}">
            @csrf
            <table class="table">
                <thead class='table-dark'>
                    <tr>
                        <th>TRANSACTIONS</th>
                        <th class='text-center'>ACTION</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($request_type as $requests)
                    <tr>
                        @if($requests->isEnabled == '1')
                        <td><span class="badge rounded-pill text-bg-success">Active</span> {{ucwords(strtolower($requests->request_type_name))}}</td>
                        @endif
                        @if($requests->isEnabled == '0')
                        <td><span class="badge rounded-pill text-bg-warning">Inactive</span> {{ucwords(strtolower($requests->request_type_name))}}</td>
                        @endif
                        <td>
                            @if($requests->isEnabled == '1')
                            <select class="form-select text-center" aria-label="Default select example" name="{{$requests->code_name}}" id="{{$requests->request_type_id}}">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @endif
                            @if($requests->isEnabled == '0')
                            <select class="form-select text-center" aria-label="Default select example" name="{{$requests->code_name}}" id="{{$requests->request_type_id}}">
                                <option value="0" selected>Inactive</option>
                                <option value="1">Active</option>
                            </select>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger float-end" style="width:23%"><i class="bi bi-pencil-square"></i> Update</button>
        </form>
    </div>



</div>
@endforeach
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

</html>