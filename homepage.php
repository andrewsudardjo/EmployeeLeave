<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link href="homepage.css" rel="stylesheet"/> 
</head>
<body>
    <div class="loginpage">
        <div class="title"><h1>Sign in</h1></div>
        <form method="POST" action="#">
            <input class="input" id="username" name="username" type="text" placeholder="Email or Phone" required>
            <br>
            <input class="input1" id="password" name="password" type="password" placeholder="Password" required>
            <div class="submit"><input type="submit" value="Login"></div>
            <div class="forgot"><a href="forgotpass.php">Forgot password?</a></div>
            <div class="register">Not a member? <a href="register.php">Create account</a></div>
        </form>
    </div>
</body>
</html>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "dbconnect.php";

    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to fetch the user
    $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username');
    $stmt->execute(['username' => $username]);

    // Fetch the user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header('Location: admin.php');
            } else {
                header('Location: apply-leave.php');
            }
            exit();
        } else {
            echo "<p style='color: red;'>Password verification failed.</p>";
        }
    } else {
        echo "<p style='color: red;'>Username not found.</p>";
    }
}
?>
