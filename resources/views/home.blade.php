@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
   
  </head>
  <body>
    <header class="header">
      @if (session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif
      <div class="section__container header__container" id="home">
        <p>Simple - Unique - Friendly</p>
        <h1>Make Yourself At Home<br />In Our <span>Hotel</span>.</h1>
      </div>
    </header>

    <section class="section__container booking__container">
      <form action="/" class="booking__form">
        <div class="input__group">
          <span><i class="ri-calendar-2-fill"></i></span>
          <div>
            <label for="check-in">CHECK-IN</label>
            <input type="text" placeholder="Check In" />
          </div>
        </div>
        <div class="input__group">
          <span><i class="ri-calendar-2-fill"></i></span>
          <div>
            <label for="check-out">CHECK-OUT</label>
            <input type="text" placeholder="Check Out" />
          </div>
        </div>
        <div class="input__group">
          <span><i class="ri-user-fill"></i></span>
          <div>
            <label for="guest">GUEST</label>
            <input type="text" placeholder="Guest" />
          </div>
        </div>
        <div class="input__group input__btn">
          <button class="btn">CHECH OUT</button>
        </div>
      </form>
    </section>

    <section class="section__container about__container" id="about">
      <div class="about__image">
        <img src="{{ asset('images/about.jpg')}}" alt="about" />
      </div>
      <div class="about__content">
        <p class="section__subheader">ABOUT US</p>
        <h2 class="section__header">The Best Holidays Start Here!</h2>
        <p class="section__description">
          With a focus on quality accommodations, personalized experiences, and
          seamless booking, our platform is dedicated to ensuring that every
          traveler embarks on their dream holiday with confidence and
          excitement.
        </p>
        <div class="about__btn">
          <button class="btn">Read More</button>
        </div>
      </div>
    </section>

    <section class="section__container room__container">
      <p class="section__subheader">OUR LIVING ROOM</p>
      <h2 class="section__header">The Most Memorable Rest Time Starts Here.</h2>
      <div class="room__grid">
        @foreach($roomTypes as $roomType)
            <div class="room__card">
              <div class="room__card__image">
                <img src="{{ asset('images/room-1.jpg')}}" alt="{{ $roomType->type }}" />
                <div class="room__card__icons">
                  <span><i class="ri-heart-fill"></i></span>
                  <span><i class="ri-paint-fill"></i></span>
                  <span><i class="ri-shield-star-line"></i></span>
                </div>
              </div>
              <div class="room__card__details">
                <h4>{{ $roomType->type }}</h4>
                <p>{{ $roomType->description }}</p>
                <h5>Starting from <span>${{ $roomType->prix }}/night</span></h5>
                <button class="btn" onclick="window.location.href='{{ route('reservation.index') }}'">Book Now</button>
              </div>
            </div>
        @endforeach
    </div>
    </section>

    <section class="service" id="service">
      <div class="section__container service__container">
        <div class="service__content">
          <p class="section__subheader">SERVICES</p>
          <h2 class="section__header">Strive Only For The Best.</h2>
          <ul class="service__list">
            <li>
              <span><i class="ri-shield-star-line"></i></span>
              High Class Security
            </li>
            <li>
              <span><i class="ri-24-hours-line"></i></span>
              24 Hours Room Service
            </li>
            <li>
              <span><i class="ri-headphone-line"></i></span>
              Conference Room
            </li>
            <li>
              <span><i class="ri-map-2-line"></i></span>
              Tourist Guide Support
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section class="section__container banner__container">
      <div class="banner__content">
        <div class="banner__card">
          <h4>25+</h4>
          <p>Properties Available</p>
        </div>
        <div class="banner__card">
          <h4>350+</h4>
          <p>Bookings Completed</p>
        </div>
        <div class="banner__card">
          <h4>600+</h4>
          <p>Happy Customers</p>
        </div>
      </div>
    </section>

   

    <footer class="footer" id="contact">
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="logo">
            <a href="#home"><img src="{{ asset('images/logo.png')}}" alt="logo" /></a>
          </div>
          <p class="section__description">
            Discover a world of comfort, luxury, and adventure as you explore
            our curated selection of hotels, making every moment of your getaway
            truly extraordinary.
          </p>
          <button class="btn">Book Now</button>
        </div>
        <div class="footer__col">
          <h4>QUICK LINKS</h4>
          <ul class="footer__links">
            <li><a href="#">Browse Destinations</a></li>
            <li><a href="#">Special Offers & Packages</a></li>
            <li><a href="#">Room Types & Amenities</a></li>
            <li><a href="#">Customer Reviews & Ratings</a></li>
            <li><a href="#">Travel Tips & Guides</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>OUR SERVICES</h4>
          <ul class="footer__links">
            <li><a href="#">Concierge Assistance</a></li>
            <li><a href="#">Flexible Booking Options</a></li>
            <li><a href="#">Airport Transfers</a></li>
            <li><a href="#">Wellness & Recreation</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <h4>CONTACT US</h4>
          <ul class="footer__links">
            <li><a href="#">rayalpark@info.com</a></li>
          </ul>
          <div class="footer__socials">
            <a href="#"><img src="{{ asset('images/facebook.png')}}" alt="facebook" /></a>
            <a href="#"><img src="{{ asset('images/instagram.png')}}" alt="instagram" /></a>
            <a href="#"><img src="{{ asset('images/youtube.png')}}" alt="youtube" /></a>
            <a href="#"><img src="{{ asset('images/twitter.png')}}" alt="twitter" /></a>
          </div>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2023 Web Design Mastery. All rights reserved.
      </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../js/main.js"></script>
  </body>
</html>
@endsection
