<?php
$conn = new mysqli('localhost', 'root', '', 'newswave');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

   

    

    // SQL query to check if the username and password match in the users table
    $sql = "SELECT * FROM adminsection WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // User found, verify the password
    $row = $result->fetch_assoc();
    // Compare the entered password 
    if ($password==$row['password']) {
        // Password is correct, log in the user 
        echo "Login successful! Redirect to homepage...";
        // Redirect to your homepage
        header("Location: registeredusers.php");
        exit();
    } else {
        // Password is incorrect
        echo "<script>alert('Incorrect Password'); window.location.href='loginpageadmin.php';</script>";
        
    }
}   else {
      // Username not found
      echo "<script>alert('Username not found'); window.location.href='loginpageadmin.php'</script>";
}

    // Close the connection
    $conn->close();
}
?>