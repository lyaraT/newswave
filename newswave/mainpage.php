<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWSWAVE - Your Source for News</title>
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
        @media screen and (max-width: 768px) {
    .navbar-logo {
        margin-right: 10px; /* Adjust margin for logo on smaller screens */
    }

    ul li {
        margin-right: 0; /* Remove margin between menu items */
        margin-bottom: 10px; /* Add space below each menu item */
    }

    .dropdown-content {
        position: static; /* Adjust dropdown to display normally on small screens */
        display: none;
        background-color: transparent;
        box-shadow: none;
    }

    .dropdown:hover .dropdown-content {
        display: none;
    }

    .dropdown:hover {
        background-color: transparent; /* Ensure dropdown trigger is clickable */
    }
}@media screen and (max-width: 768px) {
    .navbar-logo img {
        max-height: 30px; /* Adjust maximum height for smaller screens */
    }
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

        .main-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .main-content {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .left-section {
            flex: 1;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 400px; /* Adjust height as needed */
            padding: 20px;
        }

        .left-section video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .right-section {
            flex: 1;
            display: flex;
            gap: 10px;
        }

        .large-box {
            flex: 2; /* Adjust this value to change the width ratio */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .small-box-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .small-box {
            flex: 1;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .large-box img, .small-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .second-main-div {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .third-main-div, .fourth-main-div {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: space-between;
        }

        .mini-box {
            flex: 1;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .mini-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        footer {
            background-color: #154067;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
            width: 100%;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .footer-left, .footer-right {
            flex-basis: calc(20% - 20px);
            max-width: calc(50% - 20px);
            padding: 10px;
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
            .main-content {
                flex-direction: column;
            }

            .left-section, .right-section {
                width: 100%;
            }

            .right-section {
                flex-direction: column;
            }

            .third-main-div, .fourth-main-div {
                flex-direction: column;
            }

            .mini-box {
                flex: 1 1 100%;
                margin-bottom: 10px;
            }
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
            <div class="navbar-logo">
                <a href="mainpage.php"><img src="images/Capture.png" alt="NewsWave Logo"></a>
            </div>
        </nav>
    </header>


    <div class="main-container">
        <h3>Main Stories</h3>
        <div class="main-content">
            <div class="left-section">
                <video autoplay loop muted playsinline>
                    <source src="videos/4765224-sd_640_360_24fps.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="right-section">
                <div class="large-box">
                    <img src="images/pexels-mjlo-2872418.jpg" alt="Large Picture"> <!-- Replace with your image path -->
                </div>
                <div class="small-box-container">
                    <div class="small-box">
                        <img src="images/23433ce0-2bec-11ef-90be-b75b34b0bbb2.jpg.webp" alt="Small Picture 1"> <!-- Replace with your image path -->
                    </div>
                    <div class="small-box">
                        <img src="images/Cricket.jpg" alt="Small Picture 2"> <!-- Replace with your image path -->
                    </div>
                </div>
            </div>
        </div>

        <div class="second-main-div">
            <h2>Sri Lanka Cricket Faces Transition Challenges Amidst Leadership Overhaul</h2>
            <p>In a pivotal moment for Sri Lanka's cricketing landscape, the national team grapples with significant changes in leadership. Following recent coaching and administrative shifts, the team navigates a critical phase marked by both promise and uncertainty. As stalwart players contemplate retirement, emerging talents eagerly eye opportunities to redefine Sri Lanka's competitive edge. Amidst this transition, the cricketing community awaits with bated breath, pondering the trajectory that will shape the island nation's sporting future.</p>
        </div>

        <h3>Trending Stories</h3>
        <div class="third-main-div">
            <div class="mini-box">
                <img src="images/srilanka-scaled.jpg" alt="Mini Box 1"> <!-- Replace with your image path -->
            </div>
            <div class="mini-box">
                <img src="images/1713145285029_nn_netcast_2_240414_1920x1080-8wt114.jpg" alt="Mini Box 2"> <!-- Replace with your image path -->
            </div>
            <div class="mini-box">
                <img src="images/example3.webp" alt="Mini Box 3"> <!-- Replace with your image path -->
            </div>
            <div class="mini-box">
                <img src="images/example4.avif" alt="Mini Box 4"> <!-- Replace with your image path -->
            </div>
        </div>

        <div class="fourth-main-div">
            <div class="mini-box">
                <img src="images/skynews-sri-lanka-protest-sri-lanka_
5766049.jpg" alt="Mini Box 1"> <!-- Replace with your image path -->
            </div>
            <div class="mini-box">
                <img src="images/example-1.jpeg" alt="Mini Box 2"> <!-- Replace with your image path -->
            </div>
            <div class="mini-box">
                <img src="images/tv-news-live-report-anchorman-260nw-2169480555.webp" alt="
Mini Box 3"> <!-- Replace with your image path -->
            </div>
            <div class="mini-box">
                <img src="images/Ukraine-Peace-Summit_20240616_214920_0000.jpg" alt="Mini Box 4"> <!-- Replace with your image path -->
            </div>
        </div>
        
        <footer>
    <div class="footer-container">
        <div class="footer-left">
            <h1>NEWAVE</h1>
            <p>Found in 1989</p>
            <p>Colombo 07</p>
        </div>
        <div class="footer-right">
            <p>Address: 123 Main Street, Colombo 07</p>
            <p>Telephone: +94 11 1234567</p>
        </div>
    </div>
</footer>

    </html>
   
