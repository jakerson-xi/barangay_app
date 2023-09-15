<html lang="en">
<!--HEADER -->
@include('head')
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

<link href="{{asset('css/registration.css')}}" rel="stylesheet">

@include('sweetalert::alert')

<div class="myContainer_reg mt-3">
    <h1 class="display-6  text-center fw-bolder ">ID VERIFICATION</h1>

    <div class=" ">







        <iframe src="https://docupass.app/{{$frame['reference']}}" frameborder="0" allow="camera https://docupass.app;microphone https://docupass.app" allowtransparency="true" class="mx-auto" style="width: 100%; height: 100%;">
        </iframe>





    </div>



</div>


</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@include('footer')