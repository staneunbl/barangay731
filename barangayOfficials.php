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
  <title>Barangay Officials Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="adminfiles/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="adminfiles/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="adminfiles/dist/css/ogcss.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                <li class="breadcrumb-item active">Barangay Officials List</li>
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
                <h3 class="card-title" style="font-weight: bold; margin-top: 10px;">Barangay Officials</h3>
                 <?php
                // Check if the session username is set
                if(isset($_SESSION['username'])) {
                  // Fetch the RoleID from the database for the logged-in user
                  $username = $_SESSION['username'];
                  $roleQuery = "SELECT RoleID FROM users_tbl WHERE Username = '$username'";
                  $roleResult = mysqli_query($conn, $roleQuery);

                  // Check if the query was successful and if the logged-in user has RoleID not equal to 3
                  if($roleResult && mysqli_num_rows($roleResult) > 0) {
                    $row = mysqli_fetch_assoc($roleResult);
                    if(!isset($row['RoleID']) || $row['RoleID'] != 3) {
                      // Create Officials Button
                      echo '<button class="btnSave bg-1 text-fff text-bold at-modal__button--primary createofficials-button float-right" type="button" data-toggle="modal" data-target="#modal-10"><i class="fas fa-plus fa-xs"></i> Create Official</button>';
                      
                    }
                  }
                }
                ?>
              </div>
              <div class="card-header">
                  <div class="formHeader row">
                      <div class="filter-section fl" style="margin-left: 10px;"> 
                          <label for="filter" class="filter-label">Filter by:</label>
                          <select name="filter" id="filter">
                              <option value="active" <?php echo ($filter == 'active') ? 'selected' : ''; ?>> Active Officials </option>
                              <option value="inactive" <?php echo ($filter == 'inactive') ? 'selected' : ''; ?>> Archived Officials </option>
                          </select>
                          <input type="hidden" name="filter_value" id="filter_value" value="<?php echo $filter; ?>"> 
                      </div>  
                      <div style="flex-grow: 1;"></div>
                      
                 <?php
                // Check if the session username is set
                if(isset($_SESSION['username'])) {
                  // Fetch the RoleID from the database for the logged-in user
                  $username = $_SESSION['username'];
                  $roleQuery = "SELECT RoleID FROM users_tbl WHERE Username = '$username'";
                  $roleResult = mysqli_query($conn, $roleQuery);

                  // Check if the query was successful and if the logged-in user has RoleID not equal to 3
                  if($roleResult && mysqli_num_rows($roleResult) > 0) {
                    $row = mysqli_fetch_assoc($roleResult);
                    if(!isset($row['RoleID']) || $row['RoleID'] != 3) {
                      // Create Officials Button
                      echo '<button class="btnSave bg-1 text-fff text-bold at-modal__button--primary createpositions-button" type="button" data-toggle="modal" data-target="#modal-9" style="margin-right: 8px;"><i class="fas fa-plus fa-xs"></i> Create Position</button>';
                      
                    }
                  }
                }
                ?>
                      
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
                <table id="barangayofficialslistdt" style="width: 100% !important;" class="table table-sm table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Barangay ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Middle Name</th>
                      <th>Position Name</th>
                      <th>IsActive</th>
                      <th>IsArchived</th>
                      <th class="action-header">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr class='bg-2'>";
                        echo "<td>" . $row['BrgyOfficialId'] . "</td>";
                        echo "<td>" . $row['FirstName'] . "</td>";
                        echo "<td>" . $row['LastName'] . "</td>";
                        echo "<td>" . $row['MiddleName'] . "</td>";
                        echo "<td>" . $row['PositionName'] . "</td>";
                        echo "<td>" . ($row["IsActive"] ? "Yes" : "No") . "</td>";
                        echo "<td>" . ($row["IsArchived"] ? "Yes" : "No") . "</td>";
                        echo "<td style='text-align: center;'>";
                        if ($filter != 'inactive') {
                        echo '<div class="btn-group" role="group" aria-label="Actions">';

                          echo '<button class="at-modal__button5 at-modal__button--primary updateofficials-button updateofficials-button" type="button" data-toggle="modal" data-target="#modal-11" data-officials-id="' . $row['BrgyOfficialId'] . '"><i class="fas fa-edit"></i></button>';
                        }
                        if ($filter != 'inactive') {
                        echo '<button class="btn btn-archive" type="button" data-toggle="modal" data-modal-action="open" data-target="#modal-8" data-officials-id="' . $row['BrgyOfficialId'] . '"> <i class="fas fa-archive"></i></button>';
                        }
                        echo "</td>";
                        echo "</tr>";
                        echo "</div>";
                      }
                    }
                    $conn->close();
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
<!-- Modal for Create Position -->
<div class="modal" id="modal-9" tabindex="-1" role="dialog" aria-labelledby="modal-9-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-9-title">Create Barangay Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="at-modal__section9"> <!-- Content will be loaded here --></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Creating Official -->
<div class="modal" id="modal-10" tabindex="-1" data-target=".bd-example-modal-sm" role="dialog" aria-labelledby="modal-10-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-10-title">Create Barangay Official</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="at-modal__section10"> <!-- Content will be loaded here --></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Updating Official -->
<div class="modal" id="modal-11" tabindex="-1" role="dialog" aria-labelledby="modal-10-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-11-title">Update Barangay Official</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="at-modal__section11"> <!-- Content will be loaded here --></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="adminfiles/dist/js/adminlte.min.js"></script>

<!-- Script for Filteration -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var filterSelect = document.getElementById("filter");
        filterSelect.addEventListener("change", function() {
            applyFilter(this.value);
        });

        function applyFilter(selectedOption) {
            var currentUrl = window.location.href;
            var url = currentUrl.includes('?') ? currentUrl.split('?')[0] : currentUrl;
            var newUrl = url + '?filter=' + selectedOption;
            window.location.href = newUrl;
        }
    });
</script>

<!-- Script for Archive Button with SweetAlert Confirmation -->
<script>
// Confirm archive action event
jQuery('.btn-archive').on('click', function(e) {
  e.preventDefault();
  var officialsID = jQuery(this).data('officials-id');
  
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, archive it!"
  }).then((result) => {
    if (result.isConfirmed) {
      var url = "includes/deleteOfficial.inc.php?BrgyOfficialId=" + officialsID;
      jQuery.ajax({
        url: url,
        method: 'GET',
        success: function(response) {
          Swal.fire({
            title: "Archived!",
            text: "The Barangay Official has been archived.",
            icon: "success"
          }).then((result) => {
            window.location.reload();
          });
        },
        error: function(xhr, status, error) {
          console.error("AJAX Error:", error);
          Swal.fire({
            title: "Error!",
            text: "Failed to archive the Barangay Official.",
            icon: "error"
          });
        }
      });
    }
  });
});
</script>

<!-- Ajax Function for Create Postions Modal -->
<script>
    $(document).ready(function() {
        $('.createpositions-button').on('click', function(e) {
            e.preventDefault();
            var modal = $('#modal-9');
            var contentSection = modal.find('.at-modal__section9');
            var officialsID = 123;
            $.ajax({
                url: 'subcontents/createPositions.php?BrgyOfficialId=' + officialsID,
                type: 'GET',
                success: function(response) {
                    contentSection.html(response);
                    modal.modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });
    });
</script>

<!-- Ajax Function for Create Officials Modal -->
<script>
    $(document).ready(function() {
        $('.createofficials-button').on('click', function(e) {
            e.preventDefault();
            var modal = $('#modal-10');
            var contentSection = modal.find('.at-modal__section10');
            var officialsID = 123;
            $.ajax({
                url: 'subcontents/createOfficials.php?BrgyOfficialId=' + officialsID,
                type: 'GET',
                success: function(response) {
                    contentSection.html(response);
                    modal.modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });
    });
</script>

<!-- Ajax Function for Update Officials Modal-->
<script>
$(document).ready(function() {
    $('.updateofficials-button').on('click', function(e) {
        e.preventDefault();
        var modal = $('#modal-11');
        var contentSection = modal.find('.at-modal__section11');
        var officialsID = $(this).data('officials-id');
        $.ajax({
            url: 'subcontents/updateOfficials.php?BrgyOfficialId=' + officialsID,
            type: 'GET',
            success: function(response) {
                contentSection.html(response);
                modal.modal('show');
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
            }
        });
    });
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
  new DataTable('#barangayofficialslistdt', {
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
      emptyTable: '<div class="custom-danger">No Barangay Officials found.</div>'
    }
  });
</script>
</body>
</html>