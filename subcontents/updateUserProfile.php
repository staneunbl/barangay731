<?php
require '../includes/dbhandler.inc.php';

    if (isset($_GET['id'])) {
        $userID = $_GET['id'];

        $sql = "SELECT * FROM users_tbl WHERE UserID = $userID";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
</head>
<body>
    <h2>Update Profile</h2>
    <?php if (isset($error_message)) : ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="../includes/updateUserProfile.inc.php" method="POST" class="updatelabel">
        <input type="hidden" name="userID" value="<?php echo $row['UserID']; ?>">
        Last Name: <input type="text" name="lastName" value="<?php echo $row['LastName']; ?>"><br>
        First Name: <input type="text" name="firstName" value="<?php echo $row['FirstName']; ?>"><br>
        Middle Name: <input type="text" name="middleName" value="<?php echo $row['MiddleName']; ?>"><br>
        Suffix: <input type="text" name="suffix" value="<?php echo $row['Suffix']; ?>"><br>
        Username: <input type="text" name="username" value="<?php echo $row['Username']; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $row['Email']; ?>"><br>
        Phone: <input type="text" name="phone" class="form-group phone" value="<?php echo $row['Phone']; ?>"><br>
        <button type="submit" class="updateProfile">Update Profile</button>
    </form>
</body>
</html>
<?php
        } else {
            echo "User record not found.";
        }
    } else {
        echo "User ID not provided.";
    }
?>