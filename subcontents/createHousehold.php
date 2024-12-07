<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="form">
        <form id="createHouseholdForm" action="includes/household.inc.php" method="post" enctype="multipart/form-data">
            <label for="HouseholdNumber">Household Number:</label>
            <input type="Number" class="form-control mb-2" id="HouseholdNumber" name="HouseholdNumber" placeholder="Enter Household Number" required>
            <label for="HouseholdName">Household Name:</label>
            <input type="text" class="form-control mb-2" id="HouseholdName" name="HouseholdName" placeholder="Enter Household Name" required>
            <label for="ClusterNumber">Cluster Number:</label>
            <select id="ClusterNumber" class="form-control mb-3" name="ClusterNumber" required>
                <?php
                // Connect to your database
                require '../includes/dbhandler.inc.php';

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query to fetch cluster numbers from the database table
                $sql = "SELECT ClusterID FROM cluster_tbl";
                $result = $conn->query($sql);

                // Populate dropdown with options
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['ClusterID']."'>".$row['ClusterID']."</option>";
                    }
                }

                // Close database connection
                $conn->close();
                ?>
            </select>
            <hr>
            <input type="submit" class="btn btn-primary btn-block" value="Create Household">
        </form>
    </div>

<script>
document.getElementById('createHouseholdForm').addEventListener('submit', function(event) {
    // Prevent default form submission
    event.preventDefault();
    var formData = new FormData(this); // Get form data
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/household.inc.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                var createHouseholdButton = document.querySelector('#modal-7');
                if (createHouseholdButton) {
                    createHouseholdButton.style.display = 'none';
                }
                Swal.fire({
                    title: "Household Successfully created!",
                    text: response.message,
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'householdList.php'; // Change the URL as needed
                    }
                });
            } else {
                if (response.error === 'householdexists') {
                    Swal.fire({
                        title: "Error!",
                        text: "Household already exists!",
                        icon: "error"
                    });
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "An error occurred!",
                        icon: "error"
                    });
                }
            }
        } else {
            // Handle other HTTP status codes if needed
        }
    };
    xhr.send(formData);
});
</script>




</body>
</html>