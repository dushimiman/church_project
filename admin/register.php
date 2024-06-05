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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $church_id = $_POST['church_id'];
    $baptized = isset($_POST['baptized']) ? 1 : 0;
    $phone_number = $_POST['phone_number'];

    // Prepare the SQL statement
    $sql = "INSERT INTO christians (name, church_id, baptized, phone_number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("ssis", $name, $church_id, $baptized, $phone_number);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New Christian registered successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register New Christian</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

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
    <form method="POST" class = "register-form">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="church_id" placeholder="Church ID" required>
        <label>
            <input type="checkbox" name="baptized"> Baptized
        </label>
        <input type="text" name="phone_number" placeholder="Phone Number" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
