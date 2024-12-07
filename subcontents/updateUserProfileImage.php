<?php
require '../includes/dbhandler.inc.php';

if (isset($_GET['id'])) {
    $userID = $_GET['id'];

    $userID = mysqli_real_escape_string($conn, $userID);

    $sql = "SELECT * FROM users_tbl WHERE UserID = '$userID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Profile Image</title>
</head>
<body>
    <h2>Update Profile Image</h2>
    <?php if (isset($error_message)) : ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="../includes/updateUserProfileImage.inc.php" method="POST" class="updatelabel" enctype="multipart/form-data">
        <input type="hidden" name="userID" value="<?php echo $row['UserID']; ?>">
        <label for="image">Update Image:</label>
        <input type="file" accept="image/png, image/jpeg, image/jpg" name="image">
        <button type="submit" class="updateProfile">Save Image</button>
    </form>
</body>
</html>
<?php
        } else {
            echo "User record not found.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "User ID not provided.";
}
?>