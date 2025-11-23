<div class="thumb-services-area carousel-shadow relative bg-cover mt-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="site-heading text-center">
                    <h4>Our Services</h4>
                    <h2 class="title">What we do?</h2>
                </div>
            </div>
        </div>
    </div>

     @if(count($services) == 0) 
                <h3 class="text-center">No Services Found</h3>
            @endif
            
    <div class="container ">
        <div class="services-items services-carousel owl-carousel owl-theme text-center">
           

           @foreach ($services as $service)
    <div class="item service-card">
        {{-- RECTANGLE IMAGE --}}
        <div class="service-card-thumb">
            @if($service->image)
                <img
                    src="{{ asset($service->image) }}"
                    alt="{{ $service->title }}"
                    class="service-card-img"
                >
            @else
                {{-- fallback image kung walang na-upload --}}
                <img
                    src="{{ asset('main/assets/img/services/default-rect.jpg') }}"
                    alt="Service Image"
                    class="service-card-img"
                >
            @endif
        </div>

        <div class="info">
            <h3 class="mt-3">{{ $service->title }}</h3>
            <p>{{ $service->description }}</p>
            <a href="{{ route('services.show', $service->id) }}">
                Discover More <i class="fas fa-angle-right"></i>
            </a>
        </div>
    </div>
@endforeach

        </div>
    </div>
</div>
