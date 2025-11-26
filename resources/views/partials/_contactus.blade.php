<div id="contact" class="contact-area overflow-hidden default-padding">

    <!-- Section Heading -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="site-heading text-center">
                    <h4>Contact Us</h4>
                    <h2 class="title">What we do?</h2>
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
                        <h2 class="title">Need Help?</h2>
                        <p>Reach out to the world’s most reliable IT services.</p>
                    </div>
                    <form action="assets/mail/contact.php" method="POST" class="contact-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" id="name" name="name" placeholder="Name" type="text">
                                    <span class="alert-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input class="form-control" id="email" name="email" placeholder="Email*" type="email">
                                    <span class="alert-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input class="form-control" id="phone" name="phone" placeholder="Phone" type="text">
                                    <span class="alert-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group comments">
                                    <textarea class="form-control" id="comments" name="comments" placeholder="Please describe what you need."></textarea>
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

                        <!-- Alert Message -->
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
                    <!-- Replace image source with your own image -->
                    <img src="assets/img/contact-side-image.jpg" alt="Contact Illustration" class="img-fluid">
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
                        <h5>Our Location</h5>
                        <p>Database Text Address</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4 mt-md-0">
                <div class="single-contact-info">
                    <div class="icon">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    <div class="info">
                        <h5>Email Us</h5>
                        <p>info@yourdomain.com</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-4 mt-md-0">
                <div class="single-contact-info">
                    <div class="icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="info">
                        <h5>Call Us</h5>
                        <p>+456 456 4443</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Map Full Width -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="map-wrapper">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14767.262289338461!2d70.79414485000001!3d22.284975!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1424308883981"
                        style="border:0; width:100%; height:350px;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</div>
