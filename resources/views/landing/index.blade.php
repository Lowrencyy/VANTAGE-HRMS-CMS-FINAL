<x-layout>
   @include('partials._header')
   @include('partials._hero')
   @include('partials._mission')


   <div class="thumb-services-area carousel-shadow relative bg-cover mt-5">
    <div class="container mt-5">
            <div class="row mt-5">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h2 class="title">OUR OBJECTIVES</h2>
                    </div>
                </div>
            </div>

    </div>

    @include('partials._objective')
    
@include('partials._whychoose')

    
    @include('partials._services')

    @include('partials._footer')
</x-layout>