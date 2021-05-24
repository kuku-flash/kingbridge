@extends('layouts.kingship')
@section('content')
    

<section class="hero-wrap hero-wrap-2 js-fullheight " style="background-image: url('images/carhire5.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Checkout <i class="ion-ios-arrow-forward"></i></span></p>
          <h1 class="mb-3 bread">Checkout</h1>
        </div>
      </div>
    </div>
  </section>

   <!---End of background image section--->




   


<br>

<section class= "ftco-section ">

  
<div class="container">
<div class="col-75">
  <div class="checkout-container">
    <form action="/action_page.php">

      <div class="checkout-row">
        <div class="col-50">
          <h3>Billing Address</h3>
          <label for="fname"><i class="fa fa-user"></i> Full Name</label>
          <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
          <label for="email"><i class="fa fa-envelope"></i> Email</label>
          <input type="text" id="email" name="email" placeholder="john@example.com">
          <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
          <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
          <label for="city"><i class="fa fa-institution"></i> City</label>
          <input type="text" id="city" name="city" placeholder="Nairobi">

          <div class="checkout-row">
            <div class="col-50">
              <label for="state">State</label>
              <input type="text" id="state" name="state" placeholder="NY">
            </div>
          </div>
        </div>

        <div class="col-50">
          <h3>Payment</h3>
          <label for="fname">Accepted Method</label>
          <div class="mpesa-img" style="background-image:url('{{ asset('images/M-Pesa-01.svg')}}');"></div>
          <label for="cname">Name on Mpesa</label>
          <input type="text" id="cname" name="cardname" placeholder="Joshua Mungai">
          <label for="ccnum">Phone number</label>
          <input type="text" id="ccnum" name="cardnumber" placeholder="0703126261">
          <label for="expmonth">Advert Expiry Month</label>
          <input type="text" id="expmonth" name="expmonth" placeholder="September">
          <label for="daypaid">Date of payment</label>
          <input type="text" id="expmonth" name="expmonth" placeholder="September">

          <div class="checkout-row">
            <div class="col-50">
              <label for="expyear">Exp Year</label>
              <input type="text" id="expyear" name="expyear" placeholder="2018">
            </div>
          </div>
        </div>

      </div>
   
  </div>
</div>

<div class="col-25 mt-3">
  <div class="checkout-container">
    <h4>Cart 
      <span class="price" style="color:black">
        <i class="fa fa-shopping-cart"></i> 
        <b>4</b>
      </span>
    </h4>
    <p><a href="#">Gold Package 1</a> <span class="price">ksh 5500</span></p>
    <p><a href="#">Car Ad 1</a> <span class="price">Ksh 500</span></p>
    <p><a href="#">Land Ad 2</a> <span class="price">Ksh 500</span></p>
    <hr>
    <p>Total <span class="price" style="color:black"><b>Ksh 6500</b></span></p>
  </div>
</div>

<label>
  <input type="checkbox" checked="checked" name="sameadr"> Invoice shall be send/attatched to your phone/email after Ad review.
</label>
<input type="submit" value="Continue to checkout" class="btn">
</form>
</div>
</section>





@endsection