<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'newswave');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $employeeID = $_POST['employeeID'];  
    $role = $_POST['role'];
    $address = $_POST['address'];
    $nic = $_POST['nic'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO employees (fullname, gender, email, employeeID, role, nic, address, username, password) 
        VALUES ('$fullname', '$gender', '$email', '$employeeID', '$role', '$nic', '$address', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWSWAVE - Employee Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

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

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .registration-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            width: 100%;
        }

        .registration-box h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            color: #333333;
        }

        table {
            width: 100%;
        }

        td, th {
            padding: 10px 0;
            border-bottom: 1px solid #eeeeee;
        }

        td:first-child, th:first-child {
            width: 30%;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: calc(100% - 12px);
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="reset"], button[type="submit"] {
            padding: 10px 20px;
            background-color: #281E5D;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="reset"]:hover, button[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            color: #007bff;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
  
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
            <div class="navbar-logo">
                <a href="mainpage.php"><img src="images/Capture.png" alt="NewsWave Logo"></a>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="registration-container">
            <div class="registration-box">
                <h2> Registration</h2>
                <form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                    <table>
                        <tr>
                            <td><label for="employeeID">Employee ID:</label></td>
                            <td><input type="text" id="employeeID" name="employeeID" placeholder="Employee ID" required></td>
                        </tr>
                        <tr>
                            <td><label for="fullname">Full Name:</label></td>
                            <td><input type="text" id="fullname" name="fullname" placeholder="Full Name" required></td>
                        </tr>
                        <tr>
                            <td><label for="gender">Gender:</label></td>
                            <td>
                                <select id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email">Email:</label></td>
                            <td><input type="email" id="email" name="email" placeholder="Email" required></td>
                        </tr>
                        <tr>
                            <td><label for="username">Username:</label></td>
                            <td><input type="text" id="username" name="username" placeholder="Username" required></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td><input type="password" id="password" name="password" placeholder="Password" required></td>
                        </tr>
                        <tr>
                            <td><label for="role">Role:</label></td>
                            <td><input type="text" id="role" name="role" placeholder="Role" required></td>
                        </tr>
                        <tr>
                            <td><label for="nic">NIC:</label></td>
                            <td><input type="text" id="nic" name="nic" placeholder="NIC" required></td>
                        </tr>
                        <tr>
                            <td><label for="address">Address:</label></td>
                            <td><input type="text" id="address" name="address" placeholder="Address" required></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="reset" value="Reset">Cancel</button>
                                <button type="submit" value="Submit">Sign Up</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
