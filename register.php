<?php 
error_reporting(error_reporting() & ~E_NOTICE & ~E_WARNING);
    //Connect to Database
    require_once("settings.php");	
    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);	
    // Check the connection
    if (!$conn) {
        die("Database connection failure: " . mysqli_connect_error());
    }
    $sql_table = "users";	//table's name

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["reg-username"]) && isset($_POST["reg-password"]) && isset($_POST["AuthenticationCode"])) {
            $reg_username = $_POST["reg-username"];
            $reg_password = $_POST["reg-password"];
            $reg_auth = $_POST["AuthenticationCode"];

            if(empty($reg_username)) {
                header("location: register.php?error_msg=Username is required");
                exit();
            } elseif(empty($reg_password)) {
                header("location: register.php?error_msg=Password is required");
                exit();
            } elseif(empty($reg_auth)) {
                header("location: register.php?error_msg=Authentication code is required");
                exit();
            }
            if($reg_auth !== "ilovetechbar") {
                header("location: register.php?error_msg=Wrong authentication code, please try again");
                exit();
                } else {                 
                    $query = "insert into $sql_table (username, password) VALUES ('$reg_username', '$reg_password');";
                    $result = mysqli_query($conn, $query);	
                    header("location: login_main.php?reg_success=Successfully registered");
                    exit();
                    mysqli_close($conn);		//close the database connection
                }
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
    <title>Dashboard Register - Techbar</title>
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
        <form method="POST" action="register.php" >

            <h3>Register Here</h3>

            <label for="username">Username</label>
            <input type="text" name="reg-username" placeholder="" id="username" >

            <label for="password">Password</label>
            <input type="text" name="reg-password" placeholder="" id="password">

            <label for="AuthenticationCode">Authentication Code</label>
            <input type="text" name="AuthenticationCode" placeholder="Code: ilovetechbar">

            <button type="submit" name="register">Register</button>
            <?php 
                if($_GET["error_msg"]) {
                    echo("Error: ".$_GET["error_msg"]);
                }
            ?>
        </form>
</body>
</html>
