@extends('layouts.app')
@section('content')

<!-- Carousel Start -->
<div class="container-fluid p-0 mt-3">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('image/carousel-1.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                        <h1 class="display-3 text-white mb-md-4">Let's Discover The World Together</h1>
                        <a href="/plan" class="btn btn-primary py-md-3 px-md-5 mt-2">My Plans</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('image/carousel-2.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                        <h1 class="display-3 text-white mb-md-4">Discover Amazing Places With Us</h1>
                        <a href="/plan" class="btn btn-primary py-md-3 px-md-5 mt-2">My Plan</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>
<!-- Carousel End -->


<!-- Booking Start -->
<div class="container-fluid booking mt-5 pb-5">
    <div class="container pb-5">
        <div class="bg-light shadow" style="padding: 30px;">
            <div class="row align-items-center" style="min-height: 60px;">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <div class="mb-3 mb-md-0" style="height: 47px;">
                                    <div class="form-group">
                                        <input type="text" class="form-control p-4" placeholder="Plan Name" data-target="#planname"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <div class="date" id="date1" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Depart Date" data-target="#date1" data-toggle="datetimepicker"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <div class="date" id="date2" data-target-input="nearest">
                                    <input type="text" class="form-control p-4 datetimepicker-input" placeholder="Return Date" data-target="#date2" data-toggle="datetimepicker"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3 mb-md-0">
                                <select class="custom-select px-4" style="height: 47px;">
                                    <option selected>Duration</option>
                                    <option value="1">Duration 1</option>
                                    <option value="2">Duration 1</option>
                                    <option value="3">Duration 1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -2px;">New Plan</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Booking End -->

<!-- Feature Start -->
<div class="container-fluid pb-5">
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                        <i class="fa fa-2x fa-money-check-alt text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="">AI-Powered Planning</h5>
                        <p class="m-0">Magna sit magna dolor duo dolor labore rebum amet elitr est diam sea</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                        <i class="fa fa-2x fa-award text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="">Mudah & Cepat</h5>
                        <p class="m-0">Magna sit magna dolor duo dolor labore rebum amet elitr est diam sea</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex mb-4 mb-lg-0">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3" style="height: 100px; width: 100px;">
                        <i class="fa fa-2x fa-globe text-white"></i>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="">Fitur Lengkap</h5>
                        <p class="m-0">Magna sit magna dolor duo dolor labore rebum amet elitr est diam sea</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->

<!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Team Kami</h6>
            <h1>Shingeki no Data</h1>
        </div>
        <div class="row">
            <div class="col-4 pb-2">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('image/team-1.jpg') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Nafi Mulyo Kusumo</h5>
                        <p class="m-0">ML Developer</p>
                    </div>
                </div>
            </div>
            <div class="col-4 pb-2">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('image/team-2.jpg') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Syarifa Khairunnisa</h5>
                        <p class="m-0">Copywriter</p>
                    </div>
                </div>
            </div>
            <div class="col-4 pb-2">
                <div class="team-item bg-white mb-4">
                    <div class="team-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('image/team-3.jpg') }}" alt="">
                        <div class="team-social">
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-primary btn-square" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <h5 class="text-truncate">Muhammad Rifqi Syatria</h5>
                        
                        <p class="m-0">Web Developer</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Team End -->

<!-- Blog Start -->
<div class="container-fluid py-4">
    <div class="container pt-5 pb-3">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Blog</h6>
            <h1>Latest From Our Blog</h1>
        </div>
        <div class="row pb-3">
            <div class="col-lg-4 col-md-6 mb-4 pb-2">
                <div class="blog-item">
                    <div class="position-relative">
                        <img class="img-fluid w-100" src="img/blog-1.jpg" alt="">
                        <div class="blog-date">
                            <h6 class="font-weight-bold mb-n1">01</h6>
                            <small class="text-white text-uppercase">Jan</small>
                        </div>
                    </div>
                    <div class="bg-white p-4">
                        <div class="d-flex mb-2">
                            <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                            <span class="text-primary px-2">|</span>
                            <a class="text-primary text-uppercase text-decoration-none" href="">Tours & Travel</a>
                        </div>
                        <a class="h5 m-0 text-decoration-none" href="">Dolor justo sea kasd lorem clita justo diam amet</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 pb-2">
                <div class="blog-item">
                    <div class="position-relative">
                        <img class="img-fluid w-100" src="img/blog-2.jpg" alt="">
                        <div class="blog-date">
                            <h6 class="font-weight-bold mb-n1">01</h6>
                            <small class="text-white text-uppercase">Jan</small>
                        </div>
                    </div>
                    <div class="bg-white p-4">
                        <div class="d-flex mb-2">
                            <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                            <span class="text-primary px-2">|</span>
                            <a class="text-primary text-uppercase text-decoration-none" href="">Tours & Travel</a>
                        </div>
                        <a class="h5 m-0 text-decoration-none" href="">Dolor justo sea kasd lorem clita justo diam amet</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 pb-2">
                <div class="blog-item">
                    <div class="position-relative">
                        <img class="img-fluid w-100" src="img/blog-3.jpg" alt="">
                        <div class="blog-date">
                            <h6 class="font-weight-bold mb-n1">01</h6>
                            <small class="text-white text-uppercase">Jan</small>
                        </div>
                    </div>
                    <div class="bg-white p-4">
                        <div class="d-flex mb-2">
                            <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                            <span class="text-primary px-2">|</span>
                            <a class="text-primary text-uppercase text-decoration-none" href="">Tours & Travel</a>
                        </div>
                        <a class="h5 m-0 text-decoration-none" href="">Dolor justo sea kasd lorem clita justo diam amet</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->


<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- JavaScript Libraries -->
<script src="{{ asset('https://code.jquery.com/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('js/main.js')}}"></script>
@endsection

