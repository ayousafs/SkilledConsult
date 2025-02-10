<?php
// job-listings.php
// Database connection settings
$servername = 'localhost'; // Database host (change if you're using a remote server)
$username = 'root';  // Database username (change as per your setup)
$password = '';      // Database password (change as per your setup)
$dbname = 'job_applications'; // The name of the database

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the number of jobs per page
$jobsPerPage = 10;

// Get the current page from the URL, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting row for the query
$start = ($page - 1) * $jobsPerPage;

// Fetch job listings from the database (ordered by id descending)
$sql = "SELECT id, title, description, location, requirements, created_at FROM job_listings ORDER BY id DESC LIMIT $start, $jobsPerPage";
$result = $conn->query($sql);

// Get the total number of jobs in the database for pagination
$totalJobsResult = $conn->query("SELECT COUNT(id) AS total FROM job_listings");
$totalJobs = $totalJobsResult->fetch_assoc()['total'];

// Calculate total number of pages
$totalPages = ceil($totalJobs / $jobsPerPage);

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic Page Needs -->
  <meta charset="utf-8" />
  <title>Skilled Consultant</title>
  <!-- Mobile Specific Metas -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
  <meta name="author" content="" />
  <meta name="generator" content="" />
  <link rel="icon" type="theme/image/png" href="theme/images/favicon.png" />
  <!-- CSS -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css" />
  <link rel="stylesheet" href="plugins/animate-css/animate.css" />
  <link rel="stylesheet" href="plugins/slick/slick.css" />
  <link rel="stylesheet" href="plugins/slick/slick-theme.css" />
  <link rel="stylesheet" href="plugins/colorbox/colorbox.css" />
  <link rel="stylesheet" href="theme/css/style.css" />
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



    <section id="job-listings">
      <div class="container">
        <h2 class="column-title ">Current Job Openings</h2>
        <?php if ($result->num_rows > 0) { 
          while ($row = $result->fetch_assoc()) { ?>
            <div id="job-listing" class="job-listing" style="margin-bottom: 50px; margin-top: 80px;">
              <h3><?php echo htmlspecialchars($row['title']); ?></h3>
              <p class="location1">Location:&nbsp;<?php echo htmlspecialchars($row['location']); ?></p><br>
              <div class="accordion" id="accordion-<?php echo $row['id']; ?>">
                <div class="accordian">
                  <div class="accordian-header" id="headingDescription-<?php echo $row['id']; ?>">
                    <h5 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseDescription-<?php echo $row['id']; ?>" aria-expanded="true" aria-controls="collapseDescription-<?php echo $row['id']; ?>">Job Description</button>
                    </h5>
                  </div>
                  <div id="collapseDescription-<?php echo $row['id']; ?>" class="collapse" aria-labelledby="headingDescription-<?php echo $row['id']; ?>" data-parent="#accordion-<?php echo $row['id']; ?>">
                    <div class="accordian-body">
                      <?php echo nl2br(htmlspecialchars($row['description']) ?: 'No description available.'); ?>
                    </div>
                  </div>
                </div>
                <div class="accordian">
                  <div class="accordian-header" id="headingRequirements-<?php echo $row['id']; ?>">
                    <h5 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseRequirements-<?php echo $row['id']; ?>" aria-expanded="false" aria-controls="collapseRequirements-<?php echo $row['id']; ?>">Job Requirements</button>
                    </h5>
                  </div>
                  <div id="collapseRequirements-<?php echo $row['id']; ?>" class="collapse" aria-labelledby="headingRequirements-<?php echo $row['id']; ?>" data-parent="#accordion-<?php echo $row['id']; ?>">
                    <div class="accordian-body">
                      <?php 
                      echo !empty($row['requirements']) ? nl2br(htmlspecialchars($row['requirements'])) : 'No requirements listed.';
                      ?>
                    </div>
                  </div>
                </div>
              </div><br>
              <a class="btn btn-primary" href="form.php?job_id=<?php echo $row['id']; ?>">Apply Now</a>
            </div>
            <?php } } else { ?>
    <p>No job listings found.</p>
<?php } ?>

<br><br><br><br><br><br>
<div class="pagination1" style="text-align: center; margin-top: 20px;">
    <?php
    // Display page numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        // Check if it's the current page
        if ($i == $page) {
            // If it's the current page, add active class with highlighted style
            echo '<a href="?page=' . $i . '" style="padding: 10px 15px; margin: 0 5px; color: white; text-decoration: none; border-radius: 5px; font-size: 18px; background:linear-gradient(to right,#e60aea, #a800ab, #2e0238);; font-weight: bold;">' . $i . '</a>';
        } else {
            // Otherwise, just display the page number normally
            echo '<a href="?page=' . $i . '" style="padding: 10px 15px; margin: 0 5px; color: white; text-decoration: none; border-radius: 5px; font-size: 18px;" onmouseover="this.style.backgroundColor=\'#696969\'" onmouseout="this.style.backgroundColor=\'\'">' . $i . '</a>';
        }
    }
    ?>
</div>
</div>
      </div>
    </section>
  </div>
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
      <script src="theme/js/script.js"></script>
  <!-- Scripts for Bootstrap (Ensure this is added to make the accordion work) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
