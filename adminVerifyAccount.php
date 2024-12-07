<?php
session_start(); 
require 'includes/dbhandler.inc.php';

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

// Check if the user is not verified
if ($isVerified == 1) {
    header("Location: adminProfile.php");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate uploaded image
    if ($_FILES['verification_image']['error'] === UPLOAD_ERR_OK) {
        // Get file details
        $file_name = $_FILES['verification_image']['name'];
        $file_tmp = $_FILES['verification_image']['tmp_name'];
        $file_type = $_FILES['verification_image']['type'];
        $file_size = $_FILES['verification_image']['size'];

        // Check if uploaded file is an image
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        if (in_array($file_type, $allowed_types)) {
            // Save image to local folder
            $upload_dir = 'uploads/VerificationID/';
            $image_name = basename($file_name); // Only save image name without folder path
            $image_path = $upload_dir . $image_name;
            move_uploaded_file($file_tmp, $image_path);

            // Save image name to database
            $sql = "INSERT INTO verification_tbl (UserID, FirstName, LastName, MiddleName, Suffix, Username, Image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                die('Error: ' . mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmt, "issssss", $UserID, $FirstName, $LastName, $MiddleName, $Suffix, $username, $image_name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Redirect to admin dashboard after verification
            header("Location: adminProfile.php");
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
    <title>Profile Page</title>
    <link rel="stylesheet" href="adminfiles/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="adminfiles/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="builtimages/left_logo.png" type="image/x-icon">

    <!-- Font awesome -->
    <link href="homepagefolder/assets/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="homepagefolder/assets/css/bootstrap.css" rel="stylesheet">   
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="homepagefolder/assets/css/slick.css">          
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="homepagefolder/assets/css/jquery.fancybox.css" type="text/css" media="screen" /> 
    <!-- Theme color -->
    <link id="switcher" href="homepagefolder/assets/css/theme-color/default-theme.css" rel="stylesheet">    

    <!-- Main style sheet -->
    <link href="assets/css/style.css" rel="stylesheet">    

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,500,700' rel='stylesheet' type='text/css'>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-circle fa-2x"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <?php
          if(isset($_SESSION['username'])) {
            require 'includes/dbhandler.inc.php';
            $username = $_SESSION['username'];
        } else {
            $username = "";
        }
        ?>
        <span class="dropdown-header"> Hello, <?php echo $username; ?>! </span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item" style="text-align: center;">
            <i class="fas fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="includes/logout.inc.php" class="dropdown-item" style="text-align: center;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</li>
</ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="builtimages/left_logo.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
          <a href="#" class="d-block">Barangay 731</a>
      </div>
  </div>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item has-treeview menu-open">
        <a href="AdminDashboard.php" class="nav-link active">
          <i class="fas fa-chart-line nav-icon"></i>
          <p>Dashboard</p>
      </a>
  </li>
  <li class="nav-header">Main Navigation</li>
  <li class="nav-item">
    <a href="UsersList.php" class="nav-link">
      <i class="fas fa-users nav-icon"></i>
      <p>Users Page</p>
  </a>
</li>
<li class="nav-item">
    <a href="VerificationPage.php" class="nav-link">
      <i class="fas fa-user-check nav-icon"></i>
      <p>Verification Page</p>
  </a>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="fas fa-users nav-icon"></i>
      <p>
        Inhabitants
        <i class="fas fa-angle-left right"></i>
    </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="ResidentsList.php" class="nav-link">
      <i class="fas fa-user nav-icon"></i>
      <p>Residents List</p>
  </a>
</li>
<li class="nav-item">
    <a href="householdList.php" class="nav-link">
      <i class="fas fa-home nav-icon"></i>
      <p>Household List</p>
  </a>
</li>
</ul>
</li>
<li class="nav-item">
    <a href="viewRequests.php" class="nav-link">
      <i class="far fa-file-alt nav-icon"></i>
      <p>Documents Requesting</p>
  </a>
</li>              
<li class="nav-header">Blotter Records</li>
<li class="nav-item">
    <a href="viewBlotterRecords.php" class="nav-link">
      <i class="fas fa-clipboard nav-icon"></i>
      <p>Blotter Records</p>
  </a>
</li> 
<li class="nav-header">Manage Barangay</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="fas fa-users nav-icon"></i>
      <p>
        Manage Barangay
        <i class="fas fa-angle-left right"></i>
    </p>
</a>
<ul class="nav nav-treeview">
  <li class="nav-item">
    <a href="barangayOfficials.php" class="nav-link">
      <i class="fas fa-user-tie nav-icon"></i>
      <p>Barangay Officials Page</p>
  </a>
</li>

</ul>
</li> 
            <!-- <li class="nav-item">
              <a href="viewRequests.php" class="nav-link">
                <i class="far fa-file-alt nav-icon"></i>
                <p>Announcement Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="viewRequests.php" class="nav-link">
                <i class="far fa-file-alt nav-icon"></i>
                <p>Dashboard Page</p>
              </a>
          </li> -->
      </ul>
  </nav>
</div>
</aside>

<!--wrapper content-->
<div class="content-wrapper">
  <div class="content-header">
        <!-- <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Admin Profile</h1>
            </div> --><!-- /.col

            </div>/.row -->
        </div><!-- /.container-header --> 

        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- Verify Account Form -->
                <div class="col-xs-12 col-sm-12">
                    <div class="card float-sm-start mx-auto mt-5" style="max-width: 500px;">
                        <div class="card-body" style="padding:5%;">
                            <h1 class="card-title" style="font-size: 300%; margin-bottom: 5%;">Verify Your Account</h1>
                            <p class="card-text">Please upload a picture for account verification.</p>
                            <form action="verifyaccount.php" method="post" enctype="multipart/form-data">
                                <div class="mb-4">
                                    <label for="verification_image" class="form-label">Upload Image</label>
                                    <input type="file" name="verification_image" id="verification_image" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                                <a href="adminProfile.php" class="btn btn-info">Back to Profile</a>
                            </form>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div> <!-- /.row --> 
        </div><!-- /.container-fluid --> 
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- ./wrapper -->
<script src="adminfiles/plugins/jquery/jquery.min.js"></script>
<script src="adminfiles/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminfiles/dist/js/adminlte.js"></script>

<!--   Script for confirmDeactivation -->
<script>
  function confirmDeactivation() {
    return confirm("Are you sure you want to deactivate your account? Notice: You are going to be logged out.");
}
</script>
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
