<?php
require '../includes/dbhandler.inc.php';

$sql = "SELECT StatusID, StatusName FROM BlotterStatus_tbl";
$result = $conn->query($sql);
$statusOptions = '';

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $statusOptions .= "<option value='" . $row['StatusID'] . "'>" . $row['StatusName'] . "</option>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Blotter Form</title>
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
                <li class="breadcrumb-item"><a href="../viewBlotterRecords.php">Blotter Records</a></li>
                <li class="breadcrumb-item active">Blotter Form</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-2">
            <div class="card">
              <div class="alert custom-alert alert-dismissible fade show" role="alert">
                Include the date and time of the incident, location, detailed description, names and details of involved individuals, reporting officer's information, any witness statements, and actions taken or to be taken.
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
          </div>
        </div>
        <!-- Start form -->
        <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Blotter Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="blotterRecordsForm" action="../includes/blotterRecords.inc.php" method="post" class="form-horizontal">
              <div class="card-body">
                <div class="form-group row" style="margin-top: 20px;">
                  <label class="col-sm-2 col-form-label">Basic Details</label>
                  <div class="col-sm-5">
                    <!-- text input -->
                    <label for="CaseNumber">Case Number:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" id="CaseNumber" name="CaseNumber" class="form-control" placeholder="Enter the Case Number" required>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="DateFiled">Date Filed:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" id="DateFiled" name="DateFiled" class="form-control" placeholder="Enter the Date Filed" required>
                      </div>
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label"> </label>
                  <div class="col-sm-5">
                    <!-- text input -->
                    <div class="form-group">
                      <label for="ComplainantName">Complainant Name:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="ComplainantName" name="ComplainantName" class="form-control" placeholder="Enter the Complainant Name" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="RespondentName">Respondent Name:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="RespondentName" name="RespondentName" class="form-control" placeholder="Enter the Respondent Name" required>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="IncidentDetails">Incident Details:</label>
                  <div class="col-sm-10">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                        </div>
                        <textarea id="IncidentDetails" name="IncidentDetails" rows="4" cols="50" class="form-control" placeholder="Enter the Incident Details" required> </textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="ResolutionText">Resolution Text:</label>
                  <div class="col-sm-10">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                        </div>
                        <textarea id="ResolutionText" name="ResolutionText" rows="4" cols="50" class="form-control" placeholder="Enter the Resolution Text" required> </textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group row" style="margin-top: 20px;">
                  <label class="col-sm-2 col-form-label">Basic Details</label>
                  <div class="col-sm-5">
                    <!-- text input -->
                    <label for="InvestigatingOfficer">Investigating Officer:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" id="InvestigatingOfficer" name="InvestigatingOfficer" class="form-control" placeholder="Enter the Investigating Officer" required>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="StatusID">Status:</label>
                      <select id="StatusID" name="StatusID" class="form-control" required>
                        <option value="">Select Status</option>
                        <?php echo $statusOptions; ?>
                      </select>
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label" for="StatusID">Optional:</label>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="DateFiled">Date Resolved:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" id="DateResolved" name="DateResolved" class="form-control" placeholder="Enter the Date Resolved">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer" style="border-top: 1px solid #ccc;">
                <button type="submit" class="btn btn-info float-right" style="margin-left:10px; background-color: #232743; border-color: #232743;">Create Blotter</button>
                <a href="../viewBlotterRecords.php" class="btn btn-default float-right">Back To Blotter Records</a>
              </div>
              <!-- /.card-footer -->
            </form>
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

  <script>
    document.getElementById('blotterRecordsForm').addEventListener('submit', function(event) {
      event.preventDefault();

          var formData = new FormData(this); // Get form data
          var xhr = new XMLHttpRequest();
          xhr.open('POST', '../includes/blotterRecords.inc.php', true);
          
          xhr.onload = function() {
            if (xhr.status === 200) {
              var responseData = JSON.parse(xhr.responseText);
              if (responseData.hasOwnProperty('success')) {
                Swal.fire({
                  title: "Blotter Successfully created!",
                  text: "You have successfully created a Blotter!",
                  icon: "success"
                }).then((result) => {
                  if (result.isConfirmed) {
                              window.location.href = '../viewBlotterRecords.php'; // Change the URL as needed
                            }
                          });
              } else if (responseData.hasOwnProperty('error')) {
                      // Handle errors if any
                Swal.fire({
                  title: "Error!",
                  text: responseData.error,
                  icon: "error"
                });
              }
            } else {
                  // Handle errors if any
              Swal.fire({
                title: "Error!",
                text: "An error occurred while processing your request.",
                icon: "error"
              });
            }
          };

          xhr.send(formData);
        });
      </script>
    </body>
    </html>