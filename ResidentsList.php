<?php
session_start();
require "includes/dbhandler.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && !isset($_GET["filter"])) {
  header("Location: ?filter=active");
  exit();
}

$filter = isset($_GET["filter"]) ? $_GET["filter"] : "all";
$sql = "SELECT * FROM Residents_tbl";

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
  <title>Residents List</title>
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
                <li class="breadcrumb-item active">Resident List</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold; margin-top: 10px;">Residents List</h3>
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
                        echo '<span onclick="location.href=\'subcontents/createResident.php\'" class="btnSave bg-1 text-fff text-bold" id="create-resident-btn"><i class="fas fa-plus fa-xs"></i> Create Resident</span>';
                      } else {
                        echo '<span onclick="location.href=\'subcontents/createResident.php\'" class="btnSave bg-1 text-fff text-bold" id="create-resident-btn"><i class="fas fa-plus fa-xs"></i> Create Resident</span>';
                      }
                    }
                  }
                }
                ?>
              </div>
              <div class="card-header">
                <div class="formHeader row">
                  <div class="filter-section fl" style="margin-right: 10px;"> 
                    <label for="filter" class="filter-label">Filter by:</label>
                    <select name="filter" id="filter">
                      <option value="active" <?php echo $filter == "active"
                      ? "selected"
                      : ""; ?>> Active Officials </option>
                      <option value="inactive" <?php echo $filter == "inactive"
                      ? "selected"
                      : ""; ?>> Archived Officials </option>
                    </select>
                    <input type="hidden" name="filter_value" id="filter_value" value="<?php echo $filter; ?>"> 
                  </div>  
                </div>  
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="residentsdt" style="width: 100% !important;" class="table table-sm table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Gender</th>
                        <th>Birthday</th>
                        <th>Profession</th>
                        <th>Picture</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='bg-2'>";
                        echo "<td>" . $row["LastName"] . "</td>";
                        echo "<td>" . $row["FirstName"] . "</td>";
                        echo "<td>" . $row["MiddleName"] . "</td>";
                        echo "<td>" . $row["Gender"] . "</td>";
                        echo "<td>" . $row["Birthday"] . "</td>";
                        echo "<td>" . $row["Occupation"] . "</td>";
                        echo "<td><img src='uploads/" . $row["Image"] . "?v=" . time() . "' alt='Resident Picture' class='thumbnail' style='width: 50px; height: 50px;'></td>";
                        echo "<td class='action-buttons'>";

                        echo '<div class="btn-group" role="group" aria-label="Resident Actions">';

                        // Check if the filter is not set to "Archived" to display the edit button
                        if ($filter != "inactive") {
                          echo '<a href="subcontents/updateResident.php?id=' .
                          $row["ResidentID"] .
                          '" class="at-modal__button2 at-modal__button--primary edit-button"><i class="fas fa-edit"></i></a>';
                        }

                        echo '<a href="subcontents/viewResident.php?id=' .
                        $row["ResidentID"] .
                        '" class="at-modal__button1 at-modal__button--primary viewresident-button" ' .
                        'data-modal-action="open" ' .
                        'data-modal-target="modal-1" ' .
                        'data-resident-id="' .
                        $row["ResidentID"] .
                        '"><i class="fas fa-eye"></i> </a>';

                        // Check if the filter is not set to "Archived" to display the archive button
                        if ($filter != "inactive") {

                          echo '<button class="btn btn-archive" type="button" data-toggle="modal" data-modal-action="open" data-target="#modal-3" data-resident-id="' . $row['ResidentID'] . '"> <i class="fas fa-archive"></i></button>';

                          echo '<a href="barangayIndigencyCertificatePDF.php?id=' . $row["ResidentID"] . '"role="button" class="at-modal__button8"><i class="fas fa-file-pdf"></i></a>';
                        }
                        echo "</td>";
                        echo "</div>";
                      } ?>
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


  <script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="adminfiles/dist/js/adminlte.min.js"></script>

  <!-- Modal for View User -->
  <div class="modal" id="modal-1" tabindex="-1" role="dialog" aria-labelledby="modal-1-title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-1-title">View Resident</h5>
        </div>
        <div class="modal-body">
          <div class="at-modal__section1"> <!-- Content will be loaded here --></div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Script for Archive Button with SweetAlert Confirmation -->
  <script>
    jQuery('.btn-archive').on('click', function(e) {
      e.preventDefault();
      var residentID = jQuery(this).data('resident-id');
      
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
          var url = "includes/archive_resident.inc.php?id=" + residentID;
          jQuery.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
          // Handle success response
              Swal.fire({
                title: "Archived!",
                text: "The resident has been archived.",
                icon: "success"
              }).then((result) => {
                window.location.reload();
              });
            },
            error: function(xhr, status, error) {
              console.error("AJAX Error:", error);
              Swal.fire({
                title: "Error!",
                text: "Failed to archive the resident.",
                icon: "error"
              });
            }
          });
        }
      });
    });
  </script>

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

 <!-- Ajax Function for View Users Modal -->
 <script>
  $(document).ready(function() {
    $(document).on('click', '.viewresident-button', function(e) {
      e.preventDefault();
      var modal = $('#modal-1');
      var contentSection = modal.find('.at-modal__section1');
      var residentID = $(this).data('resident-id');
      $.ajax({
        url: 'subcontents/viewResident.php?id=' + residentID,
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
  new DataTable('#residentsdt', {
    layout: {
      topStart: {
        buttons: [
          'copy', 'csv', 'excel',
          {
            extend: 'pdf',
            text: 'PDF',
            exportOptions: {
              columns: ':not(:last-child)'
            }
          },
          {
            extend: 'print',
            text: 'Print',
            exportOptions: {
              columns: ':not(:last-child)'
            }
          },
          {
            extend: 'colvis',
            postfixButtons: ['colvisRestore']
          }
          ]
      }
    },
    columnDefs: [{
      type: 'null',
      targets: '_all'
    }, {
      targets: -1,
      visible: true
    }],
    language: {
      emptyTable: '<div class="custom-danger">No Residents found.</div>'
    }
  });
</script>
</body>
</html>
