<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot password</h1>
    <form method="POST" action="#">
        <input type="text" id="username" name="username" placeholder="username/email">
        <br>
        <input type="text" id="newpass" name="newpass" placeholder="New password">
        <br>
        <button type="submit" name="change">Submit</button>
        <p>Back to <a href="homepage.php">login page?</a></p>
    </form>

    <?php
    session_start();
    if($_SERVER['REQUEST_METHOD']=='POST') {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'myapp', '1234');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $username = $_POST['username'];
            $newpassword = $_POST['newpass'];

            // Hash the new password before storing it in the database
            $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

            $con = "UPDATE user SET password=:newpassword WHERE username=:username";
            $chngpwd1 = $pdo->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $hashed_password, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo "Your Password successfully changed";
        } catch(PDOException $e) {
            die("Could not connect to database: " . $e->getMessage());
        }
    }
    ?>
</body>
</html>
