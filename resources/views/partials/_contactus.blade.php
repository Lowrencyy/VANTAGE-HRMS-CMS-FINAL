<div id="contact" class="contact-area overflow-hidden default-padding">

    <!-- Section Heading -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="site-heading text-center">
                    <h4>{{ $contact->section_subtitle ?? 'Contact Us' }}</h4>
                    <h2 class="title">{{ $contact->section_title ?? 'What we do?' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form + Image -->
    <div class="container">
        <div class="row align-items-center">

            <!-- Contact Form -->
            <div class="col-lg-6 contact-form-box">
                <div class="content">
                    <div class="heading">
                        <h2 class="title">{{ $contact->need_help_title ?? 'Need Help?' }}</h2>
                        <p>{{ $contact->need_help_subtitle ?? "Reach out to the world’s most reliable IT services." }}</p>
                    </div>

                    {{-- Success / Error Messages (optional) --}}
                    @if(session('success'))
                        <div class="alert alert-success mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control"
                                           id="name"
                                           name="name"
                                           placeholder="Name"
                                           type="text"
                                           value="{{ old('name') }}">
                                    <span class="alert-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control"
                                           id="email"
                                           name="email"
                                           placeholder="Email*"
                                           type="email"
                                           value="{{ old('email') }}">
                                    <span class="alert-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input class="form-control"
                                           id="phone"
                                           name="phone"
                                           placeholder="Phone"
                                           type="text"
                                           value="{{ old('phone') }}">
                                    <span class="alert-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group comments">
                                    <textarea class="form-control"
                                              id="comments"
                                              name="comments"
                                              placeholder="Please describe what you need.">{{ old('comments') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-12">
                                <button type="submit" name="submit" id="submit">
                                    Get a free consultation
                                </button>
                            </div>
                        </div>

                        <!-- Alert Message (if you use JS for AJAX) -->
                        <div class="row">
                            <div class="col-md-12 alert-notification">
                                <div id="message" class="alert-msg"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side Image -->
            <div class="col-lg-6">
                <div class="h-100 d-flex justify-content-center align-items-center">
                    <img src="{{ asset($contact->image_path ?? 'assets/img/contact-side-image.jpg') }}"
                         alt="Contact Illustration"
                         class="img-fluid">
                </div>
            </div>

        </div>

        <!-- Contact Details Row (below the two col-lg-6) -->
        <div class="row mt-5 contact-info-row">
            <div class="col-md-4">
                <div class="single-contact-info">
                    <div class="icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info">
                        <h5>{{ $contact->location_title ?? 'Our Location' }}</h5>
                        <p>{{ $contact->location_text ?? 'Database Text Address' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4 mt-md-0">
                <div class="single-contact-info">
                    <div class="icon">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    <div class="info">
                        <h5>{{ $contact->email_title ?? 'Email Us' }}</h5>
                        <p>{{ $contact->email_text ?? 'info@yourdomain.com' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4 mt-md-0">
                <div class="single-contact-info">
                    <div class="icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info">
                        <h5>{{ $contact->phone_title ?? 'Call Us' }}</h5>
                        <p>{{ $contact->phone_text ?? '+456 456 4443' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Map Full Width -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="map-wrapper">
                    <iframe
                        src="{{ $contact->map_embed }}"
                        style="border:0; width:100%; height:350px;"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</div>
