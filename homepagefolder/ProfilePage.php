<?php
session_start();
require '../includes/dbhandler.inc.php';

if (isset($_SESSION['UserID'])) {
  $userID = $_SESSION['UserID'];

  $sql = "SELECT u.*, r.Housenumber, r.streetname, r.cityname, r.postalcode, req.*, dt.DocuName
  FROM users_tbl u 
  INNER JOIN residents_tbl r ON u.residentID = r.residentID
  LEFT JOIN request_tbl req ON u.userID = req.userID
  LEFT JOIN DocuType_tbl dt ON req.DocuType = dt.DocuTypeID
  WHERE u.UserID = ?";
  $stmt = mysqli_stmt_init($conn);
  if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $userID); // Assuming UserID is an integer
    mysqli_stmt_execute($stmt); 
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    } else { 
      echo "User record not found.";
    }
  } else {
    echo "Error: Failed to prepare SQL statement.";
  }
} else {
  header("Location: LogIn.php");
  exit();
}
// Fetch all rows into an array
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
  <title>Profile Page</title>
  <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/bootstrap.css" rel="stylesheet">   
  <link rel="stylesheet" type="text/css" href="assets/css/slick.css">          
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>    
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/profilecss.css" rel="stylesheet">    
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
           <h2>Profile Page</h2>
           <ol class="breadcrumb">
            <li><a href="#">Home</a></li>            
            <li class="active">Profile Page</li>
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
    <div class="container-overlap bg-blue-500 ng-scope">
      <div class="media m0 pv">
        <div class="media-left media-right"><a href="#"> <img src="../uploads/ProfileImages/<?php echo $row['Image']; ?>" alt="<?php echo $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName']. ' ' . $row['Suffix']; ?>" alt="User" class="media-object img-circle thumb120"></a></div>
        <div class="media-body media-middle">
          <h3 class="media-heading text-white">
            <?php 
            echo $row['FirstName'] . ' ' .
            $row['MiddleName'] . ' ' . 
            $row['LastName']. ' ' . 
            $row['Suffix']; 
            $is_verified = $row['IsVerified'];

            if ($is_verified) {
              // Display the "Verified" icon with Bootstrap's success green color
              echo '<svg style="margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1.5%" height="1%">
              <path fill="#28a745" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM241 337l-17 17-17-17-80-80L161 223l63 63L351 159 385 193 241 337z"/>
              </svg>';
            }
            ?> 
          </h3>
          <span class="text-white">Barangay 731 Constituent</span>
        </div>
      </div>
    </div>
    <div class="container-fluid ng-scope">
      <div class="row">
        <!-- Left column-->
        <div class="col-md-7 col-lg-8">
          <form class="card ng-pristine ng-valid">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">About</h4>
              </div>
            </div>
            <div class="card-body" style="margin-bottom: 28px;">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td><em class="ion-document-text icon-fw mr"></em><strong>Full Name</strong></td>
                    <td class="ng-binding"><?php echo $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName'] . ' ' . $row['Suffix']; ?></td>
                  </tr>
                  <tr>
                    <td><em class="ion-egg icon-fw mr"></em><strong>Email</strong></td>
                    <td><span class="ng-scope ng-binding editable"><?php echo $row['Email']; ?></span></td>
                  </tr>
                  <tr>
                    <td><em class="ion-ios-body icon-fw mr"></em><strong>Address</strong></td>
                    <td><span class="ng-scope ng-binding editable"><?php echo $row['Housenumber'] . ', ' . $row['streetname'] . ', ' . $row['cityname'] . ', ' . $row['postalcode']; ?></span></td>
                  </tr>
                  <tr>
                    <td><em class="ion-man icon-fw mr"></em><strong>Phone Number</strong></td>
                    <td><span class="ng-scope ng-binding editable"><?php echo $row['Phone']; ?></span></td>
                  </tr>
                  <tr>
                    <td><em class="ion-android-home icon-fw mr"></em><strong>Registration Date</strong></td>
                    <td><span class="ng-scope ng-binding editable"><?php echo $row['RegistrationDate']; ?></span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="panel-default" style="margin-bottom: 5px;">
              <div class="panel-heading">
                <h4 class="panel-title">Document Requesting</h4>
              </div>
            </div>
            <div class="card-body">
              <div class ="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><strong>Document Type</strong></th>
                      <th><strong>Purpose</strong></th>
                      <th><strong>Request Date</strong></th>
                      <th><strong>Tracking Number</strong></th>
                      <th><strong>Status</strong></th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td><?php echo $row['DocuName']; ?></td>
                        <td><?php echo $row['Purpose']; ?></td>
                        <td><?php echo $row['RequestDate']; ?></td>
                        <td><?php echo $row['TrackingNumber']; ?></td>
                        <td><?php echo $row['Status']; ?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-divider"></div>
          </form>
        </div>
        <!--Manage Profile-->
        <div class="col-md-5 col-lg-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">MANAGE PROFILE</h4>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col" style="margin:5px;">
                  <a class='btn btn-primary btn-block' href=changePassword.php>Change Password</a>
                </div>
              </div>
              <?php
              $is_verified = $row['IsVerified'];
              if (!$is_verified) {
                echo '
                <div class="row">
                <div class="col" style="margin:5px;">
                <a class="btn btn-success btn-block" target="_blank" href="verifyAccount.php">Verify Account</a>
                </div>
                </div>';
              }
              ?>
              <div class="row">
                <div class="col" style="margin:5px;">
                  <a class='btn btn-info btn-block' href='UpdateProfilePage.php?id=<?php echo $row['UserID']; ?>'>Edit Profile</a>
                </div>
              </div>
              <div class="row">
                <div class="col" style="margin:5px;">
                  <form id="deactivateForm" class="btn-block" method="POST">
                    <input type="hidden" name="userID" value="<?php echo $row['UserID']; ?>">
                    <button type="button" id="deactivateBtn2" class="btn btn-danger btn-block mt-2 btn-deactivate">Deactivate Account</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Completed Documents -->
          <div class="card-divider"></div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">Completed Documents</h4>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col" style="margin:8px;">
                  <!-- Content -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Script for Deactivate Button with SweetAlert Confirmation -->
  <script>
    jQuery('#deactivateBtn2').on('click', function(e) {
      e.preventDefault();
      var userID = jQuery(this).closest('form').find('input[name="userID"]').val();

      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, deactivate it!"
      }).then((result) => {
        if (result.isConfirmed) {
          var url = "../includes/deactivateAccount.inc.php?id=" + userID;

          jQuery.ajax({
            url: url,
                method: 'GET', // Use GET method
                success: function(response) {
                  response = JSON.parse(response);
                  if (response.status === 'success') {
                    Swal.fire({
                      title: "Deactivated!",
                      text: "Your account has been deactivated. You will be logged out.",
                      icon: "success"
                    }).then((result) => {
                      window.location.href = "../login.php";
                    });
                  } else {
                    Swal.fire({
                      title: "Error!",
                      text: response.message,
                      icon: "error"
                    });
                  }
                },
                error: function(xhr, status, error) {
                  console.error("AJAX Error:", error);
                  Swal.fire({
                    title: "Error!",
                    text: "Failed to deactivate your account.",
                    icon: "error"
                  });
                }
              });
        }
      });
    });
  </script>
</script>
<script src="assets/js/jquery.min.js"></script>  
<script src="assets/js/bootstrap.js"></script>   
<script type="text/javascript" src="assets/js/slick.js"></script>
<script type="text/javascript" src="assets/js/waypoints.js"></script>
<script type="text/javascript" src="assets/js/jquery.counterup.js"></script>  
<script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
<script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>
<script src="assets/js/custom.js"></script> 
</body>
</html>