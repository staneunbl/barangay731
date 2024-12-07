<?php
    require 'dbhandler.inc.php';

    if (isset($_GET['id'])) {
        $userID = $_GET['id'];

        $sql = "UPDATE users_tbl SET IsVerified = true WHERE UserID = $userID";
        if (mysqli_query($conn, $sql)) {
            header("Location:../UsersList.php?verify=success");
            exit();
        } else {
            header("Location:../UsersList.php?verify=error");
            exit();
        }
    } else {
        header("Location:../UsersList.php?verify=error");
        exit();
    }
?>