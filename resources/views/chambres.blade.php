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

   

    <section class="section__container room__container">
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
                <button class="btn" onclick="window.location.href='{{ route('reservation') }}'">Book Now</button>
              </div>
            </div>
        @endforeach
    </div>
    </section>

  


    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="../js/main.js"></script>
  </body>
</html>
@endsection
