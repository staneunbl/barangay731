<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Position</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <div class="container">
        <form id="createPositionForm" action="includes/createPositions.inc.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" id="positionName" name="positionName" placeholder="Enter Barangay Position" required>
            </div>
            <hr>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block" id="createPositionBtn">Create Position</button>
            </div>
        </form>
    </div>
    <script>
    document.getElementById('createPositionForm').addEventListener('submit', function(event) {
        // Prevent default form submission
        event.preventDefault();
        var formData = new FormData(this); // Get form data
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/createPositions.inc.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var createPositionButton = document.querySelector('#modal-9');
                if (createPositionButton) {
                    createPositionButton.style.display = 'none';
                }
                Swal.fire({
                    title: "Position Successfully created!",
                    text: "You have successfully created a position! It will be added when you create a Barangay Official.",
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'barangayOfficials.php'; 
                    }
                });
            } else {
                Swal.fire({
                    title: "Position creation failed.",
                    text: "A position has already been saved.",
                    icon: "error"
                });
            }
        };
        xhr.send(formData);
    });
</script>

</body>
</html>