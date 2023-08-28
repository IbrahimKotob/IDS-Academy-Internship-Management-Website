<?php
session_start();

$login_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'ids academy';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST["email"];
    $password = $_POST["password"];


    $sql = "SELECT InternID, Password, FirstName, Email FROM Intern WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["Password"])) {
          $_SESSION['user_type'] = 'intern';
          $_SESSION["firstName"] = $row["FirstName"];
            $_SESSION["intern_id"] = $row["InternID"];
            $_SESSION["email"] = $row["Email"];
            $login_success = true;
            echo 'welcome!';
        } else {
            
          $error = "Invalid username or password.";
        }
    } else {

      $error = "Invalid username or password.";
    }

    $conn->close();
}
?>

<html>
<head>
    <title>IDS Academy - Intern Login</title>
    <link rel="stylesheet" href="../CSS/MyForm.css">
    <link rel="stylesheet" href="../CSS/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }


        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h1 {
            text-align: center;
            color: #116181;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }

        .login-form label,
        .login-form input[type="email"],
        .login-form input[type="password"],
        .login-form button[type="submit"] {
            display: block;
            margin-bottom: 10px;
        }

        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form button[type="submit"] {
            background-color: #116181;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .login-form button[type="submit"]:hover {
            background-color: #0b4e66;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
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
      <li><?php 
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
<br>
<div class="login-container">
    <h1>IDS Academy - Intern Login</h1>
    <?php
    if ($login_success) {
        echo '<p>Login successful! Redirecting to homepage...</p>';
        echo '<meta http-equiv="refresh" content="2;url=HomePage.php">';
    } else {
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form">
        <?php if (isset($error)) { ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php } ?>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    <?php } ?>
</div>
</body>
</html>
