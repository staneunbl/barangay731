<?php
require __DIR__ . "/dompdf/autoload.inc.php";
use Dompdf\Options;

if (isset($_GET['id'])) {
  $userID = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT); 
  require "includes/dbhandler.inc.php";

  $sql = "SELECT COUNT(*) AS count FROM barangaycertificate_tbl";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $certificateCount = $row['count'];

  if ($certificateCount == 0) {
    $newCertificateNumber = 1;
  } else {
    $newCertificateNumber = $certificateCount + 1;
  }

    $paddedCertificateNumber = sprintf("%02d", $newCertificateNumber);
    $referenceNo = "B731-TBC24-$paddedCertificateNumber";
    $certificateNumber = "TBC24-$paddedCertificateNumber";

    $sql = "INSERT INTO BarangayCertificate_tbl (UserID, CertificateNumber, ReferenceNo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $userID, $certificateNumber, $referenceNo);
    $stmt->execute();

  $sql = "SELECT u.*, req.*
            FROM users_tbl u
            LEFT JOIN RequestForSomeone_tbl req ON u.UserID = req.userID 
            WHERE u.UserID = ?";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $userID);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($row) {
    //dito ka mag edit shay
    $htmlContent = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Barangay Certificate</title>
            <link rel=\"stylesheet\" href=\"BarangayCert/BarangayTemplateCSS.css\">
        </head>
        <body>
            <div class=\"certificate-container\">
                <div class=\"certificate\">
                    <!-- Left Logo -->
                    <div class=\"logo-left\" style=\"position: absolute;\">
                        <img src=\"BarangayCert/left_logo.png\" alt=\"Left Logo\" style=\"max-width: 130px;\">
                    </div>
                    <!-- Right Logo -->
                    <div class=\"logo-right\" style=\"position: absolute;\">
                        <img src=\"BarangayCert/right_logo.png\" alt=\"Right Logo\" style=\"max-width: 120px;\">
                    </div>
                    <div class=\"certificate-header\">
                        <!-- Center Logo -->
                        <div class=\"logo-center\">
                            <img src=\"BarangayCert/center_logo.png\" alt=\"Center Logo\" style=\"max-width: 550px;\">
                        </div>
                        <!-- Text in front of the center logo -->
                        <div class=\"certificate-text\">
                            <p>REPUBLIC OF THE PHILIPPINES<br>City of Manila<br><strong class=\"bold\"> BARANGAY 731, ZONE 80, DISTRICT-5</strong></p>
                            <!-- Insert WordArt-like text below -->
                            <div class=\"wordart-container\">
                                <div class=\"wordart-text\">BARANGAY CERTIFICATE</div>
                                <div class=\"wordart-shadow\">BARANGAY CERTIFICATE</div>
                            </div>                   
                        </div>
                    </div>
                    <table border=\"1\" class=\"certificate-table\">
                        <tr>
                            <td style=\"width: 350px;\"> REFERENCE NO: $referenceNo </td>
                            <td colspan=\"2\" style=\"width: 300px;\"> VALID UNTIL:  {$row['expiryDate']}  </td> <!-- Combined cell for VALID UNTIL -->
                            <td style=\"width: 120px; color: red; font-size: 16px;\"> $certificateNumber </td>
                        </tr>    
                        <tr>
                            <td style=\"width: 150px;\"> FAMILY NAME: {$row['lastName']} </td>
                            <td colspan=\"2\" style=\"width: 300px;\"> FIRST NAME:  {$row['firstName']} </td> <!-- Combined cell for FAMILY NAME and FIRST NAME -->
                            <td rowspan=\"4\"> [BIOMETRICS] </td>
                        </tr>               
                        <tr>
                            <td style=\"width: 150px;\"> MIDDLE NAME: {$row['middleName']} </td>
                            <td colspan=\"2\" style=\"width: 300px;\"> HUSBAND'S/WIFE'S NAME </td> <!-- Combined cell for FAMILY NAME and FIRST NAME -->
                        </tr>
                        <tr>
                            <td colspan=\"3\" style=\"width: 300px;\"> ADDRESS: </td> <!-- Combined cell for FAMILY NAME and FIRST NAME -->
                        </tr>
                        <tr>
                            <td style=\"width: 150px;\"> BIRTHDAY: {$row['birthday']} </td>
                            <td colspan=\"2\" style=\"width: 200px;\"> PLACE OF BIRTH:  </td> <!-- Combined cell for FAMILY NAME and FIRST NAME -->
                        </tr>
                        <tr>
                            <td> CITIZENSHIP  </td>
                            <td style=\"width: 200px;\">CIVIL STATUS:  </td>
                            <td style=\"width: 200px;\"> GENDER:  </td>
                            <td rowspan=\"3\"> RIGHT THUMB [BIOMETRICS] </td> <!-- Adjusted width for the RIGHT THUMB column -->
                        </tr>                                             
                        <tr>
                            <td colspan=\"3\" style=\"width: 200px;\"> PURPOSE: {$row['Purpose']}  </td>
                        </tr>
                        <tr>
                            <td colspan=\"3\"> REMARKS <br> NO DEROGATORY RECORD ON FILE <br>
                                This is to certify that the name of person appearing and printed is NOT a registered voter, and given temporary clearance for the above purpose.
                            </td>
                        </tr>
                        <tr>
                            <td> REQUESTED BY: {$row['LastName']}, {$row['FirstName']} {$row['MiddleName']} <br> RELATIONSHIP: {$row['relationshipWith']} <br> PREPARED BY: BGY. SEC-L R JAURIGUE <br> DATE ISSUED: </td>
                            <td> <center><strong> HON. SALVADOR D. LADRAN, JR. </strong> <br> PUNONG BARANGAY </center> </td>
                            <td colspan=\"2\"> TEL. NO.: 02-5238891 <br> MOBILE: 0906-9286789 <br> EMAIL: brgy731zone80@gmail.com </td>
                        </tr>
                    </table>                               
                </div>
            </div>        
        </body>
        </html>

    ";

    $options = new Options;
    $options->setChroot(__DIR__);

    $dompdf = new Dompdf\Dompdf($options);

    $dompdf->loadHtml($htmlContent);

    $dompdf->setPaper('A4', 'landscape');

    // Generate PDF in memory
    $dompdf->render();

    // Send it to browser with attachment option 
    $dompdf->stream("Barangay-Certificate.pdf", ["Attachment" => 0]);
  } else {
    echo "Error: Resident data not found!";
  }
} else {
  echo "Error: No ResidentID provided!";
}

$conn->close();
?>