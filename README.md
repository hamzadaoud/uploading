# File Upload Project

## Overview

This project is a simple file upload system that allows users to upload files through a web interface. The uploaded files are stored on the server, and users can preview and download the files after uploading.

## Features

- Upload files through a web form
- Progress bar indicating upload progress
- Display uploaded files with options to preview and download
- Secure file handling to prevent overwriting and ensure unique filenames

## Technologies Used

- HTML
- CSS (Bootstrap)
- JavaScript (jQuery)
- PHP

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/hamzadaoud/uploading.git
    cd uploading
    ```

2. **Set up your server environment:**

    Ensure you have a web server with PHP support (e.g., Apache, Nginx with PHP-FPM, XAMPP, etc.).

3. **Move the project to your web server directory:**

    For example, if you are using XAMPP, move the project to the `htdocs` directory.

    ```sh
    mv file-upload-project /path/to/your/web/server/directory
    ```

4. **Ensure the `uploads` directory is writable:**

    Make sure the `uploads` directory has write permissions. On Unix-based systems, you can do this with the following command:

    ```sh
    chmod 777 uploads
    ```

## Usage

1. **Open the file upload page:**

    Navigate to the project directory in your web browser. If you are running a local server, it might look like this:

    ```
    http://localhost/uploading/
    ```

2. **Upload a file:**

    - Click on "Choose a file" and select a file to upload.
    - Click the "Upload" button to start the upload process.

3. **View the upload progress:**

    A progress bar will indicate the upload progress. Once the upload is complete, a success message will appear.

4. **Preview and download the uploaded file:**

    After uploading, a card will display the file details with a link to preview and download the file.

## Project Structure
ile-upload-project/

-index.html # Main HTML file for the upload interface
- upload.php # PHP script to handle file uploads
- preview.php # PHP script to handle file previews
- uploads/ # Directory to store uploaded files

- README.md # Project documentation


## License

This project is open-source and available under the [MIT License](LICENSE).


## Contribution

Contributions are welcome! Please fork the repository and submit a pull request with your changes.

