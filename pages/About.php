
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        
        header {
            background-color: #116181;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .company-info {
            display: flex;
            align-items: center;
        }
        
        .company-info img {
            width: 200px;
            height: auto;
            margin-right: 2rem;
        }
        
        .company-description {
            font-size: 18px;
            line-height: 1.6;
            color: #333;
        }
        
        .features {
            display: flex;
            flex-wrap: wrap;
            margin-top: 2rem;
        }
        
        .feature {
            flex: 1;
            padding: 1rem;
            text-align: center;
            border-radius: 5px;
            background-color: #f8f8f8;
            margin: 0.5rem;
        }
        
        .feature h3 {
            margin-top: 0;
        }
        
        .feature p {
            font-size: 16px;
            color: #555;
        }
    </style>
    <title>About IDS</title>
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
    <header>
      <br>
        <h1>About IDS</h1>
    </header>
    <div class="container">
        <div class="company-info">
            <img src="../Images/IDS logo.png" alt="IDS Logo">
            <div class="company-description">
                <p>Welcome to IDS, your gateway to exciting computer science internship programs. We offer a variety of internship opportunities for students in various fields of computer science. Our goal is to provide hands-on experience and mentorship to help you excel in your career.</p>
                <p>At IDS, we are committed to fostering innovation, learning, and growth. Our experienced team is dedicated to guiding you through real-world projects, enabling you to build practical skills that are highly valued by employers.</p>
            </div>
        </div>
        <h2>Why Choose IDS Internship Programs?</h2>
        <div class="features">
            <div class="feature">
                <h3>Expert Mentors</h3>
                <p>Learn from experienced professionals in the field who are passionate about sharing their knowledge.</p>
            </div>
            <div class="feature">
                <h3>Real-World Projects</h3>
                <p>Gain hands-on experience by working on actual projects that have real impact.</p>
            </div>
            <div class="feature">
                <h3>Diverse Fields</h3>
                <p>Choose from a wide range of computer science areas to find an internship that matches your interests.</p>
            </div>
            <div class="feature">
                <h3>Networking</h3>
                <p>Connect with industry professionals, fellow interns, and potential employers for future opportunities.</p>
            </div>
        </div>
    </div>
</body>
</html>
