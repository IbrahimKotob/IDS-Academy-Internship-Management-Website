<html>
<head>
  <title>Home Page</title>
  <link rel="stylesheet" href="..\CSS\styles.css">
  <link rel="stylesheet" href="..\CSS\ContactStyle.css">
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Contact Form</title>
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
  <br>
  <br>
  <br>
  <div class="container">
        <form action="../BE/process_contact.php" method="post">
            <h2>Contact Us</h2>
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone Number">
            <input type="text" name="company" placeholder="Company Name">
            <textarea name="message" placeholder="Message" required></textarea>
            <label for="newsletter">Subscribe to newsletter:</label>
            <input type="checkbox" name="newsletter" id="newsletter">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>