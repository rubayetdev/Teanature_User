<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TeanaturE</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <script src="https://kit.fontawesome.com/a87236255f.js" crossorigin="anonymous"></script>
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <style>
        p,
        h1,
        h2,
        h3,
        a,
        h4,
        h5,
        h6,
        div,
        strong,
        ol,
        ul,
        li {
            font-family: 'Space Grotesk', sans-serif;
        }

        .discount-overlay {
            position: absolute;
            top: 0;
            left: 0;
            padding: 5px 10px; /* Adjust padding as needed */
            background-color: rgba(255, 0, 0, 0.7);
            border-radius: 5px; /* Optional: Add border radius for better appearance */
        }

        .discount {
            color: white;
            font-size: 14px; /* Adjust font size as needed */
            font-weight: bold;
        }

        .previous-price {
            position: relative;
        }

        .previous-price span {
            text-decoration: line-through;
            position: absolute;
            top: 0;
            left: 0;
            color: #999; /* Adjust color as needed */
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 50%;
            background-color: #007bff;
            color: #fff;
        }


    </style>

</head>

<body>
<!-- Spinner Start -->
<div id="spinner"
     class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
</div>
<!-- Spinner End -->

<marquee behavior="scroll" direction="left" style="font-family: Space Grotesk, sans-serif;color: @if(isset($mar->color)){{$mar->color}}@endif">@if(isset($mar->text)){{$mar->text}}@endif
</marquee>

<!-- Navbar Start -->
<div class="container-fluid bg-white sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
            <a href="{{route('welcome',['id'=>$info->id])}}" class="navbar-brand">
                <img class="img-fluid" src="img/logo.png" alt="Logo">
            </a>
            <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">

                    <a href="{{route('welcome',['id'=>$info->id])}}" class="nav-item nav-link active">Home</a>
                    <a href="{{route('product',['id'=>$info->id])}}" class="nav-item nav-link">Products</a>
                    <a href="{{route('stores',['id'=>$info->id])}}" class="nav-item nav-link">Store</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Explore</a>
                        <div class="dropdown-menu bg-light rounded-0 m-0">
{{--                            <a href="{{route('features',['id'=>$info->id])}}" class="dropdown-item">Features</a>--}}
                            <a href="{{route('abouts',['id'=>$info->id])}}" class="dropdown-item">About</a>
{{--                            <a href="{{route('stores',['id'=>$info->id])}}" class="dropdown-item">Store</a>--}}
                            <a href="{{route('Listblog',['id'=>$info->id])}}" class="dropdown-item">Blog Article</a>
                            <a href="{{route('contacts',['id'=>$info->id])}}" class="dropdown-item">Contact</a>
                            <a href="{{route('testimonials',['id'=>$info->id])}}" class="dropdown-item">Testimonial</a>
{{--                            <a href="{{route('pages',['id'=>$info->id])}}" class="dropdown-item">404 Page</a>--}}
                        </div>
                    </div>


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">{{$info->name}}</a>
                        <div class="dropdown-menu bg-light rounded-0 m-0">
                            <a href="{{route('my_profile',['id'=>$info->id])}}" class="dropdown-item">My Profile</a>
                            <a href="{{route('order_history',['id'=>$info->id])}}" class="dropdown-item">Order History</a>
                            <a href="{{route('logout')}}" class="dropdown-item">Logout</a>
                        </div>
                    </div>

                </div>
                <div class="border-start ps-4">
                    <a href="{{route('cart',['id'=>$info->id])}}" class="btn btn-sm p-0"><i class="fa-solid fa-cart-shopping"><span class="badge bg-primary">{{$count}}</span></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->


<!-- Carousel Start -->
<div class="container-fluid px-0 mb-5">
    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 text-center">
                                <p class="fs-4 text-white animated zoomIn">Welcome to <strong class="text-dark">TEA
                                        House</strong></p>
                                <h1 class="display-1 text-dark mb-4 animated zoomIn">Organic & Quality Tea
                                    Production</h1>
                                <a href="{{route('stores',['id'=>$info->id])}}"
                                   class="btn btn-light rounded-pill py-3 px-5 animated zoomIn">Explore our Products</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 text-center">
                                <p class="fs-4 text-white animated zoomIn">Welcome to <strong class="text-dark">TEA
                                        House</strong></p>
                                <h1 class="display-1 text-dark mb-4 animated zoomIn">Organic & Quality Tea
                                    Production</h1>

                                <a href="{{route('stores',['id'=>$info->id])}}" class="btn btn-light rounded-pill py-3 px-5 animated zoomIn">Buy Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->






<div class="container-fluid product py-5 my-5">
    <div class="container py-5">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Our Products</p>
            <h1 class="display-6">Tea has a complex positive effect on the body</h1>
        </div>
        @foreach($category as $cata)
        <div class="owl-carousel product-carousel wow fadeInUp" data-wow-delay="0.5s">
            <a href="" class="d-block product-item rounded">
                <img src="{{asset('storage/'.$cata->image)}}" alt="{{$cata->name}}">
                <div class="bg-white shadow-sm text-center p-4 position-relative mt-n5 mx-4">
                    <h4 class="text-primary">{{$cata->name}}</h4>
{{--                    <span class="text-body">Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum</span>--}}
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
<!-- Products End -->





<!-- Store Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium fst-italic text-primary">Online Store</p>
            <h1 class="display-6">Want to stay healthy? Choose tea taste</h1>
        </div>
        <div class="row g-4">
            @foreach($product as $prods)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="store-item position-relative text-center">
                    <img class="img-fluid" src="{{asset('storage/'.$prods->image)}}" alt="">
                    <!-- Discount overlay -->
                    @if(isset($prods->discount))
                    <div class="discount-overlay">
                        <span class="discount">{{$prods->discount}}% OFF</span>
                    </div>
                    @endif
                    <div class="p-4">
{{--                        <div class="text-center mb-3">--}}
{{--                            <small class="fa fa-star text-primary"></small>--}}
{{--                            <small class="fa fa-star text-primary"></small>--}}
{{--                            <small class="fa fa-star text-primary"></small>--}}
{{--                            <small class="fa fa-star text-primary"></small>--}}
{{--                            <small class="fa fa-star text-primary"></small>--}}
{{--                        </div>--}}
                        <h4 class="mb-3">{{$prods->name}}</h4>
                        <p>{!! $prods->description !!}</p>
                        <!-- Previous price with strikethrough -->
                        @if(isset($prods->previous_price))
                            <div class="previous-price">
                                <span class="text-secondary">{{$prods->previous_price}}৳</span>
                            </div>
                        @endif
                        <!-- New price -->
                        <h4 class="text-primary">{{$prods->price}}৳</h4>
                    </div>
                    <div class="store-overlay">
                        <a href="{{route('single-products',['prod_id'=>$prods->id,'id'=>$info->id])}}" class="btn btn-primary rounded-pill py-2 px-4 m-2">More Detail <i
                                class="fa fa-arrow-right ms-2"></i></a>
                        <form action="{{route('create_order')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$info->id}}">
                            <input type="hidden" name="product_id" value="{{$prods->id}}">
                            <input type="hidden" name="role" value="users">
                            <input type="hidden" id="quantity" name="quantity" class="form-control mb-4" min="1" value="1">
                            <button type="submit" class="btn btn-dark rounded-pill py-2 px-4 m-2">Add to Cart <i
                                    class="fa fa-cart-plus ms-2"></i></button>
                        </form>
{{--                        <a href="{{route('cart',['id'=>$info->id])}}" class="btn btn-dark rounded-pill py-2 px-4 m-2">Add to Cart <i--}}
{{--                                class="fa fa-cart-plus ms-2"></i></a>--}}
                    </div>
                </div>
            </div>
            @endforeach




            <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{route('stores',['id'=>$info->id])}}" class="btn btn-primary rounded-pill py-3 px-5">View More Products</a>
            </div>
        </div>
    </div>
</div>
<!-- Store End -->





<!-- Footer Start -->
<div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <h4 class="text-primary mb-4">Our Office</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>@if(isset($contact->address)) {{$contact->address}} @endif</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>@if(isset($contact->fphone)) {{$contact->fphone}} @endif</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>@if(isset($contact->femail)) {{$contact->femail}} @endif</p>
{{--                <div class="d-flex pt-3">--}}
{{--                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i--}}
{{--                            class="fab fa-twitter"></i></a>--}}
{{--                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i--}}
{{--                            class="fab fa-facebook-f"></i></a>--}}
{{--                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i--}}
{{--                            class="fab fa-youtube"></i></a>--}}
{{--                    <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i--}}
{{--                            class="fab fa-linkedin-in"></i></a>--}}
{{--                </div>--}}
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-primary mb-4">Quick Links</h4>
                <a class="btn btn-link" href="{{route('abouts',['id'=>$info->id])}}">About Us</a>
                <a class="btn btn-link" href="{{route('contacts',['id'=>$info->id])}}">Contact Us</a>
                <a class="btn btn-link" href="">Our Services</a>
                <a class="btn btn-link" href="">Terms & Condition</a>
                <a class="btn btn-link" href="">Support</a>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="text-primary mb-4">Business Hours</h4>
                <p class="mb-1">Monday - Friday</p>
                <h6 class="text-light">09:00 am - 07:00 pm</h6>
                <p class="mb-1">Saturday</p>
                <h6 class="text-light">09:00 am - 12:00 pm</h6>
                <p class="mb-1">Sunday</p>
                <h6 class="text-light">Closed</h6>
            </div>
{{--            <div class="col-lg-3 col-md-6">--}}
{{--                <h4 class="text-primary mb-4">Newsletter</h4>--}}
{{--                <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>--}}
{{--                <div class="position-relative w-100">--}}
{{--                    <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"--}}
{{--                           placeholder="Your email">--}}
{{--                    <button type="button"--}}
{{--                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Copyright Start -->
<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                &copy; <a class="fw-medium" href="https://www.teanature.com">TeanaturE</a>, All Right Reserved.
            </div>
            <div class="col-md-6 text-center text-md-end">
                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                Designed & Developed By <a class="fw-medium" href="https://trodev.com">Trodev</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
        class="bi bi-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>
