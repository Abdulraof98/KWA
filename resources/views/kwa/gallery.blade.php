@extends('layouts.main2')
@section('content')
	
<style>
	   
    
#myImg {

border-radius: 5px;
cursor: pointer;
transition: 0.3s;
}

#myImg:hover {opacity: 0.72}


#myImg2 {

border-radius: 5px;
cursor: pointer;
transition: 0.3s;
}

#myImg2:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1000; /* Sit on top */
padding-top: 100px; /* Location of the box */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
margin: auto;
display: block;
width: 80%;
max-width: 800px;
}

/* Caption of Modal Image */
#caption {
margin: auto;
display: block;
width: 80%;
max-width: 700px;
text-align: center;
color: #ccc;
padding: 10px 0;
height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
-webkit-animation-name: zoom;
-webkit-animation-duration: 0.6s;
animation-name: zoom;
animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
from {-webkit-transform:scale(0)} 
to {-webkit-transform:scale(1)}
}

@keyframes zoom {
from {transform:scale(0)} 
to {transform:scale(1)}
}

/* The Close Button */
.close {
position: absolute;
top: 15px;
right: 35px;
color: #f1f1f1;
font-size: 40px;
font-weight: bold;
transition: 0.9s;
}

.close:hover,
.close:focus {
color: #bbb;
text-decoration: none;
cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
.modal-content {
  width: 100%;
}
}
  
</style>
	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search arewa -->
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg breadcrumb-single-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p class="english">Lets see Our</p>
						<h1>{{__('header.Galleries')}}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
 <!-- Gallery Start -->
 <div class="container-fluid pt-5 pb-3">
        <div class="container">
            <div class="text-center pb-2 section-title" >
                <h3 class=" px-5 english"><span class="px-2">Our Gallery</span></h3>
                <h3 class=" px-5 persian"><span class="px-2">عکس ها</span></h3>
            </div>
            <div class="row portfolio-container">
				@foreach($model as $val)
                <div class="col-lg-3 col-md-6 mb-4 portfolio-item first">
                    <div class="position-relative overflow-hidden mb-2">
                        <img class="img-fluid w-100" onClick='display(this)' src="{{URL::asset('public/uploads/admin/gallery/'.$val->image_name)}}" alt="{{$val->image_title}}">
                        <div class="portfolio-btn bg-primary d-flex align-items-center justify-content-center">
                            <a href="img/portfolio-1.jpg" data-lightbox="portfolio">
                                <!-- <i class="fa fa-plus text-white" style="font-size: 60px;"></i> -->
                            </a>
                        </div>
                    </div>
                </div>
				@endforeach
                
               
                <!-- <div class="col-lg-3 col-md-6 mb-4 portfolio-item first">
                    <div class="position-relative overflow-hidden mb-2">
                        <img class="img-fluid w-100" onClick='display(this)' src="{{URL::asset('public/assets/img/latest-news/gathering4.jpg')}}" alt="">
                        <div class="portfolio-btn bg-primary d-flex align-items-center justify-content-center">
                            <a href="img/portfolio-4.jpg" data-lightbox="portfolio">
                            </a>
                        </div>
                    </div>
                </div> -->
                <!-- <img style="width:30%" id="myImg" class="img-fluid" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg">

					<img style="width:28%" class="img-fluid" src="https://cdn.pixabay.com/photo/2015/06/19/21/24/the-road-815297__340.jpg">
					<img style="width:29%" class="img-fluid" src="https://image.shutterstock.com/image-photo/mountains-during-sunset-beautiful-natural-260nw-407021107.jpg"> -->

                          <!-- The Modal -->
					<div id="myModal" class="modal">
					<span class="close">&times;</span>
					<img class="modal-content" id="modalImg" src="">
						
					<div id="caption"></div>
					</div>
            </div>
        </div>
    </div>
    <!-- Gallery End -->

	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->

	<script>
		// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
// var img = document.getElementById("myImg");
// var modalImg = document.getElementById("modalImg");
var captionText = document.getElementById("caption");
// img.onclick = function(){
//   modal.style.display = "block";
//   modalImg.src = this.src;
//   captionText.innerHTML = this.alt;
// }

var outside = document.getElementsByClassName('.modal');

 function display(obj){
            console.log(obj);
			var modalImg = document.getElementById("modalImg");
			modalImg.src = obj.src;
			modal.style.display = "block";
			captionText.innerHTML = obj.alt
 }
// When the user clicks on <span> (x), close the modal
var span = document.getElementsByClassName("close")[0];
span.onclick = function() { 
  modal.style.display = "none";
}
	</script>
	@stop