    <?php
    session_start();
    require '../includes/dbhandler.inc.php';

    $username = "";

    if (isset($_SESSION['username'])) {
      $username = $_SESSION['username'];
      $sql = "SELECT UserID FROM users_tbl WHERE Username = ?";
      $stmt = $conn->prepare($sql);

      if (!$stmt) {
        die('Error: ' . $conn->error);
      }

      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

      if (!$result) {
        die('Error fetching data: ' . $stmt->error);
      }

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['UserID'];
      } else {
        echo "User not found.";
      }

      $stmt->close();
    } else {
      header("Location: ../login.php");
      exit();
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">    
      <title>Update Profile Page</title>
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
    <style>
      .document-info {
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: bold;
      }

      #mu-track {
        display: inline;
        float: left;
        width: 100%;
      }

      hr {
        margin-top: 10px;
        margin-bottom: 10px;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1); /* You can adjust the color and opacity as needed */
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
                <div class="row" style="margin-top: 5px">
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
               <h2>Track Document Request</h2>
               <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>            
                <li class="active">Track Document Request</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End breadcrumb -->

    <!-- Start contact -->
    <section id="mu-contact" style="background-color: #f8f9fa;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div style="background-color: white; padding: 30px; border: 1px solid #EBEBEB;">
              <h2>Track Document Request</h2>
              <hr>
              <form action="" method="post">
                <div class="input-group mb-3">
                  <input type="text" class="form-control input-lg" id="trackingnumber" name="trackingnumber" style="border-color: #ced4da; margin-right: 10px;">
                  <span class="input-group-btn" style="margin-left: 10px;">
                    <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                  </span>
                </div>
                <input type="hidden" name="userId" value="<?php echo $userId; ?>">
              </form>
            </div>
          </div>
        </div>
      </section>

      <?php 
// Show tracking details when form is successfully submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['userId']) && isset($_POST['trackingnumber'])) {
          $userId = mysqli_real_escape_string($conn, $_POST['userId']);
          $trackingNumber = mysqli_real_escape_string($conn, $_POST['trackingnumber']);

          $sql = "SELECT r.*, d.DocuName 
          FROM request_tbl r 
          JOIN docutype_tbl d ON r.DocuType = d.DocuTypeID 
          WHERE r.UserId = ? AND r.TrackingNumber = ?";
          $stmt = $conn->prepare($sql);

          if (!$stmt) {
            die('Error: ' . $conn->error);
          }

          $stmt->bind_param("is", $userId, $trackingNumber);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

              echo '<section id="mu-track" style="background-color: #f8f9fa;">';
              echo '  <div class="container">';
              echo '    <div class="row">';
              echo '      <div class="col-md-12">';
              echo '';
              echo '        <!-- Content -->';
              echo '        <div class="panel panel-default">';
              echo '          <div class="panel-heading">';
              echo '            <h4 class="panel-title">Document Requesting Information:</h4>';
              echo '          </div>';
              echo '          <div class="panel-body">';
              echo '            <strong> Document Type: </strong> ' . $row['DocuName'] . '<br>';
              echo '            <strong> Purpose:</strong> ' . $row['Purpose'] . '<br>';
              echo '            <strong> Request Date:</strong> ' . $row['RequestDate'] . '<br>';
              echo '            <strong> Status:</strong> ' . $row['Status'] . '<br>';
              echo '          </div>';
              echo '        </div>';
              echo '      </div>';
              echo '    </div>';
              echo '  </div>';
              echo '</section>';

        // Start Announcement Alert

              echo '<section id="mu-track" style="background-color: #f8f9fa;">';
              echo '<div class="container">';
              echo '<div class="row" style="margin-bottom: 30px;">';

              echo '<div class="col-md-12">';

              echo '<div class="alert alert-info alert-dismissible" role="alert">';
              echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
              echo '<div class="media">';
              echo '<div class="media-left">';
              echo '<span class="glyphicon glyphicon-info-sign glyphicon-lg" aria-hidden="true"></span>';
              echo '</div>';
              echo '<div class="media-body">';
              echo '<h4 class="media-heading">Maaari na lamang na dalhin ang kahit anong <b>VALID ID</b> ninyo upang ipakita sa barangay.</h4>';
              echo '<p>Note: mayroong Document Fee na nagkakahalagang Php 100</p>';
              echo '<hr>';
              echo '<h4 class="media-heading">Please bring any of your <b>VALID ID</b> to the barangay.</h4>';
              echo '<p>Note: there will be a Document Fee for Php 100</p>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</section>';
        // End Announcement Alert
            }
          } else {
            echo '<section id="mu-track" style="background-color: #f8f9fa;">';
            echo '<div class="container">';
            echo '<div class="row" style="margin-bottom: 30px;">';

            echo '<div class="col-md-12">';

            echo '<div class="alert alert-danger alert-dismissible" role="alert">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            echo '<div class="media">';
            echo '<div class="media-left">';
            echo '<span class="glyphicon glyphicon-info-sign glyphicon-lg" aria-hidden="true"></span>';
            echo '</div>';
            echo '<div class="media-body">';
            echo '<h4 class="media-heading">No matching tracking number found for the user.</h4>';
            echo '<hr>';
            echo '<h4 class="media-heading">Hindi natagpuan ang katugmang numero ng pagtutukoy para sa user.</h4>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</section>';
          }

          $stmt->close();
        } else {
          echo "Invalid request.";
        }
      }
      ?>

      <!-- Start footer -->
      <footer id="mu-footer">
        <!-- start footer top -->
        <div class="mu-footer-top">
          <div class="container">   
            <div class="row text-center">           
              <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="footer_menu" style="margin-top: 20px;">
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


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>