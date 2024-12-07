<?php
require 'dbhandler.inc.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['CaseNumber'], $_POST['DateFiled'], $_POST['ComplainantName'], $_POST['RespondentName'], $_POST['IncidentDetails'], $_POST['StatusID'], $_POST['ResolutionText'], $_POST['InvestigatingOfficer'], $_POST['DateResolved'])) {
    $caseNumber = $_POST['CaseNumber'];
    $dateFiled = $_POST['DateFiled'];
    $complainantName = $_POST['ComplainantName'];
    $respondentName = $_POST['RespondentName'];
    $incidentDetails = $_POST['IncidentDetails'];
    $statusID = $_POST['StatusID'];
    $resolutionText = $_POST['ResolutionText'];
    $investigatingOfficer = $_POST['InvestigatingOfficer'];
    $dateResolved = $_POST['DateResolved'];

    //insert data into BlotterRecords_tbl
    $sql = "INSERT INTO BlotterRecords_tbl (CaseNumber, DateFiled, ComplainantName, RespondentName, IncidentDetails, StatusID, ResolutionText, InvestigatingOfficer, DateResolved) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssisss", $caseNumber, $dateFiled, $complainantName, $respondentName, $incidentDetails, $statusID, $resolutionText, $investigatingOfficer, $dateResolved);

    if ($stmt->execute()) {
        // Data inserted successfully
        echo json_encode(array("success" => "Data inserted successfully"));
        exit();
    } else {
        // Error in executing the query
        echo json_encode(array("error" => "SQL error: " . $stmt->error)); // Log the SQL error
        exit();
    }
}

//form data error, redirect back with an error message
echo json_encode(array("error" => "Unknown error"));
exit();
?>
