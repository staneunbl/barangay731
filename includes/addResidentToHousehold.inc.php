<?php
require 'dbhandler.inc.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    if(isset($_SESSION['selectedResidents'], $_POST['householdID'])) {
        $householdID = $_POST['householdID'];
        $residentIDs = $_SESSION['selectedResidents'];

        // Update household with selected residents
        foreach ($residentIDs as $residentID) {
            $sql = "UPDATE Residents_tbl SET householdID = '$householdID' WHERE ResidentID = '$residentID'";
            mysqli_query($conn, $sql);
        }

        // Redirect to the specified page with householdID
        header("Location: ../householdList.php?id=$householdID");
        exit();
    } else {
        // Return JSON data in case of an error
        echo json_encode(array("error" => "Invalid request."));
    }
} else {
    // Return JSON data in case of an error
    echo json_encode(array("error" => "Invalid request."));
}
?>
