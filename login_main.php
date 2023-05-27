<!DOCTYPE html>
<html lang="en" class="login_manager-class">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style_login.css">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <title>Login to management - Techbar</title>
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
        <div class="shape"></div>
        <div class="shape"></div>
    </div> 
    <form  method="POST" action="login_backend.php">

        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" name="username" placeholder="admin or root" id="username" required="required">

        <label for="password">Password</label>
        <input type="text" name="password" placeholder="Password: 1234" id="password" required="required">

        <button type="submit">Log In</button>
        
    </form>
</body>
</html>
