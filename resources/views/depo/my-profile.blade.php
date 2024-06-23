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
    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

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


<!-- Navbar Start -->
<marquee behavior="scroll" direction="left">Your Marquee Text Here</marquee>

<!-- Navbar Start -->
<div class="container-fluid bg-white sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
            <a href="{{route('depo-welcome',['id'=>$info->id])}}" class="navbar-brand">
                <img class="img-fluid" src="{{asset('img/logo.png')}}" alt="Logo">
            </a>
            <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">

                    <a href="{{route('depo-welcome',['id'=>$info->id])}}" class="nav-item nav-link ">Home</a>
                    <a href="{{route('depo-product',['id'=>$info->id])}}" class="nav-item nav-link">Products</a>
                    <a href="{{route('depo-stores',['id'=>$info->id])}}" class="nav-item nav-link">Store</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Explore</a>
                        <div class="dropdown-menu bg-light rounded-0 m-0">
                            <a href="{{route('depo-features',['id'=>$info->id])}}" class="dropdown-item">Features</a>
                            <a href="{{route('depo-abouts',['id'=>$info->id])}}" class="dropdown-item">About</a>
{{--                            <a href="{{route('depo-stores',['id'=>$info->id])}}" class="dropdown-item">Store</a>--}}
                            <a href="{{route('depo-blogs',['id'=>$info->id])}}" class="dropdown-item">Blog Article</a>
                            <a href="{{route('depo-contacts',['id'=>$info->id])}}" class="dropdown-item">Contact</a>
                            <a href="{{route('depo-testimonials',['id'=>$info->id])}}" class="dropdown-item">Testimonial</a>
                            <a href="{{route('depo-pages',['id'=>$info->id])}}" class="dropdown-item">404 Page</a>
                        </div>
                    </div>


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">{{$info->owner_name}}</a>
                        <div class="dropdown-menu bg-light rounded-0 m-0">
                            <a href="{{route('depo-my_profile',['id'=>$info->id])}}" class="dropdown-item active">My Profile</a>
                            <a href="{{route('depo-order_history',['id'=>$info->id])}}" class="dropdown-item">Order History</a>
                            <a href="{{route('logout')}}" class="dropdown-item">Logout</a>
                        </div>
                    </div>

                </div>
                <div class="border-start ps-4">
                    <a href="{{route('depo-cart',['id'=>$info->id])}}" class="btn btn-sm p-0"><i class="fa-solid fa-cart-shopping"><span class="badge bg-primary">{{$count}}</span></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">My Profile</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
{{--                <li class="breadcrumb-item"><a href="#">My Profile</a></li>--}}
                <li class="breadcrumb-item text-dark" aria-current="page">My Profile</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Article Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- User Information -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        User Information
                    </div>
                    <div class="card-body">
                        <!-- Display user information here -->
                        <div class="mb-3">
                            <strong>Name:</strong> {{$id->name}}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> {{$id->email}}
                        </div>
                        <div class="mb-3">
                            <strong>Phone:</strong> 0{{$info->mobile}}
                        </div>
                        <div class="mb-3">
                            <strong>Address:</strong> {{$info->address}}, {{$info->city}}
                        </div>
                        <div class="mb-3">
                            <strong>Owner Name:</strong> {{$info->owner_name}}
                        </div>
                        <div class="mb-3">
                            <strong>Trade Licence:</strong> {{$info->trade_lic}}
                        </div>
                        <div class="mb-3">
                            <strong>Action:</strong> Active
                        </div>
                        <!-- Add more user information as needed -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Profile Picture -->
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        Profile Picture
                    </div>
                    <div class="card-body text-center">
                        @if(isset($info->pic))
                            <img src="{{asset('storage/'.$info->pic)}}" alt="Profile Picture" class="img-fluid rounded-circle" style="max-width: 300px;" />

                        <!-- Display profile picture or initials -->
                        @else
                        <div id="profile-display">
                            <!-- JavaScript will populate this div -->

                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Check if profile picture is set
                    // Replace "$profilePic" with your server-side variable

                    // If profile picture is set, display it

                        // If profile picture is not set, display first name and last name initials
                        var firstName = "{{$id->name}}"; // Replace with the actual first name
                        var lastName = "Doe"; // Replace with the actual last name
                        var initials = firstName.charAt(0).toUpperCase();
                        document.getElementById('profile-display').innerHTML = '<div style="font-size: 48px;">' + initials + '</div>';

                });
            </script>
            <!-- Edit Button (outside user info and profile pic) -->
            <div class="col-12 text-center">
                <a href="{{route('depo-account_settings',['id'=>$info->id])}}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
</div>









<!-- Article End -->


<!-- Footer Start -->
<div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary mb-4">Our Office</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>+012 345 67890</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>info@example.com</p>
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
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary mb-4">Quick Links</h4>
                <a class="btn btn-link" href="">About Us</a>
                <a class="btn btn-link" href="">Contact Us</a>
                <a class="btn btn-link" href="">Our Services</a>
                <a class="btn btn-link" href="">Terms & Condition</a>
                <a class="btn btn-link" href="">Support</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary mb-4">Business Hours</h4>
                <p class="mb-1">Monday - Friday</p>
                <h6 class="text-light">09:00 am - 07:00 pm</h6>
                <p class="mb-1">Saturday</p>
                <h6 class="text-light">09:00 am - 12:00 pm</h6>
                <p class="mb-1">Sunday</p>
                <h6 class="text-light">Closed</h6>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-primary mb-4">Newsletter</h4>
                <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                <div class="position-relative w-100">
                    <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                           placeholder="Your email">
                    <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                </div>
            </div>
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
<script src="{{asset('lib/wow/wow.min.js')}}"></script>
<script src="{{asset('lib/easing/easing.min.js')}}"></script>
<script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

<!-- Template Javascript -->
<script src="{{asset('js/main.js')}}"></script>
</body>

</html>

