
<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Form</title> 
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Login Form</span></div>
        <form method="POST" action="#">
          <div class="row">
            <i class="fas fa-user"></i>
            <input id="username" name="username" type="text" placeholder="Email or Phone" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input id="password" name="password" type="password" placeholder="Password" required>
          </div>
          <div class="pass"><a href="#">Forgot password?</a></div>
          <div class="row button">
            <input type="submit" value="Login">
          </div>
          <div class="signup-link">Not a member? <a href="register.php">Signup now</a></div>
        </form>
      </div>
    </div>

  </body>
</html>

<?php
    session_start();
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

			if($user['role'] == 'admin'){
				header('Location: admin.php');
			}else{
				header('Location: apply-leave.php');
			}
			exit();
			
    	    	}else {
       			 echo "<p style='color: red;'>Password verification failed.</p>";
    	    	}			
	   }else{
		echo "<p style='color: red;'>username not found</p>";
    	   }
            

        } catch (PDOException $e) {
            die("Could not connect to the database: " . $e->getMessage());
        }
    }
?>

