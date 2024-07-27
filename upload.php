<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['fileUpload'])) {
        $fileError = $_FILES['fileUpload']['error'];
        if ($fileError === UPLOAD_ERR_OK) {
            $tempFile = $_FILES['fileUpload']['tmp_name'];
            $fileName = $_FILES['fileUpload']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $uploadDir = 'uploads/';
            $fileHash = isset($_POST['fileHash']) ? $_POST['fileHash'] : md5(uniqid());
            $filePath = $uploadDir . $fileHash . '.' . $fileExtension;

            // Ensure the upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Append chunks to the file if it exists
            if (file_exists($filePath)) {
                // Append the chunk to the existing file
                $file = fopen($filePath, 'ab');
                $chunk = file_get_contents($tempFile);
                fwrite($file, $chunk);
                fclose($file);
            } else {
                // Move the file to the desired directory
                if (move_uploaded_file($tempFile, $filePath)) {
                    // Generate the preview URL
                    $previewUrl = 'preview.php?file=' . urlencode($fileHash . '.' . $fileExtension);
                    $downloadUrl = 'uploads/' . $fileHash . '.' . $fileExtension;
                    // Return the response with the file info
                    echo json_encode([
                        "message" => "File uploaded successfully.",
                        "fileName" => $fileName,
                        "fileUrl" => $downloadUrl,
                        "previewUrl" => $previewUrl,
                        "fileHash" => $fileHash
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Error moving uploaded file."]);
                }
            }
        } else {
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded.',
                UPLOAD_ERR_NO_FILE => 'No file was uploaded.',
                UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
                UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
                UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.',
            ];

            $errorMessage = isset($errorMessages[$fileError]) ? $errorMessages[$fileError] : 'Unknown error.';
            http_response_code(400);
            echo json_encode(["message" => $errorMessage]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "No file was uploaded."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed."]);
}
?>
