<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['report']) && $_FILES['report']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        
        // Check if the uploads directory exists, if not, create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $targetFile = $targetDir . basename($_FILES["report"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow certain file formats
        if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
            echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["report"]["tmp_name"], $targetFile)) {
                // Insert report details into database
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

                // Escape special characters in the file name and file path
                $reportName = $conn->real_escape_string(basename($_FILES["report"]["name"]));
                $filePath = $conn->real_escape_string($targetFile);

                $sql = "INSERT INTO reports (report_name, file_path) VALUES ('$reportName', '$filePath')";

                if ($conn->query($sql) === TRUE) {
                    echo "The file ". basename($_FILES["report"]["name"]). " has been uploaded.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded or there was an upload error.";
    }
} else {
    echo "Invalid request.";
}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Report</title>
</head>
<body>
    <h1>Upload Report</h1>
    <form action="upload_report.php" method="post" enctype="multipart/form-data">
        <label for="report">Choose a report to upload:</label>
        <input type="file" name="report" id="report" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
