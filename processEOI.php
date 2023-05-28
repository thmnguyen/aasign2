<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Adding EOI record to MySQL">
	<meta name="keywords" content="PHP, MySQL">
	<title>Adding EOI record to MySQL</title>
</head>
<body>
	<?php
        //Deny direct access
        // Ref: https://hidayatabisena.medium.com/how-to-prevent-direct-url-access-to-php-form-files-e5e983bc3cb1
        if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
            header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
            die( header( 'location: /index.php' ) );
        }
        //Connect to Database
        require_once("settings.php");	
        $conn = @mysqli_connect($host,$user,$pwd,$sql_db);	
        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql_table = "eoi";	//table's name

        // SQL query to check if the table exists
        $checkTableQuery = "SHOW TABLES LIKE '$sql_table'";
        $result = $conn->query($checkTableQuery);

        // If the table doesn't exist, create the table
        if ($result->num_rows == 0) {
            $createTableQuery = "CREATE TABLE $sql_table (
            EOInumber INT(11) AUTO_INCREMENT PRIMARY KEY,
            job_ref_num VARCHAR(5) NOT NULL,
            f_name VARCHAR(20) NOT NULL,
            l_name VARCHAR(20) NOT NULL,
            dob VARCHAR(20) NOT NULL,
            gender VARCHAR(20) NOT NULL,
            address VARCHAR(40) NOT NULL,
            city VARCHAR(40) NOT NULL,
            state VARCHAR(20) NOT NULL,
            code INT(4) NOT NULL,
            email VARCHAR(20) NOT NULL,
            ph_num INT(12) NOT NULL,
            skills VARCHAR(20) NOT NULL,
            comments VARCHAR(40) NOT NULL,
            status VARCHAR(20) NOT NULL
            )";
        
            if ($conn->query($createTableQuery) === TRUE) {
                echo "Table $sql_table created successfully.";
            } else {
                echo "Error creating table: " . $conn->error;
            }
        } else {
        echo "Table $sql_table already exists.";
        }

		// Sanitising data input fuction
        function sanitise_input($data){
			$data = trim($data);				//remove spaces
			$data = stripslashes($data);		//remove backslashes in front of quotes
			$data = htmlspecialchars($data);	//convert HTML special characters to HTML code
			return $data;
		}
		// Server side validate and initialize data input
		$errMsg = "";
        
        //Job reference number input 
        if (isset($_POST["job_ref_num"]) && $_POST['job_ref_num'] != "") {
            $job_ref_num = sanitise_input($_POST["job_ref_num"]);
        
            if (!preg_match("/^[a-zA-Z0-9]*$/", $job_ref_num)) {
                $errMsg .= "<p>Only alpha letters and numbers allowed in Job Reference Number.</p>";
            } else if (strlen($job_ref_num) > 5) {
                $errMsg .= "<p>Job Reference Number is limited up to 5 characters.</p>";
            }
        } else {
            $errMsg .= "<p>Please enter the Job Reference Number.</p>";
        }
        //First name input
        if (isset($_POST["f_name"]) && $_POST['f_name'] != "") {
            $f_name = sanitise_input($_POST["f_name"]);
        
            if (!preg_match("/^[a-zA-Z]*$/", $f_name)) {
                $errMsg .= "<p>Only letters allowed for first name</p>";
            } else if (strlen($f_name) > 20) {
                $errMsg .= "<p>First Name is limited up to 20 characters.</p>";
            }
        } else {
            $errMsg .= "<p>Please enter your first name.</p>";
        }

         //Last name input
         if (isset($_POST["l_name"]) && $_POST['l_name'] != "") {
            $l_name = sanitise_input($_POST["l_name"]);
        
            if (!preg_match("/^[a-zA-Z]*$/", $l_name)) {
                $errMsg .= "<p>Only letters allowed for last name.</p>";
            } else if (strlen($l_name) > 20) {
                $errMsg .= "<p>Last Name is limited up to 20 characters.</p>";
            }
        } else {
            $errMsg .= "<p>Please enter your last name.</p>";
        }       
        
        // DoB input and validate age between 15 and 80 years old
        if (isset($_POST["dob"]) && $_POST['dob'] != "") {
            $dob = sanitise_input($_POST["dob"]);

            $dobDate = date_create_from_format('d/m/Y', $dob);
            if ($dobDate === false) {
                $errMsg .= "<p>Enter Date of Birth in the form dd/mm/yyyy.</p>";
            } else {
                $dobFormatted = date_format($dobDate, 'm/d/Y'); // Convert DoB to m/d/Y format
                $_age = floor((time() - strtotime($dobFormatted)) / 31556926); // Calculate the age using the formatted DoB

                if ($_age < 15 || $_age > 80) {
                    $errMsg .= "<p>Age must be between 15 and 80 years old. Calculated age: " . $_age . " years old.</p>";
                }
            }
        } else {
            $errMsg .= "<p>Please enter your Date of Birth.</p>";
        }

        //Gender Radio input
        if (isset($_POST["gender"])) {
			$gender = sanitise_input($_POST["gender"]);		
        } else {
			$species = "Unknown gender";
        }

		//Address input
        if (isset($_POST["address"]) && $_POST['address'] != "") {
            $address = sanitise_input($_POST["address"]);
        
            if (strlen($address) > 40) {
                $errMsg .= "<p>Address is limited up to 40 characters.</p>";
            }
        } else {
            $errMsg .= "<p>Please enter your address.</p>";
        }       
        
        // Suburb input
        if (isset($_POST["city"]) && $_POST['city'] != "") {
            $city = sanitise_input($_POST["city"]);
        
            if (strlen($city) > 40) {
                $errMsg .= "<p>Suburb is limited up to 40 characters.</p>";
            }
        } else {
            $errMsg .= "<p>Please enter your suburb.</p>";
        }      

        //State input
        if (isset($_POST["state"]) && $_POST['state'] != "Please Select") {
            $state = sanitise_input($_POST["state"]);      

        } else {
            $errMsg .= "<p>Please select your State.</p>";
        }      

        // Post code input - Validates based on the selected state
        if (isset($_POST["code"]) && $_POST['code'] != "") {
            $code = sanitise_input($_POST["code"]);

            if (!preg_match("/^[0-9]*$/", $code)) {
                $errMsg .= "<p>Only numbers are allowed for Post Code.</p>";
            } else if (strlen($code) != 4) {
                $errMsg .= "<p>Post code has to be 4 digits.</p>";
            } else {
                $stateCode = substr($state, 0, 3); // Get the first three letters of the state
                $expectedCode = ""; // Initialize the expected code based on the state

                if ($stateCode === "NSW" || $stateCode === "ACT") {
                    $expectedCode = "2";
                } else if ($stateCode === "VIC") {
                    $expectedCode = "3";
                } else if ($stateCode === "QLD") {
                    $expectedCode = "4";
                } else if ($stateCode === "SA") {
                    $expectedCode = "5";
                } else if ($stateCode === "WA") {
                    $expectedCode = "6";
                } else if ($stateCode === "TAS") {
                    $expectedCode = "7";
                }

                if (substr($code, 0, 1) !== $expectedCode) {
                    $errMsg .= "<p>Postcode must start with $expectedCode for $state.</p>";
                }
            }
        } else {
            $errMsg .= "<p>Please enter your post code.</p>";
        }
        
        //Email Input
        if (isset($_POST["email"]) && $_POST['email'] != "") {
            $email = sanitise_input($_POST["email"]);      

        } else {
            $errMsg .= "<p>Please enter your email.</p>";
        }      

        //Phone number input
        if (isset($_POST["ph_num"]) && $_POST['ph_num'] != "") {
            $ph_num = sanitise_input($_POST["ph_num"]);
        
            if (strlen($ph_num) > 12) {
                $errMsg .= "<p>Phone number is up to 12 digits only.</p>";
            }
        } else {
            $errMsg .= "<p>Please enter your phone number.</p>";
        }              
        
        //Skills input       
        if (isset($_POST["skills"]))
            $checkBox = implode(',', $_POST['skills']);
                
         //Comments input
        if (isset($_POST["comments"]))
            $comments = sanitise_input($_POST["comments"]);
        
        else {
                header("location: apply.php");
        }    

        //Print validation message and action to stop the code to return input form if there is error
        if ($errMsg != "") {
			echo "<p>$errMsg</p>";
            echo '<a href="apply.php">Back to Apply</a>';
            exit;
		} else{
            //SQL query to insert data to the table
            $EOInumber = "";
            $query = "insert into $sql_table (job_ref_num, f_name, l_name, dob, gender, address, city, state, code, email, ph_num, skills, comments, status) values ('$job_ref_num', '$f_name', '$l_name', '$dob', '$gender', '$address', '$city', '$state', '$code', '$email', '$ph_num', '$checkBox', '$comments', 'NEW');";		//Execute the query
            $result = mysqli_query($conn, $query);	//execute the query
            if (!$result){		//if execution unsuccessful
                echo "<p class='wrong'>Something is wrong with ", $query, "</p>";
            }
            else{	
                echo "<p class='ok'>Your application has been successfully submitted.</p>";
            }
            mysqli_close($conn);		//close the database connection
        }
	?>
</body>
</html>
