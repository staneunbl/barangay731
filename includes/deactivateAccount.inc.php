<?php
require 'dbhandler.inc.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['id'])) {
        $userID = $_GET['id'];

        // Prepare and execute the SQL query
        $sql = "UPDATE Users_tbl SET IsActive = 0 WHERE UserID = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);

            // Check if any rows were affected
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // Deactivate the user's session
                session_start();
                session_unset();
                session_destroy();
                $response['status'] = 'success';
                $response['message'] = 'Account deactivated successfully and logged out.';
            } else {
                // No rows affected, indicate error
                $response['status'] = 'error';
                $response['message'] = 'No rows affected. Account deactivation failed.';
            }
        } else {
            // Error in preparing the SQL statement
            $response['status'] = 'error';
            $response['message'] = 'Error in preparing SQL statement: ' . mysqli_error($conn);
        }
    } else {
        // UserID not set
        $response['status'] = 'error';
        $response['message'] = 'UserID not set.';
    }
} else {
    // Request method is not GET
    $response['status'] = 'error';
    $response['message'] = 'Request method is not GET.';
}

// Encode the response as JSON
echo json_encode($response);
?>