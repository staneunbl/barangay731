<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create Barangay Official</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../adminfiles/dist/css/ogcss.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>    
</head>
<body>
    <form id="createOfficialsForm" action="includes/createOfficials.inc.php" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row"> 
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter First Name" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">         
                    <div class="form-group">
                        <label for="middleName">Middle Name:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" id="middleName" name="middleName" class="form-control" placeholder="Enter Middle Name" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Enter Last Name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="file" id="image" name="image" onchange="updateLabel(this)" accept="image/png, image/jpeg, image/jpg" placeholder="Upload Image" required>
                    <label class="custom-file-label" for="image" id="picture-label">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="positionId">Position:</label>
                <select id="positionId" name="positionId" class="form-control">
                    <?php require '../includes/dbhandler.inc.php';
                    $sql = "SELECT PositionId, PositionName FROM Positions_tbl";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['PositionId'] . "'>" . $row['PositionName'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No positions available</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>
            <hr>
            <button type="submit" value="Add Barangay Official" class="btn btn-primary btn-block">Create Official</button>
        </div>
    </form>
    <script>
        document.getElementById('createOfficialsForm').addEventListener('submit', function(event) {
            // Prevent default form submission
            event.preventDefault();
            var formData = new FormData(this); // Get form data
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/createOfficials.inc.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        var createOfficialButton = document.querySelector('#modal-10');
                        if (createOfficialButton) {
                            createOfficialButton.style.display = 'none';
                        }
                        Swal.fire({
                            title: "Official Successfully created!",
                            text: "You have successfully created the Official!",
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'barangayOfficials.php'; // Change the URL as needed
                            }
                        });
                    } else {
                        // Handle errors if any
                        Swal.fire({
                            title: "Error",
                            text: "There can be only one record for Barangay Captain",
                            icon: "error"
                        });
                    }
                } else {
                    // Handle errors if any
                    Swal.fire({
                        title: "Error",
                        text: "An error occurred while processing your request.",
                        icon: "error"
                    });
                }
            };
            xhr.send(formData);
        });
    </script>
    <script>
      function updateLabel(input) {
        var label = document.getElementById('picture-label');
        var fileName = input.files[0].name;
        label.textContent = fileName;
    }
</script>
</body>
</html>