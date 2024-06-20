<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'newswave');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variable for news articles
$news_articles = [];
$categoryCondition = "";

// Check if a specific category is selected
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = $_GET['category'];
    $categoryCondition = "WHERE type_of_news = '" . $conn->real_escape_string($category) . "'";
}

// Prepare SQL statement to fetch news articles
$sql = "SELECT news_heading, image_path, news_description 
        FROM createnews 
        $categoryCondition
        ORDER BY news_id DESC"; // Adjust sorting as needed

$result = $conn->query($sql);

// Fetch and store the result in an array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $news_articles[] = $row;
    }
}

// Close the database connection
$conn->close();

// Output the HTML for news articles
if (!empty($news_articles)) {
    foreach ($news_articles as $article) {
        echo '<div class="article">
                <h3>' . htmlspecialchars($article['news_heading']) . '</h3>
                <img src="' . htmlspecialchars($article['image_path']) . '" alt="News Image">
                <p>' . htmlspecialchars($article['news_description']) . '</p>
              </div>';
    }
} else {
    echo '<p>No news articles found.</p>';
}
?>
