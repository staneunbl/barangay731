<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Blotter Records</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="adminfiles/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="adminfiles/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="adminfiles/dist/css/ogcss.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="shortcut icon" href="builtimages/left_logo.png" type="image/x-icon">  
</head>
<style>

  .nav-pills .nav-link.active.all {
    background-color: #0275d8;
    color: #fff;
  }


  .nav-pills .nav-link.active.ongoing {
    background-color: #28a745;
    color: #fff;
  }
  .nav-pills .nav-link.active.settled {
    background-color: #ffc107;
    color: #212529;
  }
  .nav-pills .nav-link.active.canceled {
    background-color: #dc3545;
    color: #fff;
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
                <li class="breadcrumb-item active">Blotter Records</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="font-weight: bold; margin-top: 10px;">Blotter Records</h3>
              <span onclick="window.location.href='subcontents/BlotterForm.php'" class="btnSave bg-1 text-fff text-bold" id="create-resident-btn">Blotter Form</span>
            </div>
            <div class="card-body">
              <div class="container-fluid">
                <div class="card-container row">
                  <div class="col-lg-2">
                    <div class="mb-4 mt-3">
                      <div class="mb-3">Filtered Status: </div>
                      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active all" data-status-id="ongoing" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">All Blotters</a>
                        <a class="nav-link ongoing" data-status-id="ongoing" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Ongoing</a>
                        <a class="nav-link settled" data-status-id="settled" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Settled</a>
                        <a class="nav-link canceled"  data-status-id="canceled" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Canceled</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="mb-1">
                      <div class="table-responsive">
                        <table id="blotterdt" class="table table-sm table-hover table-striped" style="width: 100% !important;">
                          <thead>
                            <tr>
                              <th class="align-middle bt-0">Case Number</th>
                              <th class="align-middle bt-0">Person Involved</th>
                              <th class="align-middle bt-0">Date Filled</th>
                              <th class="align-middle bt-0 text-center">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- PHP Loop starts here -->
                            <?php
                              require 'includes/dbhandler.inc.php';
                              $sql = "SELECT br.*, bs.StatusName 
                              FROM BlotterRecords_tbl br 
                              JOIN BlotterStatus_tbl bs ON br.StatusID = bs.StatusID";
                              $result = $conn->query($sql);

                              if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                  $statusID = $row['StatusID'];
                                  $statusClass = strtolower($row['StatusName']);
                                  ?>
                                  <tr class="<?php echo $statusClass; ?>">
                                    <td class="align-middle">
                                      <div class="text-inverse"> <?php echo $row['CaseNumber']; ?></div>
                                    </td>
                                    <td class="align-middle">
                                      <div><?php echo $row['ComplainantName']; ?> vs <?php echo $row['RespondentName']; ?></div>
                                    </td>
                                    <td class="align-middle">
                                      <div><span><?php echo $row['DateFiled']; ?></span></div>
                                    </td>
                                    <td class="align-middle text-center">
                                      <a href="subcontents/viewDetailedBlotterRecord.php?id=<?php echo $row['BlotterID']; ?>" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>

                                      <button class="btn btn-info"><i class="fas fa-info-circle"></i>Update</button>
                                    </td>
                                  </tr>
                                  <?php
                                }
                              }
                              ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
      <!-- /.content -->

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



<!-- JavaScript -->
<script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="adminfiles/dist/js/adminlte.min.js"></script>

<!-- Script for Status Validation -->
<script>
$(document).ready(function() {
    // Add click event listener to status tabs
    $('.nav-pills .nav-link').click(function() {
        var status = $(this).attr('class').split(' ')[1]; // Get the second class of the clicked tab
        filterRecords(status); // Call the function to filter records
    });
});

function filterRecords(status) {
    // Show all table rows if "All" is selected
    if (status === "all") {
        $('#blotterdt tbody tr').show();
    } else {
        // Hide all table rows initially
        $('#blotterdt tbody tr').hide();
        // Show table rows with matching status class
        $('.' + status).show();
    }
}
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
new DataTable('#blotterdt', {
    layout: {
        topStart: {
            buttons: [
                'copy', 'csv', 'excel', {
                    extend: 'pdf',
                    text: 'PDF',
                    exportOptions: {
                        columns: ':not(:first-child, :last-child)'
                    }
                }, {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: ':not(:first-child, :last-child)'
                    }
                }, {
                    extend: 'colvis',
                    postfixButtons: ['colvisRestore']
                }
            ]
        }
    },
    columnDefs: [
        { type: 'null', targets: '_all' },
        { targets: -1, visible: true }
    ],
    language: {
        search: '<span class="text-left">Search:</span>',
        emptyTable: '<div class="custom-danger">No Users found.</div>'
    }
});
</script>
</body>
</html>