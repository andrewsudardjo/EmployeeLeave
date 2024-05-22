<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <button type="submit">Login</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Database configuration
        $dsn = 'mysql:host=localhost;dbname=mydb';
        $db_user = 'myapp';
        $db_password = '1234';

        // Get form data
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Using MD5 for simplicity, consider using stronger hashing like bcrypt

        try {
            // Connect to the database
            $pdo = new PDO($dsn, $db_user, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the query to fetch the user
            $stmt = $pdo->prepare('SELECT * FROM user WHERE username = :username AND password = :password');
            $stmt->execute(['username' => $username, 'password' => $password]);

            // Fetch the user
            $user = $stmt->fetch();
            if ($user) {
                echo "<p style='color: green;'>Login successful! Welcome, " . $user['username'] . ".</p>";
                // Redirect to a welcome page or perform other actions after successful login
            } else {
                echo "<p style='color: red;'>Invalid username or password.</p>";
            }
        } catch (PDOException $e) {
            die("Could not connect to the database: " . $e->getMessage());
        }
    }
    ?>
</body>
</html>
