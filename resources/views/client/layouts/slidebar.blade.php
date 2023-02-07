{{-- Slide bar --}}
<div id="carouselSondz" class="carousel slide mt-5 w-60" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselSondz" data-slide-to="0" class="active"></li>
      <li data-target="#carouselSondz" data-slide-to="1"></li>
      <li data-target="#carouselSondz" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      @foreach ($slides as $item)
        <div class="carousel-item @if($loop->first) active @endif">
          <img class="d-block w-100" src="{{ config('app.url') . $item->image }}" alt="slide">
        </div>
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselSondz" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselSondz" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>