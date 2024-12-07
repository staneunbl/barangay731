<?php
// Check if BrgyOfficialId is provided in the URL
if(isset($_GET['BrgyOfficialId'])) {
    // Get BrgyOfficialId from the URL
  $BrgyOfficialId = $_GET['BrgyOfficialId'];

    // Database connection
  require '../includes/dbhandler.inc.php';

    // Fetch data for the selected barangay official
  $sql = "SELECT * FROM BarangayOfficials_tbl WHERE BrgyOfficialId = $BrgyOfficialId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstName = $row['FirstName'];
    $lastName = $row['LastName'];
    $middleName = $row['MiddleName'];
    $positionId = $row['PositionID'];
        // You may fetch more data if needed
  } else {
    echo "Barangay official not found";
        exit(); // Stop further execution
      }

    // Close database connection
      $conn->close();
    } else {
      echo "BrgyOfficialId not provided in the URL";
    exit(); // Stop further execution
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
      .container {
        max-height: 400px; /* Adjust as needed */
        overflow-y: auto;
        padding: 10px;
      }
    </style>    
  </head>
  <body>
    <div class="container">
      <form id="updateOfficialsForm" action="includes/updateOfficials.inc.php" method="POST" class="form-container" enctype="multipart/form-data">
        <div class="row"> 
          <div class="col-md-6">       
            <input type="hidden" name="BrgyOfficialId" value="<?php echo $BrgyOfficialId; ?>">
            <div class="form-group">
              <label for="firstName">First Name:</label>
              <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
            </div>
          </div>
          <div class="col-md-6">       
            <div class="form-group">
              <label for="middleName">Middle Name:</label>
              <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo $middleName; ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="lastName">Last Name:</label>
          <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>">
        </div><hr>
        <div class="form-group">
          <label for="image">Current Image:&nbsp;&nbsp;</label>
          <?php if(isset($row['Image']) && !empty($row['Image'])): ?>
          <img src="uploads/BarangayOfficials/<?php echo $row['Image']; ?>?v=<?php echo time(); ?>" alt="Current Image" style="max-width: 130px;" class="rounded">
        <?php else: ?>
          <p>No image available</p>
        <?php endif; ?>
      </div><hr>
      <div class="form-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input"  id="image" name="image" accept="image/png, image/jpeg, image/jpg" onchange="updateLabelOfficial(this)">
          <label id="picture-label" class="custom-file-label" for="image">Upload New Image:</label>
        </div>
      </div>
      <div class="form-group">
        <label for="positionId">Position:</label>
        <select id="positionId" name="positionId" class="form-control">
          <?php
          require '../includes/dbhandler.inc.php';

          $sql = "SELECT PositionId, PositionName FROM Positions_tbl";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $selected = ($row['PositionId'] == $positionId) ? 'selected' : '';
              echo "<option value='" . $row['PositionId'] . "' $selected>" . $row['PositionName'] . "</option>";
            }
          } else {
            echo "<option value=''>No positions available</option>";
          }

          $conn->close();
          ?>
        </select>
      </div>
      <hr>
      <button type="submit" class="btn btn-primary btn-block">Update Official</button>
    </form>
  </div>
  <script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('updateOfficialsForm').addEventListener('submit', function(event) {
            // Prevent default form submission
            event.preventDefault();
            var formData = new FormData(this); // Get form data
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/updateOfficials.inc.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var editOfficialButton = document.querySelector('#modal-11');
                    if (editOfficialButton) {
                        editOfficialButton.style.display = 'none';
                    }
                    Swal.fire({
                        title: "Official Successfully updated!",
                        text: "You have successfully updated the Official!",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'barangayOfficials.php'; // Change the URL as needed
                        }
                    });
                } else {
                    // Handle errors if any
                }
            };
            xhr.send(formData);
        });
    </script>
    <script>
        function updateLabelOfficial(input) {
            var label = document.getElementById('picture-label');
            var fileName = input.files[0].name;
            
            // Limit to 8 characters
            if (fileName.length > 8) {
                fileName = fileName.substring(0, 30) + "...";
            }

            label.textContent = fileName;
        }
    </script>
</body>
</html>