<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
  <link rel="stylesheet" href="css/login.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap"
    rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">

    <style>
        .alert {
            padding: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert p {
            margin: 0;
        }

        /* Optional: Add fade-out animation */
        .alert-success {
            animation: fadeOut 1s ease-in-out forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }

    </style>

</head>

<body>

  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="images/tree.jpg" alt="TeanaturE">
        <div class="text">
          <span class="text-1"> <br>TeanaturE</span>
          <span class="text-2">Welcome to our Company </span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="images/tree.jpg" alt="TeanaturE">
        <div class="text">
          <span class="text-1"> <br> to our </span>
          <span class="text-2"> </span>
        </div>
      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Login</div>
            @if(Session::has('success'))
                <div class="alert alert-success" id="success-message">
                    <p>{{ Session::get('success') }}</p>
                </div>
                <script>
                    setTimeout(function(){
                        var successMessage = document.getElementById('success-message');
                        if(successMessage) {
                            successMessage.style.opacity = '0';
                            setTimeout(function(){
                                successMessage.style.display = 'none';
                            }, 1000); // fade out animation duration
                        }
                    }, 10000); // 10 seconds in milliseconds
                </script>
            @endif
            <form action="{{route('loggedIn')}}" method="post">
                @csrf
                @if(request()->has('redirect'))
                    <input type="hidden" name="redirect" value="{{ request()->input('redirect') }}">
                @endif
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" name="email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" name="password" required>
              </div>
              <div class="text"><a href="#">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Log In">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Sign up</label></div>
            </div>
          </form>
        </div>
        <div class="signup-form">
          <div class="title">Signup</div>
          <form action="{{route('register-customer')}}" method="post">
              @csrf
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your name"  name="name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" placeholder="Enter your email" name="email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-mobile"></i>
                <input type="text" placeholder="Enter your mobile number" name="mobile" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password"  name="password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Sign Up">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Log in</label></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
