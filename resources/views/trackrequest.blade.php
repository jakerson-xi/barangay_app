<html lang="en">
@include('head')
<link href="{{asset('css/head.css')}}" rel="stylesheet">
<div class="myContainer_track mb-lg-5">
    <div class="card-body ">
        <h1 style="text-align: center; color: #000000;" class="mt-4 mb-4">TRACK YOUR REQUEST/CONCERNS</h1>
        <form method="post" enctype="multipart/form-data" action="{{url('searchRequest')}}" class="needs-validation" novalidate>
            @csrf
            <div class="input-group mb-5" style="height: 6%;">
                <input id="keys" name="keys" style="font-size:larger; width: 5%;" type="search" class="form-control rounded" placeholder="Enter your track key" aria-label="Search" aria-describedby="search-addon" />
                <button type="submit" class="btn" style="border-color:#AA0F0A; background-color: #AA0F0A; color: white;">search</button>
            </div>
        </form>
        @foreach($user_info as $info)
        @if(strpos($info->reference_key, 'CONCERN-') !== false)
        <div>
            <H5>RESULT:</H5>
            <table class="table border-dark table-bordered text-center">
                <tbody class="border-5 table-group-divider" style="background-color: white ;">
                    <tr>
                        <th scope="row">NAME</td>
                        <th scope="row">CONCERN TYPE</td>
                        <th scope="row">CONCERN TITLE</td>
                        <th scope="row">DATE SUBMITTED</td>
                        <th scope="row">STATUS</td>
                    </tr>
                    <tr>
                        <td>{{$info->first_name." " .$info->last_name}}</td>
                        <td>{{$info->concern_type}}</td>
                        <td>{{$info->concern_title}}</td>
                        <td>{{$info->request_date}}</td>
                        <td>
                            @if($info->concern_status == 'PENDING')
                            <div class="badge bg-warning text-wrap" style="width: 6rem;">
                                PENDING
                            </div>
                            @endif
                            @if($info->concern_status == 'PROCESSING')
                            <div class="badge bg-info text-wrap" style="width: 6rem;">
                                PROCESSING
                            </div>
                            @endif
                            @if($info->concern_status == 'DONE')
                            <div class="badge bg-PRIMARY text-wrap" style="width: 6rem;">
                                DONE
                            </div>
                            @endif
                            @if($info->concern_status == 'DENIED')
                            <div class="badge bg-danger text-wrap" style="width: 6rem;">
                                DENIED
                            </div>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @else
        <div>
            <H5>RESULT:</H5>
            <table class="table border-dark table-bordered text-center">
                <tbody class="border-5 table-group-divider" style="background-color: white ;">
                    <tr>
                        <th scope="row">NAME</td>
                        <th scope="row">DOC. TYPE</td>
                        <th scope="row">DATE REQUESTED</td>
                        <th scope="row">STATUS</td>
                    </tr>
                    <tr>
                        <td>{{$info->first_name." " .$info->last_name}}</td>
                        <td>{{$info->request_type_name." (" .$info->request_description.")"}}</td>
                        <td>{{$info->request_date}}</td>
                        <td>
                            @if($info->request_status == 'PENDING')
                            <div class="badge bg-warning text-wrap" style="width: 6rem;">
                                PENDING
                            </div>
                            @endif
                            @if($info->request_status == 'PROCESSING')
                            <div class="badge bg-info text-wrap" style="width: 6rem;">
                                PROCESSING
                            </div>
                            @endif
                            @if($info->request_status == 'READY FOR PAYMENT')
                            <div class="badge bg-SUCCESS text-wrap" style="width: 6rem;">
                                READY FOR PAYMENT
                            </div>
                            @endif
                            @if($info->request_status == 'DONE')
                            <div class="badge bg-PRIMARY text-wrap" style="width: 6rem;">
                                DONE
                            </div>
                            @endif
                            @if($info->request_status == 'DENIED')
                            <div class="badge bg-danger text-wrap" style="width: 6rem;">
                                DENIED
                            </div>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
        @endforeach
    </div>
</div>
@include('footer')