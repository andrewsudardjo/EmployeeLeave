/*
This code is for showing the list of username only 
*/
<?php
	session_start();
	include "dbconnect.php";
	$stmt = $pdo->prepare('SELECT id, username, password FROM user');
	$stmt->execute();

	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
	<body>
		<?php foreach ($users as $user):?>
			<h1><?php echo htmlspecialchars($user['username']);?> </h1>
		<?php endforeach; ?>
	</body>
</html>



