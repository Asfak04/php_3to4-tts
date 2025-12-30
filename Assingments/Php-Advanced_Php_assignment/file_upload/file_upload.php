<?php
$conn = new mysqli("localhost", "root", "", "upload_db");

if ($conn->connect_error) {
    die("Database connection failed");
}

if (isset($_POST['upload'])) {

    $uploadDir = "uploads/";
    $file = $_FILES['myfile'];

    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

    $fileName = basename($file['name']);
    $fileTmp  = $file['tmp_name'];
    $fileSize = $file['size'];
    echo $fileSize;
    $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($fileExt, $allowedTypes)) {
        die("Invalid file type");
    }
    // size of uploaded file in bytes. 1024 bytes = 1kb.
    // Validate size (2MB)
    if ($fileSize > 2 * 1024 * 1024) {
        die(" File too large");
    }

    // Rename file
    $newFileName = uniqid("upload_", true) . "." . $fileExt;
    $filePath = $uploadDir . $newFileName;

    // Move file
    if (move_uploaded_file($fileTmp, $filePath)) {

        // Insert into database
        $stmt = $conn->prepare(
            "INSERT INTO uploads (file_name, file_path) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $newFileName, $filePath);
        $stmt->execute();

        echo "File uploaded & saved to database";

    } else {
        echo " Upload failed";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
</head>
<body>

<h2>Upload File</h2>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="myfile" required><br><br>
    <button type="submit" name="upload">Upload</button>
</form>

</body>
</html>
