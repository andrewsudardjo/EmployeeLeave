<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee | Apply Leave</title>
</head>
<body>
    <h1>Apply for leave</h1>
    <form method="post">
	<div>
		<label for="user"> Username</label>
		<input placeholder="" id = "mask" name="user" class="masked type="text">
        <div>
            <label for="fromdate">From Date</label>
            <input placeholder="" id="mask1" name="fromdate" class="masked" type="date">
        </div>
        <div class="input-field col m6 s12">
            <label for="todate">To Date</label>
            <input placeholder="" id="mask2" name="todate" class="masked" type="date">
        </div>
        <div class="input-field col m12 s12">
            <label for="description">Description</label>
            <textarea id="textarea1" name="description" class="materialize-textarea"></textarea>
        </div>
        <button type="submit" name="apply" id="apply" class="waves-effect waves-light btn">Apply</button>
    </form>

    <?php
    if (isset($_POST['apply'])) {
        $dsn = 'mysql:host=localhost;dbname=leaveapp;charset=utf8';
        $username = 'myapp1';
        $password = '1234';

        try {
            $dbh = new PDO($dsn, $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        // Retrieve form data
	$user = $_POST['user'];
        $fromdate = $_POST['fromdate'];
        $todate = $_POST['todate'];
        $description = $_POST['description'];

        // Prepare SQL statement
        $sql = "INSERT INTO leaveapp (username,fromdate, todate, description) VALUES (:user, :fromdate, :todate, :description)";
        $stmt = $dbh->prepare($sql);

        // Bind parameters to statement
	$stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
        $stmt->bindParam(':todate', $todate, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "Leave application submitted successfully";
        } else {
            echo "Error submitting leave application";
        }
    }
    ?>
</body>
</html>
