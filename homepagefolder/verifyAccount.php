<?php
session_start();
require '../includes/dbhandler.inc.php';

if (!isset($_SESSION['username'])) {
  header("Location: LogIn.php");
  exit();
}

$username = $_SESSION['username'];

$sql = "SELECT UserID, FirstName, LastName, MiddleName, Suffix, IsVerified FROM users_tbl WHERE Username = ?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
  die('Error: ' . mysqli_error($conn));  
}

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $UserID, $FirstName, $LastName, $MiddleName, $Suffix, $isVerified);

if (!mysqli_stmt_fetch($stmt)) {
  die('Error fetching data: ' . mysqli_stmt_error($stmt)); 
}

mysqli_stmt_close($stmt);

if ($isVerified == 1) {
  header("Location: ../homepagefolder/index.php");
  exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate uploaded image
  if ($_FILES['verification_image']['error'] === UPLOAD_ERR_OK) {
    $file_name = $_FILES['verification_image']['name'];
    $file_tmp = $_FILES['verification_image']['tmp_name'];
    $file_type = $_FILES['verification_image']['type'];
    $file_size = $_FILES['verification_image']['size'];

        // Check if uploaded file is an image
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (in_array($file_type, $allowed_types)) {
            // Save image to local folder
      $upload_dir = '../uploads/VerificationID/';
      $image_name = basename($file_name);
      $image_path = $upload_dir . $image_name;
      move_uploaded_file($file_tmp, $image_path);

      $sql = "INSERT INTO verification_tbl (UserID, FirstName, LastName, MiddleName, Suffix, Username, Image) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
        die('Error: ' . mysqli_error($conn)); 
      }

      mysqli_stmt_bind_param($stmt, "issssss", $UserID, $FirstName, $LastName, $MiddleName, $Suffix, $username, $image_name);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      header("Location: ../homepagefolder/index.php");
      exit();
    } else {
      echo "Error: Please upload only JPEG, PNG, or GIF images.";
    }
  } else {
    echo "Error uploading file.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
  <title>Edit Profile Page</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">

  <!-- Font awesome -->
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">   
  <!-- Slick slider -->
  <link rel="stylesheet" type="text/css" href="assets/css/slick.css">          
  <!-- Fancybox slider -->
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
  <!-- Theme color -->
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">    

  <!-- Main style sheet -->
  <link href="assets/css/style.css" rel="stylesheet">    

  
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
  
  <style>
    .containerVerification {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 80vh;
    }

    .card {
      position: relative;
      font-family: Arial, sans-serif;
      color: #fff;
      background-color: #232743;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.6);
      max-height: 800px;
      max-width: 600px;
      width: 100%;
    }

    .card img {
      position: absolute; 
      top: -15%;
      left: 50%; 
      transform: translateX(-50%); 
      max-width: calc(100% - 20px); 
      max-height: calc(100% - 20px); 
    }

    h1 {
      margin-top: 250px;
      text-align: center;
    }

    p {
      text-align: center;
    }

    form {
      margin: 15px;
      padding: 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    input[type="file"] {
      margin-bottom: 20px;
      background-color: #fff; 
      border: 1px solid #ccc; 
      border-radius: 3px;
      padding: 8px;
      width: 100%;
      box-sizing: border-box; 
      box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.5);
    }

    button[type="submit"] {
      background-color: #fff;
      color: #333333;
      margin-top: 10px;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #232743; 
      color: #fff;
      border: 1px solid #ccc; 
      box-shadow: inset 0 0 8px rgba(255, 255, 255, 0.5);
    }
  </style>
</head>
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
                          <a href="#" class="mu-top-email">
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
           <h2>Profile Page</h2>
           <ol class="breadcrumb">
            <li><a href="#">Home</a></li>            
            <li class="active">Profile Page</li>
            <li class="active">Edit Profile Page</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End breadcrumb -->

<!-- Start contact  -->
<section id="mu-contact">
 <div class="container">
   <div class="row">
     <div class="col-md-12">
       <div class="mu-contact-area">
        <!-- Verification Card-->
        <div class="containerVerification">
          <div class="card">
            <img src="assets/img/verify-image.png" alt="Verify-Image" />
            <h1>Verify Your Account</h1>
            <p>Please upload a picture for your account's verification.</p>
            <form action="verifyaccount.php" method="post" enctype="multipart/form-data" style="color: #000;">
              <input type="file" name="verification_image" accept="image/*" required>
              <button type="submit">Upload</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
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
              <li><a href="index.php">Home</a></li>
              <li><a href="announcement.php">Announcements</a></li>
              <li><a href="#">Online Forms</a></li>
              <li><a href="RequestDocu.php">Request Documents</a></li>
              <li><a href="trackRequestsPage.php">Track Documents</a></li>
              <li><a href="contact.php">Contact Us</a></li>
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
  
  <!-- jQuery library -->
  <script src="assets/js/jquery.min.js"></script>  
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>   
  <!-- Slick slider -->
  <script type="text/javascript" src="assets/js/slick.js"></script>
  <!-- Counter -->
  <script type="text/javascript" src="assets/js/waypoints.js"></script>
  <script type="text/javascript" src="assets/js/jquery.counterup.js"></script>  
  <!-- Mixit slider -->
  <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
  <!-- Add fancyBox -->        
  <script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>
  
  <!-- Custom js -->
  <script src="assets/js/custom.js"></script> 

</body>
</html>