<?php
// Check if all required fields are set
if(isset($_POST['usrnam_name'], $_POST['mail_name'], $_POST['contct_name'], $_POST['pass_name'], $_POST['cpass_name'])) {
    $name = $_POST['usrnam_name'];
    $email = $_POST['mail_name'];
    $number = $_POST['contct_name'];
    $pswrd = $_POST['pass_name'];
    $cpswrd = $_POST['cpass_name'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Validate password length and match with confirm password
    if(strlen($pswrd) < 6 || $pswrd != $cpswrd) {
        die("Password should be at least 6 characters long and match confirm password");
    }

    // Hash the password
    $hashedPassword = password_hash($pswrd, PASSWORD_DEFAULT);

    // Connect to the database
    $db=mysqli_connect('localhost','root','','online_bus') or die("Could not connect to Database");

    // Prepare the query
    $query = "INSERT INTO user__details (name, email, password, cont_num) VALUES (?, ?, ?, ?)";
    $statement = mysqli_prepare($db, $query);

    // Bind parameters and execute the query
    mysqli_stmt_bind_param($statement, 'ssss', $name, $email, $hashedPassword, $number);
    $result = mysqli_stmt_execute($statement);

    // Check if the query executed successfully
    if($result) {
        // Redirect to login page
        header('location: login_page.html');
    } else {
        die("Could not execute query: " . mysqli_error($db));
    }

    // Close statement and database connection
    mysqli_stmt_close($statement);
    mysqli_close($db);
} else {
    // Redirect back to the registration page if required fields are not set
    header('location: sign-up.html');
}
?>
