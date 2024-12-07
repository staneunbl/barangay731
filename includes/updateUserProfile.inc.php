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
    
    // Check if a new image is uploaded
    if ($_FILES['image']['size'] > 0) {
        $image = $_FILES['image']['name'];
        
        // Generate a random string for uniqueness
        $unique_code = uniqid();
        // Use last name and unique code as the filename
        $image = $lastName . '_' . $unique_code . '.jpg'; // Example: Lastname_randomstring.jpg
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = '../uploads/ProfileImages/' . $image;

        // Update image filename in the database
        $sql = "UPDATE Users_tbl SET Image = '$image' WHERE UserID = $userID";

        if (!mysqli_query($conn, $sql)) {
            $response = array(
                "status" => "error",
                "message" => "Failed to update image filename in the database."
            );
            echo json_encode($response);
            exit();
        }
        
        // Move the new image to the folder
        if (!move_uploaded_file($image_tmp, $image_path)) {
            $response = array(
                "status" => "error",
                "message" => "Failed to move uploaded image."
            );
            echo json_encode($response);
            exit();
        }
    }

    // Update other user information in the database
    $sql = "UPDATE Users_tbl SET LastName = '$lastName', FirstName = '$firstName', MiddleName = '$middleName', Suffix= '$suffix', Username = '$username', Email = '$email', Phone = '$phone' WHERE UserID = $userID";

    if (mysqli_query($conn, $sql)) {
        $response = array(
            "status" => "success",
            "message" => "Profile Successfully updated!"
        );
        echo json_encode($response);
        exit();
    } else {
        $response = array(
            "status" => "error",
            "message" => "Database update query failed."
        );
        echo json_encode($response);
        exit();
    }
} else {
    header("Location:../ProfilePage.php");
    exit();
}
?>
