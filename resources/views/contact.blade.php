<html lang="en">
<!--HEADER -->
@include('head')
<!--CONTACT -->

<style>
  a:link {
    text-decoration: none;
    color: black;
  }


  a:visited {
    text-decoration: none;
    color: black;
  }


  a:hover {
    text-decoration: none;
    color: black;
  }


  a:active {
    text-decoration: none;
    color: black;
  }

  .no-bullet {
    list-style: none;
  }
</style>
<div class="myContainer">


  <h1 class="mx-2 font-weight-bold" style="color: #AA0F0A;">Barangay Contact List:</h1>



  <div class="container overflow-hidden mt-3">

    <div class="row d-flex align-items-stretch">
      <div class="col-6">
        <div class="container p-3 border  bg-light">
          <p class="h4">Barangay Hotline</p>
          <ul>
            @foreach($info as $infos)
            @if($infos->id >= 18 && $infos->id <= 21 ) <li><strong>{{$infos->type}} #: </strong><a href="tel:{{$infos->content}}">{{$infos->content}}</a></li>
              @endif
              @endforeach
          </ul>
        </div>
      </div>
      <div class="col-6">
        <div class="container p-3 border  bg-light">
          <p class="h4">Emergency Hotline</p>
          <ul>
          @foreach($info as $infos)
            @if($infos->id >= 22 && $infos->id <= 25 ) <li><strong>{{$infos->type}} #: </strong><a href="tel:{{$infos->content}}">{{$infos->content}}</a></li>
              @endif
              @endforeach
          </ul>
        </div>
      </div>
    </div>

  </div>

  <hr style="height: 2.5px; color: #aa0f0a; opacity: 100;">



  <div class="container overflow-hidden">

    <div class="row gx-5">

      <!-- <div class="col">
        <div class="p-3 border bg-light">
          <h1 class="display-5 mb-3">Message Us:</h1>
          <form>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Contact Number</label>
              <input type="tel" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Message</label>
              <textarea class="form-control" id="exampleInputPassword1"></textarea>
            </div>
            <div class="d-grid gap-2">
              <button class="btn" type="button" style=" background-color:#AA0F0A; color: white;">Submit</button>
            </div>

          </form>
        </div>
      </div> -->
      <div class="col">
        <div class="p-3 border bg-light">
          <h1 class="display-5 mb-3">Map:</h1>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3862.642921182897!2d121.05135981486077!3d14.505176583296691!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397cf39b32caa71%3A0x2f877c498fcca642!2sBarangay%20South%20Signal%20Village%20Hall!5e0!3m2!1sen!2sph!4v1655214596871!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- FOOTER-->
@include('footer')