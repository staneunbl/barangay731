<?php
session_start();
require_once 'dbhandler.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $RoleID = $_POST["RoleID"];
    
    $sql = "SELECT * FROM Users_tbl WHERE (username = '$username' OR email = '$email') AND IsActive = 1";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['RoleID'] = $RoleID;
            $_SESSION['UserID'] = $row['UserID']; // Add UserID to session

            if ($row['RoleID'] == 1) {
                header("Location: ../AdminDashboard.php");
                exit();
            } else if ($row['RoleID'] == 3) {
                header("Location: ../AdminDashboard.php");
                exit();
            } else {
                header("Location: ../homepagefolder/index.php");
                exit();
            }
        } else {
            header("Location: ../login.php?error=Invalid Password");
            exit();
        }
    } else {
        header("Location: ../login.php?error=Invalid Username");
        exit();
    }
}
?>