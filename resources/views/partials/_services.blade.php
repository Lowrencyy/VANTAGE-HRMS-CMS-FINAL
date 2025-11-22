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

    <div class="container ">
        <div class="services-items services-carousel owl-carousel owl-theme text-center">
            @if(count($services) == 0) 
                <p>No Services Found</p>
            @endif

            @foreach ($services as $service)  <!-- Change $services to $service -->
                <div class="item">
                    <div class="icon">
                        <img src="{{ asset('main/assets/img/icon/1.png') }}" alt="Icon">
                    </div>
                    <div class="info">
                        <h4>{{ $service['title'] }}</h4>  <!-- Change $services to $service -->
                        <p>
                          {{ $service['description'] }}  <!-- Change $services to $service -->
                        </p>
                        <a href="/services/{{ $service['id'] }}">Discover More <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
