<?php
session_start();

require '../includes/dbhandler.inc.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $currentPassword = $_POST['current_password'];
  $newPassword = $_POST['new_password'];
  $confirmPassword = $_POST['confirm_password'];

  if ($newPassword !== $confirmPassword) {
    echo json_encode(array("success" => false, "message" => "Passwords do not match"));
    exit();
  }

  $sql = "SELECT Password FROM users_tbl WHERE Username = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo json_encode(array("success" => false, "message" => "Database error"));
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $storedHashedPassword);

  if (!mysqli_stmt_fetch($stmt)) {
    echo json_encode(array("success" => false, "message" => "Failed to fetch data"));
    exit();
  }

  mysqli_stmt_close($stmt);

    // Validate current password
  if (password_verify($currentPassword, $storedHashedPassword)) {
        // Hash the new password
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password in the database
    $updateSql = "UPDATE users_tbl SET Password = ? WHERE Username = ?";
    $updateStmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($updateStmt, $updateSql)) {
      echo json_encode(array("success" => false, "message" => "Database error"));
      exit();
    }

    mysqli_stmt_bind_param($updateStmt, "ss", $hashedNewPassword, $username);
    mysqli_stmt_execute($updateStmt);
    mysqli_stmt_close($updateStmt);

    echo json_encode(array("success" => true, "message" => "Password changed successfully"));
    exit();
  } else {
    echo json_encode(array("success" => false, "message" => "Incorrect current password"));
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
  <title>Change Password Page</title>
  <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/bootstrap.css" rel="stylesheet">   
  <link rel="stylesheet" type="text/css" href="assets/css/slick.css">          
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">    
  <link href="assets/css/style.css" rel="stylesheet">    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>    
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
</head>
<style>
  .swal2-popup {
    font-size: 15px;
  }

  .swal2-modal {
    width: 400px;
    top: -12%;
  }

  .swal2-title {
    font-size: 20px;
  }

  .swal2-content {
    font-size: 16px;
  }
</style>
<body>

  <!--START SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#">
    <i class="fa fa-angle-up"></i>      
  </a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header  -->
  <header id="mu-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="mu-header-area">
            <div class="row" style="margin-top: 8px">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="mu-header-top-left">
                  <div class="mu-top-email">
                    <i class="fa fa-map-marker"></i>
                    <span>1173 Meding Street, Malate </span>
                  </div>
                  <div class="mu-top-phone">
                    <i class="fa fa-phone"></i>
                    <span>888888888888</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="mu-header-top-right">
                  <nav>
                    <ul class="mu-top-social-nav">
                      <div class="mu-header-top-left">
                        <?php if(isset($_SESSION['username'])): ?>
                          <!-- Display profile icon or username when logged in -->
                          <a href="../homepagefolder/ProfilePage.php" class="mu-top-email">
                            <i class="fa fa-user fa-lg"></i> <!-- Profile icon -->
                          </a>
                          <a href="../includes/logout.inc.php" class="mu-profile-link">
                            <div class="mu-top-phone">
                              <span>Logout</span>
                            </div>
                          </a>                          
                        <?php else: ?>
                          <!-- Display Registration link when not logged in -->
                          <a href="../login.php" class="mu-top-email">
                            <div class="">
                              <span>Login</span>
                            </div>
                          </a>                                         
                          <!-- Display login link when not logged in -->
                          <a href="../Register.php" class="mu-profile-link">
                            <div class="mu-top-phone">
                              <span>Register</span>
                            </div>
                          </a>                                     
                        <?php endif; ?>
                      </div>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- End header  -->
  <!-- Start menu -->
  <section id="mu-menu">
    <nav class="navbar navbar-default" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->  
          <!-- <a class="navbar-brand" href="index.php"><i class="fa fa-university"></i><span>Barangay 731</span></a> -->      
          <!-- IMG BASED LOGO  -->
          <a class="navbar-brand" href="index.php"><img src="../builtimages/left_logo.png" style="width:63px; margin-top: -18px" alt="logo"> </a>
          <a class="navbar-brand"> <span style="margin-top: 10px !important">Barangay 731</span> </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
            <li class="active"><a href="index.php">Home</a></li>  
            <li><a href="announcement.php">Announcements</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services<span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="RequestDocu.php">Documents Requesting</a></li>                
                <li><a href="index.php">Online Forms</a></li>                
              </ul>
            </li> 
            <li><a href="trackRequestsPage.php">Track Requests</a></li>
            <li><a href="contact.php">Contact</a></li>            
            <li><a href="#" id="mu-search-icon"><i class="fa fa-search"></i></a></li>
          </ul>                     
        </div><!--/.nav-collapse -->        
      </div>     
    </nav>
  </section>
  <!-- End menu -->
  <!-- Start search box -->
  <div id="mu-search">
    <div class="mu-search-area">      
      <button class="mu-search-close"><span class="fa fa-close"></span></button>
      <div class="container">
        <div class="row">
          <div class="col-md-12">            
            <form class="mu-search-form">
              <input type="search" placeholder="Type Your Keyword(s) & Hit Enter">              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End search box -->
  <!-- Page breadcrumb -->
  <section id="mu-page-breadcrumb">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="mu-page-breadcrumb-area">
           <h2>Change Password Page</h2>
           <ol class="breadcrumb">
            <li><a href="#">Home</a></li>            
            <li class="active">Profile Page</li>
            <li class="active">Change Password Page</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End breadcrumb -->

<!-- Start contact  -->
<section id="mu-contact">
 <div class="mu-contact-area">
   <form id="changePasswordProfile" action="changepassword.php" method="post">
    <div class="container">
      <h2> Change Password <i class="fa fa-lock"></i></h2>
      <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_password'): ?>
        <p style="color: red;">Incorrect current password. Please try again.</p>
      <?php endif; ?>
      <h1 class="page-header" style="margin: 5px !important;"></h1>
      <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top: 40px;">
          <div  style="color: #6c757d; font-size: 16px;">
            <p><i class="fa fa-arrow-right"></i> Enter your current password in the "Current Password" field.</p>
            <p><i class="fa fa-arrow-right"></i> Enter your desired new password in the "New Password" field.</p>
            <p><i class="fa fa-arrow-right"></i> Confirm your new password in the "Confirm New Password" field.</p>
            <p><i class="fa fa-arrow-right"></i> Click on the "Change Password" button to apply changes.</p>
            <p>Make sure to keep your new password safe and secure!</p>
          </div>
        </div>
        <!-- edit form column -->
        <div class="col-md-6 col-sm-6 col-xs-12 personal-info" style="border-left: 1px solid #ccc; border-width: 0.5px;">
          <h3> </h3>
          <div class="form-group">
            <label for="current_password">Current Password:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="current_password" name="current_password" required>
              <span class="input-group-addon" onclick="togglePasswordVisibility('current_password')">
                <i id="current_password_eye" class="glyphicon glyphicon-eye-close"></i>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="new_password">New Password:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="new_password" name="new_password" required>
              <span class="input-group-addon" onclick="togglePasswordVisibility('new_password')">
                <i id="new_password_eye" class="glyphicon glyphicon-eye-close"></i>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="confirm_password">Confirm New Password:</label><br>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" value="Change Password" type="submit" style="margin-right: 5px;">
              <a href="ProfilePage.php" class="btn btn-info">Back to Profile</a>
            </div>
          </div>                    
        </form>
      </div>
    </div>
  </div>
  <h1 class="page-header" style="margin-top: 10px !important;"></h1> 
</div>
</section>
<!-- End contact  -->


<!-- Start footer -->
<footer id="mu-footer">
  <!-- start footer top -->
  <div class="mu-footer-top">
    <div class="container">   
      <div class="row text-center">           
        <div class="col-lg-12 col-sm-12 col-xs-12">
          <div class="footer_menu">
            <ul>
              <li><a href="homepage.php">Home</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Online Forms</a></li>
              <li><a href="#">Track Documents</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>
          <hr>            
          <div class="footer_copyright">
            <div style="font-size: 19px;">&copy; All Right Reserved.</div>
          </div>              
        </div><!--- END COL -->             
      </div><!--- END ROW -->         
    </div><!--- END CONTAINER -->
  </div>
  <!-- end footer top -->
  <!-- start footer bottom -->
<!--     <div class="mu-footer-bottom">
      <div class="container">
        <div class="mu-footer-bottom-area">
          <p>&copy; All Right Reserved. Designed by <a href="http://www.markups.io/" rel="nofollow">MarkUps.io</a></p>
        </div>
      </div>
    </div> -->
    <!-- end footer bottom -->
  </footer>
  <!-- End footer -->

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('changePasswordProfile').addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
          title: "Do you want to change your password?",
          icon: "question",
          showDenyButton: true,
          confirmButtonText: "Change",
          denyButtonText: `Cancel`,
          customClass: {
            container: 'custom-swal-container',
            popup: 'custom-swal-popup',
            header: 'custom-swal-header',
            title: 'custom-swal-title',
            content: 'custom-swal-content',
            actions: 'custom-swal-actions',
            confirmButton: 'custom-swal-confirmButton',
            denyButton: 'custom-swal-denyButton',
          }
        }).then((result) => {
          if (result.isConfirmed) {
                    var formData = new FormData(document.getElementById('changePasswordProfile')); // Get form data
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'changePassword.php', true);
                    xhr.onload = function() {
                      if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                          Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                          }).then(() => {
                            window.location.href = 'includes/logout.inc.php';
                          });
                        } else {
                          Swal.fire("Error", response.message, "error").then(() => {
                            window.location.href = 'changepassword.php';
                          });
                        }
                      } else {
                        Swal.fire("Error", "Server Error", "error").then(() => {
                          window.location.href = 'changepassword.php';
                        });
                      }
                    };
                    xhr.send(formData);
                  } else if (result.isDenied) {
                    Swal.fire("Password change cancelled!", "", "info").then(() => {
                      window.location.href = 'changepassword.php';
                    });
                  }
                });
      });
    });
  </script>
  <script>
    function togglePasswordVisibility(fieldId) {
      var passwordField = document.getElementById(fieldId);
      var eyeIcon = document.getElementById(fieldId + '_eye');

      if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("glyphicon-eye-close");
        eyeIcon.classList.add("glyphicon-eye-open");
      } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("glyphicon-eye-open");
        eyeIcon.classList.add("glyphicon-eye-close");
      }
    }
  </script>
  <script src="assets/js/jquery.min.js"></script>  
  <script src="assets/js/bootstrap.js"></script>   
  <script type="text/javascript" src="assets/js/slick.js"></script>
  <script type="text/javascript" src="assets/js/waypoints.js"></script>
  <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
  <script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>
  <script src="assets/js/custom.js"></script> 
</body>
</html>