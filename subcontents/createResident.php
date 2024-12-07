<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Create Resident</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../adminfiles/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../adminfiles/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../adminfiles/dist/css/ogcss.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="shortcut icon" href="../builtimages/left_logo.png" type="image/x-icon">  
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
    width: 1rem;
    height: 1rem;
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
              require '../includes/dbhandler.inc.php';
              $username = $_SESSION['username'];
            } else {
              $username = "";
            }
            ?>
            <span class="dropdown-header"> Hello, <?php echo $username; ?>! </span>
            <div class="dropdown-divider"></div>
            <a href="../adminProfile.php" class="dropdown-item" style="text-align: center;">
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
      <!-- Brand Logo -->

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
            <li class="nav-header">Manage Barangay</li>
            <li class="nav-item">
              <a href="../barangayOfficials.php" class="nav-link">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>Barangay Officials Page</p>
              </a>
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
                <li class="breadcrumb-item"><a href="../AdminDashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="../ResidentsList.php">Resident List</a></li>
                <li class="breadcrumb-item active">Update Resident</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <section class="content">
        <div class="row">
          <div class="col-md-2">

            <div class="card">
              <div class="alert custom-alert alert-dismissible fade show" role="alert">
                Include the resident's personal information such as name, address, contact details, age, occupation, and family members.
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
          </div>
          <!-- /.card -->
        </div>

        <!-- Start form -->
        <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Create Residents</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="createResidentForm" action="../includes/residents.inc.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
              <div class="card-body">
                <div class="form-group row" style="margin-top: 20px;">
                  <label class="col-sm-2 col-form-label">Personal Information</label>
                  <div class="col-sm-5">
                    <!-- text input -->
                    <label for="FirstName">First Name:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" id="FirstName" name="FirstName" class="form-control" placeholder="Enter First Name">
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="LastName">Last Name:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="LastName" name="LastName" class="form-control" placeholder="Enter Last Name">
                      </div>
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label"> </label>
                  <div class="col-sm-5">
                    <!-- text input -->
                    <div class="form-group">
                      <label for="MiddleName">Middle Name:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="MiddleName" name="MiddleName" class="form-control" placeholder="Enter Middle Name">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="Suffix">Suffix:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="Suffix" name="Suffix" class="form-control" placeholder="Enter Suffix">
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Address Details</label>
                  <div class="col-sm-5">
                    <!-- text input -->
                    <div class="form-group">
                      <label for="HouseNumber">House Number:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <input type="text" id="HouseNumber" name="HouseNumber"  class="form-control" placeholder="Enter Housenumber" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="StreetName">Street Name:</label>
                      <div class="input-group" style="margin-top: -6px;">
                          <!-- <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-road"></i></span>
                          </div> -->
                          <select id="StreetName" name="StreetName" class="form-control" required>
                            <option value="" selected disabled>Select Street Name</option>
                            <option value="Meding">Meding</option>
                            <option value="Meding">Gumamela</option>
                            <option value="Paraiso">Paraiso</option>
                            <option value="Eden">Eden</option>
                            <option value="Rosal">Rosal</option>
                            <option value="F. Muñoz">F. Muñoz</option>
                            <option value="R. Villaluz">R. Villaluz</option>
                            <option value="San Isidro">San Isidro</option>
                            <option value="Calvin">Calvin</option>
                            <option value="San Isidro">San Isidro</option>
                            <option value="Angel Linao">Angel Linao</option>
                            <option value="Villa Aragon">Villa Aragon</option>
                            <option value="San Andres">San Andres</option>

                          </select>
                        </div>
                      </div>
                    </div>
                    <label class="col-sm-2 col-form-label"> </label>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="ClusterID">Cluster:</label>
                        <select id="ClusterID" name="ClusterID" class="form-control">
                         <!-- Options will be populated dynamically using JavaScript -->
                       </select>
                     </div> 
                   </div>
                 </div>
                 <hr>
                 <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Other Details</label>
                  <div class="col-sm-5">
                    <!-- text input -->
                    <div class="form-group">
                      <label for="Birthday">Birthday:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                        </div>
                        <input type="date" id="Birthday" name="Birthday" class="form-control" placeholder="Enter Birthday" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-5">
                    <!-- text input -->
                    <div class="form-group">
                      <label for="PlaceOfBirth">Place of Birth:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        </div>
                        <input type="text" id="PlaceOfBirth" name="PlaceOfBirth" class="form-control" placeholder="Enter Place of Birth" required>
                      </div>
                    </div>
                  </div>

                  <!--citizenship & occupation row-->
                  <label class="col-sm-2 col-form-label"> </label>
                  <div class="col-sm-5">
                    <!-- text input -->
                    <div class="form-group">
                      <label for="Citizenship">Citizenship:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        </div>
                        <input type="text" id="Citizenship" name="Citizenship" value = "Filipino"class="form-control" placeholder="Enter Citizenship" required>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="Occupation">Occupation:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                        </div>
                        <input type="text" id="Occupation" name="Occupation" class="form-control" placeholder="Enter Occupation">
                      </div>
                    </div>
                  </div>
                  <!--civil status & gender row-->
                  <label class="col-sm-2 col-form-label"> </label>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="CivilStatus">Civil Status:</label>
                      <select id="CivilStatus" name="CivilStatus" class="form-control">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Separated">Separated</option>
                        <option value="Widowed">Widowed</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="Gender">Gender:</label>
                      <select id="Gender" name="Gender" class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                        <input type="text" id="others_text" name="Gender_other" class="form-control" style="display:none;">
                      </select>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Select if Applicable:</label>
                  <div class="col-sm-3">
                    <label for="LiveIn">Live In:</label>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="customRadio1" name="LiveIn" value="yes">
                      <label for="customRadio1" class="custom-control-label"> Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="customRadio2" name="LiveIn" value="no">
                      <label for="customRadio2" class="custom-control-label"> No</label>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <label for="PWD">PWD:</label>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="PWDYes" name="PWD" value="yes">
                      <label class="custom-control-label" for="PWDYes">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="PWDNo" name="PWD" value="no">
                      <label class="custom-control-label" for="PWDNo">No</label>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <label for="SoloParent">Solo Parent:</label>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="SoloParentYes" name="SoloParent" value="yes">
                      <label class="custom-control-label" for="SoloParentYes">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="SoloParentNo" name="SoloParent" value="no">
                      <label class="custom-control-label" for="SoloParentNo">No</label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"> </label>
                  <div class="col-sm-3">
                    <label for="Student">Student:</label>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="StudentYes" name="Student" value="yes">
                      <label class="custom-control-label" for="StudentYes">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="StudentNo" name="Student" value="no">
                      <label class="custom-control-label" for="StudentNo">No</label>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <label for="RegisteredVoter">Registered Voter:</label>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="RegisteredVoterYes" name="RegisteredVoter" value="yes">
                      <label class="custom-control-label" for="RegisteredVoterYes">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="RegisteredVoterNo" name="RegisteredVoter" value="no">
                      <label class="custom-control-label" for="RegisteredVoterNo">No</label>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <label for="Kasambahay">Kasambahay:</label>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="KasambahayYes" name="Kasambahay" value="yes">
                      <label class="custom-control-label" for="KasambahayYes">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="KasambahayNo" name="Kasambahay" value="no">
                      <label class="custom-control-label" for="KasambahayNo">No</label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Upload Picture</label>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label for="Picture">Picture:</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="picture" accept="image/png, image/jpeg, image/jpg" name="image" onchange="updateLabel(this)">
                        <label class="custom-file-label" for="picture" id="picture-label"> Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer" style="border-top: 1px solid #ccc;">
                <button type="submit" class="btn btn-info float-right" style="margin-left:10px; background-color: #232743; border-color: #232743;">Create Resident</button>
                <a href="../ResidentsList.php" class="btn btn-default float-right">Back To Resident List</a>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->
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

  <script src="../adminfiles/plugins/jquery/jquery.min.js"></script>
  <script src="../adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../adminfiles/dist/js/adminlte.min.js"></script>
  
  <script>
    document.getElementById('createResidentForm').addEventListener('submit', function(event) {
          // Prevent default form submission
      event.preventDefault();

          var formData = new FormData(this); // Get form data
          var xhr = new XMLHttpRequest();
          xhr.open('POST', '../includes/residents.inc.php', true);
          
          xhr.onload = function() {
            if (xhr.status === 200) {
              var responseData = JSON.parse(xhr.responseText);
              if (responseData.hasOwnProperty('success')) {
                Swal.fire({
                  title: "Resident Successfully created!",
                  text: "You have successfully created the Resident!",
                  icon: "success"
                }).then((result) => {
                  if (result.isConfirmed) {
                              window.location.href = '../ResidentsList.php'; // Change the URL as needed
                            }
                          });
              } else if (responseData.hasOwnProperty('error')) {
                      // Handle errors if any
                Swal.fire({
                  title: "Error!",
                  text: responseData.error,
                  icon: "error"
                });
              }
            } else {
                  // Handle errors if any
              Swal.fire({
                title: "Error!",
                text: "An error occurred while processing your request.",
                icon: "error"
              });
            }
          };

          xhr.send(formData);
        });
      </script>
      <script>
        function updateLabel(input) {
          var label = document.getElementById('picture-label');
          var fileName = input.files[0].name;
          label.textContent = fileName;
        }
      </script>

      <script>
        document.addEventListener("DOMContentLoaded", function() {
          var clusters = [
            { id: 1, name: 'clusterOne' },
            { id: 2, name: 'clusterTwo' },
            { id: 3, name: 'clusterThree' },
            { id: 4, name: 'clusterFour' },
            { id: 5, name: 'clusterFive' },
            { id: 6, name: 'clusterSix' },
            { id: 7, name: 'clusterSeven' },
            { id: 8, name: 'clusterEight' }
            ];

          var clusterSelect = document.getElementById('ClusterID');
          clusters.forEach(function(cluster) {
            var option = document.createElement('option');
            option.value = cluster.id;
            option.textContent = cluster.name;
            clusterSelect.appendChild(option);
          });
        });
      </script>
      <script>
        document.getElementById('Gender').addEventListener('change', function() {
          var otherText = document.getElementById('others_text');
          if (this.value === 'Others') {
            otherText.style.display = 'block';
            otherText.setAttribute('required', 'true');
          } else {
            otherText.style.display = 'none';
            otherText.removeAttribute('required');
          }
        });
      </script>
    </body>
    </html>