    <div class="container">
           @if(count($objectives) == 0 ) 
                <h3 class="text-center">No Objectives Found</h3>

                @endif
        <div class="services-items services-carousel owl-carousel owl-theme text-center">
                
             

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