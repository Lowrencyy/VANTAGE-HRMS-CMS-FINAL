<div class="container">
    @if($objectives->isEmpty())
        <h3 class="text-center">No Objectives Found</h3>
    @else
        <div class="services-items services-carousel owl-carousel owl-theme text-center">
            @foreach ($objectives as $objective)
                <div class="item objective-card">
                    {{-- RECTANGLE IMAGE --}}
                    <div class="objective-card-thumb">
                        @if($objective->image)
                            <img
                                src="{{ asset($objective->image) }}"
                                alt="{{ $objective->title }}"
                                class="objective-card-img"
                            >
                        @else
                            {{-- fallback rectangle --}}
                            <img
                                src="{{ asset('main/assets/img/objectives/default-rect.jpg') }}"
                                alt="Objective Image"
                                class="objective-card-img"
                            >
                        @endif
                    </div>

                    {{-- TEXT --}}
                    <div class="info">
                        <h3 class="mt-3">{{ $objective->title }}</h3>
                        <p>{{ $objective->description }}</p>
                        <a href="/objectives/{{ $objective->id }}">
                            Discover More <i class="fas fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
