<div class="about-standard-area overflow-hidden default-padding">
    <!-- Fixed Shape -->
    <div class="fixed-shape">
        {{-- optional shapes --}}
    </div>
    <!-- End Fixed Shape -->

    <div class="container">
        <div class="row align-center">

            {{-- LEFT IMAGE (same style as service image) --}}
            <div class="col-lg-6">
                <div class="service-image-wrapper">
                    @if(!empty($objective?->image))
                        <img
                            src="{{ asset($objective->image) }}"
                            alt="{{ $objective->title }}"
                            class="service-image-fixed"
                        >
                    @else
                        <img
                            src="{{ asset('assets/img/about/4.jpg') }}"
                            alt="Objective Image"
                            class="service-image-fixed"
                        >
                    @endif
                </div>
            </div>

            {{-- RIGHT CONTENT --}}
            <div class="col-lg-6 info">
                <h5>Our Objective</h5>

                <h2 class="title">
                    {{ $objective?->title ?? 'We Help IT Companies Scale Engineering Capacity' }}
                </h2>

                <p>
                    {{ $objective?->description ?? 'Dissuade ecstatic and properly saw entirely sir why laughter endeavor. In on my jointure horrible margaret suitable he followed speedily. Indeed vanity excuse or mr lovers of on. By offer scale an stuff. Blush be sorry no sight sang lose.' }}
                </p>

                <a class="btn btn-theme effect btn-md"
                   href="{{ isset($objective) ? url('/objectives/'.$objective->id) : url('/#objectives') }}">
                    Learn More
                </a>
            </div>

        </div>
    </div>
</div>
