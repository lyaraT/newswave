<?php
// Initialize message variable
$message = "";

// Database connection
$conn = new mysqli('localhost', 'root', '', 'newswave');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete news article
    if (isset($_POST["delete_article"])) {
        $id = intval($_POST["delete_article"]); // Sanitize input
        if ($id > 0) {
            $delete_sql = "DELETE FROM createnews WHERE id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $message = "<p style='color: green;'>News article deleted successfully!</p>";
            } else {
                $message = "<p style='color: red;'>Error deleting news article: " . $conn->error . "</p>";
            }
            $stmt->close();
        } else {
            $message = "<p style='color: red;'>Invalid ID for deletion.</p>";
        }
    }

    // Update news article
    if (isset($_POST["update_article"])) {
        // Check if required fields are set
        if (isset($_POST["id"], $_POST["news_heading"], $_POST["type_of_news"], $_POST["news_description"])) {
            $id = intval($_POST["id"]); // Sanitize input
            $news_heading = $_POST["news_heading"];
            $type_of_news = $_POST["type_of_news"];
            $news_description = $_POST["news_description"];
            $image_path = '';

            // Handle file upload
            if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] == 0) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image_path"]["name"]);
                if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                }
            }

            // Update SQL query with prepared statement
            $update_sql = "UPDATE createnews SET news_heading=?, type_of_news=?, news_description=?";
            $params = array($news_heading, $type_of_news, $news_description);

            // Append image_path to query if not empty
            if (!empty($image_path)) {
                $update_sql .= ", image_path=?";
                $params[] = $image_path;
            }

            $update_sql .= " WHERE id=?";
            $params[] = $id;

            $stmt = $conn->prepare($update_sql);
            if ($stmt) {
                // Bind parameters
                $types = str_repeat("s", count($params)); // Assuming all are strings for simplicity
                $stmt->bind_param($types, ...$params);

                // Execute query
                if ($stmt->execute()) {
                    $message = "<p style='color: green;'>News article updated successfully!</p>";
                } else {
                    $message = "<p style='color: red;'>Error updating news article: " . $conn->error . "</p>";
                }
                $stmt->close();
            } else {
                $message = "<p style='color: red;'>Error preparing update statement.</p>";
            }
        } else {
            $message = "<p style='color: red;'>Error updating news article: Required fields not provided.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News Articles</title>
    <style>
               body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
        }

        .top-space {
            width: 100%;
            height: 100px; /* Adjust height as needed */
            background-image: url('images/desktop-wallpaper-blue-plain-dark-blue-background.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
        }

        header {
            background-color: #281E5D;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        ul {
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        ul li {
            margin-right: 20px; /* Add space between menu items */
        }

        ul li a {
            color: white;
            text-decoration: none;
            padding: 14px 16px;
            text-align: center;
        }

        .navbar-logo {
            margin-right: 20px; /* Add some margin to separate the logo from the edge */
        }

        .navbar-logo img {
            height: 50px; /* Adjust the height as needed */
            width: auto; /* Maintain the aspect ratio */
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: grey;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        
        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        table th {
            background-color: #f0f0f0;
            color: #555;
            font-weight: bold;
        }
        
        table td img {
            max-width: 100px;
            max-height: 100px;
            border-radius: 4px;
        }
        
        form {
            display: inline;
        }
        
        .edit-form {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        
        .edit-form label {
            font-weight: bold;
            color: #555;
        }
        
        .edit-form input[type="text"], 
        .edit-form textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        .edit-form input[type="file"] {
            margin-top: 5px;
        }
        
        .edit-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .edit-form button:hover {
            background-color: #45a049;
        }
        
        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
        }
        
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
<div class="table-container">
    <h2>Manage News Articles</h2>

    <!-- Display message -->
    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <!-- Display news articles in table -->
    <?php
    // Fetch news articles
    $sql = "SELECT * FROM createnews";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>
                <tr>
                    <th>Picture</th>
                    <th>News Heading</th>
                    <th>Type of News</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td><img src="' . $row['image_path'] . '" alt="Image"></td>
                    <td>' . $row['news_heading'] . '</td>
                    <td>' . $row['type_of_news'] . '</td>
                    <td>' . $row['news_description'] . '</td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="edit_article" value="' . $row["id"] . '">
                            <input type="submit" value="Edit">
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="delete_article" value="' . $row["id"] . '">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>';
        }

        echo '</table>';
    } else {
        echo "<p>No news articles found.</p>";
    }
    ?>

    <!-- Handle edit form display -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_article"])) {
        $id = intval($_POST["edit_article"]); // Sanitize input
        $edit_sql = "SELECT * FROM createnews WHERE id = ?";
        $stmt = $conn->prepare($edit_sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
    ?>
            <div class="edit-form">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="news_heading">News Heading:</label><br>
                    <input type="text" id="news_heading" name="news_heading" value="<?php echo $row['news_heading']; ?>"><br>
                    <label for="type_of_news">Type of News:</label><br>
                    <input type="text" id="type_of_news" name="type_of_news" value="<?php echo $row['type_of_news']; ?>"><br>
                    <label for="news_description">Description:</label><br>
                    <textarea id="news_description" name="news_description"><?php echo $row['news_description']; ?></textarea><br>
                    <label for="image_path">Upload Image:</label><br>
                    <input type="file" id="image_path" name="image_path"><br>
                    <button type="submit" name="update_article">Update</button>
                </form>
            </div>
    <?php
        } else {
            echo "<p>Error: News article not found.</p>";
        }
        $stmt->close();
    }
    ?>

</div>

<?php
// Close the database connection
$conn->close();
?>

</body>
</html>
