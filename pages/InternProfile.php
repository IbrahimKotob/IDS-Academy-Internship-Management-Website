<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\CSS\styles.css">
    <link rel="stylesheet" href="..\CSS\profile_styles.css">
    <title>Intern Profile</title>
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
        if (isset( $_SESSION["email"])) {
            $db_host = 'localhost';
            $db_username = 'root';
            $db_password = '';
            $db_name = 'ids academy'; 

            $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $email = $_SESSION['email'];

            $sql = "SELECT * FROM Intern WHERE Email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <h2>Intern Profile</h2>
                <form action="../BE/update_intern_profile.php" method="post">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" value="<?php echo $row['FirstName']; ?>" required><br>

                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" value="<?php echo $row['LastName']; ?>" required><br>

                    <label for="phoneNumber">Phone Number:</label>
                    <input type="tel" name="phoneNumber" value="<?php echo $row['PhoneNumber']; ?>" required><br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo $row['Email']; ?>" required><br>

                    <label for="major">Major:</label>
                    <input type="text" name="major" value="<?php echo $row['Major']; ?>" required><br>

                    <label for="university">University:</label>
                    <input type="text" name="university" value="<?php echo $row['University']; ?>" required><br>


                    <button type="submit">Update Profile</button>
                </form>
                <?php
            } else {
                echo "No intern found.";
            }

            $conn->close();
        } else {
            echo "You are not logged in.";
        }
        ?>
    </div>
</body>
</html>