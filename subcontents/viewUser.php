<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .container {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
<div class="container mt-3">
    <?php
    require '../includes/dbhandler.inc.php';

    if (isset($_GET['id'])) {
        $userID = $_GET['id'];

        $sql = "SELECT * FROM users_tbl WHERE UserID = $userID";
        $result = mysqli_query($conn, $sql);

        // Check if the user record exists
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <div class="row">
                <div class="col-md-5">
                    <div class="card user-profile">
                        <img src='uploads/ProfileImages/<?php echo $row['Image']; ?>' alt='User Picture'
                             class='card-img-top' style='border-radius: 10px;'>
                        <div class="card-body">
                            <h5 class="text-center"><?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></h5><hr>
                            <div class="text-muted text-center"> Registration Date: <?php echo $row['RegistrationDate']; ?> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="user-details">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Last Name:</strong>
                                <span><?php echo $row['LastName']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>First Name:</strong>
                                <span><?php echo $row['FirstName']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Middle Name:</strong>
                                <span><?php echo $row['MiddleName']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Suffix:</strong>
                                <span><?php echo $row['Suffix']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Username:</strong>
                                <span><?php echo $row['Username']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Email:</strong>
                                <span><?php echo $row['Email']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Phone:</strong>
                                <span><?php echo $row['Phone']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Role:</strong>
                                <span><?php echo $row['RoleID']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Active:</strong>
                                <span><?php echo $row['IsActive']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Verified:</strong>
                                <span><?php echo $row['IsVerified']; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        } else {
            echo "User record not found.";
        }
    } else {
        echo "User ID not provided.";
    }
    ?>
</div>
</body>
</html>
