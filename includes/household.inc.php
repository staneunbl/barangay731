<?php
session_start();
require 'dbhandler.inc.php';

if (
    isset($_POST['HouseholdNumber'], $_POST['HouseholdName'], $_POST['ClusterNumber'])
) { 
    $HouseholdNumber = mysqli_real_escape_string($conn, $_POST['HouseholdNumber']);
    $HouseholdName = mysqli_real_escape_string($conn, $_POST['HouseholdName']);
    $ClusterNumber = mysqli_real_escape_string($conn, $_POST['ClusterNumber']);

    // Check if the household already exists in the database
    $sqlCheck = "SELECT * FROM Household_tbl WHERE HouseholdNumber = ?";
    $stmtCheck = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmtCheck, $sqlCheck)) {
        $response = array(
            'error' => 'sqlerror'
        );
        echo json_encode($response);
        exit();
    } else {
        mysqli_stmt_bind_param($stmtCheck, "s", $HouseholdNumber);
        mysqli_stmt_execute($stmtCheck);
        mysqli_stmt_store_result($stmtCheck);
        $resultCheck = mysqli_stmt_num_rows($stmtCheck);

        if ($resultCheck > 0) {
            $response = array(
                'error' => 'householdexists'
            );
            echo json_encode($response);
            exit();
        }
    }

    // Insert household details into the database
    $sql = "INSERT INTO Household_tbl (HouseHoldNumber, HouseholdName, ClusterId) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $response = array(
            'error' => 'sqlerror'
        );
        echo json_encode($response);
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $HouseholdNumber, $HouseholdName, $ClusterNumber);
        mysqli_stmt_execute($stmt);
        $response = array(
            'success' => true,
            'message' => 'Household Successfully created!'
        );
        echo json_encode($response);
        exit();
    }
} else {
    $response = array(
        'error' => 'incompletefields'
    );
    echo json_encode($response);
    exit();
}
?>
