<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if BrgyOfficialId and other necessary fields are provided
    if(isset($_POST['BrgyOfficialId'], $_POST['positionId'])) {
        // Get data from the form
        $BrgyOfficialId = $_POST['BrgyOfficialId'];
        $positionId = $_POST['positionId'];

        // Initialize variables for optional fields
        $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
        $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
        $middleName = isset($_POST['middleName']) ? $_POST['middleName'] : '';

        // Database connection
        require 'dbhandler.inc.php';

        // Prepare and execute SQL update statement
        $sql = "UPDATE BarangayOfficials_tbl SET PositionID = ?";

        // Add optional fields to the update statement if they are provided
        $params = array($positionId);
        if (!empty($firstName)) {
            $sql .= ", FirstName = ?";
            $params[] = $firstName;
        }
        if (!empty($lastName)) {
            $sql .= ", LastName = ?";
            $params[] = $lastName;
        }
        if (!empty($middleName)) {
            $sql .= ", MiddleName = ?";
            $params[] = $middleName;
        }

        // Image handling
        if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            $image_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $unique_code = uniqid();
            $image = $lastName . '_' . $unique_code . '.' . $image_extension;
            $imageFolder = '../uploads/BarangayOfficials/' . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], $imageFolder);
            $sql .= ", Image = ?";
            $params[] = $image;
        }

        $sql .= " WHERE BrgyOfficialId = ?";
        $params[] = $BrgyOfficialId;

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);

        // Execute statement
        if ($stmt->execute() === TRUE) {
            // Close statement and database connection
            $stmt->close();
            $conn->close();

            // Redirect to barangayOfficials.php after successful update
            header("Location: ../barangayOfficials.php");
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close database connection
        $conn->close();
    } else {
        echo "All fields are required for updating";
    }
} else {
    echo "Invalid request method";
}
?>
