<?php
session_start();
require '../includes/dbhandler.inc.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Get the logged-in user's username
$username = $_SESSION['username'];

// Retrieve the ResidentID associated with the logged-in user
$stmt = $conn->prepare("SELECT r.ResidentID FROM Users_tbl u INNER JOIN Residents_tbl r ON u.ResidentID = r.ResidentID WHERE u.Username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// If a ResidentID is found, store it
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $residentId = $row['ResidentID'];
} else {
    echo "Error: Resident ID not found for the logged-in user";
    exit();
}

$stmt->close();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present in the POST data
    if (!isset($_POST['userId'], $_POST['docuType'], $_POST['purpose'], $_POST['requestFor'])) {
        echo json_encode(array("success" => false, "message" => "Required fields are missing."));
        exit();
    }
    
    // Get form data
    $userId = $_POST['userId'];
    $docuType = $_POST['docuType'];
    $requestFor = $_POST['requestFor'];
    $relationshipWith = isset($_POST['relationshipWith']) ? $_POST['relationshipWith'] : ''; 
    $purpose = $_POST['purpose'];
    $requestDate = date('Y-m-d H:i:s');
    
    // Set expiry date to 6 months from the current date
    $expiryDate = date('Y-m-d', strtotime('+6 months'));

    // Generate tracking number
    $trackingNumber = $docuType . "-" . str_pad($userId, 2, '0', STR_PAD_LEFT) . "-" . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);

    // Prepare and execute the INSERT query
    if ($requestFor === 'self') {
        $stmt = $conn->prepare("INSERT INTO Request_tbl (UserId, ResidentID, DocuType, RequestFor, Purpose, RequestDate, ExpiryDate, Status, TrackingNumber) VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', ?)");
        $stmt->bind_param("iissssss", $userId, $residentId, $docuType, $requestFor, $purpose, $requestDate, $expiryDate, $trackingNumber);
    } elseif ($requestFor === 'others') {
        $relationshipWith = $_POST['relationshipWith'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $middleName = $_POST['middleName'];
        $birthday = $_POST['birthday'];
        $stmt = $conn->prepare("INSERT INTO requestForSomeone_tbl (userID, DocuType, Purpose, requestFor, relationshipWith, firstName, lastName, middleName, birthday, requestDate, expiryDate, TrackingNumber, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
        $stmt->bind_param("isssssssssss", $userId, $docuType, $purpose, $requestFor, $relationshipWith, $firstName, $lastName, $middleName, $birthday, $requestDate, $expiryDate, $trackingNumber);
    } else {
        echo json_encode(array("success" => false, "message" => "Invalid request type."));
        exit();
    }
    
    if ($stmt->execute()) {
        // Set success message in session
        $_SESSION['success_message'] = "Request submitted successfully!";
        
        // Return success response as JSON
        echo json_encode(array("success" => true, "message" => $_SESSION['success_message']));
        exit();
    } else {
        // Handle error
        echo json_encode(array("success" => false, "message" => "Error submitting request: " . $stmt->error));
    }

    $stmt->close();
} else {
    // If the request is not POST, redirect to the form page
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
    exit();
}
?>