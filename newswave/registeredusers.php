<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users Table</title>
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

        .table-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 80%; /* Adjust the width as needed */
            margin: auto; /* Center the table horizontally */
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .edit-form {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            width: 80%;
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

    <div class="table-container">
        <?php
            $conn = new mysqli('localhost', 'root', '', 'newswave');

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST["delete_user"])) {
                    $employeeID = $_POST["delete_user"];
                    $delete_sql = "DELETE FROM employees WHERE employeeID = $employeeID";
                    if ($conn->query($delete_sql) === TRUE) {
                        echo "Record deleted successfully";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }

                if(isset($_POST["update_user"])) {
                    $employeeID = $_POST["employeeID"];
                    $fullname = $_POST["fullname"];
                    $gender = $_POST["gender"];
                    $email = $_POST["email"];
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $nic = $_POST["nic"];
                    $address = $_POST["address"];
                    $role = $_POST["role"];

                    $update_sql = "UPDATE employees SET fullname='$fullname', gender='$gender', email='$email', username='$username', password='$password', nic='$nic', address='$address', role='$role' WHERE employeeID=$employeeID";
                    if ($conn->query($update_sql) === TRUE) {
                        echo "Record updated successfully";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_user"])) {
                $employeeID = $_POST["edit_user"];
                $edit_sql = "SELECT * FROM employees WHERE employeeID = $employeeID";
                $result = $conn->query($edit_sql);

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $field1name = $row["fullname"];
                    $field2name = $row["gender"];
                    $field3name = $row["email"];
                    $field4name = $row["username"];
                    $field5name = $row["password"];
                    $field6name = $row["nic"];
                    $field7name = $row["address"];
                    $field8name = $row["role"];
                    $employeeID = $row["employeeID"];
        ?>
                    <div class="edit-form">
                        <form method="post">
                            <input type="hidden" name="employeeID" value="<?php echo $employeeID; ?>">
                            <label for="fullname">Full Name:</label><br>
                            <input type="text" id="fullname" name="fullname" value="<?php echo $field1name; ?>"><br>
                            <label for="gender">Gender:</label><br>
                            <input type="text" id="gender" name="gender" value="<?php echo $field2name; ?>"><br>
                            <label for="email">Email:</label><br>
                            <input type="text" id="email" name="email" value="<?php echo $field3name; ?>"><br>
                            <label for="username">Username:</label><br>
                            <input type="text" id="username" name="username" value="<?php echo $field4name; ?>"><br>
                            <label for="password">Password:</label><br>
                            <input type="text" id="password" name="password" value="<?php echo $field5name; ?>"><br>
                            <label for="nic">NIC:</label><br>
                            <input type="text" id="nic" name="nic" value="<?php echo $field6name; ?>"><br>
                            <label for="address">Address:</label><br>
                            <input type="text" id="address" name="address" value="<?php echo $field7name; ?>"><br>
                            <label for="role">Role:</label><br>
                            <input type="text" id="role" name="role" value="<?php echo $field8name; ?>"><br><br>
                            <input type="submit" name="update_user" value="Update">
                        </form>
                    </div>
        <?php
                } else {
                    echo "Error: User not found.";
                }
            }

            $sql = "SELECT * FROM employees";
            echo '<table> 
                    <tr>
                        <th>EmployeeID</th> 
                        <th>FullName</th> 
                        <th>Gender</th> 
                        <th>Email</th> 
                        <th>Username</th>
                        <th>Password</th>
                        <th>NIC</th> 
                        <th>Address</th>
                        <th>Role</th>
                        <th>Edit</th> 
                        <th>Delete</th> 
                    </tr>';

            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $field1name = $row["employeeID"];
                    $field2name = $row["fullname"];
                    $field3name = $row["gender"];
                    $field4name = $row["email"];
                    $field5name = $row["username"];
                    $field6name = $row["password"];
                    $field7name = $row["nic"];
                    $field8name = $row["address"];
                    $field9name = $row["role"];
                    $employeeID = $row["employeeID"];

                    echo '<tr> 
                            <td>'.$field1name.'</td>
                            <td>'.$field2name.'</td> 
                            <td>'.$field3name.'</td> 
                            <td>'.$field4name.'</td> 
                            <td>'.$field5name.'</td>
                            <td>'.$field6name.'</td>
                            <td>'.$field7name.'</td>
                            <td>'.$field8name.'</td>
                            <td>'.$field9name.'</td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="edit_user" value="' . $employeeID . '">
                                    <input type="submit" value="Edit">
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="delete_user" value="' . $employeeID . '">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>';
                }
                $result->free();
            }
            echo '</table>';
            $conn->close();
        ?>        
    </div>  
</body>
</html>
