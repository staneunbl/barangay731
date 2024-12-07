<?php
require '../includes/dbhandler.inc.php';

if (isset($_GET['id'])) {
  $householdID = $_GET['id'];
  $ClusterID = $_GET['cluster_id'];

    // Fetch household information
  $sql = "SELECT * FROM Household_tbl WHERE HouseholdID = $householdID";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $household = mysqli_fetch_assoc($result);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Residents List</title>
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
        transform: scale(1.3); /* Adjust the scale factor as needed */
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
                <li class="breadcrumb-item active">Update Household</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <form action='../includes/reviewResidentToHousehold.inc.php' method='POST'>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight: bold; margin-top: 10px;"> Edit Household: <?php echo $household['HouseholdName']; ?> </h3>
                  <span onclick="window.location.href='../householdList.php';" class="btnSave bg-1 text-fff text-bold" id="create-resident-btn">Back to Household List</span>
                </div>

                <!-- Display form to add residents -->
                <input type='hidden' name='householdID' value='<?php echo $householdID; ?>'>

                <!-- Construct SQL query based on search criteria -->
                <?php
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT * FROM Residents_tbl WHERE HouseholdID IS NULL AND ClusterID = $ClusterID AND (FirstName LIKE '%$search%' OR LastName LIKE '%$search%')";
                $result = mysqli_query($conn, $sql);
                ?>
                <div class="card-body">
                  <div class="table-responsive">                

                    <table id="viewhouseholdr" style="width: 100% !important;" class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center; font-style: italic; font-size: 15px;"> (check if applicable)</th>
                          <th>Last Name</th>
                          <th>First Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <tr>
                            <td style="text-align: center;">
                              <input type="checkbox" name="residentIDs[]" id="resident_<?php echo $row['ResidentID']; ?>" value="<?php echo $row['ResidentID']; ?>" class="custom-checkbox">
                              <label for="resident_<?php echo $row['ResidentID']; ?>" class="checkbox-label"></label>
                            </td>
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
                <div class="card-footer" style="border-top: 1px solid #ccc;">
                  <!-- <h3 class="card-title" style="font-weight: bold; margin-top: 10px;"> Select Residents to Add: </h3> -->
                  <button class="btnSave bg-1 text-fff text-bold" type='submit' id="create-resident-btn" style="margin-top:5px;"> <i class="fas fa-plus fa-xs"></i> Add Residents to Household </button>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </form>
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
        emptyTable: '<div class="custom-danger">No Resident found.</div>'
      }
    });
  </script>

</body>
</html>

<?php
} else {
  echo "Household not found.";
}
} else {
  echo "Household ID not provided.";
}
?>