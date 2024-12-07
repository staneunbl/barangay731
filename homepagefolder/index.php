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

  // Initialize verification and password messages
  $verificationMessage = "";
  $changePasswordMessage = "";

  // Check if the user is not verified
  if ($isVerified == 0) {
    $verificationMessage = "Please verify your account.";
  } else {
    // Check if the user has the default password
    $defaultPassword = $LastName . 731;

    if (password_verify($defaultPassword, $storedHashedPassword)) {
      $changePasswordMessage = "For security reasons, we recommend changing your password <a href='changePassword.php'>here</a>.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
  <title>Homepage</title>
  <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/bootstrap.css" rel="stylesheet">   
  <link rel="stylesheet" type="text/css" href="assets/css/slick.css">          
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" /><link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">        
  <link href="assets/css/style.css" rel="stylesheet">    
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>

</head>
<style>
  /* Hide the previous and next buttons */
.slick-prev,
.slick-next {
    display: none !important;
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
                          <a href="ProfilePage.php" class="mu-top-email">
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
    
    <!-- Start Slider -->
    <section id="mu-slider">
      <!-- Start single slider item -->
      <div class="mu-slider-single">
        <div class="mu-slider-img">
          <figure>
            <img src="assets/img/header.png" alt="img">
          </figure>
        </div>
        <div class="mu-slider-content">
          <h4>The Official Website of Barangay 731</h4>
          <span></span>
          <?php if(isset($_SESSION['username'])): ?>
            <!-- Display profile icon or username when logged in -->
            <h2>Welcome, <?php echo $_SESSION['username']; ?> !</h2>
            <!-- Verification Message -->
            <div class="verification-message" style="font-size: 18px; color: white; ">
              <?php
              if ($isVerified == 0) {
                        // Check if the user has already submitted the verification form
                $sql_check_verification = "SELECT COUNT(*) FROM verification_tbl WHERE UserID = ?";
                $stmt_check_verification = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt_check_verification, $sql_check_verification)) {
                            die('Error: ' . mysqli_error($conn));  // Output any SQL error
                          }

                          mysqli_stmt_bind_param($stmt_check_verification, "i", $UserID);
                          mysqli_stmt_execute($stmt_check_verification);
                          mysqli_stmt_bind_result($stmt_check_verification, $verification_count);
                          mysqli_stmt_fetch($stmt_check_verification);

                          mysqli_stmt_close($stmt_check_verification);

                          if ($verification_count > 0) {
                            // User has submitted the verification form, display appropriate message
                            echo "Please wait for the admin to verify your account.";
                          } else {
                            // User has not submitted the verification form, display standard verification message
                            echo $verificationMessage . " ";
                            echo "<span style='display: none;'> UserID: " . $UserID . " </span>";
                          }
                        }
                        ?>
                      </div>
                      <!-- Display the Verify button only if it should be displayed -->
                      <?php if ($isVerified == 0 && $verification_count == 0): ?>
                        <form action="../homepagefolder/verifyAccount.php" method="get" id="verificationForm">
                          <!-- Hidden input fields to pass data -->
                          <input type="hidden" name="UserID" value="<?php echo urlencode($UserID); ?>">
                          <input type="hidden" name="FirstName" value="<?php echo urlencode($FirstName); ?>">
                          <input type="hidden" name="LastName" value="<?php echo urlencode($LastName); ?>">
                          <input type="hidden" name="MiddleName" value="<?php echo urlencode($MiddleName); ?>">
                          <input type="hidden" name="Suffix" value="<?php echo urlencode($Suffix); ?>">
                          <button type="submit" name="submit" value="Verify" class="mu-read-more-btn">Verify your account</button>
                        </form>
                      <?php endif; ?>
                      <?php else: ?>
                        <!-- Display default content if not logged in -->
                        <h2>Welcome, Guest</h2>
                        <!-- Add your default content here -->
                      <?php endif; ?>
                      <?php if(isset($_SESSION['username']) && !empty($changePasswordMessage)): ?>
                      <!-- Display the change password message if the user has the default password -->
                      <div class="password-message" style="font-size: 18px;"> 
                        <?php echo $changePasswordMessage; ?>
                      </div>
                      <div class="dashboard-message" style="font-size: 24px; color: white; font-weight: bold;"> This is your Homepage. </div>
                    <?php endif; ?>
                  </div>
                </div>
                <!-- End single slider item -->
                <!-- Start single slider item -->
                <div class="mu-slider-single">
                  <div class="mu-slider-img">
                    <figure>
                      <img src="assets/img/header.png" alt="img">
                    </figure>
                  </div>
                  <div class="mu-slider-content">
                    <!-- Content for third slider item -->
                  </div>
                </div>
                <!-- End single slider item -->
              </section>
              <!-- End Slider -->

              <!-- Start service  -->
              <section id="mu-service">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="mu-service-area">
                        <!-- Start single service -->
                        <a href="index.php">
                          <div class="mu-service-single">
                            <span class="fa fa-check-square-o"></span>
                            <h3>Online Forms Services</h3>
                            <p></p>
                          </div>
                        </a>
                        <!-- Start single service -->
                        <a href="RequestDocu.php" class="mu-service-single">
                          <div>
                            <span class="fa fa-file custom-text-color"></span>
                            <h3 class="custom-text-color">Documents Requests</h3>
                            <p class="custom-text-color"></p>
                          </div>
                        </a>
                        <!-- Start single service -->
                        <a href="trackRequestsPage.php">
                        <div class="mu-service-single">
                          <span class="fa fa-table"></span>
                          <h3>Tracking Documents</h3>
                          <p></p>
                        </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- End service  -->

              <!-- Start about us -->
              <section id="mu-about-us">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mu-about-us-area">           
                        <div class="row">
                          <div class="col-lg-6 col-md-6">
                            <div class="mu-about-us-left">
                              <!-- Start Title -->
                              <div class="mu-title">
                                <h2>About Us</h2>              
                              </div>
                              <!-- End Title -->
                              <p>Barangay 731, situated in the heart of the bustling city, is a vibrant community characterized by its diverse population and dynamic atmosphere. With its rich history and strong sense of unity.</p>
                              <p>At the heart of Barangay 731 lies a tight-knit community, where residents come together to celebrate traditions, support local initiatives, and foster meaningful connections.</p>
                              <p> With its vibrant energy and strong community spirit, Barangay 731 embodies the dynamic essence of urban living.</p>
                            </div>
                          </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="mu-about-us-right">                            
                            <!-- <a id="mu-abtus-video" href="https://www.youtube.com/watch?v=J1Ip2sC_lss" target="_blank"> -->
                              <img src="../builtimages/barangayofficials.jpg" alt="img" class="img-responsive">
                            <!-- </a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <!-- End about us -->

              <!-- Start about us counter -->
              <section id="mu-abtus-counter">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mu-abtus-counter-area">
                        <div class="row">
                          <!-- Start counter item -->
                          <?php
                          require '../includes/dbhandler.inc.php';

                          // Query to get the count of residents
                          $sql = "SELECT COUNT(*) AS numResidents FROM Residents_tbl";
                          $result = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_assoc($result);
                          $numResidents = $row['numResidents'];
                          ?>

                          <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mu-abtus-counter-single">
                              <span class="fa fa-users"></span>
                              <h4><?php echo $numResidents; ?></h4>
                              <p>Residents</p>
                            </div>
                          </div>
                          <!-- End counter item -->
                          <!-- Start counter item -->
                          <?php
                          require '../includes/dbhandler.inc.php';

                          // Query to get the count of residents
                          $sql = "SELECT COUNT(*) AS numHousehold FROM Household_tbl";
                          $result = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_assoc($result);
                          $numHousehold = $row['numHousehold'];
                          ?>

                          <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mu-abtus-counter-single">
                              <span class="fa fa-home"></span>
                              <h4><?php echo $numHousehold; ?></h4>
                              <p>Households</p>
                            </div>
                          </div>
                          <!-- End counter item -->
                          <!-- Start counter item -->
                          <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mu-abtus-counter-single">
                              <span class="fa fa-tasks"></span>
                              <h4>888</h4>
                              <p>Projects</p>
                            </div>
                          </div>
                          <!-- End counter item -->
                          <!-- Start counter item -->
                          <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="mu-abtus-counter-single no-border">
                              <span class="fa fa-building"></span>
                              <h4>88</h4>
                              <p>Businesses</p>
                            </div>
                          </div>
                          <!-- End counter item -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- End about us counter -->

              <!-- Start from blog -->
              <section id="mu-from-blog">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mu-from-blog-area">
                        <!-- start title -->
                        <div class="mu-title">
                          <h2> Announcements</h2>
                          <p>Stay updated with the latest news and important announcements from our barangay, we strive to keep our residents informed and engaged. </p>
                        </div>
                        <!-- end title -->  
                        <!-- start from blog content   -->
                        <div class="mu-from-blog-content">
                          <div class="row">
                            <div class="col-md-4 col-sm-4">
                              <article class="mu-blog-single-item">
                                <figure class="mu-blog-single-img">
                                  <a href="#"><img src="https://static.vecteezy.com/system/resources/previews/005/191/083/non_2x/newspaper-glyph-icon-periodical-publication-silhouette-symbol-negative-space-isolated-illustration-vector.jpg" alt="img"></a>
                                  <figcaption class="mu-blog-caption">
                                    <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                  </figcaption>                      
                                </figure>
                                <div class="mu-blog-description">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ipsum non voluptatum eum repellendus quod aliquid. Vitae, dolorum voluptate quis repudiandae eos molestiae dolores enim.</p>
                                  <a class="mu-read-more-btn" href="#">Read More</a>
                                </div>
                              </article>
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <article class="mu-blog-single-item">
                                <figure class="mu-blog-single-img">
                                  <a href="#"><img src="https://static.vecteezy.com/system/resources/previews/005/191/083/non_2x/newspaper-glyph-icon-periodical-publication-silhouette-symbol-negative-space-isolated-illustration-vector.jpg" alt="img"></a>
                                  <figcaption class="mu-blog-caption">
                                    <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                  </figcaption>                      
                                </figure>
                                <div class="mu-blog-description">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ipsum non voluptatum eum repellendus quod aliquid. Vitae, dolorum voluptate quis repudiandae eos molestiae dolores enim.</p>
                                  <a class="mu-read-more-btn" href="#">Read More</a>
                                </div>
                              </article>
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <article class="mu-blog-single-item">
                                <figure class="mu-blog-single-img">
                                  <a href="#"><img src="https://static.vecteezy.com/system/resources/previews/005/191/083/non_2x/newspaper-glyph-icon-periodical-publication-silhouette-symbol-negative-space-isolated-illustration-vector.jpg" alt="img"></a>
                                  <figcaption class="mu-blog-caption">
                                    <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                                  </figcaption>                      
                                </figure>
                                <div class="mu-blog-description">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ipsum non voluptatum eum repellendus quod aliquid. Vitae, dolorum voluptate quis repudiandae eos molestiae dolores enim.</p>
                                  <a class="mu-read-more-btn" href="#">Read More</a>
                                </div>
                              </article>
                            </div>
                          </div>
                        </div>     
                        <!-- end from blog content   -->   
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- End from blog -->

              <!-- Start latest course section -->
              <section id="mu-latest-courses">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="mu-latest-courses-area">
                        <!-- Start Title -->
                        <div class="mu-title">
                          <h2>Barangay Officials</h2>
                          <p>In Barangay 731, we have individuals serving as our Barangay Officials. Committed to the welfare and progress of our barangay, these officials work tirelessly to ensure the smooth functioning of our local government and the well-being of our residents.</</p>
                        </div>
                        <?php
                        // Database connection
                        require '../includes/dbhandler.inc.php';

                        // Fetch data from BarangayOfficials_tbl with join to Positions_tbl
                        $sql = "SELECT bo.*, p.PositionName 
                        FROM BarangayOfficials_tbl bo
                        INNER JOIN Positions_tbl p ON bo.PositionID = p.PositionId
                        WHERE bo.IsArchived = 0";
                        $result = $conn->query($sql);
                        ?>
                        <div id="mu-latest-course-slide" class="mu-latest-courses-content">
                          <?php
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              ?>
                              <div class="col-lg-4 col-md-4 col-xs-12">
                                <div class="mu-latest-course-single">
                                  <figure class="mu-latest-course-img">
                                    <a href="#">
                                      <img src="../uploads/barangayOfficials/<?php echo $row['Image']; ?>" alt="<?php echo $row['LastName']; ?> image" style="max-width: 700px; max-height: 320px;">
                                    </a>
                                  </figure>
                                  <div class="mu-latest-course-single-content">
                                    <h4><a href="#"> <?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></a></h4>
                                    <p><?php echo $row['PositionName']; ?></p> <!-- Display position name -->
                                  </div>
                                </div>
                              </div>
                              <?php
                            }
                          } else {
                            echo "No barangay officials found";
                          }
                              // Close database connection
                          $conn->close();
                          ?>
                          <!-- End latest course content -->
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              <!-- End latest course section -->

              <!-- Start our teacher -->
              <section id="mu-our-teacher">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mu-our-teacher-area">
                        <!-- begain title -->
                        <div class="mu-title">
                          <h2>Contact Persons</h2>
                          <p>Description</p>
                        </div>
                        <!-- end title -->
                        <!-- begain our teacher content -->
                        <div class="mu-our-teacher-content">
                          <div class="row">
                            <div class="col-lg-3 col-md-3  col-sm-6">
                              <div class="mu-our-teacher-single">
                                <figure class="mu-our-teacher-img">
                                  <img src="https://t3.ftcdn.net/jpg/03/53/11/00/360_F_353110097_nbpmfn9iHlxef4EDIhXB1tdTD0lcWhG9.jpg" alt="teacher img">
                                  <div class="mu-our-teacher-social">
                                    <a href="#"><span class="fa fa-facebook"></span></a>
                                    <a href="#"><span class="fa fa-twitter"></span></a>
                                    <a href="#"><span class="fa fa-google-plus"></span></a>
                                  </div>
                                </figure>                    
                                <div class="mu-ourteacher-single-content">
                                  <h4> Organization </h4>
                                  <span>Organization</span>
                                  <p>Description</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                              <div class="mu-our-teacher-single">
                                <figure class="mu-our-teacher-img">
                                  <img src="https://t3.ftcdn.net/jpg/03/53/11/00/360_F_353110097_nbpmfn9iHlxef4EDIhXB1tdTD0lcWhG9.jpg" alt="teacher img">
                                  <div class="mu-our-teacher-social">
                                    <a href="#"><span class="fa fa-facebook"></span></a>
                                    <a href="#"><span class="fa fa-twitter"></span></a>
                                    <a href="#"><span class="fa fa-google-plus"></span></a>
                                  </div>
                                </figure>                    
                                <div class="mu-ourteacher-single-content">
                                  <h4> Organization </h4>
                                  <span>Organization</span>
                                  <p>Description</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                              <div class="mu-our-teacher-single">
                                <figure class="mu-our-teacher-img">
                                  <img src="https://t3.ftcdn.net/jpg/03/53/11/00/360_F_353110097_nbpmfn9iHlxef4EDIhXB1tdTD0lcWhG9.jpg" alt="teacher img">
                                  <div class="mu-our-teacher-social">
                                    <a href="#"><span class="fa fa-facebook"></span></a>
                                    <a href="#"><span class="fa fa-twitter"></span></a>
                                    <a href="#"><span class="fa fa-google-plus"></span></a>
                                  </div>
                                </figure>                    
                                <div class="mu-ourteacher-single-content">
                                  <h4>Organization</h4>
                                  <span>Organization</span>
                                  <p>Description</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6">
                              <div class="mu-our-teacher-single">
                                <figure class="mu-our-teacher-img">
                                  <img src="https://t3.ftcdn.net/jpg/03/53/11/00/360_F_353110097_nbpmfn9iHlxef4EDIhXB1tdTD0lcWhG9.jpg" alt="teacher img">
                                  <div class="mu-our-teacher-social">
                                    <a href="#"><span class="fa fa-facebook"></span></a>
                                    <a href="#"><span class="fa fa-twitter"></span></a>
                                    <a href="#"><span class="fa fa-google-plus"></span></a>
                                  </div>
                                </figure>                    
                                <div class="mu-ourteacher-single-content">
                                  <h4> Full Name </h4>
                                  <span>Kagawad</span>
                                  <p>Description</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> 
                        <!-- End our teacher content -->           
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- End our teacher -->
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
  <script src="assets/js/bootstrap.js"></script>   
  <script type="text/javascript" src="assets/js/slick.js"></script>
  <script type="text/javascript" src="assets/js/waypoints.js"></script>
  <script type="text/javascript" src="assets/js/jquery.counterup.js"></script>  
  <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
  <script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>
  
  <!-- Custom js -->
  <script src="assets/js/custom.js"></script> 

</body>
</html>