<?php
session_start();

require 'includes/dbhandler.inc.php';

// Set default filter to active if not provided
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'active';

// Fetch data from BarangayOfficials_tbl and join with Positions_tbl
$sql = "SELECT B.BrgyOfficialId, B.FirstName, B.LastName, B.MiddleName, P.PositionName, B.IsActive, B.IsArchived
FROM BarangayOfficials_tbl B
INNER JOIN Positions_tbl P ON B.PositionID = P.PositionId";

if ($filter == "active") {
  $sql .= " WHERE IsArchived = 0";
} elseif ($filter == "inactive") {
  $sql .= " WHERE IsArchived = 1";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="adminfiles/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="adminfiles/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="shortcut icon" href="builtimages/left_logo.png" type="image/x-icon">  
</head>
<!-- <style>
  .sidebar {
    border: none; /* Reset any border */
    padding: 0; /* Reset any padding */
    margin: 0; /* Reset any margin */
}
    .content-wrapper {
      max-height: calc(100vh - 56px); /* 56px is the height of the navbar */
      overflow-y: auto; /* Enable vertical scrolling if content exceeds height */
    }
  </style> -->
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

          <li class="nav-item dropdown">
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
          </li>

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
              <a href="adminProfile.php" class="dropdown-item" style="text-align: center;">
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
        <!-- Brand Logo -->

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
              <li class="nav-item">
                <a href="adminProfile.php" class="nav-link">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Profile</p>
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
                    <?php
                    require 'includes/dbhandler.inc.php';

                    // Query to get the count of residents
                    $sql = "SELECT COUNT(*) AS numVerUsers FROM verification_tbl ";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $numVerUsers = $row['numVerUsers'];
                    ?>
                  <p>
                    Verification Page
                    <span class="right badge badge-danger"><?php echo $numVerUsers ; ?></span>
                  </p>
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
            <li class="nav-header">Manage Barangay</li>
            <li class="nav-item">
              <a href="barangayOfficials.php" class="nav-link">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>Barangay Officials Page</p>
              </a>
            </li>
            <li class="nav-header">Manage Records</li>
              <li class="nav-item">
                <a href="VerificationPage.php" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>
                  <?php
                  require 'includes/dbhandler.inc.php';

                  // Query to get the count of residents
                  $sql = "SELECT COUNT(*) AS numHousehold FROM request_tbl";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                  $numHousehold = $row['numHousehold'];

                  // Additional query to get the count from requestforsomeone_tbl
                  $sql2 = "SELECT COUNT(*) AS numRequests FROM requestforsomeone_tbl";
                  $result2 = mysqli_query($conn, $sql2);
                  $row2 = mysqli_fetch_assoc($result2);
                  $numRequests = $row2['numRequests'];
                  ?>
                  <p>
                    Documents Requests
                    <span class="right badge badge-warning"><?php echo $numHousehold + $numRequests; ?></span>
                  </p>
                </a>
              </li>
            <li class="nav-item">
              <a href="viewBlotterRecords.php" class="nav-link">
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
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <?php
                require 'includes/dbhandler.inc.php';

                  // Query to get the count of residents
                $sql = "SELECT COUNT(*) AS numUsers FROM users_tbl";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $numUsers = $row['numUsers'];
                ?>
                <div class="inner">
                  <h3><?php echo $numUsers; ?></h3>
                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="UsersList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <?php
                require 'includes/dbhandler.inc.php';

                  // Query to get the count of residents
                $sql = "SELECT COUNT(*) AS numResidents FROM Residents_tbl";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $numResidents = $row['numResidents'];
                ?>
                <div class="inner">
                  <h3><?php echo $numResidents; ?><sup style="font-size: 20px"></sup></h3>

                  <p>Residents</p>
                </div>
                <div class="icon">
                  <i class="ion ion-home"></i>
                </div>
                <a href="ResidentsList.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                  <?php
                  require 'includes/dbhandler.inc.php';

                  // Query to get the count of residents
                  $sql = "SELECT COUNT(*) AS numHousehold FROM request_tbl";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                  $numHousehold = $row['numHousehold'];

                  // Additional query to get the count from requestforsomeone_tbl
                  $sql2 = "SELECT COUNT(*) AS numRequests FROM requestforsomeone_tbl";
                  $result2 = mysqli_query($conn, $sql2);
                  $row2 = mysqli_fetch_assoc($result2);
                  $numRequests = $row2['numRequests'];
                  ?>
                  <div class="inner">
                      <h3><?php echo $numHousehold + $numRequests; ?></h3>
                      <p>Documents Requests</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-document-text"></i>
                  </div>
                  <a href="viewRequests.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <?php
                require 'includes/dbhandler.inc.php';

                  // Query to get the count of residents
                $sql = "SELECT COUNT(*) AS numVerUsers FROM verification_tbl ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $numVerUsers = $row['numVerUsers'];
                ?>
                <div class="inner">
                  <h3><?php echo $numVerUsers ; ?></h3>
                  <p>Verify Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-checkmark-circle"></i>
                </div>
                <a href="VerificationPage.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>

          <!-- Main row -->
          <div class="row">
          </div>
      </section>
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer no-print">
      <div class="float-right d-none d-sm-block">
      </div>All rights Reserved.
    </footer>

  </div>
  <!-- ./wrapper -->
  <script src="adminfiles/plugins/jquery/jquery.min.js"></script>
  <script src="adminfiles/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="adminfiles/dist/js/adminlte.js"></script>
</body>
</html>