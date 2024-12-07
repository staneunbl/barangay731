<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Page</title>
    <link rel="shortcut icon" href="builtimages/left_logo.png" type="image/x-icon">
</head>
<body>
    <h2>Review Details</h2>

   <!-- Your existing HTML and PHP code -->

<?php
    // Include database connection
    require 'includes/dbhandler.inc.php';

    // Check if the VerificationID is provided as a query parameter
    if (isset($_GET['verificationID'])) {
        // Retrieve the VerificationID from the query parameter
        $verificationID = $_GET['verificationID'];

        // Prepare SQL statement to fetch data based on VerificationID
        $sql = "SELECT *, users_tbl.UserID as UserID FROM verification_tbl JOIN users_tbl ON verification_tbl.UserID = users_tbl.UserID WHERE VerificationID = ?";
        $stmt = mysqli_stmt_init($conn);

        // Check if the SQL statement is valid
        if (!$stmt) {
            die("Error: Unable to initialize SQL statement. " . mysqli_error($conn));
        }

        // Check if the SQL statement is valid
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die("Error: SQL statement preparation failed. " . mysqli_stmt_error($stmt));
        }

        // Bind the VerificationID parameter to the statement
        mysqli_stmt_bind_param($stmt, "i", $verificationID);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Check if there's a row returned
        if ($row = mysqli_fetch_assoc($result)) {
            // Check if UserID key exists
            if (isset($row['UserID'])) {
                // Display the details
                echo "<div>";
                echo "<p><strong>Verification ID:</strong> " . $row['VerificationID'] . "</p>";
                echo "<p><strong>First Name:</strong> " . $row['FirstName'] . "</p>";
                echo "<p><strong>Last Name:</strong> " . $row['LastName'] . "</p>";
                echo "<p><strong>Middle Name:</strong> " . $row['MiddleName'] . "</p>";
                echo "<p><strong>Suffix:</strong> " . $row['Suffix'] . "</p>";
                echo "<p><strong>Username:</strong> " . $row['Username'] . "</p>";
                echo "<p><strong>Verification Date:</strong> " . $row['VerificationDate'] . "</p>";
                
                // Display the image
                echo "<p><strong>Image:</strong> <img src='uploads/VerificationID/".$row['Image']."' alt='Verification ID' class='thumbnail'></p>";

                // Add a form around the "Verify" link/button
                echo "<form method='post' action='includes/verifyAccountUser.inc.php'>";
                echo "<input type='hidden' name='userID' value='" . $row['UserID'] . "'>";
                echo "<button type='submit' name='verify_submit'>Verify</button>";
                echo "</form>";
                
                echo "</div>";
            } else {
                echo "<p>User ID not found.</p>";
            }
        } else {
            echo "<p>No data found for the provided Verification ID.</p>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Verification ID not provided.</p>";
    }

    // Close the database connection
    mysqli_close($conn);
?>
<!-- Your remaining HTML code -->


    <!-- You can add more HTML elements or styling as needed -->
</body>
</html>
