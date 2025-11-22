<div class="video-area extra-padding text-center default-padding faq-area bg-gray bg-fixed shadow dark text-light"                  
{{-- in this background image --}}
     style="background-image: url({{ asset(str_replace('public/', 'storage/', $why->background_image)) }});">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h5>WHY CHOOSE US?</h5>
                    {{-- banner title  --}}
                    <h2>{{ $why->banner_title ?? 'Why Choose Us' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-shape-bottom">
        <img src="{{ asset('main/assets/img/shape/9.png') }}" alt="Shape">
    </div>
</div>


<div class="features-area overflow-hidden bg-gray default-padding">

    <div class="fixed-shape shape left bottom">
        <img src="{{ asset('main/assets/img/shape/3.png') }}" alt="Shape">
    </div>

    <div class="container">
        <div class="row align-center">

            <div class="col-lg-5 why-us">
                <h5>Why Choose Us?</h5>
                <h2 class="title">{{ $why->title ?? 'Why choose us' }}</h2>
                <p class="text-black">
                    {{ $why->description ?? 'Businesses worldwide choose us because we provide meticulously crafted, scalable, and secure custom IT solutions...' }}
                </p>
            </div>

            <div class="col-lg-7 features-box text-center">
                <div class="row">

                    <div class="col-lg-6 col-md-6 item-grid">
                        <div class="item">
                            <i class="flaticon-cogwheel"></i>
                            <h5><a href="#">{{ $why->solution_title_1 ?? 'The Power of Integrated Expertise' }}</a></h5>
                            <p></p>
                        </div>

                        <div class="item">
                            <i class="flaticon-globe-grid"></i>
                            <h5><a href="#">{{ $why->solution_title_2 ?? 'Philippine-Focused, Global Standards' }}</a></h5>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 item-grid">

                        <div class="item">
                            <i class="flaticon-cloud-storage"></i>
                            <h5><a href="#">{{ $why->solution_title_3 ?? 'Impact Through Empowerment' }}</a></h5>
                            <p></p>
                        </div>

                        <div class="item">
                            <i class="flaticon-backup"></i>
                            <h5><a href="#">{{ $why->solution_title_4 ?? 'Products Built for Measurable Value' }}</a></h5>
                            <p></p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
