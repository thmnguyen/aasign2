<?php
// Only allows access to page if the user has been through the authentication
// page and has the authenticated boolean set in the session.
session_start();
if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: ./login_main.php?error_msg=Unauthenticated");
}
?>

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
                <li><a href="#">
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
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
                    <div class="boxes">
                        <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Total Applicants</span>
                        <span class="number">
                       
                        <?php //PHP code to retrive the number of row in the database to find the number of applicants
                            require_once("settings.php");
                            $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                            //Check connection
                            if (!$conn){
                                echo "<p>Database connection failure.</p>";		//connection failed
                            } else {
                                $sql_table = "eoi";
                            // Retrieve the number of entries
                            $query = "select COUNT(*) AS total from $sql_table";
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $totalEntries = $row['total'];
                                echo $totalEntries;
                            } else {
                                echo 'Failed to retrieve the number of entries.';
                            }
                        }
                            // Close the database connection
                            mysqli_close($conn);
                        ?>                            
                        </span>
                    </div>
            </div>


            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>

                <div class="activity-data">

                <!-- Php Table -->
                <?php
                    // MySQL database credentials
                    require_once("settings.php");

                    // Create a database connection
                    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                   
                    //Check connection
                    if (!$conn){
                        echo "<p>Database connection failure.</p>";		//connection failed
                    } else {
                        $sql_table = "eoi";
                        // Set up SQL command to query or add data into the table
                        $query = "select EOInumber, job_ref_num, f_name, l_name, dob, gender, address, city, state, code, email, ph_num, skills, comments, status from $sql_table order by EOInumber, job_ref_num;";		
                        $result = mysqli_query($conn, $query);				//execute the query and store the result into result pointer
                        
                        if (!$result){			//if execution was not successful
                            echo "<p>Something is wrong with ", $query, "</p>";
                        }
                        else{			//display table
                            echo "<table border='`1`'>";
                            //echo "<table id = "searchtable">";
                            echo "<tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>Job Ref Number</th>
                                        <th scope='col'>First Name</th>
                                        <th scope='col'>Last Name</th>
                                        <th scope='col'>Date of Birth</th>
                                        <th scope='col'>Gender</th>
                                        <th scope='col'>Street</th>
                                        <th scope='col'>City</th>
                                        <th scope='col'>State</th>
                                        <th scope='col'>Postcode</th>
                                        <th scope='col'>Email</th>
                                        <th scope='col'>Phone Number</th>
                                        <th scope='col'>Skill Lists</th>
                                        <th scope='col'>Other Skills</th>
                                        <th scope='col'>Status</th>
                                  </tr>";
                            //Retrieve current record pointed by the result pointer	  
                            while ($record = mysqli_fetch_assoc($result)){
                                echo "<tr>\n";
                                echo "<td>", $record["EOInumber"], "</td>\n";
                                echo "<td>", $record["job_ref_num"], "</td>\n";
                                echo "<td>", $record["f_name"], "</td>\n";
                                echo "<td>", $record["l_name"], "</td>\n";
                                echo "<td>", $record["dob"], "</td>\n";
                                echo "<td>", $record["gender"], "</td>\n";
                                echo "<td>", $record["address"], "</td>\n";
                                echo "<td>", $record["city"], "</td>\n";
                                echo "<td>", $record["state"], "</td>\n";
                                echo "<td>", $record["code"], "</td>\n";
                                echo "<td>", $record["email"], "</td>\n";
                                echo "<td>", $record["ph_num"], "</td>\n";
                                echo "<td>", $record["skills"], "</td>\n";
                                echo "<td>", $record["comments"], "</td>\n";
                                echo "<td>", $record["status"], "</td>\n";
                                echo "</tr>\n";
                            }
                            echo "</table>\n";
                            mysqli_free_result($result);		//Free up the memory, after using the result pointer
                        }
                        mysqli_close($conn);
                    }
                ?>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
