 <?php
 session_start(); 
 require '../includes/dbhandler.inc.php';

 $username = ""; 
 if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

  $sql = "SELECT UserID, FirstName, LastName, MiddleName, Suffix, IsVerified, Password FROM users_tbl WHERE Username = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    die('Error: ' . mysqli_error($conn)); 
  }

  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $UserID, $FirstName, $LastName, $MiddleName, $Suffix, $isVerified, $storedHashedPassword);

  if (!mysqli_stmt_fetch($stmt)) {
    die('Error fetching data: ' . mysqli_stmt_error($stmt)); 
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
  <title>Announcement Page</title>

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
  

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
               <h2>Announcement Page</h2>
               <ol class="breadcrumb">
                <li><a href="#">Home</a></li>            
                <li class="active">Announcements</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End breadcrumb -->
    <section id="mu-course-content">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="mu-course-content-area">
            <div class="row">

              <div class="col-md-3">
                <!-- start sidebar -->
                <aside class="mu-sidebar">
                  <!-- start single sidebar -->
                  <div class="mu-single-sidebar">
                    <h3>Categories</h3>
                    <ul class="mu-sidebar-catg">
                      <li><a href="#">Web Design</a></li>
                      <li><a href="">Web Development</a></li>
                      <li><a href="">Math</a></li>
                      <li><a href="">Physics</a></li>
                      <li><a href="">Camestry</a></li>
                      <li><a href="">English</a></li>
                    </ul>
                  </div>
                  <!-- end single sidebar -->

                  <!-- start single sidebar -->
                  <div class="mu-single-sidebar">
                    <h3>Archives</h3>
                    <ul class="mu-sidebar-catg mu-sidebar-archives">
                      <li><a href="#">May <span>(25)</span></a></li>
                      <li><a href="">June <span>(35)</span></a></li>
                      <li><a href="">July <span>(20)</span></a></li>
                      <li><a href="">August <span>(125)</span></a></li>
                      <li><a href="">September <span>(45)</span></a></li>
                      <li><a href="">October <span>(85)</span></a></li>
                    </ul>
                  </div>
                  <!-- end single sidebar -->
                  <!-- start single sidebar -->
                  <div class="mu-single-sidebar">
                    <h3>Tags Cloud</h3>
                    <div class="tag-cloud">
                      <a href="#">Health</a>
                      <a href="#">Science</a>
                      <a href="#">Sports</a>
                      <a href="#">Mathematics</a>
                      <a href="#">Web Design</a>
                      <a href="#">Admission</a>
                      <a href="#">History</a>
                      <a href="#">Environment</a>
                    </div>
                  </div>
                  <!-- end single sidebar -->
                </aside>
                <!-- / end sidebar -->
              </div>

              <div class="col-md-9">
                <!-- start course content container -->
                <div class="mu-course-container mu-blog-archive">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <article class="mu-blog-single-item">
                        <figure class="mu-blog-single-img">
                          <a href="#"><img src="assets/img/blog/blog-1.jpg" alt="img"></a>
                          <figcaption class="mu-blog-caption">
                            <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                          </figcaption>                      
                        </figure>
                        <div class="mu-blog-meta">
                          <a href="#">By Admin</a>
                          <a href="#">02 June 2016</a>
                        </div>
                        <div class="mu-blog-description">
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ipsum non voluptatum eum repellendus quod aliquid. Vitae, dolorum voluptate quis repudiandae eos molestiae dolores enim.</p>
                          <a class="mu-read-more-btn" href="#">Read More</a>
                        </div>
                      </article> 
                    </div>                  
                    <div class="col-md-6 col-sm-6">
                      <article class="mu-blog-single-item">
                        <figure class="mu-blog-single-img">
                          <a href="#"><img src="assets/img/blog/blog-2.jpg" alt="img"></a>
                          <figcaption class="mu-blog-caption">
                            <h3><a href="#">Lorem ipsum dolor sit amet.</a></h3>
                          </figcaption>                      
                        </figure>
                        <div class="mu-blog-meta">
                          <a href="#">By Admin</a>
                          <a href="#">02 June 2016</a>
                        </div>
                        <div class="mu-blog-description">
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae ipsum non voluptatum eum repellendus quod aliquid. Vitae, dolorum voluptate quis repudiandae eos molestiae dolores enim.</p>
                          <a class="mu-read-more-btn" href="#">Read More</a>
                        </div>
                      </article>
                    </div>
                  </div>
                </div>
                <!-- end course content container -->
                <!-- start course pagination -->
                <div class="mu-pagination">
                  <nav>
                    <ul class="pagination">
                      <li>
                        <a href="#" aria-label="Previous">
                          <span class="fa fa-angle-left"></span> Prev 
                        </a>
                      </li>
                      <li class="active"><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li>
                        <a href="#" aria-label="Next">
                         Next <span class="fa fa-angle-right"></span>
                       </a>
                     </li>
                   </ul>
                 </nav>
               </div>
               <!-- end course pagination -->
             </div>

           </div>
         </div>
       </div>
     </div>
   </div>
 </section>

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