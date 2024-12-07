<?php
require 'dbhandler.inc.php';
session_start();
if(isset($_POST['residentIDs'])) {
    // Store selected resident IDs in session variable
  $_SESSION['selectedResidents'] = $_POST['residentIDs'];

    // Fetch selected residents' details from database and sort alphabetically
  $selectedResidents = array();
  foreach($_SESSION['selectedResidents'] as $residentID) {
    $sql = "SELECT * FROM Residents_tbl WHERE ResidentID = $residentID";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $selectedResidents[] = $row['LastName'] . ', ' . $row['FirstName'];
  }
  sort($selectedResidents);
}

// Get household ID from the previous page (assuming it's passed via POST)
$householdID = isset($_POST['householdID']) ? $_POST['householdID'] : '';
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
  <link rel="stylesheet" href="../adminfiles/dist/css/ogcss.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<style>
  .alert-warning {
    color: #8a6d3b;
    background-color: #fcf8e3;
    border-color: #faebcc;
    padding: 0.75rem 1.25rem;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 4px;
  }
</style>
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
            <span class="dropdown-item dropdown-header"> Hello, user! </span>
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
            <li class="nav-item">
              <a href="../barangayOfficials.php" class="nav-link">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>Barangay Officials Page</p>
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
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold; margin-top: 10px;">Review Selected Residents:</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if (!empty($selectedResidents)): ?>
                  <table class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr style="background-color: #232743; color: white;">
                        <th>#</th>
                        <th>Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $count = 1; ?>
                      <?php foreach($selectedResidents as $resident): ?>
                        <tr>
                          <td><?php echo $count++; ?></td>
                          <td><?php echo $resident; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  <hr>
                  <!-- Option to confirm -->
                  <form action="addResidentToHousehold.inc.php" method="POST">
                    <!-- Hidden input field for household ID -->
                    <input type="hidden" name="householdID" value="<?php echo $householdID; ?>">
                    <!-- Hidden input field for resident IDs -->
                    <?php foreach($_SESSION['selectedResidents'] as $residentID): ?>
                      <input type="hidden" name="residentIDs[]" value="<?php echo $residentID; ?>">
                    <?php endforeach; ?>
                    <button type="submit" name="confirm" class="btn btn-primary float-right">Confirm</button>
                  </form>
                <?php else: ?>
                  <div class="alert alert-warning" role="alert">
                    <i class="fas fa-exclamation-triangle"></i>&nbsp; No residents selected.
                  </div>
                <?php endif; ?>
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

<!--   <script>
    // Define a JavaScript variable to hold the householdID
    var householdID = '<?php echo $householdID; ?>';

    // Your remaining JavaScript code here
    document.getElementById('reviewResidenttoHH').addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'addResidentToHousehold.inc.php', true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          Swal.fire({
            title: "Residents Successfully added to Household!",
            text: "You have successfully added the Resident!",
            icon: "success"
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../householdList.php?id=' + householdID;
            }
          });
        } else {
          // Handle errors if any
        }
      };
      xhr.send(formData);
    });
  </script> -->

  
</body>
</html>
