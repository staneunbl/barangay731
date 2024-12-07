<?php
require '../includes/dbhandler.inc.php';

// Check if ID parameter is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
  $blotterRecordID = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the blotter record from the database using the ID
  $sql = "SELECT br.*, bs.StatusName 
  FROM BlotterRecords_tbl br 
  JOIN BlotterStatus_tbl bs ON br.StatusID = bs.StatusID
  WHERE br.BlotterID = '$blotterRecordID'";
  $result = $conn->query($sql);

    // Check if a record is found
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>

    <!--   di pa tapos hindi pa nakukuha id padebug nalang antok na ako AHAHAHAHAHAHA -->

    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Detailed Blotter Record</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../adminfiles/plugins/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="../adminfiles/dist/css/adminlte.min.css">
      <link rel="stylesheet" href="../adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="../adminfiles/dist/css/ogcss.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
      <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">  
    </head>
    <style>
      .card-info:not(.card-outline) .card-header {
        background-color: #232743;
      }

      .row {
        margin-left: 10px;
        margin-right: 10px;
      }

      .card-primary.card-outline {
        border-top: 3px solid #232743;
      }

      .custom-alert {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
      }
      .card {
        background-color: #fff;
        border: 0 solid #eee;
        border-radius: 0;
      }
      .card {
        margin-bottom: 30px;
        -webkit-box-shadow: 2px 2px 2px rgba(0,0,0,0.1), -1px 0 2px rgba(0,0,0,0.05);
        box-shadow: 2px 2px 2px rgba(0,0,0,0.1), -1px 0 2px rgba(0,0,0,0.05);
      }

      .card-profile .card-header {
        height: 9rem;
        background-size: cover;
        background-position: center center
      }

      .card-profile-img {
        max-width: 8rem;
        margin-top: -6rem;
        margin-bottom: 1rem;
        border: 3px solid #fff;
        border-radius: 100%
      }

      .avatar {
        width: 2rem;
        height: 2rem;
        line-height: 2rem;
        border-radius: 50%;
        display: inline-block;
        background: #ced4da no-repeat center/cover;
        position: relative;
        text-align: center;
        color: #868e96;
        font-weight: 600;
        vertical-align: bottom
      }

      .avatar.avatar-md {
        width: 3rem;
        height: 3rem
      }

      .avatar.avatar-lg {
        width: 4rem;
        height: 4rem
      }

      .avatar.avatar-xl {
        width: 5rem;
        height: 5rem
      }

      .avatar.avatar-xxl {
        width: 7rem;
        height: 7rem;
        min-width: 7rem
      }

      .card-header:first-child {
        border-radius: 0 0 0 0;
      }
      .card-header:first-child {
        border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
      }
      .card-header {
        padding: 1rem 1.25rem;
        background-color: #fff;
        border-bottom: 1px solid #eee;
      }
      .card-header {
        -webkit-box-shadow: 2px 2px 2px rgba(0,0,0,0.05);
        box-shadow: 2px 2px 2px rgba(0,0,0,0.05);
      }


    </style>
    <body class="hold-transition sidebar-mini">
      <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
          </ul>

          <!-- SEARCH FORM -->
          <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->

<!--         <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> -->

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user-circle fa-2x"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <?php
            if(isset($_SESSION['username'])) {
              require '../includes/dbhandler.inc.php';
              $username = $_SESSION['username'];
            } else {
              $username = "";
            }
            ?>
            <span class="dropdown-header"> Hello, <?php echo $username; ?>! </span>
            <div class="dropdown-divider"></div>
            <a href="../adminProfile.php" class="dropdown-item" style="text-align: center;">
              <i class="fas fa-user"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="../includes/logout.inc.php" class="dropdown-item" style="text-align: center;">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../builtimages/left_logo.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Barangay 731</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-open">
              <a href="../AdminDashboard.php" class="nav-link active">
                <i class="fas fa-chart-line nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../adminProfile.php" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-header">Main Navigation</li>
            <li class="nav-item">
              <a href="../UsersList.php" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Users Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../VerificationPage.php" class="nav-link">
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
                  <a href="../ResidentsList.php" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>Residents List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../householdList.php" class="nav-link">
                    <i class="fas fa-home nav-icon"></i>
                    <p>Household List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">Manage Barangay</li>
            <li class="nav-item">
              <a href="../barangayOfficials.php" class="nav-link">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>Barangay Officials Page</p>
              </a>
            </li>
            <li class="nav-header">Manage Records</li>
            <li class="nav-item">
              <a href="../viewRequests.php" class="nav-link">
                <i class="fas fa-file-alt nav-icon"></i>
                <p>Documents Requesting</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../viewBlotterRecords.php" class="nav-link">
                <i class="fas fa-clipboard nav-icon"></i>
                <p>Blotter Records</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../AdminDashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../viewBlotterRecords.php">Blotter Records</a></li>
                <li class="breadcrumb-item active">View Blotter Record</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>


      <!-- Main content -->
      <section class="content">
        <div class="row">

          <!-- Start form -->
          <!-- Horizontal Form -->


          <div class="col-md-4">
            <!-- Start Complainant Card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><strong>Complainant Details</strong></h3>
              </div>
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-auto d-flex align-items-center"><span style="background-image: url(../builtimages/left_logo.png)" class="avatar avatar-lg"></span></div>
                  <div class="col">
                    <div class="form-group">
                     <div class="media-body">
                      <div class="media-heading mt-2">
                        <h5><?php echo $row['ComplainantName']; ?></h5>
                      </div>
                      <div class="text-muted text-small">Complainant Name</div>
                    </div>
                  </div>
                </div>
                </div><!-- <hr>
                <label class="form-label">Details</label>
                <div class="form-group">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div> -->
              </div>
            </div>

            <!-- Start Respondent Card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><strong>Respondent Details</strong></h3>
              </div>
              <div class="card-body">
                <div class="row mb-2">
                  <div class="col-auto d-flex align-items-center"><span style="background-image: url(../builtimages/left_logo.png)" class="avatar avatar-lg"></span></div>
                  <div class="col">
                    <div class="form-group">
                     <div class="media-body">
                      <div class="media-heading mt-2">
                        <h5><?php echo $row['RespondentName']; ?></h5>
                      </div>
                      <div class="text-muted text-small">Respondent Name</div>
                    </div>
                  </div>
                </div>
              </div><!-- <hr>
              <label class="form-label">Details</label>
              <div class="form-group">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              </div> -->
            </div>
          </div>

          <!-- Start Details -->
        </div>
        <div class="col-md-8">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title"><strong>CASE NUMBER: <?php echo $row['CaseNumber']; ?></strong></h3>
            </div>
            <div class="list-group card-list-group">
              <div class="list-group-item py-4">
                <div class="media-body">
                  <div class="media-heading">
                    <h5>Date Filled:</h5>
                  </div>
                  <div class="text-muted text-small"><?php echo $row['DateFiled']; ?></div>
                  <hr>
                  <div class="media-heading">
                    <h5>Status:</h5>
                  </div>
                  <div class="text-muted text-small"><?php echo $row['StatusName']; ?></div>
                  <hr>
                  <div class="media-heading">
                    <h5>Incident Details:</h5>
                  </div>
                  <div class="text-muted text-small"><?php echo $row['IncidentDetails']; ?></div>
                  <hr>
                  <div class="media-heading">
                    <h5>Resolution Text:</h5>
                  </div>
                  <div class="text-muted text-small"><?php echo $row['ResolutionText']; ?></div>
                  <hr>
                  <div class="media-heading">
                    <h5>Date Resolved:</h5>
                  </div>
                  <div class="text-muted text-small"><?php echo $row['DateResolved']; ?></div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer no-print">
      <div class="float-right d-none d-sm-block">
      </div>All rights Reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <script src="../adminfiles/plugins/jquery/jquery.min.js"></script>
  <script src="../adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../adminfiles/dist/js/adminlte.min.js"></script>

</body>
</html>
<?php
} else {
        // Handle case where no record is found
  echo "No record found with ID: $blotterRecordID";
}
} else {
    // Handle case where ID parameter is not provided
  echo "No ID parameter provided in the URL";
}
?>