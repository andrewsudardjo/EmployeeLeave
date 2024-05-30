/*
This code is for showing the list of username only 
*/
<?php
session_start();

$dsn = 'mysql:host=localhost;dbname=mydb';
$db_user = 'myapp';
$db_password = '1234';

try{
	$pdo = new PDO($dsn, $db_user, $db_password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $pdo->prepare('SELECT id, username FROM user');
	$stmt->execute();

	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "$users[0]";
}catch(PDOException $e){
	die("couldntconnect");

}
?>

<!DOCTYPE html>
<html>
	<body>
		<?php foreach ($users as $user):?>
			<h1><?php echo htmlspecialchars($user['username']);?> </h1>
		<?php endforeach; ?>
	</body>
</html>



