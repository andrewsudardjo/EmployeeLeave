<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Create a new PDO instance and connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=mydb', 'myapp', '1234');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Execute a query to retrieve all rows from the users table
    $stmt = $pdo->query('SELECT * FROM users');

    // Fetch and display each row
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo 'ID: ' . $row['id'] . ' - Username: ' . $row['username'] . ' - Email: ' . $row['email'] . '<br>';
    }
} catch (PDOException $e) {
    // Handle any errors that occur during the connection or query
    echo 'Connection failed: ' . $e->getMessage();
}
?>

