@extends('layouts.kingship')
@section('content')
<section class="hero-wrap-3 js-smallheight" style="background-image: url('{{ asset('images')}}');" data-stellar-background-ratio="0.5">
    <div class="container">
         <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
           <div class="col-md-9 ftco-animate pb-5">
               <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('apartments')}}" style="color: #D4AF37">Properties <i class="ion-ios-arrow-forward"></i></a></span> apartments <span><i class="ion-ios-arrow-forward"></i></span></p>
             <h1 class="mb-3">{{$appartment->title}}</h1>
           </div>
         </div>
       </div>
       
</section>

<section class="ftco-section ftco-appartment-details bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lx-9 col-lg-9 col-sm-12 mb-4 bg-white rounded" > 
            <?php 
            $img = [];
            $img = explode(",", $appartment->photos);
            ?>              
            <img id=featured class="mt-3 main" src="/storage/photos/{{ $img[0] }}">

			<div id="slide-wrapper">
			<div class="slide-one-item home-slider owl-carousel" >
			<div id="slider">
				<ul class="thumbs mt-3">	
					@foreach ($img as $i)
					<img class="thumbnail thumb-img" src=" /storage/photos/{{ $i}}">
					@endforeach
				</ul>

			</div>
			</div>
			</div> 
                      
    <div class="row">
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="icon-bed" style="color: #d4af37;"></span></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Bedrooms
                          <span>5</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="icon-bathtub" style="color: #d4af37;"></span></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Bathrooms
                          <span>5</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-appartment" style="color: #d4af37;"></span></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Parking
                          <span>6</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="icon-pets" style="color: #d4af37;"></span></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Pets
                          <span>Allowed</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="icon-pool" style="color: #d4af37;"></span></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Swimming pool 
                          <span>Available</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        <div class="col-md d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services">
            <div class="media-body py-md-4">
                <div class="d-flex mb-3 align-items-center">
                    <div class="icon d-flex align-items-center justify-content-center" ><span class="flaticon-appartment" style="color: #d4af37;"></span></div>
                    <div class="text">
                      <h3 class="heading mb-0 pl-3">
                          Color
                          <span>Black</span>
                      </h3>
                  </div>
              </div>
            </div>
          </div>      
        </div>
        </div>
        <div class="col-md-12 pills">
                      <div class="bd-example bd-example-tabs">
                          <div class="d-flex justify-content-center">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                              <li class="nav-item">
                                <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Features</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="pills-manufacturer-tab" data-toggle="pill" href="#pills-manufacturer" role="tab" aria-controls="pills-manufacturer" aria-expanded="true">Description</a>
                              </li>
                             
                            </ul>
                          </div>

                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                              <div class="row">
                                  <div class="col-md-9">
                                      <ul class="features">
                                          <li class="check"><span class="ion-ios-checkmark"></span>Compound.</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>Laundry Area.</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>Fitted with Quality imported Tiles.</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>Stairs fitted with Marble.</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>The ceiling is T&G timber throughout.</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>3 Covered Carports.</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>Solar water heaters</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>Generator for Power Barkup</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>Kitchen Pantry</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>Big water storage Tanks with pumps to pressurise water to the Bathrooms.</li>
                                          <li class="check"><span class="ion-ios-checkmark"></span>Spacious One (1) Bedroom Guestwing. Has its own Kitchennete.</li>
                                      </ul>
                                  </div>
                                  
                                  
                              </div>
                          </div>

                          <div class="tab-pane fade" id="pills-manufacturer" role="tabpanel" aria-labelledby="pills-manufacturer-tab">
                            <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                                  <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
                          </div>

                         
                        </div>
                      </div>
            </div>

        </div>



        
        <div class="col-xl-3 col-lg-3 col-sm-12 rounded">

            <div class="mb-4 p-4 text-center bg-white rounded">
            	<p class=""> <h4 class="mb-0"> KSh {{$appartment->price}} </h4>  <span> REF-ID:{{$appartment->id}}</span> </p>
            </div>
			<div class="mb-4 p-4 text-center bg-white rounded">
				<p>
					<img src="/storage/users-avatar/{{$appartment->user->avatar}}" alt="Avatar" class="avatar">
				</p>
				 <p> <h3 class="h5 text-black mb-0">{{$appartment->user->firstname}} {{$appartment->user->secondname}}</h3>
				<small class="mt-1"><i class="icon-verified_user"> </i>Verified</small> </p> 

				 <p> <a href="#" class="text-dark" >View profile</a></p>

				 <p><a href="#" class="btn btn-primary py-2 mr-1 w-100"><i class="icon-chat"> </i>Chat</a> </p>	
				

				<p> {{$appartment->user->email}} <a href="#" class="btn btn-primary py-2 mr-1 w-100"><i class="icon-message "></i>SEND EMAIL</a> </p>	
				<p> {{$appartment->user->phone_number}} <a href="#" class="btn btn-primary py-2 mr-1 w-100"><i class="icon-phone"> </i>CALL</a> </p>	

				<p>
				<p> <span><i class="icon-location-arrow mt-1"></i> {{$appartment->county->county_name}}-{{$appartment->city->city}}</span> </p>	
				<p> <span><i class="icon-timer"></i> Posted 2hrs ago</span> </p>	
				<p> <span><i class="icon-eye"></i> 123 ad views</span> </p>	
				</p>

				<p>
				
						<i class="ftco-animate"><a href="#" class="text-dark"><span class="icon-twitter"></span></a></i>
						<i class="ftco-animate"><a href="#" class="text-dark"><span class="icon-facebook"></span></a></i>
						<i class="ftco-animate"><a href="#" class="text-dark"><span class="icon-instagram"></span></a></i>
					 
				</p>

				<p><a href="#" class="btn btn-primary py-2 mr-1 w-100"><i class="icon-heart"> </i>SAVE AS FAVOURITE</a> </p>

				<p><a href="#" class="btn btn-primary py-2 mr-1 w-100"><i class="icon-remove"> </i>REPOERT THIS AD</a> </p>

             
            </div>
         
           


          </div>

      </div>

        
    </div>
  </section>

  <section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
      <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          <span class="subheading">Choose Properties</span>
        <h2 class="mb-2">Related apartments</h2>
      </div>
    </div>
    <div class="col-md-12">
        <div class="carousel-car owl-carousel">
            @foreach ($appartments as $appartment)
                
                      <div class="item">
                          <div class="car-wrap rounded ftco-animate">
                              <div class="img rounded d-flex align-items-end" style="background-image: url({{ strtok($appartment->photos, ',') }});">
                              </div>
                              <div class="text">
                                  <h2 class="mb-0"><a href="#"> {{$appartment->title}}</a></h2>
                                  <div class="d-flex mb-3">
                    <span class="cat">{{$appartment->city->city}}</span>
                    <p class="price ml-auto">Ksh {{$appartment->price}} <span>Negotiable</span></p>
                                  </div>
                <p class="d-flex mb-0 d-block"><a href="{{ route('apartment_details',$appartment->id)}}" class="btn btn-primary py-2 mr-1">Buy now</a> <a href="house-details.html" class="btn btn-secondary py-2 ml-1">Details</a></p>
                              </div>
                          </div>
            </div>

            @endforeach
                  
                  </div>
             </div>
        </div>
    </div>
</section>

  <script type="text/javascript">
    let thumbnails = document.getElementsByClassName('thumbnail')
    
    let activeImages = document.getElementsByClassName('active')
    
    for (var i=0; i < thumbnails.length; i++){
    
      thumbnails[i].addEventListener('click', function(){
          console.log(activeImages)
          
          if (activeImages.length > 0){
              activeImages[0].classList.remove('active')
          }
          
    
          this.classList.add('active')
          document.getElementById('featured').src = this.src
      })
    }        
    </script> 


  @endsection