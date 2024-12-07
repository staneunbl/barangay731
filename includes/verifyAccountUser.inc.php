<?php
require 'dbhandler.inc.php';

// Check if the form is submitted
if (isset($_POST['verify_submit'])) {
    $userID = $_POST['userID'];

    // Update the user status to verified in the users_tbl
    $sql = "UPDATE users_tbl SET IsVerified = 1 WHERE userID = ?";
    $stmt = mysqli_stmt_init($conn);

    // Check if the SQL statement is valid
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind the userID parameter to the statement
        mysqli_stmt_bind_param($stmt, "i", $userID);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // User verified successfully
            echo "<p>User has been verified successfully.</p>";
            
        } else {
            // Error occurred while verifying user
            echo "<p>Error occurred while verifying user.</p>";
        }
    } else {
        // Failed to prepare SQL statement
        echo "<p>Failed to prepare SQL statement.</p>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // If form is not submitted, redirect user back to the review page
    header("Location: review_page.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
