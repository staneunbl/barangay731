<?php

session_start();
require "includes/dbhandler.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && !isset($_GET["filter"])) {
  header("Location: ?filter=active");
  exit();
}

// Fetch data for the first table
$sql1 = "SELECT request_tbl.*, users_tbl.*
FROM request_tbl 
INNER JOIN users_tbl ON request_tbl.UserId = users_tbl.UserID";
$result1 = mysqli_query($conn, $sql1);
$rows1 = [];
if ($result1 && mysqli_num_rows($result1) > 0) {
  while ($row = mysqli_fetch_assoc($result1)) {
    $rows1[] = $row;
  }
}

// Fetch data for the second table without GROUP BY clause
$sql2 = "SELECT requestForSomeone_tbl.*
FROM requestForSomeone_tbl
WHERE requestForSomeone_tbl.userID IS NOT NULL";
$result2 = mysqli_query($conn, $sql2);
$rows2 = [];
if ($result2 && mysqli_num_rows($result2) > 0) {
  while ($row = mysqli_fetch_assoc($result2)) {
    $rows2[] = $row;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Requests List</title>
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
          <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="AdminDashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Document Requests</li>
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
                <h3 class="card-title" style="font-weight: bold; margin-top: 10px;"> Document Requests List</h3> 
              </div>
              <!-- /.card-header -->

              <div class="card-header p-3">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Request for Myself</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Request for Someone Else</a></li>
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="settings">
                    <!-- First Table -->
                    <div class="table-responsive">                
                      <table id="viewrequestsdt" style="width: 100% !important;" class="table table-sm table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Request ID</th>
                            <th>User Name</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Document Type</th>
                            <th>Purpose</th>
                            <th>Request Date</th>
                            <th>Tracking Number</th>
                            <th>Status</th>
                            <th class="action-header">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($rows1 as $row) : ?>
                            <tr class='bg-2'>
                              <td><?php echo $row["RequestId"]; ?></td>
                              <td><?php echo $row["Username"]; ?></td>
                              <td><?php echo $row["FirstName"]; ?></td>
                              <td><?php echo $row["LastName"]; ?></td>
                              <td><?php echo $row["DocuType"]; ?></td>
                              <td><?php echo $row["Purpose"]; ?></td>
                              <td><?php echo $row["RequestDate"]; ?></td>
                              <td><?php echo $row["TrackingNumber"]; ?></td>
                              <td><?php echo $row["Status"]; ?></td>
                              <td class='action-buttons'>
                                &nbsp; <!-- Add space character -->
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane" id="timeline">
                    <!-- Second Table -->
                    <div class="table-responsive">                
                      <table id="viewrequestsdttwo" style="width: 100% !important;" class="table table-sm table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Request ID</th>
                            <th>User ID</th>
                            <th>Document Type</th>
                            <th>Purpose</th>
                            <th>Request For</th>
                            <th>Relationship With</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Middle Name</th>
                            <th>Birthday</th>
                            <th>Request Date</th>
                            <th>Tracking Number</th>
                            <th>Status</th>
                            <th class="action-header">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($rows2 as $row) : ?>
                            <tr class='bg-2'>
                              <td><?php echo $row["requestID"]; ?></td>
                              <td><?php echo $row["userID"]; ?></td>
                              <td><?php echo $row["DocuType"]; ?></td>
                              <td><?php echo $row["Purpose"]; ?></td>
                              <td><?php echo $row["requestFor"]; ?></td>
                              <td><?php echo $row["relationshipWith"]; ?></td>
                              <td><?php echo $row["firstName"]; ?></td>
                              <td><?php echo $row["lastName"]; ?></td>
                              <td><?php echo $row["middleName"]; ?></td>
                              <td><?php echo $row["birthday"]; ?></td>
                              <td><?php echo $row["requestDate"]; ?></td>
                              <td><?php echo $row["trackingNumber"]; ?></td>
                              <td><?php echo $row["Status"]; ?></td>
                              <td class='action-buttons'>
                                <?php echo '<a href="barangayCertificatePDF.php?id=' . $row["userID"] . '"role="button" class="at-modal__button8"><i class="fas fa-file-pdf"></i></a>'; ?>
                                &nbsp; <!-- Add space character -->
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div><!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
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



    <script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

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
      new DataTable('#viewrequestsdt', {
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
          emptyTable: '<div class="custom-danger">No Requests found.</div>'
        }
      });
    </script>
    <script>
      new DataTable('#viewrequestsdttwo', {
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
          emptyTable: '<div class="custom-danger">No Requests found.</div>'
        }
      });
    </script>
    <script src="adminfiles/dist/js/adminlte.min.js"></script>
    <script src="adminfiles/plugins/jquery/jquery.min.js"></script>
    <script src="adminfiles/plugins/jquery-ui/jquery-ui.min.js"></script>
  </body>
  </html>