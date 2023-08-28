<html>
<head>
  <title>Home Page</title>
  <link rel="stylesheet" href="..\CSS\styles.css">
  <link rel="stylesheet" href="..\CSS\HomeStyle.css">
</head>
<body>
<nav>
    <ul>
    <img src="../Images/IDS Academy logo.png" width="10%;">
      <li><a href="HomePage.php">Home</a></li>
      <li><a href="About.php">About</a></li>
      <li><a href="ProgramList.php">Programs</a></li>
      <li><a href="InternshipForm.php">Apply For Internship!</a></li>
      <li><a href="ContactForm.php">Contact</a></li>
      <li><a href="InternLogin.php">Intern Login</a></li>
      <li><a href="Login.php">Employee Login</a></li>
      <li><?php session_start();
      if (isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
    $user_name = $_SESSION["firstName"];
    if($user_type === 'employee'){
      echo "<a href='Profile.php'>Welcome, $user_type: $user_name!</a>";
      }else{
          echo "<a href='InternProfile.php'>Welcome, $user_type: $user_name!</a>";
      }
  } else {
    echo "<a>Welcome, Guest. Please log in.</a>";
} ?></li>
    </ul>
  </nav>
  <section class="hero">
    <div class="hero-content">
      <h1 style="color: black;">Start Your Software Development Journey</h1>
      <p style="color: black;">Unlock your potential with hands-on web development internships and programs.</p>
      <a href="ProgramList.php" class="btn">Explore Internship Programs</a>
    </div>
  </section>

  <section class="features">
    <div class="feature">
      <i class="fas fa-code"></i>
      <h2>Real-World Projects</h2>
      <p>Work on real projects and gain practical experience.</p>
    </div>
    <div class="feature">
      <i class="fas fa-graduation-cap"></i>
      <h2>Expert Mentors</h2>
      <p>Learn from industry experts and experienced mentors.</p>
    </div>
    <div class="feature">
      <i class="fas fa-certificate"></i>
      <h2>Certification</h2>
      <p>Earn certificates upon successful completion.</p>
    </div>
  </section>

  <footer>
    <p>&copy; 2023 IDS Academy. All rights reserved.</p>
  </footer>
</body>
</html>
