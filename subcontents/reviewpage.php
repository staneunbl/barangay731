<?php
require '../includes/dbhandler.inc.php';

if (isset($_GET['id'])) {
    $verificationID = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT v.*, u.Image AS user_image, CONCAT(r.HouseNumber, ' ', r.StreetName, ', ', r.CityName) AS address, r.Gender, r.Birthday, TIMESTAMPDIFF(YEAR, r.Birthday, CURDATE()) AS age FROM verification_tbl v 
            JOIN Users_tbl u ON v.UserID = u.UserID 
            JOIN residents_tbl r ON u.ResidentID = r.ResidentID
            WHERE v.VerificationID = '$verificationID'";
    $result = mysqli_query($conn, $sql);

    // Check if there is exactly one row corresponding to the given ID
    if (mysqli_num_rows($result) == 1) {
        // Fetch the row data
        $row = mysqli_fetch_assoc($result);

        $image_path = '../uploads/ProfileImages/' . $row['user_image'];
        
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Review Verification Page</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="../adminfiles/plugins/fontawesome-free/css/all.min.css">
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <link rel="stylesheet" href="../adminfiles/dist/css/adminlte.min.css">
            <link rel="stylesheet" href="../adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.min.css">
            <link rel="stylesheet" href="../adminfiles/dist/css/ogcss.css">
            <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">  
            <style>
                .row {
                    margin-left: 40px;
                    margin-right: 40px;
                }

                .card-body {
                    margin: 10px !important;
                }

                .card-info:not(.card-outline) .card-header {
                    background-color: #232743;
                }
            </style>
        </head>

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
                          <a href="../UsersList.php" class="nav-link">
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
                        <li class="nav-item">
                          <a href="../barangayOfficials.php" class="nav-link">
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

                <div class="content-wrapper">
                    <section class="content-header">
                    </section>
                    <section class="content">
                        <div class="row">
                            <div class="col-md-3">
                                <form action="" method="POST" class="form scrollX">
                                    <!-- Profile Image -->
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">User Profile</h3>
                                        </div>                                            
                                        <div class="text-center" style="padding: 20px;">
                                            <img src='<?php echo $image_path; ?>' alt="No image available" style='max-width: 200px; width: 100%;' class="rounded">
                                            <h4 class="profile-username text-center" style="margin-top: 15px;"><?php echo $row['FirstName'] . ' ' . $row['LastName'] . ' ' . $row['MiddleName'] . ' ' . $row['Suffix']; ?></h4>
                                            <h7 class=" text-center"> Address: <?php echo $row["address"]; ?></h7><br>
                                            <h7 class=" text-center"> Birthday: <?php echo $row["Birthday"]; ?></h7><br>
                                            <h7 class=" text-center"> Age: <?php echo $row["age"]; ?></h7>
                                            <hr>

                                            <h5 class=" text-center"> Username: <?php echo $row["Username"]; ?></h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Identification Details</h3>
                                        </div>
                                        <?php
                                        if (isset($_POST['verifyResident'])) {
                                            // Update the IsVerified column in users_tbl
                                            $userID = $row['UserID'];
                                            $update_sql = "UPDATE users_tbl SET IsVerified = 1 WHERE UserID = '$userID'";
                                            if (mysqli_query($conn, $update_sql)) {
                                                // Delete the row in verification_tbl
                                                $delete_sql = "DELETE FROM verification_tbl WHERE UserID = '$userID'";
                                                if (mysqli_query($conn, $delete_sql)) {
                                                    // Remove the image file from the VerificationID folder
                                                    $image_path = '../uploads/VerificationID/' . $row['Image'];
                                                    if (file_exists($image_path)) {
                                                        if (unlink($image_path)) {
                                                            echo '<div class="alert alert-success" role="alert">User verified successfully and verification record deleted. Image file deleted.</div>';
                                                        } else {
                                                            echo '<div class="alert alert-danger" role="alert">Error deleting image file.</div>';
                                                        }
                                                    } else {
                                                        echo '<div class="alert alert-warning" role="alert">Image file not found.</div>';
                                                    }
                                                } else {
                                                    echo '<div class="alert alert-danger" role="alert">Error deleting verification record: ' . mysqli_error($conn) . '</div>';
                                                }
                                            } else {
                                                echo '<div class="alert alert-danger" role="alert">Error updating user verification status: ' . mysqli_error($conn) . '</div>';
                                            }
                                        }
                                        ?>
                                        <div class="formtwoheader p-3" style="text-align: center;">
                                            <img src="../uploads/VerificationID/<?php echo $row['Image']; ?>" alt="verification picture" style="max-width:400px; max-height:300px; display: inline-block;">
                                        </div>
                                        <div class="card-footer" style="border-top: 1px solid #ccc;">
                                            <button class="btnSave bg-1 text-fff text-bold float-right" name="verifyResident"> VERIFY THE RESIDENT </button>
                                            <a href="../VerificationPage.php"  class="btn btn-default float-right" style="margin-right: 10px;"> Back to Verification Page</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            <script src="../adminfiles/plugins/jquery/jquery.min.js"></script>
            <script src="../adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../adminfiles/dist/js/adminlte.min.js"></script>
            <script src="../adminfiles/dist/js/demo.js"></script>
        </body>

        </html>
        <?php
    } else {
        echo "Verification ID not provided.";
    }
    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Verification ID not provided.";
}
?>
