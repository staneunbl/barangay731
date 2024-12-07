<?php
require '../includes/dbhandler.inc.php';

if (isset($_GET['id'])) {
  $userID = $_GET['id'];

  $sql = "SELECT * FROM users_tbl WHERE UserID = $userID";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
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
        <link href="assets/css/profilecss.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <style>
            .swal2-popup {
              font-size: 14px;
          }

          .swal2-modal {
              width: 450px;
              top: -10%;
          }

          .swal2-title {
              font-size: 24px;
          }

          .swal2-content {
              font-size: 18px;
          }

          .userProfileInfo .image {
            position: relative
        }

        .userProfileInfo .image .editImage {
            position: absolute;
            bottom: -27px;
            right: 20px;
            background: #fe5621;
            color: #fff;
            text-align: center;
            font-size: 18px;
            font-size: 1.8rem;
            width: 54px;
            height: 54px;
            line-height: 54px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box
        }

        .userProfileInfo .image .editImage:hover {
            background: #fe693a
        }

        .userProfileInfo .box {
            padding: 0
        }

        .userProfileInfo .box .info,
        .userProfileInfo .box .name,
        .userProfileInfo .box .socialIcons {
            padding: 10px 5px;
            border-bottom: 1px solid #e6e7ed
        }

        .userProfileInfo .box .socialIcons {
            border: 0
        }

        .userProfileInfo .box .info>span {
            margin: 10px 0;
            display: block;
            padding: 0 0 0 35px;
            position: relative
        }

        .userProfileInfo .box .info>span .fa {
            position: absolute;
            left: 5px;
            top: 4px;
            color: #9da2a6
        }

        .boxHeadline {
            margin: 0 0 25px 0;
            font-size: 18px;
            font-size: 1.8rem
        }

        .boxHeadline+.boxHeadlineSub {
            margin: -18px 0 30px 0
        }

        .boxHeader .boxTitle {
            margin: 22px 0 20px 30px
        }

        .boxHeader .boxHeaderOptions {
            margin: 9px 12px 0 0
        }

        .boxHeader .boxHeaderOptions .btn {
            color: #9da2a6;
            padding: 0;
            width: 40px;
            height: 40px;
            line-height: 42px;
            text-align: center;
            font-size: 24px;
            font-size: 2.4rem
        }

        .boxHeader .boxHeaderOptions .btn:active,
        .boxHeader .boxHeaderOptions .btn:focus,
        .boxHeader .boxHeaderOptions .btn:hover {
            background: #f2f9ff;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none
        }

        .boxHeader.pageBoxHeader .boxHeaderOptions {
            margin: 20px 12px 0 0
        }

        .boxHeader.boxHeaderBorders {
            border-bottom: 1px solid #e6e7ed
        }

        .boxHeader.box {
            padding: 30px
        }

        .boxHeader.box .pageTitle {
            margin: 0 0 6px 0
        }

        .boxHeader.box .pageTitle+.breadcrumb {
            margin: 0
        }


        .boxHeadlineSub {
            font-size: 14px;
            font-size: 1.4rem;
            font-weight: 400;
            font-style: italic;
            color: #919599;
            margin: 0 0 25px 0;
            line-height: 18px
        }

        .boxHeadlineSub a {
            color: #fe5621
        }

        .bgTitle {

            background-size: 100% 100%
        }

        .bgTitle .boxTitle {
            margin: 0;
            padding: 22px 30px;
            color: #fff
        }

        .box {
            background: #fff;
            margin: 0 0 24px 0
        }

        .box.box-without-padding {
            padding: 0
        }

        .box.box-without-sidepadding .boxTitle {
            margin-left: 30px
        }

        .box .tableWrap {
            margin: 0 -30px
        }

        .box .table-responsive {
            width: auto
        }

        .box .panel-group:last-of-type {
            margin-bottom: 0
        }

        .boxes {
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .boxes {
                margin: 0;
            }
        }

        input.form-control {
            height: 38px; /* Adjust the height as needed */
            font-size: 16px; /* Adjust the font size as needed */
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
                                                    <a href="../homepagefolder/ProfilePage.php" class="mu-top-email">
                                                        <i class="fa fa-user fa-lg"></i>
                                                        <!-- Profile icon -->
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
                </div>
                <!--/.nav-collapse -->
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
                        <h2>Update Profile Page</h2>
                        <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Profile Page</li>
                            <li class="active">Update Profile Page</li>
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
                        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-md-4 col-lg-4">
                                    <form id="updateProfileForm" action="../includes/updateUserProfile.inc.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="userID" value="<?php echo $row['UserID']; ?>">
                                        <div class="userProfileInfo">
                                            <div class="image">
                                                <img src="../uploads/ProfileImages/<?php echo $row['Image']; ?>?v=<?php echo time(); ?>" alt="<?php echo $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName']. ' ' . $row['Suffix']; ?>" class="img-responsive center-block" style="max-width: 260px;">
                                                <h6 class="text-center" style="margin-top: 20px;">Upload your image here.</h6>
                                                <input type="file" class="center-block well well-sm" style="max-width: 260px;" name="image">
                                            </div>
                                            <div class="box">
                                                <div class="name"><strong><?php echo strtoupper($row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName'] . ' ' . $row['Suffix']); ?></strong></div>
                                                <div class="info">
                                                    <span><i class="fa fa-envelope" aria-hidden="true"></i> <a href="tel:+4210555888777" title="#"><?php echo $row['Email']; ?></a></span>
                                                    <span><i class="fa fa-phone-square" aria-hidden="true"></i> <a href="#" title="#"><?php echo $row['Phone']; ?></a></span>
                                                    <span><i class="fa fa-calendar" aria-hidden="true"></i>Registration Date:<br><?php echo $row['RegistrationDate']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-7 col-lg-7">
                                        <div class="boxes">
                                            <h2 class="boxTitle">Edit Profile</h2>
                                            <hr>
                                            <?php if (isset($error_message)) : ?>
                                                <div class="error">
                                                    <?php echo $error_message; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="container form-horizontal">
                                                <div class="row">
                                                    <!-- edit form column -->
                                                    <div class="col-md-7 col-sm- col-xs-12">
                                                        <div class="form-group">
                                                            <label class="col-lg-3 control-label">First name:</label>
                                                            <div class="col-lg-9">
                                                                <input class="form-control" type="text" name="firstName" value="<?php echo $row['FirstName']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-3 control-label">Last name:</label>
                                                            <div class="col-lg-9">
                                                                <input class="form-control" type="text" name="lastName" value="<?php echo $row['LastName']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-3 control-label">Middle name:</label>
                                                            <div class="col-lg-9">
                                                                <input class="form-control" type="text" name="middleName" value="<?php echo $row['MiddleName']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-3 control-label">Suffix:</label>
                                                            <div class="col-lg-9">
                                                                <input class="form-control" type="text" name="suffix" value="<?php echo $row['Suffix']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-3 control-label">Username:</label>
                                                            <div class="col-lg-9">
                                                                <input class="form-control" type="text" name="username" value="<?php echo $row['Username']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-3 control-label">Email:</label>
                                                            <div class="col-lg-9">
                                                                <input class="form-control" type="text" name="email" value="<?php echo $row['Email']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Phone:</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" type="text" name="phone" value="<?php echo $row['Phone']; ?>">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="text-right">
                                                            <a href="ProfilePage.php" style="margin-right: 5px;" class="btn btn-info">Back to Profile</a>
                                                            <input class="btn btn-primary" value="Save Changes" type="submit">
                                                        </div>
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

<script>
    document.getElementById('updateProfileForm').addEventListener('submit', function(event) {
            // Prevent default form submission
      event.preventDefault();
                var formData = new FormData(this); // Get form data
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../includes/updateUserProfile.inc.php', true);
                xhr.onload = function() {
                  if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                      Swal.fire({
                        title: response.message,
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = 'ProfilePage.php';
                      }
                  });
                } else {
                  Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error"
                });
              }
          } else {
            // Handle errors if any
            Swal.fire({
              title: "Error",
              text: "Server Error",
              icon: "error"
          });
        }
    };
    xhr.send(formData);
});
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
<?php
} else {
  echo "User record not found.";
}
} else {
  echo "User ID not provided.";
}
?>