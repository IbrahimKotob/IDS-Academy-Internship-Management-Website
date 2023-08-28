<html>
<head>
  <title>Home Page</title>
  <link rel="stylesheet" href="..\CSS\styles.css">
  <link rel="stylesheet" href="..\CSS\profile_styles.css">
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
        <?php
        if (isset($_SESSION['username'])) {
            $db_host = 'localhost';
            $db_username = 'root';
            $db_password = '';
            $db_name = 'ids academy'; 

            $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $username = $_SESSION['username'];

            $sql = "SELECT * FROM Users WHERE Username='$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <h2>Employee Profile</h2>
                <form action="../BE/update_profile.php" method="post">
                    <input type="text" name="firstName" value="<?php echo $row['FirstName']; ?>" required>
                    <input type="text" name="lastName" value="<?php echo $row['LastName']; ?>" required>
                    <input type="tel" name="phoneNumber" value="<?php echo $row['PhoneNumber']; ?>" required>
                    <input type="email" name="email" value="<?php echo $row['Email']; ?>" required>
                    <input type="text" name="jobTitle" value="<?php echo $row['JobTitle']; ?>" required>
                    <button type="submit">Update Profile</button>
                </form>
                <?php
            } else {
                echo "No user found.";
            }

            $conn->close();
        } else {
            echo "You are not logged in.";
        }
        ?>
    </div>
</body>
</html>