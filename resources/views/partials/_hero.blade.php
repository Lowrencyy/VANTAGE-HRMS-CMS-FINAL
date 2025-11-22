{{-- Hero Banner Section --}}
<div class="banner-area auto-height text-color inc-shape" id="hero">
    <div class="item">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6">
                    <div class="content">
                        <h2 class="wow fadeInDown font-banner">{{ $banner->title ?? 'Default Title' }} <strong>{{ $banner->subtitle ?? 'Vantage IT' }}</strong></h2>
                        <p class="wow fadeInLeft">{{ $banner->description ?? 'Default Description: Please Edit This is only a place holder ' }}</p>
                        <a class="btn circle btn-theme effect btn-md wow fadeInUp" href="{{ $banner->button_link ?? '#' }}">
                            {{ $banner->button_text ?? 'Get Started' }} <i class="fas fa-long-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 thumb">
                    {{-- Check if image exists, otherwise use default logo --}}
                    <img class="wow fadeInUp" 
                         src="{{ asset($banner->image ?? 'storage/default-image.png') }}" 
                         alt="Thumb">
                </div>
            </div>
        </div>
    </div>
</div>
