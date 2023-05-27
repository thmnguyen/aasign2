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

    if (isset($_POST["username"]) && isset($_POST["password"])) {
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
        $query= "SELECT * FROM $sql_table WHERE username = '$username' AND password = '$password';";
        $result = mysqli_query($conn, $query);	
        
        // If there no matching users, redirect to login page
        if ($result->num_rows == 0) {
            header("Location: ./login_main.php?error_msg=AccessDenied");
        } else {
            // Otherwise, add the authenticated variable to the session and redirect manager page
            $_SESSION["authenticated"]=true;
            header("Location: ./manage.php");
        }
    }
            

?>
