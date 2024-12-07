<?php
session_start();

require 'includes/dbhandler.inc.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $currentPassword = $_POST['current_password'];
  $newPassword = $_POST['new_password'];
  $confirmPassword = $_POST['confirm_password'];

  if ($newPassword !== $confirmPassword) {
    echo json_encode(array("success" => false, "message" => "Passwords do not match"));
    exit();
  }

  $sql = "SELECT Password FROM users_tbl WHERE Username = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo json_encode(array("success" => false, "message" => "Database error"));
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $storedHashedPassword);

  if (!mysqli_stmt_fetch($stmt)) {
    echo json_encode(array("success" => false, "message" => "Failed to fetch data"));
    exit();
  }

  mysqli_stmt_close($stmt);

    // Validate current password
  if (password_verify($currentPassword, $storedHashedPassword)) {
        // Hash the new password
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password in the database
    $updateSql = "UPDATE users_tbl SET Password = ? WHERE Username = ?";
    $updateStmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($updateStmt, $updateSql)) {
      echo json_encode(array("success" => false, "message" => "Database error"));
      exit();
    }

    mysqli_stmt_bind_param($updateStmt, "ss", $hashedNewPassword, $username);
    mysqli_stmt_execute($updateStmt);
    mysqli_stmt_close($updateStmt);

    echo json_encode(array("success" => true, "message" => "Password changed successfully"));
    exit();
  } else {
    echo json_encode(array("success" => false, "message" => "Incorrect current password"));
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Admin Change Password </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="adminfiles/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="adminfiles/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="adminfiles/dist/css/ogcss.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="shortcut icon" href="builtimages/left_logo.png" type="image/x-icon">  
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

  .custom-control-input[type="radio"]:not(:disabled)~.custom-control-label::before {
    width: 1.2rem;
    height: 1.1rem;
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
            <li class="nav-item">
              <a href="barangayOfficials.php" class="nav-link">
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
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="row flex-lg-nowrap">
              <div class="col-12 col-md-3 mb-3">
                <div class="card">
                  <div class="alert custom-alert alert-dismissible fade show" role="alert">
                    <p><i class="fa fa-arrow-right"></i> Enter your current password in the "Current Password" field.</p>
                    <p><i class="fa fa-arrow-right"></i> Enter your desired new password in the "New Password" field.</p>
                    <p><i class="fa fa-arrow-right"></i> Confirm your new password in the "Confirm New Password" field.</p>
                    <p><i class="fa fa-arrow-right"></i> Click on the "Change Password" button to apply changes.</p>
                    <p>Make sure to keep your new password safe and secure!</p>
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button> -->
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="row">
                      <div class="col mb-3">
                        <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_password'): ?>
                          <p style="color: red;">Incorrect current password. Please try again.</p>
                        <?php endif; ?>
                        <form id="changePasswordProfile2" action="adminChangePassword.php" method="post">

                          <div class="card">
                            <div class="card-body">
                              <div class="e-profile">
                                <div class="row">
                                  <div class="col-12 col-sm-auto mb-3">
                                    <!-- Some content here -->
                                  </div>
                                </div>
                                <ul class="nav nav-tabs">
                                  <li class="nav-item"><a href="" class="active nav-link">Change Password</a></li>
                                </ul>
                                <div class="tab-content pt-3">
                                  <div class="tab-pane active">
                                    <div class="row">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col-12">
                                            <div class="row">
                                              <div class="col">
                                                <div class="form-group">
                                                  <label for="current_password">Current Password</label>
                                                  <div class="input-group">
                                                    <input class="form-control" type="password" id="current_password" name="current_password" placeholder="••••••" required>
                                                    <div class="input-group-append">
                                                      <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword"><i class="fas fa-eye"></i></button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col">
                                                <div class="form-group">
                                                  <label for="new_password">New Password</label>
                                                  <div class="input-group">
                                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="••••••" required>
                                                    <div class="input-group-append">
                                                      <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword"><i class="fas fa-eye"></i></button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col">
                                                <div class="form-group">
                                                  <label for="confirm_password">Confirm <span class="d-none d-xl-inline">Password</span></label>
                                                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="••••••" required>
                                                </div>
                                              </div>
                                            </div><hr>
                                            <div class="row">
                                              <div class="col d-flex justify-content-end">
                                                <a href="adminProfile.php" class="btn btn-info mr-2">Back to Admin Profile</a>
                                                <input class="btn btn-primary" value="Change Password" type="submit" style="margin-right: 5px;">
                                              </div>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
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
              <script src="adminfiles/plugins/jquery/jquery.min.js"></script>
              <script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
              <script src="adminfiles/dist/js/adminlte.min.js"></script>
              <script>
                document.addEventListener("DOMContentLoaded", function() {
                  document.getElementById('changePasswordProfile2').addEventListener('submit', function(event) {
                    event.preventDefault();
                    Swal.fire({
                      title: "Do you want to change your password?",
                      icon: "question",
                      showDenyButton: true,
                      confirmButtonText: "Change",
                      denyButtonText: `Cancel`,
                      customClass: {
                        container: 'custom-swal-container',
                        popup: 'custom-swal-popup',
                        header: 'custom-swal-header',
                        title: 'custom-swal-title',
                        content: 'custom-swal-content',
                        actions: 'custom-swal-actions',
                        confirmButton: 'custom-swal-confirmButton',
                        denyButton: 'custom-swal-denyButton',
                      }
                    }).then((result) => {
                      if (result.isConfirmed) {
                        var formData = new FormData(document.getElementById('changePasswordProfile2')); // Get form data
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', 'adminChangePassword.php', true);
                        xhr.onload = function() {
                          if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                              Swal.fire({
                                title: "Success!",
                                text: response.message,
                                icon: "success"
                              }).then(() => {
                                window.location.href = 'LogIn.php?password_changed=success';
                              },2000);
                            } else {
                              Swal.fire("Error", response.message, "error").then(() => {
                                window.location.href = 'adminChangePassword.php';
                              });
                            }
                          } else {
                            Swal.fire("Error", "Server Error", "error").then(() => {
                              window.location.href = 'adminChangePassword.php';
                            });
                          }
                        };
                        xhr.send(formData);
                      } else if (result.isDenied) {
                        Swal.fire("Password change cancelled!", "", "info").then(() => {
                          window.location.href = 'adminChangePassword.php';
                        });
                      }
                    });
                  });
                });
              </script>
              <script>
                document.addEventListener("DOMContentLoaded", function() {
                  document.getElementById('toggleCurrentPassword').addEventListener('click', function() {
                    var currentPasswordInput = document.getElementById('current_password');
                    var toggleButton = document.getElementById('toggleCurrentPassword');
                    if (currentPasswordInput.type === 'password') {
                      currentPasswordInput.type = 'text';
                      toggleButton.classList.add('active');
                    } else {
                      currentPasswordInput.type = 'password';
                      toggleButton.classList.remove('active');
                    }
                  });

                  document.getElementById('toggleNewPassword').addEventListener('click', function() {
                    var newPasswordInput = document.getElementById('new_password');
                    var toggleButton = document.getElementById('toggleNewPassword');
                    if (newPasswordInput.type === 'password') {
                      newPasswordInput.type = 'text';
                      toggleButton.classList.add('active');
                    } else {
                      newPasswordInput.type = 'password';
                      toggleButton.classList.remove('active');
                    }
                  });
                });
              </script>
            </body>
            </html>