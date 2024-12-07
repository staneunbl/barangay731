<?php
session_start();
require 'includes/dbhandler.inc.php';

if (isset($_SESSION['UserID'])) {
  $userid = $_SESSION['UserID'];

  $sql = "SELECT u.*, rl.*
  FROM users_tbl u 
  LEFT JOIN roles rl ON rl.RoleID = u.RoleID
  WHERE u.UserID = ?";
  $stmt = mysqli_stmt_init($conn);
  if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    } else {
      echo "User record not found.";
    }
  } else {
    echo "Error: Failed to prepare SQL statement.";
  }
} else {
  header("Location: LogIn.php");
  exit();
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Admin Profile</title>
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

.profile-header-img img {
    max-width: 100%;
}

.profile-header {
    position: relative;
    overflow: hidden;
}
.profile-header .profile-header-cover {
    background: url(builtimages/left_logo.png) center no-repeat;
    background-size: 50% auto;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.profile-header .profile-header-cover:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25) 0, rgba(0, 0, 0, 0.50) 100%);
}
.profile-header .profile-header-content,
.profile-header .profile-header-tab,
.profile-header-img,
body .fc-icon {
    position: relative;
}
.profile-header .profile-header-tab {
    background: #fff;
    list-style-type: none;
    margin: -1.25rem 0 0;
    padding: 0 0 0 8.75rem;
    border-bottom: 1px solid #c8c7cc;
    white-space: nowrap;
}
.profile-header .profile-header-tab > li {
    display: inline-block;
    margin: 0;
}
.profile-header .profile-header-tab > li > a {
    display: block;
    color: #000;
    line-height: 1.25rem;
    padding: 0.625rem 1.25rem;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.75rem;
    border: none;
}
.profile-header .profile-header-tab > li.active > a,
.profile-header .profile-header-tab > li > a.active {
    color: #007aff;
}
.profile-header .profile-header-content:after,
.profile-header .profile-header-content:before {
    content: "";
    display: table;
    clear: both;
}
.profile-header .profile-header-content {
    color: #fff;
    padding: 1.25rem;
}
body .fc th a,
body .fc-ltr .fc-basic-view .fc-day-top .fc-day-number,
body .fc-widget-header a {
    color: #000;
}
.profile-header-img {
    float: left;
    width: 7.5rem;
    height: 7.5rem;
    overflow: hidden;
    z-index: 10;
    margin: 0 1.25rem -1.25rem 0;
    padding: 0.1875rem;
    -webkit-border-radius: 0.25rem;
    -moz-border-radius: 0.25rem;
    border-radius: 0.25rem;
}
.profile-header-info h4 {
    font-weight: 500;
    margin-bottom: 0.3125rem;
}
.profile-container {
    padding: 1.5625rem;
}
@media (max-width: 967px) {
    .profile-header-img {
        width: 5.625rem;
        height: 5.625rem;
        margin: 0;
    }
    .profile-header-info {
        margin-left: 4rem;
        padding-bottom: 0.9375rem;
    }
    .profile-header .profile-header-tab {
        padding-left: 0;
    }
}
@media (max-width: 767px) {
    .profile-header .profile-header-cover {
        background-position: top;
    }
    .profile-header-img {
      margin-top:20px;
        width: 4rem;
        height: 4rem;
    }

    .profile-header-info h4 {
        margin: 0 0 0.3125rem;
    }
    .profile-header .profile-header-tab {
        white-space: nowrap;
        overflow: scroll;
        padding: 0;
    }
    .profile-container {
        padding: 0.9375rem 0.9375rem 3.6875rem;
    }


.coming-soon-cover img,
.email-detail-attachment .email-attachment .document-file img,
.email-sender-img img,
.friend-list .friend-img img,
.profile-header-img img {
    max-width: 100%;
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

<!--       <li class="nav-item dropdown">
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="AdminDashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Admin Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div class="col-lg-9">
                <div class="card card-info">
                  <!-- /.card-header -->
                  <div class="profile-header">
                    <div class="profile-header-cover"></div>
                    <div class="profile-header-content">
                      <div class="profile-header-img">
                        <img src="uploads/ProfileImages/<?php echo $row['Image']; ?>" alt="<?php echo $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName']. ' ' . $row['Suffix']; ?>" class="rounded" width="200">
                      </div>

                      <div class="profile-header-info p-4">
                        <h4 class="m-t-sm">
                          <?php 
                          echo $row['FirstName'] . ' ' .
                          $row['MiddleName'] . ' ' . 
                          $row['LastName']. ' ' . 
                          $row['Suffix']; 
                          $is_verified = $row['IsVerified'];

                          if ($is_verified) {
                                // Display the "Verified" icon with Bootstrap's success green color
                            echo '<svg style="margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="2%" height="2%">
                            <path fill="#28a745" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM241 337l-17 17-17-17-80-80L161 223l63 63L351 159 385 193 241 337z"/>
                            </svg>';
                          }
                          ?> 
                        </h4>
                        <p class="m-b-sm"><?php echo $row['RoleName']; ?> of Barangay 731</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">User Profile</h3>
                  </div>
                  <div class="panel-body">
                    <table class="table profile__table">
                      <tbody>
                        <tr>
                          <th><strong>Role</strong></th>
                          <td><?php echo $row['RoleName']?></td>
                        </tr>
                        <tr>
                          <th><strong>Full Name</strong></th>
                          <td><?php echo $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName'] . ' ' . $row['Suffix']; ?></td>
                        </tr>
                        <tr>
                          <th><strong>Email</strong></th>
                          <td><?php echo $row['Email']; ?></td>
                        </tr>
                        <tr>
                          <th><strong>Phone Number</strong></th>
                          <td><?php echo $row['Phone']; ?></td>
                        </tr>
                        <tr>
                          <th><strong>Registration Date</strong></th>
                          <td><?php echo $row['RegistrationDate']; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
              <div class="col-lg-3">

                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Manage Profile</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <a class='btn btn-primary btn-block' href=adminChangePassword.php>Change Password</a>
                    </div>
                   
                    <div class="row">
                      <a class='btn btn-info btn-block mt-2' href='adminUpdateProfile.php?id=<?php echo $row['UserID']; ?>'>Edit Profile</a>
                    </div>

                    <div class="row">
                      <form id="deactivateForm" class="btn-block" method="POST"> <!-- Change method to "POST" -->
                        <input type="hidden" name="userID" value="<?php echo $row['UserID']; ?>">
                        <button type="button" id="deactivateBtn" class="btn btn-danger btn-block mt-2 btn-deactivate">Deactivate Account</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- /.content -->
        </div>
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

        <!-- Script for Deactivate Button with SweetAlert Confirmation -->
        <script>
          jQuery('#deactivateBtn').on('click', function(e) {
            e.preventDefault();
            var userID = jQuery(this).closest('form').find('input[name="userID"]').val();

            Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, deactivate it!"
            }).then((result) => {
              if (result.isConfirmed) {
                var url = "includes/deactivateAccount.inc.php?id=" + userID;

                jQuery.ajax({
                  url: url,
                method: 'GET', // Use GET method
                success: function(response) {
                  response = JSON.parse(response);
                  if (response.status === 'success') {
                    Swal.fire({
                      title: "Deactivated!",
                      text: "Your account has been deactivated. You will be logged out.",
                      icon: "success"
                    }).then((result) => {
                      window.location.href = "login.php";
                    });
                  } else {
                    Swal.fire({
                      title: "Error!",
                      text: response.message,
                      icon: "error"
                    });
                  }
                },
                error: function(xhr, status, error) {
                  console.error("AJAX Error:", error);
                  Swal.fire({
                    title: "Error!",
                    text: "Failed to deactivate your account.",
                    icon: "error"
                  });
                }
              });
              }
            });
          });
        </script>
    </body>
    </html>