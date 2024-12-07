<?php
require '../includes/dbhandler.inc.php';

    // Check if the resident ID is provided
if (isset($_GET['id'])) {
    $residentID = $_GET['id'];

        // Fetch resident details from the database
    $sql = "SELECT * FROM Residents_tbl WHERE ResidentID = $residentID";
    $result = mysqli_query($conn, $sql);

        // Check if the resident record exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Details</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
            <style>
                .container {
                    max-height: 500px;
                    overflow-y: auto;
                    max-width: auto;
                }
            </style>
            </head>
                <body>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card user-profile">
                                    <img src="uploads/<?php echo $row['Image']; ?>?v=<?php echo time(); ?>" alt="Resident Picture" class="thumbnail" style="max-width: 100%; height: auto; border-radius: 10px;">
                                    <div class="card-body">
                                        <h5 class="text-center"><?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="user-details">
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-primary">Personal Details:</li>
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
                                            <strong>Age:</strong>
                                            <span><?php echo $row['Age']; ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="user-datails mt-3">
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-primary">Other Details:</li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Birthday:</strong>
                                            <span><?php echo $row['Birthday']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Place of Birth:</strong>
                                            <span><?php echo $row['PlaceOfBirth']; ?></span>
                                        </li>

                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Citizenship:</strong>
                                            <span><?php echo $row['Citizenship']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Occupation/Student:</strong>
                                            <span><?php echo $row['Occupation']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Civil Statush:</strong>
                                            <span><?php echo $row['CivilStatus']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Gender:</strong>
                                            <span><?php echo $row['Gender']; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Column 3 -->
                            <div class="col-md-4">
                                <div class="user-details">
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-primary">Address Details:</li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>House Number:</strong>
                                            <span><?php echo $row['HouseNumber']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Street Name:</strong>
                                            <span><?php echo $row['StreetName']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>City Name:</strong>
                                            <span><?php echo $row['CityName']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Postal Code:</strong>
                                            <span><?php echo $row['PostalCode']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Cluster:</strong>
                                            <span><?php echo $row['ClusterID']; ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="user-datails mt-3">
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-primary">Resident Is A:</li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>PWD:</strong>
                                            <span><?php echo $row['PWD']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>LiveIn:</strong>
                                            <span><?php echo $row['LiveIn']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Solo Parent:</strong>
                                            <span><?php echo $row['SoloParent']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Student:</strong>
                                            <span><?php echo $row['Student']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Registered Voter:</strong>
                                            <span><?php echo $row['RegisteredVoter']; ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>Kasambahay:</strong>
                                            <span><?php echo $row['Kasambahay']; ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Resident record not found.";
    }
} else {
    echo "Resident ID not provided.";
}
?>