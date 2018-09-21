@extends("layouts.app")

@section("content")

<a href="{{ url('/') }}" class="btn btn-default btn-rounded mb-4">Authorize Instagram</a>

@if(count($recentMedia))
  <div class="row">
    @foreach ($recentMedia as $media)
      @php
        $image = $media['images']['standard_resolution']['url'];
        $caption = $media['caption']['text'];
        $created_time = $media['created_time'];
        $link = $media['link'];
        $location = $media['location']['name'];
      @endphp

      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="view overlay" style="height: 260px">
            <img class="card-img-top" src="{{ $image }}" alt="Standard resolution">
            <a href="{{ $link }}" target="_blank">
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>
          <div class="card-body">

            <h4 class="card-title">{{ $caption }}</h4>
            
            <p class="card-text">The image was uploaded {{ ($location) ? "at $location" : "" }} on {{  date('M j, Y h:m', $created_time) }}</p>
            
            <div class="text-center">
              <a href="{{ $link }}" target="_blank" class="btn btn-light-blue btn-md mt-auto mb-0">Read more</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif

@endsection