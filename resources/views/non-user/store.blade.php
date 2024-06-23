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


    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a87236255f.js" crossorigin="anonymous"></script>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

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
    </style>

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <marquee behavior="scroll" direction="left" style="font-family: Space Grotesk, sans-serif;">Your Marquee Text Here
    </marquee>

    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top" style="font-family: Space Grotesk, sans-serif;">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
                <a href="index.html" class="navbar-brand">
                    <img class="img-fluid" src="img/logo.png" alt="Logo">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">

                        <a href="{{route('home')}}" class="nav-item nav-link ">Home</a>
                        <a href="{{route('products')}}" class="nav-item nav-link">Products</a>
                        <a href="{{route('store')}}" class="nav-item nav-link active">Store</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Explore</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="{{route('feature')}}" class="dropdown-item">Features</a>
                                <a href="{{route('about')}}" class="dropdown-item">About</a>
{{--                                <a href="{{route('store')}}" class="dropdown-item active">Store</a>--}}
                                <a href="{{route('blog')}}" class="dropdown-item">Blog Article</a>
                                <a href="{{route('contact')}}" class="dropdown-item">Contact</a>
                                <a href="{{route('testimonial')}}" class="dropdown-item">Testimonial</a>
                                <a href="{{route('page')}}" class="dropdown-item">404 Page</a>
                            </div>
                        </div>


                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">log in</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="{{route('login')}}" class="dropdown-item">As Customer</a>
                                <a href="{{route('login')}}" class="dropdown-item">As Depo</a>
                            </div>
                        </div>

                    </div>
                    <div class="border-start ps-4">
                        <a href="{{route('cart.view')}}" class="btn btn-sm p-0"><i class="fa-solid fa-cart-shopping"><span class="badge bg-primary"></span></i></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s"
        style="font-family: Space Grotesk, sans-serif;">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown" style="font-family: Space Grotesk, sans-serif;">
                Tea Store</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-dark" aria-current="page">Store</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


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
                                <a href="{{route('single-products',['prod_id'=>$prods->id])}}" class="btn btn-primary rounded-pill py-2 px-4 m-2">More Detail <i
                                        class="fa fa-arrow-right ms-2"></i></a>
                                <form action="{{route('create-orders')}}" method="post">
                                    @csrf
                                    {{--                            <input type="hidden" name="user_id" value="{{$info->id}}">--}}
                                    <input type="hidden" name="product_id" value="{{$prods->id}}">
                                    <input type="hidden" name="role" value="non-users">
                                    <input type="hidden" id="quantity" name="quantity" class="form-control mb-4" min="1" value="1">
                                    <button type="submit" class="btn btn-dark rounded-pill py-2 px-4 m-2">Add to Cart <i
                                            class="fa fa-cart-plus ms-2"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach




                {{--                <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">--}}
                {{--                    <a href="" class="btn btn-primary rounded-pill py-3 px-5">View More Products</a>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <!-- Store End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6" style="font-family: Space Grotesk, sans-serif;">
                    <h4 class="text-primary mb-4" style="font-family: Space Grotesk, sans-serif;">Our Office</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"
                            style="font-family: Space Grotesk, sans-serif;"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"
                            style="font-family: Space Grotesk, sans-serif;"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"
                            style="font-family: Space Grotesk, sans-serif;"></i>info@example.com</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" style="font-family: Space Grotesk, sans-serif;">
                    <h4 class="text-primary mb-4" style="font-family: Space Grotesk, sans-serif;">Quick Links</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6" style="font-family: Space Grotesk, sans-serif;">
                    <h4 class="text-primary mb-4" style="font-family: Space Grotesk, sans-serif;">Business Hours</h4>
                    <p class="mb-1" style="font-family: Space Grotesk, sans-serif;">Monday - Friday</p>
                    <h6 class="text-light" style="font-family: Space Grotesk, sans-serif;">09:00 am - 07:00 pm</h6>
                    <p class="mb-1" style="font-family: Space Grotesk, sans-serif;">Saturday</p>
                    <h6 class="text-light" style="font-family: Space Grotesk, sans-serif;">09:00 am - 12:00 pm</h6>
                    <p class="mb-1" style="font-family: Space Grotesk, sans-serif;">Sunday</p>
                    <h6 class="text-light" style="font-family: Space Grotesk, sans-serif;">Closed</h6>
                </div>
                <div class="col-lg-3 col-md-6" style="font-family: Space Grotesk, sans-serif;">
                    <h4 class="text-primary mb-4" style="font-family: Space Grotesk, sans-serif;">Newsletter</h4>
                    <p style="font-family: Space Grotesk, sans-serif;">Dolor amet sit justo amet elitr clita ipsum elitr
                        est.</p>
                    <!-- <div class="position-relative w-100" style="font-family: Space Grotesk, sans-serif;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4" style="font-family: Space Grotesk, sans-serif;">
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
