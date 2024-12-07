<?php
require 'dbhandler.inc.php';
session_start();

// Check if the form is submitted
if (isset($_POST['verify_submit'])) {
    if (!isset($_SESSION['username'])) {
        header("Location: LogIn.php");
        exit(); 
    }

    // Validate and process the uploaded image
    if ($_FILES['verification_image']['error'] === UPLOAD_ERR_OK) {
        $userID = $_POST['userID'];
        $username = $_SESSION['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $suffix = $_POST['suffix'];

        // Directory where uploaded images will be saved
        $uploadDirectory = '../uploads/VerificationID/';

        // Get the filename and extension
        $filename = basename($_FILES['verification_image']['name']);
        $tempFile = $_FILES['verification_image']['tmp_name'];

        // Move the uploaded file to the designated directory
        $targetFile = $uploadDirectory . $filename;
        move_uploaded_file($tempFile, $targetFile);

        // Fetch the user's password from the users_tbl
        $sql_select_password = "SELECT Password FROM users_tbl WHERE Username = ?";
        $stmt_select_password = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt_select_password, $sql_select_password)) {
            // Handle database error
            die('Error: ' . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt_select_password, "s", $username);

        if (!mysqli_stmt_execute($stmt_select_password)) {
            // Handle execution error
            die('Error: ' . mysqli_stmt_error($stmt_select_password));
        }

        mysqli_stmt_store_result($stmt_select_password);

        if (mysqli_stmt_num_rows($stmt_select_password) > 0) {
            mysqli_stmt_bind_result($stmt_select_password, $storedPassword);
            mysqli_stmt_fetch($stmt_select_password);

            // Insert verification data into verification_tbl
            $verificationDate = date("Y-m-d"); // Current date
            $sql_insert_verification = "INSERT INTO verification_tbl (UserID,Username, Password, FirstName, LastName, MiddleName, Suffix, VerificationDate, Image) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert_verification = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt_insert_verification, $sql_insert_verification)) {
                // Handle database error
                die('Error: ' . mysqli_error($conn));
            }

            // Hash the stored password before inserting into the verification table
            $hashedPassword = password_hash($storedPassword, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt_insert_verification, "sssssssss", $userID,$username, $hashedPassword, $firstname, $lastname, $middlename, $suffix, $verificationDate, $filename);

            if (!mysqli_stmt_execute($stmt_insert_verification)) {
                // Handle execution error
                die('Error: ' . mysqli_stmt_error($stmt_insert_verification));
            }

            // Close statement
            mysqli_stmt_close($stmt_insert_verification);
        }

        // Close statement and database connection
        mysqli_stmt_close($stmt_select_password);
        mysqli_close($conn);

        // Redirect the user to the homepage or any other page
        header("Location: ../homepagefolder/index.php?verification=success");
        exit();
    } else {
        // Handle upload error
        echo "Error uploading file.";
    }
} else {
    // Redirect the user to the form page if accessed directly without form submission
    header("Location: verifyAccount.php");
    exit();
}
?>
