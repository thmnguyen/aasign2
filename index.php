<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="styles/style.css">
  <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
  <title>techbar-home</title>
</head>
<body>
    <?php
        $page = "indexPage";
        include_once("includes/header.inc");
    ?>
  <!-- Banner Section -->
  <section class="banner">
      <div class="container">
        <div class="banner-content">
          <h1>techbar</h1>
          <h2></h2>
          <p>Cutting-edge software engineer service for the digital era ahead</p>
          <a href="https://www.youtube.com/watch?v=AL_ykbch3S0" class="btn-one">Short Video</a>
        </div>
      </div>
    </section>
  <!-- Section 1 - Who we are-->
    <section class="section-1">
      <div class="container-1">
        <div class="left">
          <div class="content"> 
            <h1>Who we are</h1>
            <p>We're techbar - we believe in the transformative power of technology. Our team consists of experienced professionals with diverse expertise in various IT areas, such as software development, web development, mobile app development, IT consulting, cybersecurity, cloud computing, and data analytics.<br>
               Our focus is on delivering innovative and effective solutions that meet our clients' needs. We're proud to be a customer-centric company that prioritizes our clients' needs, working closely with them to understand their business goals and tailor our services accordingly</p>
          </div>
        </div>
        <div class="right"></div>
      </div>
    </section>
 <!--What We Offer Section-->
 <div class="main">
  <h1>What we offer</h1>
  <ul class="cards">
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="images/card_1.png" alt="card_1"></div>
        <div class="card_content">
          <h2 class="card_title">Mobile App Development</h2>
          <p class="card_text">We offer mobile app development services. Our team can design and develop apps for both Android and iOS platforms, and provide services like app maintenance, testing, and support.</p>
          <button class="btn card_btn" onclick="document.location='about.html'">Read More</button>
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="images/card_2.png" alt="card_2"></div>
        <div class="card_content">
          <h2 class="card_title">IT Consulting</h2>
          <p class="card_text">We offer IT consulting services to help businesses make informed technology decisions. Our team can provide advice on hardware and software purchases, IT strategy, and more.</p>
          <button class="btn card_btn" onclick="document.location='about.html'">Read More</button>
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="images/card_3.png" alt="card_3"></div>
        <div class="card_content">
          <h2 class="card_title">Software Development</h2>
          <p class="card_text">We offer software development services for industries like healthcare, finance, education, and more. Our team can provide services like software design, development, testing, maintenance, and support.</p>
          <button class="btn card_btn" onclick="document.location='about.html'">Read More</button>
        </div>
      </div>
    </li>
     </ul>
</div>

 <!--Footer Section-->
  <?php
    include_once("includes/footer.inc")
  ?>
</body>
</html>
