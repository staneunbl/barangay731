<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
            height: 100vh;
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
            background-color: #007bff; /* black */
            color: #fff; /* white */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col d-none d-lg-inline-block account-block">
                <div class="overlay"></div>

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
                                <p class="lead text-white">Registration Page</p>
                            </div>
                        </div>
                        <div class="carousel-item overlay">
                            <img src="builtimages/1bgimage731.jpg" class="d-block w-100" alt="Slide 2">
                            <div class="account-testimonial">
                                <h4 class="text-white mb-4">The Barangay Officials</h4>
                                <p class="lead text-white">Registration Page</p>
                            </div>
                        </div>
                        <div class="carousel-item overlay">
                            <img src="builtimages/3bgimage731.jpg" class="d-block w-100" alt="Slide 3">
                            <div class="account-testimonial">
                                <h4 class="text-white mb-4">Along the Streets of Barangay 731</h4>
                                <p class="lead text-white">Registration Page</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only"> Previous </span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only"> Next </span>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="container" style="max-width: 550px;">
                    <div class="pl-md-5 mt-md-5 pt-3 mt-5 mb-3 mb-md-0">
                        <img src="builtimages/left_logo.png" alt="brgy731_logo" class="mx-auto d-block mb-4 float-right" style="width: 100px;"> </img>                    
                        <div class="mb-5">
                            <h3 class="h2 font-weight-bold text-theme mb-3"> Registration </h3>
                            <h6 class="h5"> Complete the form below </h6>
                        </div>
                            <?php
                            if (isset($_GET['error'])) {
                                $error = $_GET['error'];
                                if ($error === "usernameExists") {
                                    echo "<script>$(document).ready(function() { $('#usernameExistsModal').modal('show'); });</script>";
                                } elseif ($error === "residentsNotFound") {
                                    echo "<script>$(document).ready(function() { $('#residentNotFoundModal').modal('show'); });</script>";
                                }
                            }
                            ?>
                        <!-- Form starts -->
                        <form action="includes/register.inc.php" method="post" onsubmit="return validatePassword()">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">First Name</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="inputFirstName" name="FirstName" required>            
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputLastName">Last Name</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="inputLastName" name="LastName" required>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputFirstName">Middle Name</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="inputMiddleName" name="MiddleName" >
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputLastName">Suffix</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="inputSuffix" name="Suffix" > 
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control form-control-sm" id="inputEmail" name="Email" required>  
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPhone">Mobile Phone</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="inputPhone" name="Phone" pattern="09[0-9]{9}" title="Please enter a valid mobile phone number starting with 09 and containing 11 digits." required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="inputUsername" name="Username" required>        
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPassword">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control form-control-sm" id="inputPassword" name="Password" required>          
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputConfirmPassword">Confirm Password</label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control form-control-sm" id="inputConfirmPassword" name="ConfirmPassword" required>                                    
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnreg" class="btn btn-theme btn-block mt-2 mb-4"> Register </button>
                        </form>
                        <!-- Form ends -->
                        <hr>
                        <p class="text-muted text-center mt-2"> Already have an account? <a href="login.php" class="text-primary ml-2"> Login </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Resident Not Found -->
    <div class="modal" id="residentNotFoundModal" tabindex="-1" role="dialog" aria-labelledby="residentNotFoundModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="residentNotFoundModalLabel"> Resident Not Found </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    The resident with the provided information was not found. Please check the details and try again.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Username Exists -->
    <div class="modal" id="usernameExistsModal" tabindex="-1" role="dialog" aria-labelledby="usernameExistsModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="usernameExistsModalLabel"> Username Exists </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    The chosen username already exists. Please choose a different username.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Confirm Password -->
    <div class="modal" id="confirmPasswordModal" tabindex="-1" role="dialog" aria-labelledby="confirmPasswordModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmPasswordModalLabel"> Confirm Password </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Password and confirm password do not match. Please try again.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

        function validatePassword() {
            var password = document.getElementById("inputPassword").value;
            var confirmPassword = document.getElementById("inputConfirmPassword").value;
            var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()-_+=])(?=.*[^\w\d]).{8,}$/;

            if (!passwordPattern.test(password)) {
                alert("Password must contain at least one digit, one lowercase letter, one uppercase letter, one special character, and have a minimum length of 8 characters.");
                return false;
            }

            if (password !== confirmPassword) {
                $('#confirmPasswordModal').modal('show');
                return false;
            }

            return true;
        }
    </script>
    <script>
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var error = urlParams.get('error');

            if (error === "residentsNotFound") {
                $('#residentNotFoundModal').modal('show');
            } else if (error === "usernameExists") {
                $('#usernameExistsModal').modal('show');
            }
        });
    </script>  
    
</body>
</html>