<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

// Fetch baptized Christians from the database
$sql = "SELECT * FROM christians WHERE baptized = 1";
$result = $conn->query($sql);

// Check if there are any baptized Christians
if ($result->num_rows > 0) {
    $baptized_christians = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $baptized_christians = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Baptized Christians</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="register.php">Register New Christian</a></li>
            <li><a href="view_all.php">View All Christians</a></li>
            <li><a href="view_baptized.php">View Baptized Christians</a></li>
            <li><a href="view_unbaptized.php">View Unbaptized Christians</a></li>
            <li><a href="upload_report.php">Upload Report</a></li>
            <li><a href="view_reports.php">View Reports</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>

    <h2>View Baptized Christians</h2>

    <?php if (empty($baptized_christians)): ?>
        <p>No baptized Christians available.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Church ID</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($baptized_christians as $christian): ?>
                    <tr>
                        <td><?php echo $christian['name']; ?></td>
                        <td><?php echo $christian['church_id']; ?></td>
                        <td><?php echo $christian['phone_number']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
