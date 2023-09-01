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
    </div>
</div>
</div>
@include('footer')