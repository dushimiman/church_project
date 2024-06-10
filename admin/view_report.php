<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "church_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, report_name, file_path, upload_date FROM reports";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Reports</title>
</head>
<body>
    <h1>Uploaded Reports</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Report Name</th>
            <th>Upload Date</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["report_name"]. "</td>
                        <td>" . $row["upload_date"]. "</td>
                        <td><a href='download.php?file=" . $row["file_path"]. "'>Download</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No reports found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>

