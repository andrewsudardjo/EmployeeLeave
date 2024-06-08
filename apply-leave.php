<!DOCTYPE html>
<html lang="en">
<head>
    <link href="applyLeave.css" rel="stylesheet">
    <title>Employee | Apply Leave</title>
</head>
<body>

<?php
session_start();
include "dbconnect.php";

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from_date = $_POST['fromdate'];
    $to_date = $_POST['todate'];
    $reason = $_POST['reason'];

    $stmt = $pdo->prepare('INSERT INTO leaveapp (user_id, from_date, to_date, reason) VALUES (:user_id, :from_date, :to_date, :reason)');
    $stmt->execute(['user_id' => $user_id, 'from_date' => $from_date, 'to_date' => $to_date, 'reason' => $reason]);
    echo "<p style='color: green;'>Leave application submitted successfully.</p>";
}

$test = $pdo->prepare('SELECT reason, from_date, to_date, status FROM leaveapp WHERE user_id = :user_id ORDER BY from_date DESC');
$test->execute(['user_id' => $user_id]);
$leave_requests = $test->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Apply for leave</h1>
<form method="post">
    <div class="input-field col m6 s12">
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
<hr>
<h2>Leave application details</h2>
<table border="1">
    <tr>
        <th>From Date</th>
        <th>To Date</th>
        <th>Reason</th>
        <th>Status</th>
    </tr>
    <?php foreach ($leave_requests as $request): ?>
        <tr>
            <td><?php echo htmlspecialchars($request['from_date']); ?></td>
            <td><?php echo htmlspecialchars($request['to_date']); ?></td>
            <td><?php echo htmlspecialchars($request['reason']); ?></td>
            <td>
                <?php
                $status = htmlspecialchars($request['status']);
                switch ($status) {
                    case 'approved':
                        $color = 'green';
                        break;
                    case 'rejected':
                        $color = 'red';
                        break;
                    default:
                        $color = 'black';
                        break;
                }
                ?>
                <span style="color: <?php echo $color; ?>"><?php echo $status; ?></span>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
