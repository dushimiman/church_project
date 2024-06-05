<?php
include '../config.php';
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["report_file"])) {
    $report_name = $_POST['report_name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["report_file"]["name"]);

    if (move_uploaded_file($_FILES["report_file"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO reports (report_name, report_file) VALUES ('$report_name', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "Report uploaded successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
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

<!-- HTML for report upload form -->
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="report_name" placeholder="Report Name" required>
    <input type="file" name="report_file" required>
    <button type="submit">Upload</button>
</form>
