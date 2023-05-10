<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="styles/style.css"> 
  <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
  <title>techbar-about</title>
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
    <!-- About our group Section -->
    <section>
      <div class="container-about">
        <div class="left-about">
          <div class="profile-content"> 
            <h1>About our group</h1>
            <dl class="profile">
              <dt>Group Name:</dt>
              <dd> Techbar</dd>
              <dt>Group ID:</dt>
              <dd>104307938</dd>
              <dt>Tutor's Name:</dt>
              <dd> Md Kafil Uddin</dd>
              <dt>Course:</dt>
              <dd> Computing Technology Inquiry Project</dd>
              <dt>Email:</dt>
              <dd> <a href="mailto:104462769@student.swin.edu.au"> 104462769@student.swin.edu.au</a></dd>
          </dl>
          </div>
        </div>
        <div class="right-about"></div>
      </div>
    </section>
    <!-- Member Profile Section -->
    <h1>Group Member Profile</h1>
    <div class="container-about-2" id="enhancement_1">
      <div class="cta">
         <img src="images/tom.jpg" alt="">
         <div class="text">
            <h2>Thong Nguyen</h2>
            <p>Student ID: 104462769</p>
            <p>Hobbies: Bushwalking, Photography, Golf</p>
            <p>Programming Skill: VBA, Python</p>
         </div>
      </div>
      
      <div class="cta">
        <img src="images/riya.jpg" alt="">
        <div class="text">
           <h2>Riya</h2>
           <p>Student ID: 104364852</p>
           <p>Hobbies: Reading, Travelling, Photography</p>
           <p>Programming Skill: Java Basic .</p>
        </div>
     </div>
    
     <div class="cta">
      <img src="images/hamid.jpg" alt="">
      <div class="text">
         <h2>Hamid Ali</h2>
         <p>Student ID: 103826490</p>
         <p>Hobbies: Painting, Photography, Gardening</p>
         <p>Programming Skill: Python Basic</p>
      </div>
   </div>

   <div class="cta">
    <img src="images/anlee.jpg" alt="">
    <div class="text">
       <h2>Thu Nguyen</h2>
       <p>Student ID: 104307938</p>
       <p>Hobbies: Studying Languages, Travelling, Boxing</p>
       <p>Programming Skill: Python Basic</p>
    </div>
 </div>

 <div class="cta">
  <img src="images/kay.jpg" alt="">
  <div class="text">
     <h2>Kay</h2>
     <p>Student ID: 104561187</p>
     <p>Hobbies: Bushwalking, Photography, Golf</p>
     <p>Programming Skill: VBA, Python</p>
  </div>
</div>
   </div>

         <!-- Class timetable -->
        <div class="timetable">
          <h1>Timetable</h1>
          <table>
            <tr>
              <th>Time</th>
              <th>Monday</th>
              <th>Tuesday</th>
              <th>Wednesday</th>
              <th>Thursday</th>
              <th>Friday</th>
            </tr>
                  
            <tr>
              <th>09:30</th>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th>10:30</th>
              <td class="table-color" rowspan="3">COS10009<br />Lecture 1: ATC101 </td>
              <td></td>
              <td></td>
              <td class="table-color" rowspan="3">TNE10006<br />Lecture 1: ATC101</td>
              <td></td>
            </tr>
                    
            <tr>
                        <th>11:30</th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>12:30</th>
                        <td class="table-color" rowspan="2">COS10026<br />Lecture 1: Online</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>13:30</th>
                        <td rowspan="2">COS10004<br />Class 1: EN402</td>
                        <td></td>
                        <td></td>
                        <td rowspan="2">COS10026<br />Class 1: ATC421</td>
                    </tr>
                    <tr>
                        <th>14:30</th>
                        <td rowspan="4">TNE10006<br />Class 1: ATC328</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>15:30</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>16:30</th>
                        <td rowspan="2">COS10026<br />Workshop 1: BA603</td>
                        <td></td>
                        <td></td>
                        <td class="table-color" rowspan="2">COS10004<br />Lecture 1: Online</td>
                    </tr>
                    <tr>
                        <th>17:30</th>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>18:30</th>
                        <td></td>
                        <td></td>
                        <td rowspan="2">COS10009<br />Class 1: ATC627</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                      <th>19:30</th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                </table>
              </div>
 <!--Footer Section-->
 <?php
    include_once("includes/footer.inc")
  ?>
</body>
</html>
