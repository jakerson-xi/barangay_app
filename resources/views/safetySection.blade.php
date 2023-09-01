<html lang="en">
<!--HEADER -->
@include('head')
<!-- SAFETY SECTION -->
<!-- SAFETY SECTION -->
<div class="mb-2 mt-2" style="display: block;">
  <div id="carouselExampleControls" class="carousel slide carousel-dark" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{asset('assets/imgs/mapBook/mapBook1.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/imgs/mapBook/mapBook2.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/imgs/mapBook/mapBook3.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/imgs/mapBook/mapBook4.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/imgs/mapBook/mapBook5.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/imgs/mapBook/mapBook6.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/imgs/mapBook/mapBook7.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/imgs/mapBook/mapBook8.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/imgs/mapBook/mapBook9.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/imgs/mapBook/mapBook10.jpg')}}" class="d-block w-100" alt="..." onclick="showImage(this)">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<img src="your-image-source" onclick="showImage(this)" />

<script>
  function showImage(imgElement) {
    // create a new element to show the image
    var newImg = document.createElement("img");
    newImg.src = imgElement.src;

    // set the CSS style for the new element
    newImg.style.position = "fixed";
    newImg.style.top = 0;
    newImg.style.left = 0;
    newImg.style.width = "100%";
    newImg.style.height = "100%";
    newImg.style.objectFit = "contain";
    newImg.style.zIndex = 9999;
    newImg.style.backgroundColor = "rgba(0,0,0,0.8)";

    // add the new element to the document
    document.body.appendChild(newImg);

    // add an event listener to remove the new element when it is clicked
    newImg.addEventListener("click", function() {
      document.body.removeChild(newImg);
    });
  }
</script>



<!-- FOOTER-->
@include('footer')