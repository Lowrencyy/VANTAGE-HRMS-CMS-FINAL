<!-- Start Services Area
============================================= -->
<div class="standard-services-area bg-gray carousel-shadow default-padding">
  
</div>
<!-- End Services Area -->

<!-- Start Works About
============================================= -->
<div class="works-about-area reverse bg-gray overflow-hidden">
    <div class="container">
        <div class="works-about-items default-padding-bottom">
            <div class="row align-center">

                {{-- LEFT IMAGE --}}
              <div class="col-lg-6">
    <div class="thumb service-image-wrapper">
        @if($service->image)
            <img
                src="{{ asset($service->image) }}"
                alt="{{ $service->title }}"
                class="service-image-fixed"
            >
        @else
            {{-- fallback 826x826 placeholder --}}
            <img
                src="{{ asset('assets/img/placeholder/826x826.png') }}"
                alt="Service Image"
                class="service-image-fixed"
            >
        @endif
    </div>
</div>


                {{-- RIGHT CONTENT --}}
                <div class="col-lg-6 info">
                    <h2 class="title">{{ $service->title }}</h2>

                    <p>
                        {{ $service->description }}
                    </p>

                    @php
                        // explode comma-separated checklist to array
                        $items = $service->check_list
                            ? explode(',', $service->check_list)
                            : [];
                    @endphp

                    <ul>
                        {{-- ito ung checkbox na dapat naka explode comma separated --}}
                        @forelse($items as $item)
                            @php $item = trim($item); @endphp
                            @if($item !== '')
                                <li>
                                    <h5>{{ $item }}</h5>
                                </li>
                            @endif
                        @empty
                            <li>
                                <h5>No details available for this service yet.</h5>
                            </li>
                        @endforelse
                    </ul>

                    <a class="btn btn-theme effect btn-sm" href="{{ url('/') }}#services">
                        Back to Services
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
