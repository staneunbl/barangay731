 <?php
session_start(); // Start the session

require '../includes/dbhandler.inc.php';

// Initialize variables
$username = ""; // Set a default value

// Check if the user is logged in
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

  $sql = "SELECT UserID, FirstName, LastName, MiddleName, Suffix, IsVerified, Password FROM users_tbl WHERE Username = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('Error: ' . mysqli_error($conn));  // Output any SQL error
  }

  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $UserID, $FirstName, $LastName, $MiddleName, $Suffix, $isVerified, $storedHashedPassword);

  if (!mysqli_stmt_fetch($stmt)) {
    die('Error fetching data: ' . mysqli_stmt_error($stmt));  // Output any fetch error
  }

  mysqli_stmt_close($stmt);


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
  <title>Contact Page</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/bootstrap.css" rel="stylesheet">   
  <link rel="stylesheet" type="text/css" href="assets/css/slick.css">          
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">    
  <link href="assets/css/style.css" rel="stylesheet">    
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
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
           <h2>Contact Page</h2>
           <ol class="breadcrumb">
            <li><a href="#">Home</a></li>            
            <li class="active">Contact Page</li>
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
        <!-- start title -->
        <div class="mu-title">
          <h2>Get in Touch</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores ut laboriosam corporis doloribus, officia, accusamus illo nam tempore totam alias!</p>
        </div>
        <!-- end title -->
        <!-- start contact content -->
        <div class="mu-contact-content">           
          <div class="row">
            <div class="col-md-6">
              <div class="mu-contact-left">
                <form class="contactform">                  
                  <p class="comment-form-author">
                    <label for="author">Name <span class="required">*</span></label>
                    <input type="text" required="required" size="30" value="" name="author">
                  </p>
                  <p class="comment-form-email">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" required="required" aria-required="true" value="" name="email">
                  </p>
                  <p class="comment-form-url">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject">  
                  </p>
                  <p class="comment-form-comment">
                    <label for="comment">Message</label>
                    <textarea required="required" aria-required="true" rows="8" cols="45" name="comment"></textarea>
                  </p>                
                  <p class="form-submit">
                    <input type="submit" value="Send Message" class="mu-post-btn" name="submit">
                  </p>        
                </form>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mu-contact-right">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1930.75040011998!2d120.9964818!3d14.570515849999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c983096ed53b%3A0xd4434dd4802e9abd!2sBrgy.%20731%2C%20Malate%2C%20Manila%2C%201004%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1713807270275!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
        </div>
        <!-- end contact content -->
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