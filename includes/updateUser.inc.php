<?php
require 'dbhandler.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $suffix = $_POST['suffix'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE Users_tbl SET LastName = '$lastName', FirstName = '$firstName', MiddleName = '$middleName', Suffix= '$suffix', Username = '$username', Email = '$email', Phone = '$phone' WHERE UserID = $userID";

    if (mysqli_query($conn, $sql)) {
        header("Location:../UsersList.php?edit=User successfuly updated!");
        exit();
    } else {
        header("Location:../updateUser.php?edit=error");
        exit();
    }
} else {
    header("Location:../UsersList.php");
    exit();
}
?>