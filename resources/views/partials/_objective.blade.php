    <div class="container">
        <div class="services-items services-carousel owl-carousel owl-theme text-center">
                
                @if(count($objectives) == 0 ) 
                <p class="text-center">No Objectives Found</p>

                @endif

                @foreach ($objectives as $objective )
                     <div class="item">
                    <div class="icon">
                        <img src="{{ asset('main/assets/img/icon/1.png') }}" alt="Icon">
                    </div>
                    <div class="info">
                        <h4>{{ $objective['title'] }}</h4>
                        <p>
                          {{ $objective['description'] }}
                        </p>
                        <a href="/objectives/{{ $objective['id']}}">Discover More <i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                @endforeach

          
        </div>
    </div>