<?php
session_start();
require 'dbhandler.inc.php';

if (
    isset($_POST['LastName'], $_POST['FirstName'], $_POST['MiddleName'], $_POST['Suffix'], $_POST['Username'], $_POST['Email'], $_POST['Phone'], $_POST['RoleID'])
) { 
    $LastName = mysqli_real_escape_string($conn, $_POST['LastName']);
    $FirstName = mysqli_real_escape_string($conn, $_POST['FirstName']);
    $MiddleName = mysqli_real_escape_string($conn, $_POST['MiddleName']);
    $Suffix = mysqli_real_escape_string($conn, $_POST['Suffix']);
    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Phone = mysqli_real_escape_string($conn, $_POST['Phone']);
    $RegistrationDate = date('Y-m-d H:i:s');
    $RoleID = mysqli_real_escape_string($conn, $_POST['RoleID']);

    // File upload
    $image = $_FILES['image']['name'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $unique_code = uniqid();
    $image_new_name = $LastName . '_' . $unique_code . '.' . $image_extension;
    $resident_image_tmp_name = $_FILES['image']['tmp_name'];
    $resident_image_folder = '../uploads/ProfileImages/'.$image_new_name;

    // Check if resident exists
    $sqlCheckResident = "SELECT * FROM Residents_tbl WHERE LastName = ? AND FirstName = ? AND MiddleName = ? AND Suffix = ?";
    $stmtCheckResident = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmtCheckResident, $sqlCheckResident)) {
        $response = array(
            'error' => 'sqlerror'
        );
        echo json_encode($response);
        exit();
    } else {
        mysqli_stmt_bind_param($stmtCheckResident, "ssss", $LastName, $FirstName, $MiddleName, $Suffix);
        mysqli_stmt_execute($stmtCheckResident);
        $resultCheckResident = mysqli_stmt_get_result($stmtCheckResident);

        if ($row = mysqli_fetch_assoc($resultCheckResident)) {
            $ResidentID = $row['ResidentID'];
        } else {
            $response = array(
                'error' => 'residentsNotFound'
            );
            echo json_encode($response);
            exit();
        }
    }

    // Check if user already exists in users_tbl
    $sqlCheck = "SELECT * FROM users_tbl WHERE Username = ? OR Email = ?";
    $stmtCheck = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmtCheck, $sqlCheck)) {
        $response = array(
            'error' => 'sqlerror'
        );
        echo json_encode($response);
        exit();
    } else {
        mysqli_stmt_bind_param($stmtCheck, "ss", $Username, $Email);
        mysqli_stmt_execute($stmtCheck);
        $resultCheck = mysqli_stmt_get_result($stmtCheck);

        if ($row = mysqli_fetch_assoc($resultCheck)) {
            $response = array(
                'error' => 'userexists'
            );
            echo json_encode($response);
            exit();
        }
    }

    $IsActive = 1;
    $IsVerified = 0;
    $defaultPassword = $LastName . '731';
    //hash the default password before storing it in the database
    $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users_tbl (ResidentID, LastName, FirstName, MiddleName, Suffix, Username, Email, Phone, RegistrationDate, RoleID, Password, IsActive, IsVerified, Image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $response = array(
            'error' => 'sqlerror'
        );
        echo json_encode($response);
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "isssssssssssss", $ResidentID, $LastName, $FirstName, $MiddleName, $Suffix, $Username, $Email, $Phone, $RegistrationDate, $RoleID, $hashedPassword, $IsActive, $IsVerified, $image_new_name);
        mysqli_stmt_execute($stmt);

        move_uploaded_file($resident_image_tmp_name, $resident_image_folder);
        $response = array(
            'success' => true,
            'message' => 'User successfully created!'
        );
        echo json_encode($response);
        exit();
    }
} else {
    $response = array(
        'error' => 'sqlerror'
    );
    echo json_encode($response);
    exit();
}
?>
