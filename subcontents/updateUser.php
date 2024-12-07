<?php
require '../includes/dbhandler.inc.php';

if (isset($_GET['id'])) {
    $userID = $_GET['id'];

        // Fetch the resident record from the database
    $sql = "SELECT * FROM users_tbl WHERE UserID = $userID";
    $result = mysqli_query($conn, $sql);

        // Check if the resident record exists
    if (mysqli_num_rows($result) > 0) {
            // Display a form to edit the resident's information
        $row = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <style>
                .form-container {
                    height: 400px; /* Adjust height as needed */
                    overflow-y: auto; /* Vertical scrolling */
                    overflow-x: hidden; /* Hide horizontal scrollbar */
                    padding: 5px;
                }
                .form-group {
                    margin-bottom: 20px;
                }

                updatelabel {
                    display: block;
                    margin-bottom: 5px;
                    font-weight: bold;
                }

                input[type="text"] {
                    width: 100%;
                    padding: 10px;
                    border-radius: 5px;
                    border: 1px solid #ccc;
                    box-sizing: border-box;
                }
                .form-group.phone { margin-top: 10px; }                
            </style>    
        </head>
        <body>
            <form id="updateUserForm" action="includes/updateUser.inc.php" method="POST" class="form-container">
                <input type="hidden" name="userID" value="<?php echo $row['UserID']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row['FirstName']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row['LastName']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="middleName">Middle Name:</label>
                            <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo $row['MiddleName']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="suffix">Suffix:</label>
                            <input type="text" class="form-control" id="suffix" name="suffix" value="<?php echo $row['Suffix']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['Username']; ?>">
                </div>
                <div class="row">
                    <div class="col-md-6">                
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['Email']; ?>">
                    </div>
                    <div class="col-md-6"> 
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['Phone']; ?>">
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary btn-block updatebutton">Update User</button>
            </form>
            <script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('updateUserForm').addEventListener('submit', function(event) {
            // Prevent default form submission
            event.preventDefault();
            var formData = new FormData(this); // Get form data
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/updateUser.inc.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var editUserButton = document.querySelector('#modal-5');
                    if (editUserButton) {
                        editUserButton.style.display = 'none';
                    }
                    Swal.fire({
                        title: "User Successfully updated!",
                        text: "You have successfully updated the user!",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'Userslist.php'; // Change the URL as needed
                        }
                    });
                } else {
                    // Handle errors if any
                }
            };
            xhr.send(formData);
        });
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