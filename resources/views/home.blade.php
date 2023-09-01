<html lang="en">
<!--HEADER -->
@include('head')
<!-- HOME -->
<div class="mb-2 mt-2" style="display: block;">
    <div id="carouselExampleIndicators" class="carousel slide carousel-dark" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset($info[0]->content)}}" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#myModal">
            </div>
            <div class="carousel-item">
                <img src="{{asset($info[1]->content)}}" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#myModal">
            </div>
            <div class="carousel-item">
                <img src="{{asset($info[2]->content)}}" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#myModal">
            </div>
            <div class="carousel-item">
                <img src="{{asset($info[3]->content)}}" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#myModal">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- HTML for the modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <img src="" id="modal-image" class="img-fluid">
        </div>
    </div>
</div>

<script>
    // JavaScript to show the modal and update the image source when an image in the carousel is clicked
    var carouselImages = document.querySelectorAll('#carouselExampleIndicators .carousel-item img');
    var modalImage = document.querySelector('#myModal #modal-image');

    carouselImages.forEach(function(image) {
        image.addEventListener('click', function() {
            modalImage.src = this.src;
            $('#myModal').modal('show');
        });
    });
</script>
<!-- FOOTER-->
@include('footer')