<?php
require 'dbhandler.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];

    //image file upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = '../uploads/ProfileImages/' . $image;

    $sql = "UPDATE Users_tbl SET 
                Image = '$image'
            WHERE UserID = $userID";

    if (mysqli_query($conn, $sql)) {
        if (move_uploaded_file($image_tmp, $image_path)) {
            header("Location: ../homepagefolder/ProfilePage.php?edit=success");
            exit();
        } else {
            header("Location: ../homapagefolder/ProfilePage.php?edit=error&message=Failed to move uploaded image.");
            exit();
        }
    } else {
        header("Location: ../homapagefolder/ProfilePage.php?edit=error&message=Database update query failed.");
        exit();
    }
} else {
    header("Location: ../ProfilePage.php");
    exit();
}
?>