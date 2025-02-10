<!--
 // TWITTER: https://twitter.com/
 // FACEBOOK: https://www.facebook.com/
 // GITHUB: https://github.com/
-->



<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs
================================================== -->
    <meta charset="utf-8" />
    <title>Skilled Consultant</title>

    <!-- Mobile Specific Metas
================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=5.0"
    />
    <meta name="author" content="" />
    <meta name="generator" content="" />

    <!-- Favicon
================================================== -->
    <link rel="icon" type="theme/image/png" href="theme/images/favicon.png" />

    <!-- CSS
================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css" />
    <!-- FontAwesome -->
    <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css" />
 
    <!-- Template styles-->
    <link rel="stylesheet" href="theme/css/style.css" />
  
  
  
    <style>
        .form {
            padding-left: 40px;
            margin-top:80px ;
        }
    </style>
  </head>
  <body>
<div class="body-inner">

<div id="top-bar" class="top-bar">
    <div class="container">
      <div class="row">
        <!-- <div class="col-lg-8 col-md-8">
          <ul class="top-info text-center text-md-left">
            <li>
              <i class="fas fa-map-marker-alt"></i>
              <p class="info-text">Skilled Consultant</p>
            </li>
          </ul>
        </div> -->
        <!--/ Top info end -->
<!-- 
        <div class="col-lg-4 col-md-4 top-social text-center text-md-right">
          <ul class="list-unstyled">
            <li>
              <a title="Facebook" href="https://facebook.com/">
                <span class="social-icon"><i class="fab fa-facebook-f"></i></span>
              </a>
            
              <a title="Instagram" href="https://instagram.com/">
                <span class="social-icon"><i class="fab fa-instagram"></i></span>
              </a>
              <a title="Linkedin" href="https://Linkedin.com/">
                <span class="social-icon"><i class="fab fa-linkedin"></i></span>
              </a>
            </li>
          </ul>
        </div> -->
        <!--/ Top social end -->
      </div>
      <!--/ Content row end -->
    </div>
    <!--/ Container end -->
  </div>
  <!--/ Topbar end -->
  <!-- Header start -->
  <header id="header" class="header-one">
    <div class="bg-white-header">
      <div class="container">
        <div class="logo-area">
          <div class="row align-items-center">
            <div class="logo col-lg-3 text-center text-lg-left mb-3 mb-md-5 mb-lg-0">
              <a class="d-block" href="index.html">
                <img loading="lazy" src=".png" alt="SkilledConsultant" />
              </a>
            </div>
            <!-- logo end -->



            <!-- header right end -->
          </div>
          <!-- logo area end -->
        </div>
        <!-- Row end -->
      </div>
      <!-- Container end --><!--<nav class="navbar navbar-expand-lg navbar-dark p-0"></nav>-->
    </div>
  </header>
</div>

        <div class="navbar">
          <a  class="btn-secondary" id="btn-secondary" href="index.php">Home</a>
          <a  class="btn-secondary"id="btn-secondary" href="about.php">How it works?</a>
          <a  class="btn-secondary"id="btn-secondary" href="career.php">Careers</a>
          <a  class="btn-secondary"id="btn-secondary" href="contact.php">Contact</a>
          <a  class="btn-secondary"id="btn-secondary" href="ceo.php">CEO</a>
        </div>

            <!--/ Row end -->

          
            </div>
          
          </div>
          <!--/ Container end -->
        </div>
        <!--/ Navigation end -->
      </header>
      <!--/ Header end -->
    
    
    <!-- Ensure the action points to submit_application.php -->
   
   
    <form class="form"action="submit_application.php" method="post" enctype="multipart/form-data">
    <h2>Job Application Form</h2>
    <br><br>
        <!-- Job ID (hidden field) -->
        <input type="hidden" name="job_id" value="<?php echo isset($_GET['job_id']) ? $_GET['job_id'] : ''; ?>"> <!-- This ensures job_id is passed correctly -->

        <!-- First Name -->
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <!-- Last Name -->
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <!-- Email -->
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <!-- Primary Skills -->
        <label for="primary_skills">Primary Skills:</label><br>
        <textarea id="primary_skills" name="primary_skills" rows="4" cols="50" required></textarea><br><br>

        <!-- Secondary Skills (Optional) -->
        <label for="secondary_skills">Secondary Skills (Optional):</label><br>
        <textarea id="secondary_skills" name="secondary_skills" rows="4" cols="50"></textarea><br><br>

        <!-- Work Experience -->
        <label for="work_experience">Work Experience:</label><br>
        <textarea id="work_experience" name="work_experience" rows="4" cols="50" required></textarea><br><br>

        <!-- City -->
        <label for="city">City:</label><br>
        <input type="text" id="city" name="city" required><br><br>

        <!-- Country -->
        <label for="country">Country:</label><br>
        <input type="text" id="country" name="country" required><br><br>

        <!-- CV Upload -->
        <label for="cv">Upload your CV (JPEG/PDF only):</label><br><br>
        <input type="file" id="cv" name="cv" accept="image/jpeg/pdf" required><br><br>

        <!-- Submit Button -->
        <input type="submit" value="Submit">
    </form>
       <!--/ Title row end -->
       <footer id="footer" class="footer bg-overlay">
        <div class="footer-main">
          <div class="container">
            <div class="row justify-content-between">
              <div class="col-lg-4 col-md-6 footer-widget footer-about">
                <h3 class="widget-title">About Us</h3>
                <img
                  loading="lazy"
                  width="200px"
                  class="footer-logo"
                  src="theme/images/logo.png"
                  alt="SkilledConsultant"
                />
                <p>

                  "Empowering your business through innovative IT solutions, from strategic consulting to cutting-edge cybersecurity, AI, and seamless service management."
                </p>
                <div class="footer-social">
                  <ul>
                    <li>
                      <a
                        href="https://facebook.com/"
                        aria-label="Facebook"
                        ><i class="fab fa-facebook-f"></i
                      ></a>
                    </li>
                    <li>
                      <a
                        href="https://twitter.com/"
                        aria-label="Twitter"
                        ><i class="fab fa-twitter"></i
                      ></a>
                    </li>
                    <li>
                      <a
                        href="https://instagram.com/"
                        aria-label="Instagram"
                        ><i class="fab fa-instagram"></i
                      ></a>
                    </li>
                    <li>
                      <a
                        href="https://linkedin.com/"
                        aria-label="linkedin"
                        ><i class="fab fa-linkedin"></i
                      ></a>
                    </li>
                  </ul>
                </div>
                <!-- Footer social end -->
              
        <div class="copyright">
          <div class="container-f">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="copyright-info">
                  <span
                    >Copyright &copy;
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                   
                   <a href="scz/login.php"><br>Skilled Consultancy</a></span>
                </div>
              </div>

              </div>
            </div>
            <!-- Row end -->

            <div
              id="back-to-top"
              data-spy="affix"
              data-offset-top="10"
              class="back-to-top position-fixed"
            >
              <button class="btn btn-primary" title="Back to Top">
                <i class="fa fa-angle-double-up"></i>
              </button>
            </div>
          </div>
          <!-- Container end -->
        </div>
        <!-- Copyright end -->
      </footer>
      <!-- Footer end -->

      <!-- Javascript Files
  ================================================== -->

      <!-- initialize jQuery Library -->
      <script src="plugins/jQuery/jquery.min.js"></script>
      <!-- Bootstrap jQuery -->
      <script src="plugins/bootstrap/bootstrap.min.js" defer></script>
      <!-- Slick Carousel -->
      <script src="plugins/slick/slick.min.js"></script>
      <script src="plugins/slick/slick-animation.min.js"></script>
      <!-- Color box -->
      <script src="plugins/colorbox/jquery.colorbox.js"></script>
      <!-- shuffle -->
      <script src="plugins/shuffle/shuffle.min.js" defer></script>

   
      <!-- Template custom -->
      <script src="js/script.js"></script>
    </div>
    <!-- Body inner end -->
  </body>
</html>
