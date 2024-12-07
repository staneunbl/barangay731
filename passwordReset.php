<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript"></script>
</head>
<body>
    <h2>Reset Password</h2>
    <form action="includes/resetPassword.inc.php" method="post">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="password-repeat">Repeat Password:</label>
        <input type="password" id="password-repeat" name="password-repeat" required>
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <button type="submit" name="reset-password-submit">Reset Password</button>
    </form>
</body>
</html>