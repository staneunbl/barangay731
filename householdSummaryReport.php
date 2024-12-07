<?php
require 'includes/dbhandler.inc.php';

$totalHouseholdsQuery = "SELECT COUNT(DISTINCT HouseholdID) AS totalHouseholds FROM household_tbl";
$totalHouseholdsResult = mysqli_query($conn, $totalHouseholdsQuery);
if (!$totalHouseholdsResult) {
  echo json_encode(["error" => mysqli_error($conn)]);
  exit;
}

$totalHouseholdsData = mysqli_fetch_assoc($totalHouseholdsResult);
$totalHouseholds = $totalHouseholdsData['totalHouseholds'];
$summaryQuery = "SELECT
COUNT(r.ResidentID) AS totalResidentsPerHousehold,
SUM(CASE WHEN r.PWD = 'yes' THEN 1 ELSE 0 END) AS totalPWD,
SUM(CASE WHEN r.SoloParent = 'yes' THEN 1 ELSE 0 END) AS totalSoloParents,
SUM(CASE WHEN r.LiveIn = 'yes' THEN 1 ELSE 0 END) AS totalLiveIn,
SUM(CASE WHEN r.Student = 'yes' THEN 1 ELSE 0 END) AS totalStudents,
SUM(CASE WHEN r.RegisteredVoter = 'yes' THEN 1 ELSE 0 END) AS totalVoters,
SUM(CASE WHEN r.Kasambahay = 'yes' THEN 1 ELSE 0 END) AS totalKasambahay
FROM household_tbl h
JOIN residents_tbl r ON h.HouseholdID = r.HouseholdID;";

$summaryResult = mysqli_query($conn, $summaryQuery);
if (!$summaryResult) {
  echo json_encode(["error" => mysqli_error($conn)]);
  exit;
}

$summaryData = mysqli_fetch_assoc($summaryResult);
$response = array_merge(["totalHouseholds" => $totalHouseholds], $summaryData);

$householdDetailsQuery = "SELECT
h.HouseholdID,
h.HouseholdName,
COUNT(r.ResidentID) AS totalResidents,
SUM(CASE WHEN r.PWD = 'yes' THEN 1 ELSE 0 END) AS totalPWD,
SUM(CASE WHEN r.SoloParent = 'yes' THEN 1 ELSE 0 END) AS totalSoloParents,
SUM(CASE WHEN r.LiveIn = 'yes' THEN 1 ELSE 0 END) AS totalLiveIn,
SUM(CASE WHEN r.Student = 'yes' THEN 1 ELSE 0 END) AS totalStudents,
SUM(CASE WHEN r.RegisteredVoter = 'yes' THEN 1 ELSE 0 END) AS totalVoters,
SUM(CASE WHEN r.Kasambahay = 'yes' THEN 1 ELSE 0 END) AS totalKasambahay
FROM household_tbl h
JOIN residents_tbl r ON h.HouseholdID = r.HouseholdID
GROUP BY h.HouseholdID;";

$householdDetailsResult = mysqli_query($conn, $householdDetailsQuery);
if (!$householdDetailsResult) {
  echo json_encode(["error" => mysqli_error($conn)]);
  exit;
}

  // After executing the query to fetch household details
$resultResidents = mysqli_query($conn, $householdDetailsQuery);
if (!$resultResidents) {
  echo json_encode(["error" => mysqli_error($conn)]);
  exit;
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Household Summary Report</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="adminfiles/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="adminfiles/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="adminfiles/dist/css/ogcss.css">
  <link rel="shortcut icon" href="builtimages/left_logo.png" type="image/x-icon">  
</head>
<style>
  .certificate {
    border: .2rem solid black;
    padding: 35px;
    position: relative;
  }

  .certificate-table {
    width: 100%;
  }
  /* Define media queries for different screen sizes */
  @media screen and (max-width: 768px) {
    /* Adjust image sizes for smaller screens */
    .logo-left img,
    .logo-right img {
      max-width: 10px; /* Adjust as needed */
    }

    .logo-center img {
      max-width: 10px; /* Adjust as needed */
    }
  }
  .logo-left {
    top: 40px;
    left: 100px;
  }

  .logo-right {
    top: 50px;
    right: 100px;
  }

  .logo-center {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    margin-left: 20px;
  }

  .certificate-header {
    position: relative;
  }

  .certificate-text {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    font-family: "Times New Roman", Times, serif;
    font-size: 19px;
    text-align: center;
  }

  .bold {
    font-weight: bold;
  }

  .wordart-container {
    position: relative;
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

<!--       <li class="nav-item dropdown">
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
          <li class="nav-header">Manage Barangay</li>
          <li class="nav-item">
            <a href="barangayOfficials.php" class="nav-link">
              <i class="fas fa-user-tie nav-icon"></i>
              <p>Barangay Officials Page</p>
            </a>
          </li>
          <li class="nav-header">Manage Records</li>
          <li class="nav-item">
            <a href="viewRequests.php" class="nav-link">
              <i class="fas fa-file-alt nav-icon"></i>
              <p>Documents Requesting</p>
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
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="AdminDashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="householdList.php">Household List</a></li>
              <li class="breadcrumb-item active">Household Summary Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <div class="certificate">
                    <!-- Left Logo -->
                    <div class="logo-left" style="position: absolute;">
                      <img src="builtimages/left_logo.png" style="max-width: 140px;">
                    </div>
                    <!-- Right Logo -->
                    <div class="logo-right" style="position: absolute;">
                      <img src="builtimages/right_logo.png" alt="Right Logo" style="max-width: 120px;">
                    </div>
                    <div class="certificate-header">
                      <!-- Center Logo -->
                      <div class="logo-center">
                        <img src="builtimages/center_logo.png" alt="Center Logo" style="max-width: 550px;">
                      </div>
                      <!-- Text in front of the center logo -->
                      <div class="certificate-text">
                        <p>REPUBLIC OF THE PHILIPPINES<br>City of Manila<br><strong class="bold"> BARANGAY 731, ZONE 80, DISTRICT-5</strong></p>
                        <!-- Insert WordArt-like text below -->                 
                      </div>
                    </div>

              <!-- /.row -->

              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col mt-3">
                  <!-- First Table -->
                  <div class="certificate-table">
                    <table style="width: 100% !important;" class="summary-table table table-sm table-bordered">
                      <thead>
                        <tr style="background-color: #232743; color: white;">
                          <th>Category</th>
                          <th style="text-align: center;">Count</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><strong>Total Number of Households:</strong></td>
                          <td style="text-align: center;"><?php echo $totalHouseholds; ?></td>
                        </tr>
                        <tr>
                          <td><strong>Total Number of Residents in an Household:</strong></td>
                          <td style="text-align: center;"><?php echo $summaryData['totalResidentsPerHousehold']; ?></td>
                        </tr>
                        <tr>
                          <td><strong>Total Number of PWD:</strong></td>
                          <td style="text-align: center;"><?php echo $summaryData['totalPWD']; ?></td>
                        </tr>
                        <tr>
                          <td><strong>Total Number of Solo Parents:</strong></td>
                          <td style="text-align: center;"><?php echo $summaryData['totalSoloParents']; ?></td>
                        </tr>
                        <tr>
                          <td><strong>Total Number of Live-In:</strong></td>
                          <td style="text-align: center;"><?php echo $summaryData['totalLiveIn']; ?></td>
                        </tr>
                        <tr>
                          <td><strong>Total Number of Students:</strong></td>
                          <td style="text-align: center;"><?php echo $summaryData['totalStudents']; ?></td>
                        </tr>
                        <tr>
                          <td><strong>Total Number of Registered Voters:</strong></td>
                          <td style="text-align: center;"><?php echo $summaryData['totalVoters']; ?></td>
                        </tr>
                        <tr>
                          <td><strong>Total Number of Kasambahay:</strong></td>
                          <td style="text-align: center;"><?php echo $summaryData['totalKasambahay']; ?></td>
                        </tr>
                      </tbody>
                    </table>
                <hr>
                <!-- Second Table -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table style="width: 100% !important;" class="table table-sm table-striped">
                      <thead>
                        <tr style="background-color: #232743; color: white;">
                          <th>Household ID</th>
                          <th>Household Name</th>
                          <th>Total Residents</th>
                          <th>Total PWD</th>
                          <th>Total Solo Parents</th>
                          <th>Total Live-In</th>
                          <th>Total Students</th>
                          <th>Total Registered Voters</th>
                          <th>Total Kasambahay</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($householdData = mysqli_fetch_assoc($householdDetailsResult)) {
                          echo "<tr>";
                          echo "<td>{$householdData['HouseholdID']}</td>";
                          echo "<td>{$householdData['HouseholdName']}</td>";
                          echo "<td>{$householdData['totalResidents']}</td>";
                          echo "<td>{$householdData['totalPWD']}</td>";
                          echo "<td>{$householdData['totalSoloParents']}</td>";
                          echo "<td>{$householdData['totalLiveIn']}</td>";
                          echo "<td>{$householdData['totalStudents']}</td>";
                          echo "<td>{$householdData['totalVoters']}</td>";
                          echo "<td>{$householdData['totalKasambahay']}</td>";
                          echo "</tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
                <!-- /.invoice -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
              <hr><a id="printButton" href="#" class="btn btn-primary float-right ml-2"><i class="fas fa-print"></i> Print</a>
              <a href="householdList.php" class="btn btn-info float-right"> <i class="fas fa-arrow-left"></i> Back to Household</a>
            </div>
          </div>
        </section>
        <!-- /.content -->
      </div>

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

<script src="adminfiles/plugins/jquery/jquery.min.js"></script>
<script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminfiles/dist/js/adminlte.js"></script>

<!-- Script for Filteration -->
<script>
  function applyFilter(selectedOption) {
    document.getElementById("filter_value").value = selectedOption;
    document.forms["listForm"].submit();
  }
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Get the print button element by its ID
    var printButton = document.getElementById('printButton');
    printButton.addEventListener('click', function(event) {
      event.preventDefault();
      
      window.print();
    });
  });
</script>


  <!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('summaryReportButton').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'includes/householdSummaryReport.inc.php', true);
        
        xhr.onload = function() {
          if (xhr.status === 200) {
              var response = JSON.parse(xhr.responseText);
              console.log(response);
              if (response.error) {
                  alert("Error: " + response.error);
              } else {
                  var report = `
                      Total Number of Households: ${response.totalHouseholds}
                      Total Number of Residents: ${response.totalResidentsPerHousehold}
                      Total Number of PWD: ${response.totalPWD}
                      Total Number of Solo Parents: ${response.totalSoloParents}
                      Total Number of Live-In: ${response.totalLiveIn}
                      Total Number of Students: ${response.totalStudents}
                      Total Number of Registered Voters: ${response.totalVoters}
                      Total Number of Kasambahay: ${response.totalKasambahay}
                  `;
                  
                  alert(report);
              }
          } else {
              alert("Error fetching summary report: " + xhr.statusText);
          }
      };
        xhr.send();
    });
});

</script> -->
</body>
</html>
