<?php
session_start();

// Sanitizing data input function
function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Checks that the username and password entered match a user in the users table
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = sanitise_input($_POST["username"]);
    $password = sanitise_input($_POST["password"]);

    require_once("settings.php");

    // Database connection
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    // Check connection
    if (!$conn) {
        die("Database connection failure: " . mysqli_connect_error());
    }

    $sql_table = "users";
    $query = "SELECT * FROM $sql_table WHERE username = '$username' AND password = '$password';";
    $result = mysqli_query($conn, $query);

    // If there are no matching users, redirect to the login page
    if ($result->num_rows == 0) {
        header("Location: ./login_main.php?error_msg=WrongUsername/PasswordAccessDenied");
        exit();
    } else {
        // Otherwise, set the authenticated session variable and redirect to the manage page
        $_SESSION["authenticated"] = true;
        header("Location: ./manage.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="login_manager-class">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style_login.css">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <title>Dashboard Login - Techbar</title>
</head>
<body>

<body class="index-body">
    <?php
    include_once("includes/header.inc"); 
    ?>

    <main id="login_manager-body">
        <div class="formwarp">
    <div class="login-register">
        <div id="loginContainer">
        <div class="background">
        </div> 
        <form  method="POST" action="">

            <h3>Login Here</h3>

            <label for="username">Username</label>
            <input type="text" name="username" placeholder="admin or root" id="username" required="required">

            <label for="password">Password</label>
            <input type="text" name="password" placeholder="Password: 1234" id="password" required="required">

            <button type="submit">Log In</button>
            
        </form>
</body>
</html>
