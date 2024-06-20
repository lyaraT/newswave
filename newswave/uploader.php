<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'newswave');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $news_heading = $_POST['news_heading'];
    $type_of_news = $_POST['type_of_news'];
    $news_description = $_POST['news_description'];
    $image_path = '';

    // Handle file upload
    if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image_path"]["name"]);
        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        }
    }

    // Insert news article into the database
    $stmt = $conn->prepare("INSERT INTO createnews (news_heading, type_of_news, image_path, news_description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $news_heading, $type_of_news, $image_path, $news_description);

    if ($stmt->execute()) {
        $message = "<p style='color: green;'>News article created successfully!</p>";
    } else {
        $message = "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWSWAVE - Create News Article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
        }

        header {
            background-color: #281E5D;
            padding: 10px 0;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between; /* Distribute space between items */
            align-items: center; /* Align items vertically */
        }

        nav {
            flex: 1;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex; /* Use flexbox to align items horizontally */
            align-items: center;
        }

        nav ul li {
            margin-right: 20px; /* Add some margin to space out the items */
        }

        nav ul li a {
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .dropdown {
            position: relative; /* Positioning for dropdown */
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: grey;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            margin-top: 20px;
            text-align: left;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .registration-container {
            margin-top: 20px;
        }

        .registration-box {
            padding: 20px;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 10px;
        }

        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button[type="reset"] {
            background-color: #f44336;
            color: white;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }

        .navbar-logo {
            margin-left: auto; /* Push the logo to the right */
        }

        .navbar-logo img {
            height: 50px;
            width: auto;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="mainpage.php">Home</a></li>
            <li><a href="news_manage.php">View</a></li>

            <li class="dropdown">
                <a href="#">Login</a>
                <div class="dropdown-content">
                    <a href="loginpageadmin.php">Admin</a>
                    <a href="login.php">Employee</a>
                    <a href="login.php">Contributor</a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="navbar-logo">
        <a href="mainpage.php"><img src="images/Capture.png" alt="NewsWave Logo"></a>
    </div>
</header>

<div class="container">
    <div class="registration-container">
        <div class="registration-box">
            <h2>Create News Article</h2>
            <!-- Display message after form submission -->
            <?php
            if (!empty($message)) {
                echo $message;
            }
            ?>
            <form action="uploader.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><label for="news_heading">News Heading:</label></td>
                        <td><input type="text" id="news_heading" name="news_heading" placeholder="News Heading" required></td>
                    </tr>
                    <tr>
                        <td><label for="type_of_news">Type of News:</label></td>
                        <td>
                            <select id="type_of_news" name="type_of_news" required>
                                <option value="Politics">Politics</option>
                                <option value="Sports">Sports</option>
                                <option value="Education">Education</option>
                                <option value="Technology">Technology</option>
                                <option value="Health">Health</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="image_path">Upload Image:</label></td>
                        <td><input type="file" id="image_path" name="image_path" required></td>
                    </tr>
                    <tr>
                        <td><label for="news_description">Description:</label></td>
                        <td><textarea id="news_description" name="news_description" placeholder="Description" required></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="reset" value="Reset">Cancel</button>
                            <button type="submit" value="Submit">Create News</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>
