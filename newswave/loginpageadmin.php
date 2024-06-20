<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NewsWave</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Your existing styles */
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

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            margin-top: 60px; /* Add margin to create space between navbar and login section */
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #281E5D;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        p a {
            color: #007bff;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        .login-logo {
            width: 150px; /* Adjust this to your desired width */
            height: 150px; /* Adjust this to your desired height */
            margin-bottom: 20px; /* Add some space below the logo */
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
        </nav>
    </header>
    <div class="main-content">
        <div class="login-container" id="login-container2">
            <h1>Admin Login To NewsWave</h1>
            <div class="login-box">
                <img src="images/NewsWaveLogo.png" alt="logo" class="login-logo">
                <form action="adminlogin.php" method="post">
                <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
                <p>Don't have an account? <a href="employeesignup.php">Register here</a></p>
            </div>
        </div>
    </div>
</body>
</html>

