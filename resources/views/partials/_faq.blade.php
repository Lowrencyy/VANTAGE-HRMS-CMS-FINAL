@if($faqs->count())
<div class="faq-area default-padding bg-gray">
<div class="container">
<div class="faq-items">
<div class="row">

<div class="col-lg-5 info">
    <h5>{{ $faqSetting?->subtitle }}</h5>
    <h2 class="title">{{ $faqSetting?->title }}</h2>

    @if($faqSetting?->button_link)
        <a href="{{ $faqSetting->button_link }}" class="btn btn-theme effect btn-md">
            {{ $faqSetting?->button_text }}
        </a>
    @endif
</div>

<div class="col-lg-7">
<div class="faq-content">
<div class="accordion" id="accordionExample">

@foreach($faqs as $index => $faq)
<div class="accordion-item">
    <div class="accordion-header" id="heading{{ $index }}">
        <button class="accordion-button {{ $index ? 'collapsed' : '' }}"
                type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $index }}">
            <strong>?</strong> {{ $faq->question }}
        </button>
    </div>

    <div id="collapse{{ $index }}"
         class="accordion-collapse collapse {{ $index ? '' : 'show' }}">
        <div class="accordion-body">
            {!! nl2br(e($faq->answer)) !!}
        </div>
    </div>
</div>
@endforeach

</div>
</div>
</div>

</div>
</div>
</div>
</div>
@endif
