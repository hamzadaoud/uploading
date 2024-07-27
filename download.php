<?php
if (isset($_GET['file'])) {
    $fileName = basename($_GET['file']);
    $filePath = 'uploads/' . $fileName;

    if (file_exists($filePath)) {
        // Update the download count
        $countFile = 'downloads/' . $fileName . '.count';
        $currentCount = file_exists($countFile) ? (int)file_get_contents($countFile) : 0;
        file_put_contents($countFile, $currentCount + 1);

        // Serve the file for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Flush system output buffer
        readfile($filePath);
        exit;
    } else {
        http_response_code(404);
        echo "File not found.";
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}
?>
