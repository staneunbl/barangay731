<?php
// Database connection
require 'dbhandler.inc.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default values
$isActive = true;
$isArchived = false;

// Check if there is already a record with position ID as 1
$sqlCheckPosition = "SELECT COUNT(*) AS count FROM BarangayOfficials_tbl WHERE PositionID = 1";
$resultCheckPosition = $conn->query($sqlCheckPosition);
if ($resultCheckPosition && $resultCheckPosition->num_rows > 0) {
    $row = $resultCheckPosition->fetch_assoc();
    if ($row['count'] > 0 && $_POST['positionId'] == 1) {
        // If a record with position ID 1 already exists and the submitted position ID is also 1, do not insert new data
        echo json_encode(array("error" => "There can be only one record for Barangay Captain"));
        exit();
    }
}


// Handle form submission
if(isset($_POST['firstName'], $_POST['lastName'], $_POST['middleName'], $_POST['positionId'], $_FILES['image'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $middleName = $_POST['middleName'];
    $positionId = $_POST['positionId'];

    // Check if the person exists in residents_tbl
    $sqlCheckPerson = "SELECT ResidentID FROM residents_tbl WHERE FirstName = ? AND LastName = ? AND MiddleName = ?";
    $stmtCheckPerson = $conn->prepare($sqlCheckPerson);
    $stmtCheckPerson->bind_param("sss", $firstName, $lastName, $middleName);
    $stmtCheckPerson->execute();
    $resultCheckPerson = $stmtCheckPerson->get_result();

    if ($resultCheckPerson->num_rows === 0) {
        // Person does not exist in residents_tbl, redirect with error
        echo json_encode(array("error" => "Resident not found"));
        exit();
    }

    // File upload
    $image = uniqid($lastName . '_') . '.jpg';
    $imageFilePath = '../uploads/barangayOfficials/' . $image;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $imageFilePath)) {
        // Insert data into BarangayOfficials_tbl
        $sql = "INSERT INTO BarangayOfficials_tbl (FirstName, LastName, MiddleName, PositionID, IsActive, image, IsArchived) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        // Bind parameters
        $stmt->bind_param("sssiisi", $firstName, $lastName, $middleName, $positionId, $isActive, $image, $isArchived);

        // After the execute() call, add the following code to check for errors:
        if ($stmt->execute()) {
            // Redirect to barangayOfficials.php
            echo json_encode(array("success" => "Data inserted successfully"));
            exit(); // Ensure no further code execution after redirection
        } else {
            // Error in executing the query
            echo json_encode(array("error" => "SQL error: " . $stmt->error)); // Log the SQL error
            exit();
        }

    } else {
        // Error uploading image
        echo json_encode(array("error" => "Failed to upload image"));
        exit();
    }
}

// If form data is not set or some other error occurred, redirect back with an error message
echo json_encode(array("error" => "Unknown error"));
exit

?>
