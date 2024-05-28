<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee | Apply Leave</title>
</head>
<body>
    <h1>Apply for leave</h1>
    <form method="post">        
            <label for="fromdate">From Date</label>
            <input placeholder="" id="mask1" name="fromdate" class="masked" type="date">
        </div>
        <div class="input-field col m6 s12">
            <label for="todate">To Date</label>
            <input placeholder="" id="mask2" name="todate" class="masked" type="date">
        </div>
        <div class="input-field col m12 s12">
            <label for="reason">Reason</label>
            <textarea id="textarea1" name="reason" class="materialize-textarea"></textarea>
        </div>
        <button type="submit" name="apply" id="apply" class="waves-effect waves-light btn">Apply</button>
    </form>
</body>
</html>

<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        $dsn = 'mysql:host=localhost;dbname=mydb';
        $username = 'myapp';
        $password = '1234';

	
	$user_id = $_SESSION['user_id'];
        $from_date = $_POST['fromdate'];
        $to_date = $_POST['todate'];
        $reason = $_POST['reason'];
	echo $reason;
        try {
		echo "test";
            	$pdo = new PDO($dsn, $username, $password);
           	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	
	     	$stmt = $pdo->prepare('INSERT INTO leaveapp (user_id, from_date, to_date, reason) VALUES (:user_id, :from_date, :to_date, :reason)');
 		$stmt->execute(['user_id' => $user_id, 'from_date' => $from_date, 'to_date' => $to_date, 'reason' => $reason]);       
		
		echo "<p style='color: green;'> Leave succesful</p>";
       		
        	
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    
}
?>
