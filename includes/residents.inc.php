<?php
require 'dbhandler.inc.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $LastName = $_POST['LastName'];
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $Suffix = $_POST['Suffix'];
    $Gender = $_POST['Gender'];
    if ($Gender == "Others") {
        $Gender = $_POST['Gender_other'];
    }
    $Birthday = $_POST['Birthday'];

    // Calculate age
    $birthdate = new DateTime($Birthday);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;


    // Check if the calculated age is valid
    if ($age < 0) {
        echo json_encode(array("error" => "Invalid age calculation"));
        exit();
    } else {
        $Age = $age;
    }

    $PlaceOfBirth = $_POST['PlaceOfBirth'];
    $Citizenship = $_POST['Citizenship'];
    $CivilStatus = $_POST['CivilStatus'];
    $HouseNumber = $_POST['HouseNumber'];
    $StreetName = $_POST['StreetName'];
    $Occupation = $_POST['Occupation'];
    $ClusterID = $_POST['ClusterID'];

    // Radio button values
    $RegisteredVoter = isset($_POST['RegisteredVoter']) ? ($_POST['RegisteredVoter'] == 'yes' ? 'yes' : 'no') : 'no';
    $LiveIn = isset($_POST['customRadio']) ? ($_POST['customRadio'] == 'true' ? 'yes' : 'no') : 'no';
    $PWD = isset($_POST['PWD']) ? ($_POST['PWD'] == 'true' ? 'yes' : 'no') : 'no';
    $SoloParent = isset($_POST['SoloParent']) ? ($_POST['SoloParent'] == 'true' ? 'yes' : 'no') : 'no';
    $Kasambahay = isset($_POST['Kasambahay']) ? ($_POST['Kasambahay'] == 'true' ? 'yes' : 'no') : 'no';
    $Student = isset($_POST['Student']) ? ($_POST['Student'] == 'yes' ? 'yes' : 'no') : 'no';

    // Escape user inputs to prevent SQL injection
    $LastName = mysqli_real_escape_string($conn, $LastName);
    $FirstName = mysqli_real_escape_string($conn, $FirstName);
    $MiddleName = mysqli_real_escape_string($conn, $MiddleName);
    $Suffix = mysqli_real_escape_string($conn, $Suffix);
    $Gender = mysqli_real_escape_string($conn, $Gender);
    $Birthday = mysqli_real_escape_string($conn, $Birthday);
    $PlaceOfBirth = mysqli_real_escape_string($conn, $PlaceOfBirth);
    $Citizenship = mysqli_real_escape_string($conn, $Citizenship);
    $CivilStatus = mysqli_real_escape_string($conn, $CivilStatus);
    $HouseNumber = mysqli_real_escape_string($conn, $HouseNumber);
    $StreetName = mysqli_real_escape_string($conn, $StreetName);
    $Occupation = mysqli_real_escape_string($conn, $Occupation);
    $ClusterID = mysqli_real_escape_string($conn, $ClusterID);

    // File upload
    $image = uniqid($LastName . '_') . '.jpg';
    $resident_image_tmp_name = $_FILES['image']['tmp_name'];
    $resident_image_folder = '../uploads/'.$image;

    // Set default values for CityName and PostalCode
    $CityName = "Manila City";
    $PostalCode = "1004";

    // Check if the resident already exists in the database
    $sqlCheck = "SELECT * FROM Residents_tbl WHERE 
                 LOWER(TRIM(LastName)) = LOWER(TRIM('$LastName')) AND 
                 LOWER(TRIM(FirstName)) = LOWER(TRIM('$FirstName')) AND 
                 LOWER(TRIM(MiddleName)) = LOWER(TRIM('$MiddleName')) AND 
                 LOWER(TRIM(Suffix)) = LOWER(TRIM('$Suffix'))";

    $resultCheck = mysqli_query($conn, $sqlCheck);
    if (mysqli_num_rows($resultCheck) > 0) {
        echo json_encode(array("error" => "Resident already exists"));
        exit();
    }
    
    $IsArchived = 0;

    // Insert resident data into the database
    $sql = "INSERT INTO Residents_tbl (LastName, FirstName, MiddleName, Suffix, Gender, Birthday, Age, PlaceOfBirth, Citizenship, CivilStatus, HouseNumber, StreetName, CityName, PostalCode, Occupation, ClusterID, RegisteredVoter, LiveIn, PWD, SoloParent, Kasambahay, Student, Image, IsArchived) VALUES ('$LastName', '$FirstName', '$MiddleName', '$Suffix', '$Gender', '$Birthday', '$Age', '$PlaceOfBirth', '$Citizenship', '$CivilStatus', '$HouseNumber', '$StreetName', '$CityName', '$PostalCode', '$Occupation','$ClusterID' , '$RegisteredVoter', '$LiveIn', '$PWD', '$SoloParent', '$Kasambahay', '$Student', '$image', '$IsArchived')";

    if (mysqli_query($conn, $sql)) {
        // Move uploaded image to destination folder
        move_uploaded_file($resident_image_tmp_name, $resident_image_folder);
        echo json_encode(array("success" => "Resident successfully created"));
        exit();
    } else {
        echo json_encode(array("error" => "Failed to create resident"));
        exit();
    }
}
?>
