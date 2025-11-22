<div class="about-content-area default-padding-top">
    <div class="container">
        <div class="row align-center">

            {{-- LEFT IMAGE --}}
            <div class="col-lg-6">
                <div class="thumb">
                    @if($mission->image)
                        <img src="{{ asset($mission->image) }}" 
                             alt="Mission Image" 
                             class="mt-5 rounded">
                    @else
                        <img src="{{ asset('main/assets/img/about/4.jpg') }}" 
                             alt="Default Image" 
                             class="mt-5 rounded">
                    @endif
                </div>
            </div>

            {{-- RIGHT CONTENT --}}
            <div class="col-lg-5 offset-lg-1 info">

                <h2 class="title">{{ $mission->title ?? 'Our Mission & Vision' }}</h2>

                <p>{{ $mission->description ?? 'Default description goes here...' }}</p>

                <div class="content-tabs">

                    {{-- TABS --}}
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active"
                                id="tab_1"
                                data-bs-toggle="tab"
                                data-bs-target="#tabs_1"
                                type="button"
                                role="tab">
                                Our Mission
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                id="tab_2"
                                data-bs-toggle="tab"
                                data-bs-target="#tabs_2"
                                type="button"
                                role="tab">
                                Our Vision
                            </button>
                        </li>
                    </ul>

                    {{-- TAB CONTENT --}}
                    <div class="tab-content" id="myTabContent">

                        {{-- MISSION TEXT --}}
                        <div class="tab-pane fade show active" id="tabs_1" role="tabpanel">
                            <p>{{ $mission->mission ?? 'Default mission text...' }}</p>
                        </div>

                        {{-- VISION TEXT --}}
                        <div class="tab-pane fade" id="tabs_2" role="tabpanel">
                            <p>{{ $mission->vision ?? 'Default vision text...' }}</p>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
