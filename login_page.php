<?php
// Retrieve email and password from the form
$email = $_POST['eml'];
$password = $_POST['pass'];

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'online_bus') or die("Could not connect to Database");

// Prepare the SQL query with a parameterized statement
$query = "SELECT * FROM user__details WHERE email=?";

// Prepare the statement
$stmt = mysqli_prepare($db, $query);

// Bind parameters
mysqli_stmt_bind_param($stmt, "s", $email);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

// Check if there is a row with the given email
if(mysqli_num_rows($result) == 1) {
    // Fetch the row
    $row = mysqli_fetch_assoc($result);
    
    // Verify the password
    if(password_verify($password, $row['password'])) {
        // Password is correct, redirect to landing page
        header('location: landing_page.php');
        exit(); // It's good practice to stop script execution after redirection
    } else {
        // Password is incorrect
        echo "<font size='5' color='red'>Invalid password</font>";
    }
} else {
    // Email not found
    echo "<font size='5' color='red'>User not found</font>";
}

// Close statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($db);
?>