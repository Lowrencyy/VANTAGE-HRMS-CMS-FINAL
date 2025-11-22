  <div class="top-bar-area inc-pad bg-theme text-light">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6 info">
                    <ul>
                        <li>
                            <i class="fas fa-map-marker-alt"></i> Unit 1702 South Corporate Plaza
                        </li>
                        <li>
                            <a href=""><i class="fas fa-envelope-open"></i> Connect@vantageit.ph</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 text-end item-flex">
                    <div class="info">
                        <ul>
                            <li>
                                <i class="fas fa-clock"></i> Office Hours: 8:00 AM – 6:00 PM
                            </li>
                        </ul>
                    </div>
                    <div class="social">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

   <header id="home">
        <!-- Start Navigation -->
        <nav class="navbar mobile-sidenav navbar-sticky navbar-default validnavs navbar-fixed  no-background">

            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container-xl">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container d-flex justify-content-between align-items-center">            
                

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="/">
                        <img src="{{ asset('main/assets/img/VIT.png') }}" class="logo logo-display" alt="Logo">
                        <img src="{{ asset('main/assets/img/VIT.png') }}" class="logo logo-scrolled" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">

                    <div class="collapse-header">
                        <img src="assets/img/VIT.png" alt="Logo">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    
                    <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="dropdown">
                            <a href="/" >Home</a>
                          
                        </li>
                        <li class="dropdown">
                            <a href="#"  data-toggle="dropdown" >ABOUT US</a>
                        
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >OBJECTIVES</a>
                            <ul class="dropdown-menu">
                                    <li><a href="/objectives" class="text-primary">ALL OBJECTIVES</a></li>
                                @foreach ($objectives as $objective)
                                     <li><a href="/objectives/{{ $objective['id']}}">{{ $objective->title }}</a></li>
                                @endforeach
                               
                               
                            </ul>
                        </li>
                        {{-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >SERVICES</a>
                            <ul class="dropdown-menu">

                                @foreach ($services as $service)
                                <a href="/services/{{ $service->id }}">{{ $service->title }}</a>
                                     
                                @endforeach
                              
                                
                            </ul>
                        </li>  --}}
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" >WHY CHOOSE</a>
                         
                        </li>
                        <li>
                            <a href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->

                <div class="attr-right">
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav attr-box">
                        <ul>
                            <button class="btn btn-primary"><a href="/login">Login</a></button>
                            <li class="side-menu">
                            <a href="#">
                                <span class="bar-1"></span>
                                <span class="bar-2"></span>
                                <span class="bar-3"></span>
                            </a>
                        </li>
                        </ul>
                    </div>
                    <!-- End Atribute Navigation -->
                </div>

                <!-- Start Side Menu -->
                <div class="side">
                    <a href="#" class="close-side"><i class="fas fa-times"></i></a>
                    <div class="widget">
                        <div class="logo">
                            <img src="assets/img/VIT.png" alt="Logo">
                        </div>
                        <p>
                            Arrived compass prepare an on as. Reasonable particular on my it in sympathize. Size now easy eat hand how. Unwilling he departure elsewhere dejection at. Heart large seems may purse means few blind.
                        </p>
                    </div>
                    <div class="widget address">
                        <div>
                            <ul>
                                <li>
                                    <div class="content">
                                        <p>Address</p> 
                                        <strong>California, TX 70240</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="content">
                                        <p>Email</p> 
                                        <strong>support@validtheme.com</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="content">
                                        <p>Contact</p> 
                                        <strong>+44-20-7328-4499</strong>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget newsletter">
                        <h4 class="title">Get Subscribed!</h4>
                        <form action="#">
                            <div class="input-group stylish-input-group">
                                <input type="email" placeholder="Enter your e-mail" class="form-control" name="email">
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>  
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="widget social">
                        <ul class="link">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        </ul>
                    </div>

                </div>
                <!-- End Side Menu -->

            </div>   
            <!-- Overlay screen for menu -->
            <div class="overlay-screen"></div>
            <!-- End Overlay screen for menu -->
        </nav>
        <!-- End Navigation -->
    </header>