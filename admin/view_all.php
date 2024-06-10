<!DOCTYPE html>
<html>
<head>
    <title>View All Christians</title>
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

    <h2>View All Christians</h2>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Church ID</th>
                <th>Baptized</th>
                <th>Phone Number</th>
                <th>Ministy</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../config.php';
            session_start();

            if (!isset($_SESSION['admin'])) {
                header("Location: ../login.php");
                exit;
            }

            // Fetch all Christians from the database
            $sql = "SELECT * FROM christians";
            $result = $conn->query($sql);

            // Check if there are any Christians
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['church_id'] . "</td>";
                    echo "<td>" . ($row['baptized'] ? 'Yes' : 'No') . "</td>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>" . $row['ministry'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No Christians available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
