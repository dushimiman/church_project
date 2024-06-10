<?php
var_dump($_GET); // Dump the contents of the $_GET array for debugging
// Check if file parameter is set
if (isset($_GET['file'])) {
    $filePath = $_GET['file'];

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Read the file and output its contents
        readfile($filePath);
        exit;
    } else {
        // File not found
        echo "File not found.";
    }
} else {
    // File parameter not set
    echo "No file specified.";
}
?>


