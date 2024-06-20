<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'newswave');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $news_heading = $conn->real_escape_string($_POST['news_heading']);
    $type_of_news = $conn->real_escape_string($_POST['type_of_news']);
    $news_description = $conn->real_escape_string($_POST['news_description']);

    // Directory for uploads
    $upload_dir = 'uploads/images/';

    // Check if directory exists, if not, create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Image file path
    $image_file = $upload_dir . basename($_FILES["image_path"]["name"]);

    // Validate the image file
    $check_image = getimagesize($_FILES["image_path"]["tmp_name"]);
    if ($check_image === false) {
        die("<script>alert('File is not an image.'); window.location.href = 'news_form.html';</script>");
    }

    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($image_file, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        die("<script>alert('Only JPG, JPEG, PNG & GIF files are allowed.'); window.location.href = 'news_form.html';</script>");
    }

    // Check file size (500KB max)
    if ($_FILES["image_path"]["size"] > 500000) {
        die("<script>alert('Sorry, your file is too large.'); window.location.href = 'news_form.html';</script>");
    }

    // Move uploaded file to the designated directory
    if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $image_file)) {
        $image_path = $image_file;

        // Insert file path and other form data into the database
        $stmt = $conn->prepare("INSERT INTO createnews (news_heading, image_path, type_of_news, news_description) 
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $news_heading, $image_path, $type_of_news, $news_description);

        if ($stmt->execute()) {
            echo "<script>alert('News article created successfully'); window.location.href = 'news_form.html';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = 'news_form.html';</script>";
    }

    // Close the connection
    $conn->close();
}
?>
