<?php
require 'includes/dbhandler.inc.php';

if (isset($_GET['id'])) {
  $userID = $_GET['id'];

  $sql = "SELECT * FROM users_tbl WHERE UserID = $userID";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin Update Profile</title>
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

<!--             <li class="nav-item dropdown">
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
                  <h1>Update Profile</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="AdminDashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="adminProfile.php">Profile</a></li>
                    <li class="breadcrumb-item active">Update Profile</li>

                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <section class="content">
            <div class="row">
              <div class="row flex-lg-nowrap">
                <div class="col-12 col-md-2">
                  <div class="card">
                    <div class="alert custom-alert alert-dismissible fade show" role="alert">
                      Welcome to the Profile Edit Page! Here, you can update your profile information such as your name, username, email, phone number, and more. Make sure to review your changes before saving them.
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button> -->
                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="row">
                      <div class="col mb-3">
                        <?php if (isset($error_message)) : ?>
                          <div class="error"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <form id="updateProfileForm2" action="includes/updateUserProfile.inc.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                          <input type="hidden" name="userID" value="<?php echo $row['UserID']; ?>">
                          <div class="card">
                            <div class="card-body">
                              <div class="e-profile">
                                <div class="row">
                                  <div class="col-12 col-sm-auto mb-3">
                                    <div class="mx-auto" style="width: 140px;">
                                      <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                        <img src="uploads/ProfileImages/<?php echo htmlspecialchars($row['Image']); ?>" alt="<?php echo $row['Image']; ?>?v=<?php echo time(); ?>" alt="<?php echo $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName']. ' ' . $row['Suffix']; ?>" class="rounded" style="height: 140px; width: 140px;">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                    <div class="text-center text-sm-left mb-2 mb-sm-0">
                                      <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">
                                        <?php 
                                        echo $row['FirstName'] . ' ' .
                                        $row['MiddleName'] . ' ' . 
                                        $row['LastName']. ' ' . 
                                        $row['Suffix']; 
                                        $is_verified = $row['IsVerified'];

                                        if ($is_verified) {
                                          echo '<svg style="margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="3%" height="4%">
                                          <path fill="#28a745" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM241 337l-17 17-17-17-80-80L161 223l63 63L351 159 385 193 241 337z"/>
                                          </svg>';
                                        }
                                        ?>
                                      </h4>
                                      <p class="mb-0"><?php echo $row['Email']; ?></p>
                                      <div class="text-muted"><small><?php echo $row['Phone']; ?></small></div>
                                      <div class="mt-2">
                                        <button class="btn btn-primary" style="position: relative; overflow: hidden;">
                                          <input type="file" class="text-center center-block well well-sm" name="image" id="fileInput" style="position: absolute; top: 0; right: 0; opacity: 0; width: 100%; height: 100%;" onchange="displayFileName()" accept="image/png, image/jpeg, image/jpg">
                                          <i class="fas fa-camera" style="margin-right: 5px;"></i> Choose File
                                        </button>
                                      </div>
                                    </div>
                                    <div class="text-center text-sm-right">
                                      <span class="badge badge-secondary">Role</span>
                                      <div class="text-muted"><small>Joined <?php echo date('F j, Y', strtotime($row['RegistrationDate'])); ?></small></div>
                                    </div>
                                  </div>
                                </div>
                                <ul class="nav nav-tabs">
                                  <li class="nav-item"><a href="" class="active nav-link">Update Profile</a></li>
                                </ul>
                                <div class="tab-content pt-3">
                                  <div class="tab-pane active">
                                    <div class="row">
                                      <div class="col">
                                        <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>First Name</label>
                                              <input class="form-control" type="text" name="firstName"value="<?php echo $row['FirstName']; ?>">
                                            </div>
                                          </div>
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Last Name</label>
                                              <input class="form-control" type="text" name="lastName" value="<?php echo $row['LastName']; ?>">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Middle Name</label>
                                              <input class="form-control" type="text" name="middleName" value="<?php echo $row['MiddleName']; ?>">
                                            </div>
                                          </div>
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Suffix</label>
                                              <input class="form-control" type="text" name="suffix" value="<?php echo $row['Suffix']; ?>">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>UserName</label>
                                              <input class="form-control" type="text" name="username" value="<?php echo $row['Username']; ?>">
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Email</label>
                                              <input class="form-control" type="text" name="email" value="<?php echo $row['Email']; ?>">
                                            </div>
                                          </div>
                                          <div class="col">
                                            <div class="form-group">
                                              <label>Phone</label>
                                              <input class="form-control" type="text" name="phone" value="<?php echo $row['Phone']; ?>">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div><hr>
                                    <div class="row">
                                      <div class="col d-flex justify-content-end">
                                        <a href="adminProfile.php" class="btn btn-info mr-2">Back to Admin Profile</a>
                                        <input class="btn btn-primary" value="Save Changes" type="submit" style="margin-right: 5px;">
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
            </section>

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
            <!-- /.content -->





            <!-- /.content-wrapper -->
          <script src="adminfiles/plugins/jquery/jquery.min.js"></script>
          <script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
          <script src="adminfiles/dist/js/adminlte.min.js"></script>

          <script>
            document.getElementById('updateProfileForm2').addEventListener('submit', function(event) {
        // Prevent default form submission
              event.preventDefault();
        var formData = new FormData(this); // Get form data
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/updateUserProfile.inc.php', true);
        xhr.onload = function() {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
              Swal.fire({
                title: response.message,
                text: "You have successfully updated your Profile!",
                icon: "success"
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = 'adminProfile.php';
                }
              });
            } else {
              Swal.fire({
                title: "Error",
                text: response.message,
                icon: "error"
              });
            }
          } else {
                // Handle errors if any
            Swal.fire({
              title: "Error",
              text: "Server Error",
              icon: "error"
            });
          }
        };
        xhr.send(formData);
      });
    </script>
    <script>
      function displayFileName() {
        var input = document.getElementById('fileInput');
        var fileName = input.files[0].name;
        var displayText = fileName.substring(0, 15);
        if (fileName.length > 15) {
          displayText += '..... | ';
        }
        var buttonText = document.querySelector('.btn-primary').childNodes[2];
        buttonText.textContent = displayText;
      }
    </script>
  </body>
  </html>
  <?php
} else {
  echo "User record not found.";
}
} else {
  echo "User ID not provided.";
}
?>