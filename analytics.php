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
               <img src="images/logo.png" alt="">
            </div>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="manage.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>

                <li><a href="analytics.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="#">
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

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Analytics</span>
                </div>
            </div>
            <h1>EOIs Search Form</h1>

            <form method="post" action="analytics.php">
            <fieldset id="f1"><legend>Search EOIs Details</legend>
                <br><br>
                <p class="row">	<label for="job_ref_num">Job Ref Number: </label>
                    <input type="text" name="job_ref_num" id="job_ref_num" /></p>
                <p class="row">	<label for="f_name">First Name: </label>
                    <input type="text" name="f_name" id="f_name" /></p>
                <p class="row">	<label for="l_name">Last Name: </label>
                    <input type="text" name="l_name" id="l_name" /></p>
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="NEW">NEW</option>
                    <option value="CURRENT">CURRENT</option>
                    <option value="FINAL">FINAL</option>
                </select>
                <br><br>
                <p>	<input type="submit" value="Search" /></p>
            </fieldset>
            </form>  

            <form method="post" action="delete_data.php">
            <fieldset id="f2"><legend>Delete EOI Form</legend>
                <br><br>
                <p class="row">	<label for="job_ref_num">Job Ref Number: </label>
                    <input type="text" name="job_ref_num" id="job_ref_num" /></p>
                    <br>
                <p>	<input type="submit" value="Delete" /></p>
            </fieldset>
            </form> 

            <form method="post" action="change_data.php">
            <fieldset id="f3"><legend>Change Status</legend>
                <br><br>
                <p class="row">	<label for="EOInumber">ID Number: </label>
                    <input type="text" name="EOInumber" id="EOInumber" /></p>
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="NEW">NEW</option>
                    <option value="CURRENT">CURRENT</option>
                    <option value="FINAL">FINAL</option>
                </select>
                <br><br>
                <p>	<input type="submit" value="Change" /></p>
            </fieldset>
            </form>

            <br><br>
            
            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>

                <div class="activity-data">

                <!-- Php Table -->
                <?php
                    if($_POST)
                    {
                        function sanitise_input($data){
                            $data = trim($data);				//remove spaces
                            $data = stripslashes($data);		//remove backslashes in front of quotes
                            $data = htmlspecialchars($data);	//convert HTML special characters to HTML code
                            return $data;
                        }
                
                
                        if (isset($_POST["job_ref_num"])){		//if successfully receive form data
                            //get information from form
                            $job_ref_num = sanitise_input($_POST["job_ref_num"]);
                            $f_name = sanitise_input($_POST["f_name"]);
                            $l_name = sanitise_input($_POST["l_name"]);
                            $status = sanitise_input($_POST["status"]);
                
                            //condition to extract the data from the table
                            $condition = "";
                            if ($job_ref_num != "")		
                                $condition .= "job_ref_num='$job_ref_num'";
                            if ($f_name != ""){
                                if ($condition != "")
                                    $condition .= "and f_name='$f_name'";
                                else
                                    $condition .= "f_name='$f_name'";
                            }
                            if ($l_name != ""){
                                if ($condition != "")
                                    $condition .= "and l_name='$l_name'";
                                else
                                    $condition .= "l_name='$l_name'";
                            }
                            if ($status != ""){
                                if ($condition != "")
                                    $condition .= "and status='$status'";
                                else
                                    $condition .= "status='$status'";
                            }                    

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
                        $query = "select * from $sql_table where $condition;";		
                        $result = mysqli_query($conn, $query);				//execute the query and store the result into result pointer
                        
                        if (!$result){			//if execution was not successful
                            echo "<p>Something is wrong with ", $query, "</p>";
                        }
                        else{			//display table
                            echo "<table border='`1`'>";
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
                } else {
                    header("location:analytics.php");
                }
                }
                ?>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
