<?php
session_start();
require 'dbhandler.inc.php';

if (isset($_POST['btnreg'])) { 
    // Retrieve user details from the form
    $Email = $_POST['Email'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $MiddleName = $_POST['MiddleName'];
    $Suffix = $_POST['Suffix'];
    $UserPass = $_POST['Password'];
    $UserName = $_POST['Username'];
    $Phone = $_POST['Phone'];

    // Validation for email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        header("location: ../register.php?error=invalidemail");
        exit();
    }

    // Validation for password criteria
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()-_+=])(?=.*[^\w\d]).{8,}$/', $UserPass)) {
        header("location: ../register.php?error=invalidpassword");
        exit();
    }

    // Escape user inputs
    $Email = mysqli_real_escape_string($conn, $Email);
    $FirstName = mysqli_real_escape_string($conn, $FirstName);
    $LastName = mysqli_real_escape_string($conn, $LastName);
    $MiddleName = mysqli_real_escape_string($conn, $MiddleName);
    $Suffix = mysqli_real_escape_string($conn, $Suffix);
    $UserPass = mysqli_real_escape_string($conn, $UserPass);
    $UserName = mysqli_real_escape_string($conn, $UserName);
    $Phone = mysqli_real_escape_string($conn, $Phone);

    // Get current date and time
    $RegistrationDate = date('Y-m-d H:i:s');

    // Check if user already exists in residents_tbl
    $sqlCheckResident = "SELECT ResidentID FROM Residents_tbl WHERE LastName = ? AND FirstName = ? AND MiddleName = ? AND Suffix = ?";
    $stmtCheckResident = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmtCheckResident, $sqlCheckResident)) {
        header("location: ../register.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmtCheckResident, "ssss", $LastName, $FirstName, $MiddleName, $Suffix);
        mysqli_stmt_execute($stmtCheckResident);
        mysqli_stmt_store_result($stmtCheckResident);

        if (mysqli_stmt_num_rows($stmtCheckResident) > 0) {
            mysqli_stmt_bind_result($stmtCheckResident, $ResidentID);
            mysqli_stmt_fetch($stmtCheckResident);
        } else {
            header("location: ../register.php?error=residentsNotFound");
            exit();
        }
    }

    // Check if username already exists in users_tbl
    $sqlCheckUsername = "SELECT Username FROM users_tbl WHERE Username = ?";
    $stmtCheckUsername = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmtCheckUsername, $sqlCheckUsername)) {
        header("location: ../register.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmtCheckUsername, "s", $UserName);
        mysqli_stmt_execute($stmtCheckUsername);
        mysqli_stmt_store_result($stmtCheckUsername);
        $resultCheckUsername = mysqli_stmt_num_rows($stmtCheckUsername);

        if ($resultCheckUsername > 0) {
            header("location: ../register.php?error=usernameExists");
            exit();
        }
    }

    // Insert user into database
    $IsActive = true; 
    $IsVerified = false;
    $RoleID = 2;

    $sql = "INSERT INTO users_tbl (FirstName, LastName, MiddleName, Suffix, Username, Password, Email, Phone, RegistrationDate, IsActive, IsVerified, RoleID, ResidentID) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?RegError=Registration Failed!");
        exit();
    } else {
        $hashedPassword = password_hash($UserPass, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sssssssssiisi", $FirstName, $LastName, $MiddleName, $Suffix, $UserName, $hashedPassword, $Email, $Phone, $RegistrationDate, $IsActive, $IsVerified, $RoleID, $ResidentID);
        mysqli_stmt_execute($stmt);
        header("location: ../login.php?success=Registration Success!");
        exit();
    }
} else {
    echo "Forbidden!";
}
?>