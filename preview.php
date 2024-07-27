<?php
$fileHash = $_GET['file'] ?? '';
$uploadDir = 'uploads/';
$filePath = $uploadDir . $fileHash;

if (file_exists($filePath)) {
    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $fileName = pathinfo($filePath, PATHINFO_BASENAME);
    $previewContent = '';

    // Generate a preview based on file type
    switch ($fileExtension) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            $previewContent = "<img src='{$filePath}' alt='Image preview' class='img-fluid'>";
            break;
        case 'pdf':
            $previewContent = "<iframe src='{$filePath}' class='w-100' style='height: 500px;' frameborder='0'></iframe>";
            break;
        case 'mp4':
        case 'webm':
        case 'ogg':
            $previewContent = "<video controls class='w-100' style='max-height: 500px;'><source src='{$filePath}' type='video/{$fileExtension}'>Your browser does not support the video tag.</video>";
            break;
        default:
            $previewContent = "<p>Preview not available for this file type.</p>";
            break;
    }

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>File Preview</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
        <style>
            body {
                background-color: #f0f2f5;
                font-family: Arial, sans-serif;
            }
            .navbar {
                background-color: #222;
            }
            .navbar-brand {
                color: #fff;
            }
            .navbar-nav .nav-link {
                color: #ccc;
            }
            .navbar-nav .nav-link:hover {
                color: #fff;
            }
            .container {
                max-width: 800px;
                margin-top: 30px;
            }
            .card {
                border: none;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                margin-bottom: 20px;
            }
            .card-header {
                background-color: #007bff;
                color: #fff;
                font-size: 1.5rem;
                text-align: center;
                padding: 15px;
            }
            .card-body {
                padding: 20px;
                text-align: center;
            }
            .btn-custom {
                background-color: #007bff;
                border-color: #007bff;
                color: #fff;
            }
            .btn-custom:hover {
                background-color: #0056b3;
                border-color: #004080;
            }
            .btn-secondary {
                background-color: #6c757d;
                border-color: #6c757d;
            }
            .btn-secondary:hover {
                background-color: #5a6268;
                border-color: #545b62;
            }
            .preview-container {
                margin-top: 20px;
            }
            .button-group {
                display: flex;
                justify-content: center;
                gap: 10px;
            }
            .button-group .btn {
                margin: 0;
            }
        </style>
    </head>
    <body>
        <nav class='navbar navbar-expand-lg navbar-dark'>
            <a class='navbar-brand' href='/'>File Preview</a>
            <div class='collapse navbar-collapse'>
                <ul class='navbar-nav mr-auto'>
                    <li class='nav-item'>
                        <a class='nav-link' href='/'>Home</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='about.html'>About</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class='container'>
            <div class='card'>
                <div class='card-header'>
                    File Preview
                </div>
                <div class='card-body'>
                    <div class='preview-container'>
                        {$previewContent}
                    </div>
                    <div class='mt-3 button-group'>
                        <a href='uploads/{$fileName}' class='btn btn-custom' download>Download File</a>
                        <button class='btn btn-secondary' id='copyLinkButton'>Copy Share Link</button>
                        <a href='/' class='btn btn-secondary'>Back to Upload</a>
                    </div>
                </div>
            </div>
        </div>
        <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
        <script>
            document.getElementById('copyLinkButton').addEventListener('click', function() {
                var link = window.location.href;
                navigator.clipboard.writeText(link).then(function() {
                    alert('Share link copied to clipboard!');
                }, function(err) {
                    alert('Failed to copy link: ' + err);
                });
            });
        </script>
    </body>
    </html>";
} else {
    echo "<p>File not found.</p>";
}
?>
