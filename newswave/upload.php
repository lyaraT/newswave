<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'newswave');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variable for news articles
$news_articles = [];

// Initialize variable for news categories
$categories = [];

// Fetch all available news categories
$category_result = $conn->query("SELECT DISTINCT type_of_news FROM createnews");

if ($category_result) {
    while ($row = $category_result->fetch_assoc()) {
        $categories[] = $row['type_of_news'];
    }
}

// Check if a specific category is selected
$categoryCondition = '';
if (isset($_GET['category']) && !empty($_GET['category']) && $_GET['category'] !== 'All') {
    $category = $conn->real_escape_string($_GET['category']);
    $categoryCondition = "WHERE type_of_news = '$category'";
}

// Prepare SQL to fetch articles based on category
$sql = "SELECT news_heading, image_path, news_description, type_of_news FROM createnews $categoryCondition ORDER BY id DESC";
$result = $conn->query($sql);

// Check if there are any articles
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $news_articles[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWSWAVE - View All News Articles</title>
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
            justify-content: space-between; /* Distribute space between items */
            align-items: center; /* Align items vertically */
        }

        nav {
            flex: 1; /* Allows nav to take up available space */
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
            width: 80%;
            margin: auto;
            text-align: center;
        }

        .news-categories {
            margin: 20px 0;
        }

        .news-categories a {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #281E5D;
            color: #fff;
            border-radius: 30px;
            text-decoration: none;
        }

        .news-categories a:hover {
            background-color: #0056b3;
        }

        .news-articles {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .article {
            width: calc(33.33% - 20px);
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            text-align: left;
            box-sizing: border-box;
        }

        .article h3 {
            margin-top: 0;
            font-size: 20px;
            color: #333D79;
            margin-bottom: 10px;
        }

        .article img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        
        h3 {
            font-family: 'Arial', sans-serif;
            font-size: 24px;
            font-weight: bold;
            color: #333D79;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        h2 {
            font-family: 'Arial', sans-serif;
            font-size: 28px;
            font-weight: bold;
            color: #333D79;
            margin-bottom: 10px;
        }

        @media screen and (max-width: 768px) {
            .article {
                width: calc(50% - 20px);
            }
        }

        @media screen and (max-width: 480px) {
            .article {
                width: 100%;
            }
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
<div class="top-space"></div>

<header>
    <nav>
        <ul>
            <li><a href="mainpage.php">Home</a></li>
            <li><a href="upload.php">Articles</a></li>
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

<!-- Main Content -->
<div class="container">
    <h2>View News Articles</h2>

    <!-- Display News Categories as Oval Buttons -->
    <div class="news-categories">
        <a href="upload.php?category=All">All</a>
        <?php foreach ($categories as $category): ?>
            <a href="upload.php?category=<?php echo urlencode($category); ?>"><?php echo htmlspecialchars($category); ?></a>
        <?php endforeach; ?>
    </div>

    <!-- Display News Articles -->
    <div class="news-articles">
        <?php if (!empty($news_articles)): ?>
            <?php foreach ($news_articles as $article): ?>
                <div class="article" data-category="<?php echo htmlspecialchars($article['type_of_news']); ?>">
                    <h3><?php echo htmlspecialchars($article['news_heading']); ?></h3>
                    <img src="<?php echo htmlspecialchars($article['image_path']); ?>" alt="News Image">
                    <p><?php echo htmlspecialchars($article['news_description']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No news articles found<?php if (isset($category)) echo " for category: " . htmlspecialchars($category); ?>.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
