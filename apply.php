<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="styles/style.css">
  <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
  <title>techbar-apply</title>
</head>
<body>
    <?php
        $page = "indexPage";
        include_once("includes/header.inc");
    ?>
  
  <!-- Banner Section -->
  <section class="banner-2">
      <div class="container">
        <div class="banner-content">
          <h1>techbar</h1>
          <h2></h2>
          <p>Cutting-edge software engineer service for the digital era ahead</p>
         </div>
      </div>
    </section>
  <!-- Section Job Application -->
  <div class="apply">
    <div class="container-apply">
        <form method="post" action="processEOI.php" novalidate>
        <h1>Job Application</h1>
			<div class="job-ref-num">
				<label for="job_ref_num">Job Reference Number</label>
				<input type="text" name="job_ref_num" id="job_ref_num" pattern="^.{4}[a-zA-Z0-9]$" required="required">
			</div>
      <div class="name">
          <div>
              <label for="f_name">First Name</label>
              <input type="text" name="f_name" id="f_name" pattern="^[a-zA-Z]+$" maxlength="20" required="required">
          </div>
          <div>
              <label for="l_name">Last Name</label>
              <input type="text" name="l_name" id="l_name" pattern="^[a-zA-Z]+$" maxlength="20" required="required">
          </div>
      </div>
			<div class="details">
				
					<label for="dob">Date of Birth</label>
					<input type="text" name="dob" id="dob" placeholder="dd/mm/yyyy" pattern="\d{1,2}\/\d{1,2}\/\d{4}" required="required">
				</div>
			
      <div>  
      <fieldset class="check">
						<legend>Gender</legend>
						
						<p><input type="radio" id="male" name="gender" value="male" checked="checked"/><label for="male">Male</label>
					   	<input type="radio" id="female" name="gender" value="female"/><label for="female">Female</label>
							<input type="radio" id="other" name="gender" value="other"/><label for="other">Other</label>
            </p>

        </fieldset>
			</div>
            <div class="street">
                <label for="address">Street</label>
                <input type="text" name="address" id="address" maxlength="40" required="required">
            </div>
            <div class="address-info">
              <div>
                <label for="city">City</label>
                <input type="text" name="city" id="city" maxlength="40" required="required">
              </div>
              <div>
              <label for="state">State</label>
              <select name="state" id="state" required="required">
					    <option value="">Please Select</option>
						  <option value="ACT">Australian Capital Territory</option>
						  <option value="NSW">New South Wales</option>
						  <option value="NT">Northern Territory</option>
						  <option value="QLD">Queensland</option>
						  <option value="SA">South Australia</option>
						  <option value="TAS">Tasmania</option>
						  <option value="VIC">Victoria</option>
						  <option value="WA">Western Australia</option>
					    </select>
              </div>
              <div>
                <label for="code">Postcode</label>
                <input type="text" name="code" id="code" maxlength="4" pattern="^.{3}[0-9]$" required="required">
              </div>
            </div>

            <div class="email-info">
                <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required="required">
                </div>
                <div>
                    <label for="ph_num">Phone Number</label>
                    <input type="text" name="ph_num" id="ph_num" pattern="^.{7,11}[0-9]$" required="required">
                </div>
              </div>
			  
        <fieldset class="check">
        <legend>Skill lists</legend>
				<label>Java</label>
				<input type="checkbox" name="skills[]" value="java" checked="checked"/>
				
				<label>Python</label>
				<input type="checkbox" name="skills[]" value="python"/>
				
				<label>JavaScript</label>
				<input type="checkbox" name="skills[]" value="javaScript"/>
        
      </fieldset>
            <div>
                <label for="comments">Other Skills</label>
                <textarea id="comments" name="comments" rows="4" cols="50"></textarea>
              </div> 
            
            <div class="btns-apply">
                <button>Submit</button>
                
            </div>
        </form>
    </div>
</div>

  <!--Footer Section-->
  <?php
    include_once("includes/footer.inc")
  ?>
</body>
</html>
