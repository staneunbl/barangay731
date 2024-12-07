<?php
    require 'dbhandler.inc.php';

    // Check if the resident ID is provided in the URL
    if (isset($_GET['id'])) {
        $residentID = $_GET['id'];

        // Update the IsArchived field to true for the resident record in the database
        $sql = "UPDATE Residents_tbl SET IsArchived = true WHERE ResidentID = $residentID";
        if (mysqli_query($conn, $sql)) {
            header("Location:../ResidentsList.php?archive=success");
            exit();
        } else {
            header("Location:../ResidentsList.php?archive=error");
            exit();
        }
    } else {
        header("Location:../ResidentsList.php?archive=error");
        exit();
    }
?>