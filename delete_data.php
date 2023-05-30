<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="Admin Panel">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style_manage.css"> 
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin Dashboard Panel</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
               <a href="index.php"><img src="images/logo.png" alt="" id="logo"></a>
            </div>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="manage.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>

                <li><a href="analytics.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div> 
        </div>
            <div>
                <!-- Php Table -->
                <?php
                    function sanitise_input($data){
                        $data = trim($data);				//remove spaces
                        $data = stripslashes($data);		//remove backslashes in front of quotes
                        $data = htmlspecialchars($data);	//convert HTML special characters to HTML code
                        return $data;
                    }


                    if (isset($_POST["job_ref_num"])){		//if successfully receive form data
                        //get information from form
                        $job_ref_num = sanitise_input($_POST["job_ref_num"]);

                        //condition to extract the data from the table
                        $condition = "";
                        if ($job_ref_num != "")		
                            $condition .= "job_ref_num='$job_ref_num'";

                        require_once("settings.php");	//database information
                        $conn = @mysqli_connect($host,$user,$pwd,$sql_db);	//connect to database
                        $sql_table = "eoi";	//table's name
                        $query = "delete from $sql_table where $condition;";		//MySQL command
                        $result = mysqli_query($conn, $query); // execute the query
                        
                        if ($result) {
                            echo "<br><br><br><p>Job Ref Number: ", $job_ref_num, " has been deleted </p>";
                        } else {
                            echo "<p>Failed to execute the query</p>";
                        }                   
                        mysqli_close($conn); // Close connection
                    }
                    else{
                        header("location: analytics.php");		//redirect to form
                    }                   
                ?>
            </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
