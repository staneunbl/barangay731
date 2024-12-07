<?php
require '../includes/dbhandler.inc.php';

// Fetch all user records from the database
$usersSql = "SELECT * FROM users_tbl";
$usersResult = mysqli_query($conn, $usersSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .container {
            max-height: 400px; /* Adjust as needed */
            overflow-y: auto;
            padding: 10px;
        }            
    </style>    
</head>
<body>
    <div class="container">
        <form id="createUsersForm" method="POST" enctype="multipart/form-data" action="includes/users.inc.php">
            <input type="hidden" name="userID" value="<?php echo $row['UserID']; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="FirstName" name="FirstName" class="form-control" placeholder="Enter First Name">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="LastName" name="LastName" class="form-control" placeholder="Enter Last Name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="middleName">Middle Name:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="MiddleName" name="MiddleName" class="form-control" placeholder="Enter Middle Name">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="suffix">Suffix:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" id="Suffix" name="Suffix" class="form-control" placeholder="Enter Suffix">
                </div>
            </div>
        </div>
    </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" id="UserName" name="Username" class="form-control" placeholder="Enter Username">
          </div>
      </div>
  <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">Email:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
            </div>
            <input type="text" id="Email" name="Email" class="form-control" placeholder="Enter Email">
        </div>
    </div>
</div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">Phone:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input type="text" id="Phone" name="Phone" class="form-control" placeholder="Enter Phone Number">
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="picture">Picture:</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="picture" accept="image/png, image/jpeg, image/jpg" name="image" onchange="updateLabel(this)">
        <label class="custom-file-label" for="picture" id="picture-label">Choose file</label>
    </div>
</div>
<div class="form-group">
    <label for="RoleID">User Role:</label>
    <select id="RoleID" name="RoleID" class="form-control">
      <option value="1">Admin</option>
      <option value="2">Constituent</option>
      <option value="3">Staff</option>
  </select>
</div>
<hr>
<button type="submit" value="Submit" class="btn btn-primary btn-block">Create User</button>
</form>
</div>
</div>
<script>
document.getElementById('createUsersForm').addEventListener('submit', function(event) {
    // Prevent default form submission
    event.preventDefault();
    var formData = new FormData(this); // Get form data
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/users.inc.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                var createUserButton = document.querySelector('#modal-12');
                if (createUserButton) {
                    createUserButton.style.display = 'none';
                }
                Swal.fire({
                    title: "User Successfully created!",
                    text: response.message,
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'Userslist.php'; // Change the URL as needed
                    }
                });
            } else {
                if (response.error === 'userexists') {
                    Swal.fire({
                        title: "Error!",
                        text: "User already exists!",
                        icon: "error"
                    });
                } else if (response.error === 'residentsNotFound') {
                    Swal.fire({
                        title: "Error!",
                        text: "Resident not found!",
                        icon: "error"
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "An error occurred!",
                        icon: "error"
                    });
                }
            }
        } else {
            // Handle other HTTP status codes if needed
        }
    };
    xhr.send(formData);
});
</script>

<script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
  function updateLabel(input) {
    var label = document.getElementById('picture-label');
    var fileName = input.files[0].name;
    label.textContent = fileName;
}
</script>
</body>
</html>
