<?php
require 'dbhandler.inc.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['positionName'])) {
    $positionName = $_POST['positionName'];
    $positionName = ucwords(strtolower($positionName));
    
    // Check if position name already exists
    $check_query = "SELECT * FROM Positions_tbl WHERE PositionName = '$positionName'";
    $result = $conn->query($check_query);
    
    if ($result->num_rows > 0) {
        // If position name already exists, display error message
        echo "Error: Position already exists.";
    } else {
        // Insert position name into table
        $sql = "INSERT INTO Positions_tbl (PositionName) VALUES ('$positionName')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: ../barangayOfficials.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
