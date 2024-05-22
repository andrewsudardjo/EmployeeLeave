<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <button type="submit">Register</button>
    </form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Database configuration
        $dsn = 'mysql:host=localhost;dbname=mydb';
        $db_user = 'myapp';
        $db_password = '1234';

        // Get form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            // Connect to the database
            $pdo = new PDO($dsn, $db_user, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the username already exists
            $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $existingUser = $stmt->fetch();

            if ($existingUser) {
                echo "<p style='color: red;'>Username already exists. Please choose a different username.</p>";
            } else {
                // Insert new user into the database
                $stmt = $pdo->prepare('INSERT INTO user (username, password) VALUES (:username, :password)');
                $stmt->execute(['username' => $username, 'password' => md5($password)]);

                echo "<p style='color: green;'>Registration successful! You can now login with your new account.</p>";
            }
        } catch (PDOException $e) {
            die("Could not connect to the database: " . $e->getMessage());
        }
    }
    ?>
</body>
</html>