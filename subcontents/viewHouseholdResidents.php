<?php
require '../includes/dbhandler.inc.php';

if (isset($_GET['id'])) {
    $householdID = mysqli_real_escape_string($conn, $_GET['id']); // Sanitize input
    
    // Fetch household information
    $sql = "SELECT * FROM Household_tbl WHERE HouseholdID = $householdID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $household = mysqli_fetch_assoc($result);

        // Count residents based on categories
      $sqlCountResidents = "
      SELECT 
      SUM(CASE WHEN livein = 'Yes' THEN 1 ELSE 0 END) AS livein_count,
      SUM(CASE WHEN student = 'Yes' THEN 1 ELSE 0 END) AS student_count,
      SUM(CASE WHEN registeredvoter = 'Yes' THEN 1 ELSE 0 END) AS registeredvoter_count,
      SUM(CASE WHEN PWD = 'Yes' THEN 1 ELSE 0 END) AS PWD_count,
      SUM(CASE WHEN Kasambahay = 'Yes' THEN 1 ELSE 0 END) AS kasambahay_count,
      SUM(CASE WHEN SoloParent = 'Yes' THEN 1 ELSE 0 END) AS SoloParent_count
      FROM Residents_tbl
      WHERE HouseholdID = $householdID
      ";

      $resultCountResidents = mysqli_query($conn, $sqlCountResidents);
      $counts = mysqli_fetch_assoc($resultCountResidents);

        // Fetch residents
      $sqlResidents = "SELECT * FROM Residents_tbl WHERE HouseholdID = $householdID";
      $resultResidents = mysqli_query($conn, $sqlResidents);

      ?>
      <!DOCTYPE html>
      <html>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>View Household List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../adminfiles/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="../adminfiles/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="../adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap4.css" rel="stylesheet">
        <link rel="stylesheet" href="../adminfiles/dist/css/ogcss.css">
        <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">
      </head>
      <style>
        .custom-checkbox {
          position: absolute;
          opacity: 0;
          cursor: pointer;
        }

        .checkbox-label {
          position: relative;
          display: inline-block;
          width: 24px;
          height: 25px;
          background-color: #ccc;
          border: 1px solid #666;
        }

        .custom-checkbox:checked + .checkbox-label:after {
          content: '';
          position: absolute;
          left: 7px;
          top: 5px;
          width: 6px;
          height: 10px;
          border: solid #232743;
          border-width: 0 2px 2px 0;
          transform: rotate(45deg);
        }
        .alert-info {
          background-color: #d9edf7;
          border-color: #bce8f1;
          color: #31708f;
          padding: 0.75rem 1.25rem;
          margin-bottom: 1rem;
          border: 1px solid transparent;
          border-radius: 4px;
        }
        .summary-table-container {
          margin: 0;
        }
        .summary-table {
          width: auto;
          max-width: none;
          margin-left: 0;
          margin-right: auto;
          text-align: left;
        }
        .summary-table td, .summary-table th, .summary-table tr {
          padding: 2.5px 6px;
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
              <a href="UsersList.php" class="nav-link">
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
                <li class="breadcrumb-item"><a href="../householdList.php">Household List</a></li>
                <li class="breadcrumb-item active">View Household Resident</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold; margin-top: 10px;"> Household: <?php echo $household['HouseholdName']; ?> Family </h3>
                <span onclick="window.location.href='../householdList.php'" class="btnSave bg-1 text-fff text-bold" id="create-resident-btn">Back to Household List</span>
              </div>
              <div class="card-header">
                <?php if (mysqli_num_rows($resultResidents) == 0) : ?>
                  <div class="alert alert-info alert-dismissible fade show" role="alert">
                    No summary counts found for this household.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php else : ?>
                  <div class="summary-table-container">
                    <table class="summary-table table-sm table-bordered">
                      <tr style="background-color: #232743; color: white;">
                        <th style="border-radius: 3px; font-weight: normal;">Category</th>
                        <th style="border-radius: 3px; font-weight: normal; text-align: center;">Count</th>
                      </tr>
                      <tr><td><strong>PWD:</strong></td><td style="text-align: center;"><?php echo $counts['PWD_count']; ?></td></tr>
                      <tr><td><strong>SOLOPARENT:</strong></td><td style="text-align: center;"><?php echo $counts['SoloParent_count']; ?></td></tr>
                      <tr><td><strong>KASAMBAHAY:</strong></td><td style="text-align: center;"><?php echo $counts['kasambahay_count']; ?></td></tr>
                      <tr><td><strong>RESIDENTS LIVING IN:</strong></td><td style="text-align: center;"><?php echo $counts['livein_count']; ?></td></tr>
                      <tr><td><strong>STUDENTS:</strong></td><td style="text-align: center;"><?php echo $counts['student_count']; ?></td></tr>
                      <tr><td><strong>REGISTERED VOTERS:</strong></td><td style="text-align: center;"><?php echo $counts['registeredvoter_count']; ?></td></tr>
                    </table>
                  </div>
                <?php endif; ?>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="viewhouseholdr" style="width: 100% !important;" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Resident ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sqlResidents = "SELECT * FROM Residents_tbl WHERE HouseholdID = $householdID";
                      $resultResidents = mysqli_query($conn, $sqlResidents);
                      while ($row = mysqli_fetch_assoc($resultResidents)) {
                        ?>
                        <tr>
                          <td><?php echo $row['ResidentID']; ?></td>
                          <td><?php echo $row['LastName']; ?></td>
                          <td><?php echo $row['FirstName']; ?></td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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

    <script src="../adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="../adminfiles/dist/js/adminlte.min.js"></script>

    <!-- Script for Filteration -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var filterSelect = document.getElementById("filter");
        filterSelect.addEventListener("change", function() {
          applyFilter(this.value);
        });

        function applyFilter(selectedOption) {
            // Get the current URL
          var currentUrl = window.location.href;
            // Check if there is already a filter parameter in the URL
          var url = currentUrl.includes('?') ? currentUrl.split('?')[0] : currentUrl;
            // Construct the new URL with the selected filter option
          var newUrl = url + '?filter=' + selectedOption;
            // Redirect to the new URL
          window.location.href = newUrl;
        }
      });
    </script>

    <!-- Scripts for Data Table -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.bootstrap4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.colVis.min.js"></script>
    <script>
      new DataTable('#viewhouseholdr', {
        layout: {
          topStart: {
            buttons: ['copy','csv','excel', 'pdf','print',{
              extend: 'colvis',
              postfixButtons: ['colvisRestore']
            }]
          }
        },
        columnDefs: [
          { type: 'null', targets: '_all' },
          { targets: -1, visible: true }
          ],
        language: {
          search: '<span class="text-left">Search:</span>',
          emptyTable: '<div class="custom-danger">No Resident found in the selected cluster.</div>'
        }
      });
    </script>
  </body>
  </html>
  <?php
} else {
  echo "No residents found for this household.";
}
} else {
  echo "Household ID not provided.";
}
?>
