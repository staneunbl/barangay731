<?php
session_start();

require 'includes/dbhandler.inc.php';

$sql = "SELECT Household_tbl.*, COUNT(Residents_tbl.ResidentID) AS NumResidents 
FROM Household_tbl 
LEFT JOIN Residents_tbl ON Household_tbl.HouseholdID = Residents_tbl.HouseholdID 
GROUP BY Household_tbl.HouseholdID";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Household List</title>
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
                <li class="breadcrumb-item active">Household List</li>
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
                <h3 class="card-title" style="font-weight: bold; margin-top: 10px;">Household List</h3>
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
                      // Check if $row['UserID'] is set to prevent the undefined array key error
                      if(isset($row['UserID'])) {
                        echo '<span class="btnSave bg-1 text-fff text-bold at-modal__button--primary createhousehold-button float-right" type="button" data-toggle="modal" data-target="#modal-7" data-household-id=""><i class="fas fa-plus fa-xs"></i> Create Household</span>';
                      } else {
                        echo '<span class="btnSave bg-1 text-fff text-bold at-modal__button--primary createhousehold-button float-right" type="button" data-toggle="modal" data-target="#modal-7"><i class="fas fa-plus fa-xs"></i> Create Household</span>';
                      }
                    }
                  }
                }
                ?>
                <!--summary report button-->
                <button id="summaryReportButton" class="btn btn-info float-right" style="margin-right: 5px;" onclick="window.location.href='householdSummaryReport.php'"> <i class="fas fa-file-alt"></i> Generate Summary</button>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="householddt" style="width: 100% !important;" class="table table-sm table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Household ID</th>
                        <th>Household Number</th>
                        <th>Household Name</th>
                        <th>Cluster ID</th>
                        <th>Number of Residents</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='bg-2'>";
                        echo "<td>" . $row['HouseholdID'] . "</td>";
                        echo "<td>" . $row['HouseHoldNumber'] . "</td>";
                        echo "<td>" . $row['HouseholdName'] . "</td>";
                        echo "<td>" . $row['ClusterId'] . "</td>";
                        echo "<td>" . $row['NumResidents'] . "</td>"; 
                        echo "<td class='action-buttons'>";
                        echo '<div class="btn-group" role="group" aria-label="Actions">';

                        echo '<a href="subcontents/updateHousehold.php?id=' . $row['HouseholdID'] . '&cluster_id=' . $row['ClusterId'] . '" class="at-modal__button2 at-modal__button--primary edit-button" data-modal-action="open" data-modal-target="modal-2" data-resident-id="' . $row['HouseholdID'] . '"><i class="fas fa-edit"></i></a>';

                        echo '<a href="subcontents/viewHouseholdResidents.php?id=' . $row['HouseholdID'] . '" class="at-modal__button1 at-modal__button--primary view-button" data-modal-action="open" data-modal-target="modal-2" data-resident-id="' . $row['HouseholdID'] . '"><i class="fas fa-eye"></i></a>';
                        echo "</td>";
                        echo "</div>";
                        echo "</tr>";
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


  <script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="adminfiles/dist/js/adminlte.min.js"></script>

  <!-- Script for Filteration -->
  <script>
    function applyFilter(selectedOption) {
      document.getElementById("filter_value").value = selectedOption;
      document.forms["listForm"].submit();
    }
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

<!-- Modal for Create Household -->
<div class="modal" id="modal-7" tabindex="-1" role="dialog" aria-labelledby="modal-7-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-7-title">Create Household</h5>
      </div>
      <div class="modal-body">
        <div class="at-modal__section7"> <!-- Content will be loaded here --></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Ajax Function for Create Users Modal -->
<script>
  $(document).ready(function() {
    $('.createhousehold-button').on('click', function(e) {
      e.preventDefault();
      var modal = $('#modal-7');
      var contentSection = modal.find('.at-modal__section7');
      var householdID = $(this).data('household-id');
      $.ajax({
        url: 'subcontents/createHousehold.php?id=' + householdID,
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
  new DataTable('#householddt', {
    layout: {
      topStart: {
        buttons: [
          'copy', 'csv', 'excel', {
            extend: 'pdf',
            text: 'PDF',
            exportOptions: {
                columns: ':not(:last-child)' // Exclude last column from PDF export
              }
            }, {
              extend: 'print',
              text: 'Print',
              exportOptions: {
                columns: ':not(:last-child)' // Exclude last column from Print
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
      emptyTable: '<div class="custom-danger">No Household found.</div>'
    }
  });
</script>

</body>
</html>