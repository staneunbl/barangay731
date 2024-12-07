<?php
session_start();

require '../includes/dbhandler.inc.php';

$username = "";

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

  $sql = "SELECT users_tbl.UserID, users_tbl.LastName, users_tbl.FirstName, users_tbl.MiddleName, residents_tbl.Birthday, residents_tbl.ResidentID, users_tbl.IsVerified
  FROM users_tbl
  LEFT JOIN residents_tbl ON users_tbl.UserID = residents_tbl.residentID
  WHERE Username = ?";

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

    // Check if user exists
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $isVerified = $row['IsVerified'];
    $lastName = $row['LastName'];
    $firstName = $row['FirstName'];
    $middleName = $row['MiddleName'];
        $userId = $row['UserID']; // Assigning UserID here
        $userId = $row['ResidentID'];// Retrieve ResidentID from resident_tbl
        $birthday = $row['Birthday']; // Retrieve birthday from resident_tbl
      } else {
        echo "User not found.";
      }
      $stmt->close();
    } else {
      header("Location: ../login.php");
      exit();
    }

    if (isset($_GET['success_message'])) {
      $successMessage = $_GET['success_message'];
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">    
      <title>Requesting Documents</title>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
      <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">
      <link href="assets/css/font-awesome.css" rel="stylesheet">
      <link href="assets/css/bootstrap.css" rel="stylesheet">   
      <link rel="stylesheet" type="text/css" href="assets/css/slick.css">          
      <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
      <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">    
      <link href="assets/css/style.css" rel="stylesheet"> 
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>  
      <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
    </head>
    <style>
      .flex-box-this{
        -webkit-box-pack: justify;
        justify-content: space-between;
        display: -webkit-box ;
        display: flex;
        position: relative;
      }

      .liner {
        height: 2px;
        background: #ddd;
        position: absolute;
        width: 70%;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 35%;
      }

      span.round-tabs {
        width: 70px;
        height: 70px;
        line-height: 70px;
        display: inline-block;
        border-radius: 100px;
        background: white;
        font-size: 25px;

        border: 2px solid #ddd;
        color: #555555;
      }

      li.active span.round-tabs {
        color: #5bc0de;
        border: 2px solid #5bc0de;
      }

      span.round-tabs:hover {
        color: #736e6e;
        border: 2px solid #736e6e;
      }

      .nav-tabs > li {
        margin-bottom: -6px;
      }

      .nav-tabs > li.active:after {
        content: " ";
        display: inline-block;
        border: 12px solid transparent;
        border-bottom-color: #5bc0de;
      }

      .nav-tabs > li a {
        margin: 0 auto;
        border-radius: 100%;
        padding: 0;
      }

      @media ( max-width: 768px ) {
        span.round-tabs {
          font-size: 16px;
          width: 50px;
          height: 50px;
          line-height: 50px;
        }

      }
      
      hr {
        margin-top: 10px;
        margin-bottom: 10px;
        border-top: 1px solid #eee;
      }

      select,
      input[type="text"],
      input[type="date"] {
        font-size: 15px;
        padding: 8px
        height: 38px;
      }

      .custom-swal-container {
        font-size: 25px !important;
      }

      .custom-swal-content {
        font-size: 20px !important;
      }

      .custom-swal-popup {
        width: 400px !important;
        height: auto;
      }

      .swal2-confirm,
      .swal2-deny,
      .swal2-cancel {
        font-size: 14px !important;
      }
      .swal2-modal {
        top: -10%;
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
               <h2>Document Request</h2>
               <ol class="breadcrumb">
                <li><a href="#">Home</a></li>            
                <li class="active">Document Request</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- End breadcrumb -->
    <section id="mu-contact">
      <div class="container">
        <form id="submitrequestForm" action="../includes/RequestDocu.inc.php" method="post">
          <section class="board">
            <div class="board-inner">
              <ul class="nav nav-tabs flex-box-this" id="myTab">
                <span class="liner"></span>
                <li class="text-center active">
                  <a class="" data-toggle="tab" href="#tab1" aria-expanded="false">
                    <span class="round-tabs " data-toggle="tooltip" title="" data-original-title="Choose">
                      <i aria-hidden="true" class="fa fa-user"></i>
                    </span>
                  </a>
                </li>
                <li class="text-center">
                  <a data-toggle="tab" href="#tab2" aria-expanded="false">
                    <span class="round-tabs" data-toggle="tooltip" title="" data-original-title="Fill-up">
                      <i aria-hidden="true" class="fa fa-file"></i>
                    </span>
                  </a>
                </li>
                <li class="text-center">
                  <a data-toggle="tab" href="#tab3" aria-expanded="false">
                    <span class="round-tabs" data-toggle="tooltip" title="" data-original-title="Completion">
                      <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane in active fade" id="tab1">
                <?php if (!isset($_SESSION['username']) || $isVerified !== 1): ?>
                  <!-- Display message for unverified users -->
                  <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Only verified users can request documents. 
                    <a href="VerifyAccount.php">Click here to verify your account</a>
                  </div>
                <?php else: ?>
                  <!-- tab 1 -->
                  <div class="form-group" style="margin-top: 20px;">
                    <label for="requestFor" class="fw-bold" style="font-size: 17px;">Who are you requesting for?</label>
                    <select name="requestFor" id="requestFor" class="form-control" style="height: 50px;">
                      <option value="self" style="font-size: 17px;">Myself</option>
                      <option value="others" style="font-size: 17px;">Someone else</option>
                    </select>
                  </div>
                  <!-- Submit button -->
                  <div class="text-right">
                    <button type="submit" id="submitBtn1" class="btn btn-primary">Proceed/Magpatuloy</button>
                  </div>
                <?php endif; ?>
              </div>
              <!-- tab 2 -->
              <div class="tab-pane fade" id="tab2">
                <div class="alert alert-info">
                  <i class="fa fa-info-circle" aria-hidden="true"></i><strong> Complete the Form.</strong> Fill in the necessary details.
                  <hr>
                  <i class="fa fa-info-circle" aria-hidden="true"></i><strong> Kumpletuhin ang Form.</strong> Punan ang mga kinakailangang detalye.
                </div>

                <div class="form-group">
                  <label for="docuType">Document Type:</label>
                  <select name="docuType" id="docuType" class="form-control" style="height: 50px;">
                    <?php
                    $sql = "SELECT DocuTypeID, DocuName FROM DocuType_tbl";
                    $result = $conn->query($sql);

                            // Populate dropdown options
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["DocuTypeID"] . "' style='font-size: 16px;'>" . $row["DocuName"] . "</option>";
                      }
                    } else {
                      echo "<option value=''>No document types available</option>";
                    }
                    ?>
                  </select>
                </div>
                <!--Relationship with  -->
                <div class="additional-fields" style="display: none;">
                  <div class="form-group">
                    <label for="relationshipWith">Relationship with the person:</label>
                    <select name="relationshipWith" id="relationshipWith" class="form-control" style="height: 50px;">
                      <option value="mother" style="font-size: 16px;">Mother</option>
                      <option value="father" style="font-size: 16px;">Father</option>
                      <option value="daughter" style="font-size: 16px;">Daughter</option>
                      <option value="son" style="font-size: 16px;">Son</option>
                    </select>
                  </div>
                </div>
                <!-- Purpose -->
                <div class="form-group">
                  <label for="purpose">Purpose:</label>
                  <input type="text" id="purpose" name="purpose" class="form-control" required>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <!-- Last Name -->
                    <div class="form-group">
                      <label for="lastName">Last Name:</label>
                      <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $lastName; ?>" disabled required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <!-- First Name -->
                    <div class="form-group">
                      <label for="firstName">First Name:</label>
                      <input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo $firstName; ?>" disabled required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <!-- Middle Name -->
                    <div class="form-group">
                      <label for="middleName">Middle Name:</label>
                      <input type="text" id="middleName" name="middleName" class="form-control" value="<?php echo $middleName; ?>" disabled required>
                    </div>
                  </div>
                </div>

                <!-- Birthday -->
                <div class="form-group">
                  <label for="birthday">Birthday:</label>
                  <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo $birthday; ?>" disabled required>
                </div>

                <!-- Hidden User ID -->
                <input type="hidden" name="userId" value="<?php echo $userId; ?>">
                <!-- Hidden Resident ID -->
                <input type="hidden" name="residentId" value="<?php echo $residentId; ?>">
                <hr style="margin: 5px; margin-bottom: 15px;">
                <div class="row">
                  <div class="col-md-6">
                    <!-- Back to Tab 1 Button -->
                    <div class="text-left">
                      <button type="button" class="btn btn-primary" onclick="goToTab1()">Back/Bumalik</button>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- Submit Button -->
                    <div class="text-right">
                      <input type="submit" value="Submit/Ipasa" class="btn btn-primary">
                    </div>
                  </div>
                </div>
              </div>

              <!-- tab 3 -->
              <div class="tab-pane fade" id="tab3">
                <?php if (isset($_SESSION['success_message'])): ?>
                  <div class="alert alert-success">
                    <?php echo $_SESSION['success_message']; ?>
                  </div>
                  <div class="alert alert-info">
                    <ul>
                      <li><i class="fa fa-info-circle" aria-hidden="true"></i> <strong>Pick Up Details:</strong></li>
                      <ul style="list-style-type: none;">
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i> Visit Barangay 731 in person to collect your document.</li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i> Before obtaining your document, you can conveniently track its delivery progress on our <b><a href="trackRequestsPage.php"> [Tracking Page].</a></b></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i> Please ensure to submit your provided Tracking Number to access the tracking information.</li>
                      </ul>
                      <li><i class="fa fa-arrow-right" aria-hidden="true"></i> Additionally, kindly note that a Document Fee of 100 will be applicable.</li>
                    </ul>
                  </div>
                  <div class="alert alert-info">
                    <ul>
                      <li><i class="fa fa-info-circle" aria-hidden="true"></i> <strong>Mga Detalye ng Pag-angkat:</strong></li>
                      <ul style="list-style-type: none;">
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i> Pumunta nang personal sa Barangay 731 upang kunin ang iyong dokumento.</li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i>  Bago makuha ang iyong dokumento, maaari mong madaliang subaybayan ang pagdating nito aming <b><a href="trackRequestsPage.php">[Tracking Page].</a></b></li>
                        <li><i class="fa fa-arrow-right" aria-hidden="true"></i> Mangyaring tiyakin na isumite ang iyong ibinigay na Tracking Number upang ma-access ang impormasyon sa pagsubaybay.</li>
                      </ul>
                      <li><i class="fa fa-arrow-right" aria-hidden="true"></i> Bukod dito, pakitandaan na mayroong Document Fee na nagkakahalaga ng 100.</li>
                    </ul>
                  </div>
                  <div class="text-center">
                    <div class="btn-group" role="group" aria-label="Button group">
                      <a href="../homepagefolder/RequestDocu.php" class="btn btn-primary" style="margin-right: 10px;">Back to Document Requesting</a>
                      <a href="../homepagefolder/index.php" class="btn btn-primary">Go to Homepage</a>
                    </div>
                  </div>
                  <?php
                  unset($_SESSION['success_message']);
                  ?>
                <?php endif; ?>
              </div>
            </div>
          </section>
        </form>
      </div>
    </section>

    <!-- Start footer -->
    <footer id="mu-footer">
      <!-- start footer top -->
      <div class="mu-footer-top">
        <div class="container">
          <div class="row text-center">           
            <div class="col-lg-12 col-sm-12 col-xs-12">
              <div class="footer_menu" style="margin-top: 14px;">
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById('submitrequestForm').addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
          title: "Do you want to submit the form?",
          icon: "question",
          showDenyButton: true,
          confirmButtonText: "Submit",
          denyButtonText: `Don't Submit`,
          customClass: {
                    // Apply custom classes for sizing
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
                    var formData = new FormData(document.getElementById('submitrequestForm')); // Get form data
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '../includes/RequestDocu.inc.php', true);
                    xhr.onload = function() {
                      if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                                // Redirect to tab 3 after successful submission
                          window.location.href = "../homepagefolder/RequestDocu.php?tab=tab3&success_message=" + encodeURIComponent("Request submitted successfully!");
                        } else {
                                // Handle errors if any
                          Swal.fire("Error", response.message, "error");
                        }
                      } else {
                            // Handle errors if any
                      }
                    };
                    xhr.send(formData);
                  } else if (result.isDenied) {
                    Swal.fire("Form is not submitted!", "", "info");
                  }
                });
      });
    });
  </script>

  <!--   Script for confirmDeactivation -->
  <script>
    function confirmDeactivation() {
      return confirm("Are you sure you want to deactivate your account? Notice: You are going to be logged out.");
    }
  </script>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>
  <script>
  // When the form is submitted
    document.getElementById('submitBtn1').addEventListener('click', function(event) {
    // Prevent default form submission behavior
      event.preventDefault();

    // Show tab 2
      $('#myTab a[href="#tab2"]').tab('show');
    });
  </script>

  <script>
  // JavaScript function to switch to tab 1
    function goToTab1() {
      $('#myTab a[href="#tab1"]').tab('show');
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Check if the URL contains the 'tab' parameter
      var urlParams = new URLSearchParams(window.location.search);
      var tabParam = urlParams.get('tab');
      
      // If the 'tab' parameter is set to 'tab3', activate the third tab
      if (tabParam === 'tab3') {
        $('a[href="#tab3"]').tab('show');
      }
    });
  </script>

  <!-- Request For Someone Else toggle -->
  <script>
    document.getElementById('requestFor').addEventListener('change', function() {
      var requestForValue = this.value;
      var tab2Fields = document.getElementById('tab2').querySelectorAll('.additional-fields');
      var lastnameField = document.getElementById('lastName');
      var firstnameField = document.getElementById('firstName');
      var middlenameField = document.getElementById('middleName');
      var birthdayField = document.getElementById('birthday');
      var relationshipWithField = document.getElementById('relationshipWith');

      if (requestForValue === 'others') {
        tab2Fields.forEach(function(field) {
          field.style.display = 'block';
        });
        lastnameField.disabled = false;
        firstnameField.disabled = false;
        middlenameField.disabled = false;
        birthdayField.disabled = false;
        relationshipWithField.disabled = false;
      } else {
        tab2Fields.forEach(function(field) {
          field.style.display = 'none';
        });
        lastnameField.disabled = true;
        firstnameField.disabled = true;
        middlenameField.disabled = true; 
        birthdayField.disabled = true;
        relationshipWithField.value = 'self';
      }
    });
  </script>

  <!--script for tabs validation-->
  <script>
    var formSubmitted = false;

    function isFormCompleted() {
      var docuType = document.getElementById('docuType').value;
      var purpose = document.getElementById('purpose').value;
      var lastName = document.getElementById('lastName').value;
      var firstName = document.getElementById('firstName').value;
      var middleName = document.getElementById('middleName').value;
      var birthday = document.getElementById('birthday').value;

      return docuType !== '' && purpose !== '' && lastName !== '' && firstName !== '' && middleName !== '' && birthday !== '';
    }

    function updateTabLinks() {
      var formCompleted = isFormCompleted();
      var formSubmitted = formCompleted && submitted; 
      var tabLinks = document.querySelectorAll('#myTab li a');

      tabLinks.forEach(function(link, index) {
      if (index === 0) { // Tab 1
        link.removeAttribute('disabled');
        link.setAttribute('data-toggle', 'tab');
      } else if (index === 1) { // Tab 2
        if (!formCompleted) {
          link.setAttribute('disabled', 'disabled');
          link.removeAttribute('data-toggle');
        } else {
          link.removeAttribute('disabled');
          link.setAttribute('data-toggle', 'tab');
        }
      } else if (index === 2) { // Tab 3
        link.disabled = !formSubmitted;
        link.setAttribute('data-toggle', formSubmitted ? 'tab' : '');
      }
    });
    }

  // Run the function when the document is loaded
    document.addEventListener('DOMContentLoaded', function() {
      updateTabLinks();

      var formInputs = document.querySelectorAll('#tab2 input, #tab2 select');
      formInputs.forEach(function(input) {
        input.addEventListener('change', function() {
          updateTabLinks();
        });
      });

      var submitBtn = document.getElementById('submitBtn1');
      submitBtn.addEventListener('click', function() {
        formSubmitted = true;
        updateTabLinks();
      });
    });
  </script>

  <!-- jQuery library -->
  <script src="assets/js/jquery.min.js"></script>  
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>    
  <!-- Add fancyBox -->        
  <script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>
  <!-- Custom js -->
  <script src="assets/js/custom.js"></script> 
</body>
</html>