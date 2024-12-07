<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" href="builtimages/left_logo.png" type="image/x-icon">
    <style>
        body {
            background: #f6f9fc;
        }

        .account-block {
            background-color: #232743;
            color: #fff;
            height: 100vh;
            padding: 0 !important;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .account-testimonial {
            text-align: center;
            position: absolute;
            bottom: 3rem;
            left: 0;
            right: 0;
        }

        .text-theme {
            color: #232743 !important;
        }

        .btn-theme {
            background-color: #232743;
            color: #fff;
        }

        .carousel {
            height: 100%;
        }

        .carousel-item {
            height: 100%;
            padding: 0;
        }

        .carousel-item img {
            height: 100%;
            object-fit: cover;
            margin: 0;
            padding: 0;
        }

        .eye-active {
            color: #232743 !important;
        }

        .btn-theme:active,
        .btn-theme:focus {
            color: #fff;
        }

        .btn-theme:hover {
            background-color: #007bff;
            color: #fff;
        }

        @media (max-width: 767.98px) {
            .responsive-image {
                margin-top: 5px;
                max-width: 80px;
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 d-none d-lg-inline-block account-block">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="1800">
                    <ol class="carousel-indicators custom-carousel-indicators">
                        <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleControls" data-slide-to="1"></li>
                        <li data-target="#carouselExampleControls" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner overlay">
                        <div class="carousel-item active">
                            <img src="builtimages/2bgimage731.jpg" class="d-block w-100" alt="Slide 1">
                            <div class="account-testimonial">
                                <h4 class="text-white mb-4">Barangay 731</h4>
                                <p class="lead text-white">Login Page</p>
                            </div>
                        </div>
                        <div class="carousel-item overlay">
                            <img src="builtimages/1bgimage731.jpg" class="d-block w-100" alt="Slide 2">
                            <div class="account-testimonial">
                                <h4 class="text-white mb-4">The Barangay Officials</h4>
                                <p class="lead text-white">Login Page</p>
                            </div>
                        </div>
                        <div class="carousel-item overlay">
                            <img src="builtimages/3bgimage731.jpg" class="d-block w-100" alt="Slide 3">
                            <div class="account-testimonial">
                                <h4 class="text-white mb-4">Along the Streets of Barangay 731</h4>
                                <p class="lead text-white">Login Page</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-6" style="margin-top: 20px;">
                <div class="p-5 mt-5 mt-lg-0 mt-lg-4">
                    <!-- Logo -->
                    <img src="builtimages/left_logo.png" alt="brgy731_logo" class="mx-auto d-block mb-4 float-right responsive-image" style="width: 110px; margin-top: -8px;">
                    <div class="mb-4">
                        <h3 class="h2 font-weight-bold text-theme"> Login </h3>
                    </div>
                    <h6 class="h5 mb-0"> Welcome back! </h6>
                    <p class="text-muted mt-4 mb-4">
                        <?php
                        if (isset($_GET['error'])) {
                            $errorMessage = $_GET['error'];
                            echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
                        }

                        if (isset($_GET['password_changed']) && $_GET['password_changed'] === 'success') {
                            echo '<div class="alert alert-success">Password changed successfully! Please Log-In again!</div>';
                          }
                        ?>
                    </p>
                    <form action="includes/login.inc.php" method="post">
                        <div class="form-group">
                            <label for="InputUsername">Username</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div> 
                                <input type="text" class="form-control" id="InputUsername" name="username" required>                      
                            </div>
                        </div>
                            <div class="form-group mb-4">
                                <label for="InputPassword">Password</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>                                    
                                    <input type="password" class="form-control" id="passwordField" name="password" required>

                                    <!-- Checkbox for toggling password visibility -->
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span id="showPasswordIcon" class="far fa-eye-slash" onclick="togglePasswordVisibility()"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-theme btn-block mb-4" id="loginButton" name="login"> Login </button>
                        <a href="register.php" class="text-center forgot-link text-primary">Forgot Password?</a>
                    </form>

                    <hr>
                    <p class="text-muted text-center mt-2"> Don't have an account?
                        <a href="Register.php" class="text-primary ml-2">Register</a>
                    </p>
                    <p class="text-muted text-center mt-2"> © 2024 Barangay 731. All rights reserved. </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.carousel').carousel();
        });
    </script>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("passwordField");
            var icon = document.getElementById("showPasswordIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        }
    </script>
</body>

</html>