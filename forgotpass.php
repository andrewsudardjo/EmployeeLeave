<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <link href="forgotpass.css" rel="stylesheet">
</head>
<body>
    <div class="forgot-password-page">
        <h1>Forgot password</h1>
        <form method="POST" action="#">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <br>
            <input type="password" id="newpass" name="newpass" placeholder="New password" required>
            <br>
            <button type="submit" name="change">Submit</button>
            <p>Back to <a href="homepage.php">login page?</a></p>
        </form>
    </div>

    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'dbconnect.php';

        $username = $_POST['username'];
        $newpassword = $_POST['newpass'];

        // Hash the new password before storing it in the database
        $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

        $con = "UPDATE user SET password = :newpassword WHERE username = :username";
        $chngpwd1 = $pdo->prepare($con);
        $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $hashed_password, PDO::PARAM_STR);
        $chngpwd1->execute();
        echo "Your password has been successfully changed";
    }
    ?>
</body>
</html>
