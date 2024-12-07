<?php
require 'dbhandler.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $residentID = $_POST['residentID'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $suffix = $_POST['Suffix'];
    $gender = $_POST['Gender'];
    $birthday = $_POST['birthday'];
    $currentDate = date('Y-m-d');
    $age = date_diff(date_create($birthday), date_create($currentDate))->y;
    $placeOfBirth = $_POST['placeOfBirth'];
    $Citizenship = $_POST['Citizenship'];
    $Occupation = $_POST['Occupation'];
    $civilStatus = $_POST['CivilStatus'];
    $houseNumber = $_POST['houseNumber'];
    $streetName = $_POST['StreetName'];
    $cityName = 'Manila City';
    $postalCode = 1004;
    $ClusterID = $_POST['ClusterID'];
    $registeredVoter = $_POST['RegisteredVoter'];
    $liveIn = $_POST['liveIn'];
    $pwd = $_POST['PWD'];
    $soloParent = $_POST['SoloParent'];
    $kasambahay = $_POST['Kasambahay'];
    $student = $_POST['Student'];

    // Check if an image file is uploaded
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Image file uploaded
        // Use last name as the filename
        $image = uniqid($LastName . '_') . '.jpg';
        $image_path = '../uploads/' . $image;

        // Move uploaded image to destination folder
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            // Image uploaded successfully
        } else {
            // Error moving image file
            header("Location: updateResident.php?edit=error&message=Failed to move uploaded image.");
            exit();
        }
    } else {
        // No image uploaded, fetch current image path from the database
        $sql_image = "SELECT Image FROM Residents_tbl WHERE ResidentID = $residentID";
        $result_image = mysqli_query($conn, $sql_image);
        $row_image = mysqli_fetch_assoc($result_image);
        $image = $row_image['Image'];
    }

    // Check if any form field is empty and if so, retrieve the current data from the database
    if (empty($lastName) || empty($firstName) || empty($middleName) || empty($suffix) || empty($gender) || empty($birthday) || empty($age) || empty($placeOfBirth) || empty($Citizenship) || empty($Occupation) || empty($civilStatus) || empty($houseNumber) || empty($streetName) || empty($ClusterID) || empty($registeredVoter) || empty($liveIn) || empty($pwd) || empty($soloParent) || empty($kasambahay) || empty($student)) {
        // Retrieve current data from the database
        $sql_current_data = "SELECT * FROM Residents_tbl WHERE ResidentID = $residentID";
        $result_current_data = mysqli_query($conn, $sql_current_data);
        $row_current_data = mysqli_fetch_assoc($result_current_data);

        // Use current data for empty form fields
        $lastName = empty($lastName) ? $row_current_data['LastName'] : $lastName;
        $firstName = empty($firstName) ? $row_current_data['FirstName'] : $firstName;
        $middleName = empty($middleName) ? $row_current_data['MiddleName'] : $middleName;
        $suffix = empty($suffix) ? $row_current_data['Suffix'] : $suffix;
        $gender = empty($gender) ? $row_current_data['Gender'] : $gender;
        $birthday = empty($birthday) ? $row_current_data['Birthday'] : $birthday;
        $age = empty($age) ? $row_current_data['Age'] : $age;
        $placeOfBirth = empty($placeOfBirth) ? $row_current_data['PlaceOfBirth'] : $placeOfBirth;
        $Citizenship = empty($Citizenship) ? $row_current_data['Citizenship'] : $Citizenship;
        $Occupation = empty($Occupation) ? $row_current_data['Occupation'] : $Occupation;
        $civilStatus = empty($civilStatus) ? $row_current_data['CivilStatus'] : $civilStatus;
        $houseNumber = empty($houseNumber) ? $row_current_data['HouseNumber'] : $houseNumber;
        $streetName = empty($streetName) ? $row_current_data['StreetName'] : $streetName;
        $ClusterID = empty($ClusterID) ? $row_current_data['ClusterID'] : $ClusterID;
        $registeredVoter = empty($registeredVoter) ? $row_current_data['RegisteredVoter'] : $registeredVoter;
        $liveIn = empty($liveIn) ? $row_current_data['LiveIn'] : $liveIn;
        $pwd = empty($pwd) ? $row_current_data['PWD'] : $pwd;
        $soloParent = empty($soloParent) ? $row_current_data['SoloParent'] : $soloParent;
        $kasambahay = empty($kasambahay) ? $row_current_data['Kasambahay'] : $kasambahay;
        $student = empty($student) ? $row_current_data['Student'] : $student;
    }

    // Update the resident record in the database
    $sql = "UPDATE Residents_tbl SET 
                LastName = '$lastName',
                FirstName = '$firstName',
                MiddleName = '$middleName',
                Suffix = '$suffix',
                Gender = '$gender',
                Birthday = '$birthday',
                Age = '$age',
                PlaceOfBirth = '$placeOfBirth',
                Citizenship = '$Citizenship',
                CivilStatus = '$civilStatus',
                ClusterID = '$ClusterID', 
                HouseNumber = '$houseNumber',
                StreetName = '$streetName',
                CityName = '$cityName',
                PostalCode = '$postalCode',
                Occupation = '$Occupation',
                RegisteredVoter = '$registeredVoter',
                LiveIn = '$liveIn',
                PWD = '$pwd',
                SoloParent = '$soloParent',
                Kasambahay = '$kasambahay',
                Student = '$student',
                Image = '$image'
            WHERE ResidentID = $residentID";

    if (mysqli_query($conn, $sql)) {
        // Redirect after successful update
        header("Location: ../ResidentsList.php?edit=Resident successfully updated!");
        exit();
    } else {
        // Database update query failed
        header("Location: updateResident.php?edit=error&message=Database update query failed.");
        exit();
    }
} else {
    // Redirect if accessed without form submission
    header("Location: ResidentsList.php");
    exit();
}
?>
