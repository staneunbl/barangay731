<?php
session_start();

require 'includes/dbhandler.inc.php';

// Fetch user records from the database
$filter = isset($_POST['filter_value']) ? $_POST['filter_value'] : 'active'; // Default to 'active' if filter not provided
$usersSql = "SELECT * FROM users_tbl";

if ($filter === 'active') {
  $usersSql .= " WHERE IsActive = 1";
} elseif ($filter === 'inactive') {
  $usersSql .= " WHERE IsActive = 0";
} elseif ($filter === 'adminuser') {
  $usersSql .= " WHERE RoleID = 1";
} elseif ($filter === 'constituentuser') {
  $usersSql .= " WHERE RoleID = 2";
} elseif ($filter === 'staffuser') {
  $usersSql .= " WHERE RoleID = 3";
}

$usersResult = mysqli_query($conn, $usersSql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Users List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="adminfiles/plugins/fontawesome-free/css/all.min.css">
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
                <li class="breadcrumb-item active">Users List</li>
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
            <h3 class="card-title" style="font-weight: bold; margin-top: 10px;">Users List</h3>
            <?php
            // Check if the session username is set
            if(isset($_SESSION['username'])) {
            // Fetch the RoleID from the database for the logged-in user
              $username = $_SESSION['username'];
              $roleQuery = "SELECT RoleID FROM users_tbl WHERE Username = '$username'";
              $roleResult = mysqli_query($conn, $roleQuery);

              // Check if the query was successful and if the logged-in user has RoleID not equal to 1 (Admin)
              if($roleResult && mysqli_num_rows($roleResult) > 0) {
                $row = mysqli_fetch_assoc($roleResult);
                if(!isset($row['RoleID']) || $row['RoleID'] != 3) {
                // Check if $row['UserID'] is set to prevent the undefined array key error
                  if(isset($row['UserID'])) {
                    echo '<button class="btnSave bg-1 text-fff text-bold at-modal__button--primary createuser-button float-right" type="button" data-toggle="modal" data-target="#modal-12" data-resident-id="' . $row['UserID'] . '"><i class="fas fa-plus fa-xs"></i> Create Users</button>';
                  } else {
                    echo '<button class="btnSave bg-1 text-fff text-bold at-modal__button--primary createuser-button float-right" type="button" data-toggle="modal" data-target="#modal-12"><i class="fas fa-plus fa-xs"></i> Create Users</button>';
                  }
                }
              }
            }
            ?>
          </div>
          <div class="card-header">
            <form action="" method="POST" name="listForm">
              <div class="formHeader row">
                <div class="filter-section fl" style="margin-right: 15px">
                  <label for="filter" class="filter-label">Filter by:</label>
                  <select name="filter" id="filter" onchange="applyFilter(this.value)">
                    <option value="active" <?php if ($filter == 'active') echo 'selected'; ?>>Active Users</option>
                    <option value="all" <?php if ($filter == 'all') echo 'selected'; ?>>All Users</option>
                    <option value="inactive" <?php if ($filter == 'inactive') echo 'selected'; ?>>Inactive Users</option>
                    <option value="adminuser" <?php if ($filter == 'adminuser') echo 'selected'; ?>>Admin User</option>
                    <option value="constituentuser" <?php if ($filter == 'constituentuser') echo 'selected'; ?>>Constituent User</option>
                    <option value="staffuser" <?php if ($filter == 'staffuser') echo 'selected'; ?>>Staff User</option>
                  </select>
                  <input type="hidden" name="filter_value" id="filter_value" value="<?php echo $filter; ?>">
                </div>
              </div> <!-- .formHeader row -->
            </div> <!-- .card-header -->
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="usersdt" style="width: 100% !important;" class="table table-sm table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Registration Date</th>
                      <th>Role</th>
                      <th>Active</th>
                      <th>Verified</th>
                      <th style="text-align:center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($usersResult)) {
                      echo "<tr>";
                      echo "<td><img src='uploads/ProfileImages/" . $row['Image'] . "' alt='Resident Picture' class='thumbnail' style='width: 50px; height: 50px;'></td>";
                      echo "<td>".$row['LastName']."</td>";
                      echo "<td>".$row['FirstName']."</td>";
                      echo "<td>".$row['Username']."</td>";
                      echo "<td>".$row['Email']."</td>";
                      echo "<td>".$row['RegistrationDate']."</td>";
                      echo "<td>" . ($row["RoleID"] == 1 ? "Admin" : ($row["RoleID"] == 2 ? "Constituent" : "Staff")) . "</td>";
                      echo "<td>" . ($row["IsActive"] ? "Yes" : "No") . "</td>";
                      echo "<td>" . ($row["IsVerified"] ? "Yes" : "No") . "</td>";
                      echo "<td class='action-buttons'>";
                      echo '<div class="btn-group" role="group" aria-label="Actions">';
                      
                      if(isset($_SESSION['username'])) {
        // Fetch the RoleID from the database for the logged-in user
                        $username = $_SESSION['username'];
                        $roleQuery = "SELECT RoleID FROM users_tbl WHERE Username = '$username'";
                        $roleResult = mysqli_query($conn, $roleQuery);

                        // Check if the query was successful and if the logged-in user has RoleID equal to 3 (Staff)
                        if($roleResult && mysqli_num_rows($roleResult) > 0) {
                          $userRow = mysqli_fetch_assoc($roleResult);
                          if(isset($userRow['RoleID']) && $userRow['RoleID'] != 1) {
                            // Check if $row['UserID'] is set to prevent the undefined array key error
                            if(isset($row['UserID'])) {
                              echo '<button disabled class="at-modal__button5 at-modal__button--primary edituser-button" style="cursor: not-allowed;" type="button" data-toggle="modal" data-target="#modal-5" data-resident-id="' . $row['UserID'] . '"><i class="fas fa-edit"></i></button>';
                            } else {
                              echo '<button disabled class="at-modal__button5 at-modal__button--primary edituser-button" style="cursor: not-allowed;" type="button" data-toggle="modal" data-target="#modal-5"><i class="fas fa-edit"></i></button>';
                            }
                          } else {
                            // Enable the button for users with RoleID equal to 3 (Staff)
                            if(isset($row['UserID'])) {
                              echo '<button class="at-modal__button5 at-modal__button--primary edituser-button" type="button" data-toggle="modal" data-target="#modal-5" data-resident-id="' . $row['UserID'] . '"><i class="fas fa-edit"></i></button>';
                            } else {
                              echo '<button class="at-modal__button5 at-modal__button--primary edituser-button" type="button" data-toggle="modal" data-target="#modal-5"><i class="fas fa-edit"></i></button>';
                            }
                          }
                        }
                      }

                      echo '<button class="at-modal__button4 at-modal__button--primary viewuser-button" type="button" data-toggle="modal" data-target="#modal-4" data-resident-id="' . $row['UserID'] . '"><i class="fas fa-eye"></i></button>';
                      echo "&nbsp;";
                      echo "</td>";
                      echo "</div>";
                      echo "</tr>";
                    }
                    ?>

                  </tbody>
                </table>
              </div> <!-- .table-responsive -->
            </div> <!-- .card-body -->
          </form> <!-- .end form -->
        </div> <!-- .card-header -->
      </div> <!-- .card -->
    </div> <!-- .col-12 -->
  </div> <!-- .row -->
</section> <!-- .content -->


    <!-- /.content-wrapper -->
    <footer class="main-footer no-print">
      <div class="float-right d-none d-sm-block">
      </div>All rights Reserved.
    </footer>


    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->



<script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="adminfiles/dist/js/adminlte.min.js"></script>

<!-- Modal for Edit User -->
<div class="modal" id="modal-5" tabindex="-1" role="dialog" aria-labelledby="modal-5-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-5-title">Update User</h5>
      </div>
      <div class="modal-body">
        <div class="at-modal__section5"> <!-- Content will be loaded here --></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for View User -->
<div class="modal" id="modal-4" tabindex="-1" role="dialog" aria-labelledby="modal-4-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-5-title">View User</h5>
      </div>
      <div class="modal-body">
        <div class="at-modal__section4"> <!-- Content will be loaded here --></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Create User -->
<div class="modal" id="modal-12" tabindex="-1" role="dialog" aria-labelledby="modal-12-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-12-title">Create User</h5>
      </div>
      <div class="modal-body">
        <div class="at-modal__section12"> <!-- Content will be loaded here --></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Ajax Function for Edit User Modal -->
<script>
  $(document).ready(function() {
    // Event delegation for the Edit User button
    $(document).on('click', '.edituser-button', function(e) {
      e.preventDefault();
      var modal = $('#modal-5');
      var contentSection = modal.find('.at-modal__section5');
      var residentID = $(this).data('resident-id');
      $.ajax({
        url: 'subcontents/updateUser.php?id=' + residentID,
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

<!-- Ajax Function for View Users Modal -->
<script>
  $(document).ready(function() {
    // Event delegation for the View User button
    $(document).on('click', '.viewuser-button', function(e) {
      e.preventDefault();
      var modal = $('#modal-4');
      var contentSection = modal.find('.at-modal__section4');
      var residentID = $(this).data('resident-id');
      $.ajax({
        url: 'subcontents/viewUser.php?id=' + residentID,
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

<!-- Ajax Function for Create Users Modal -->
<script>
  $(document).ready(function() {
    // Event delegation for the Create User button
    $(document).on('click', '.createuser-button', function(e) {
      e.preventDefault();
      var modal = $('#modal-12');
      var contentSection = modal.find('.at-modal__section12');
      var residentID = $(this).data('resident-id');
      $.ajax({
        url: 'subcontents/createUser.php?id=' + residentID,
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

<!-- Script for Filteration -->
<script>
  function applyFilter(selectedOption) {
    document.getElementById("filter_value").value = selectedOption;
    document.forms["listForm"].submit();
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
  new DataTable('#usersdt', {
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