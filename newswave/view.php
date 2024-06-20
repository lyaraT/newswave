<?php
include 'db_config.php';

$sql = "SELECT * FROM uploads ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        header {
            background-color: #281E5D; 
            padding: 10px 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        nav ul li {
            float: left;
        }

        nav ul li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .dropdown {
            display: inline-block;
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
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f7f7f7;
            color: #555;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .no-files {
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
<header>
<nav>
            <ul class="navbar">
                <li><a href="mainpage.php">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Categories</a>
                    <div class="dropdown-content">
                        <a href="sports.php">Sports</a>
                        <a href="education.php">Education</a>
                        <a href="technology.php">Technology</a>
                        <a href="health.php">Health</a>

                    </div>
                </li>
               
                <li class="dropdown">
                    <a href="#" class="dropbtn">Login</a>
                    <div class="dropdown-content">
                        <a href="loginpageadmin.php">Admin</a>
                        <a href="login.php">Employee</a>
                

                    </div>
                </li>
                <li> <a href="uploader.php"> Upload Files </a> </li>


            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Uploaded Files</h1>
        <table>
            <tr>
                <th>Image</th>
                <th>PDF</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><a href="<?php echo $row['image_path']; ?>" target="_blank">View Image</a></td>
                        <td><a href="<?php echo $row['pdf_path']; ?>" target="_blank">View PDF</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="no-files">No files uploaded yet.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
