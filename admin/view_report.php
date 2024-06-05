<?php
include '../config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

// Fetch reports from the view
$sql = "SELECT * FROM view_reports";
$result = $conn->query($sql);

// Check if there are any reports
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['report_name'] . "</td>";
        echo "<td>" . $row['uploaded_at'] . "</td>";
        echo "<td><a href='" . $row['download_link'] . "' target='_blank'>Download</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No reports available.</td></tr>";
}
?>

