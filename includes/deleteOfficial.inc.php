<?php
    require 'dbhandler.inc.php';

    // Check if the BrgyOfficialId is provided in the URL
    if (isset($_GET['BrgyOfficialId'])) {
        $BrgyOfficialId = $_GET['BrgyOfficialId'];

        // Update the IsArchived field to true for the barangay official record in the database
        $sql = "UPDATE BarangayOfficials_tbl SET IsArchived = 1 WHERE BrgyOfficialId = $BrgyOfficialId";
        if (mysqli_query($conn, $sql)) {
            header("Location:../barangayOfficials.php");
            exit();
        } else {
            header("Location:../barangayOfficials.php?archive=error");
            exit();
        }
    } else {
        header("Location:../barangayOfficials.php?archive=error");
        exit();
    }
?>
