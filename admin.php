<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: homepage.php');
    exit();
}

$dsn = 'mysql:host=localhost;dbname=mydb';
$db_user = 'myapp';
$db_password = '1234';

try {
    $pdo = new PDO($dsn, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['action']) && isset($_POST['leave_id'])) {
        $action = $_POST['action'];
        $leave_id = $_POST['leave_id'];
        $status = ($action === 'approve') ? 'approved' : 'rejected';

        $stmt = $pdo->prepare('UPDATE leaveapp SET status = :status WHERE id = :id');
        $stmt->execute(['status' => $status, 'id' => $leave_id]);
    }

    $stmt = $pdo->query('SELECT lr.id, u.username, lr.from_date, lr.to_date, lr.reason, lr.status 
			 FROM leaveapp lr 
  			 JOIN user u ON lr.user_id = u.id 
  			 WHERE lr.status = "pending"');
    $leave_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database: " . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Leave Requests</title>
</head>
<body>
    <h1>Pending Leave Requests</h1>
    <table border="1">
        <tr>
            <th>Username</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Reason</th>
            <th>Action</th>
        </tr>
        <?php foreach ($leave_requests as $request): ?>
            <tr>
                <td><?php echo htmlspecialchars($request['username']); ?></td>
                <td><?php echo htmlspecialchars($request['from_date']); ?></td>
                <td><?php echo htmlspecialchars($request['to_date']); ?></td>
                <td><?php echo htmlspecialchars($request['reason']); ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="leave_id" value="<?php echo $request['id']; ?>">
                        <button type="submit" name="action" value="approve">Approve</button>
                        <button type="submit" name="action" value="reject">Reject</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
