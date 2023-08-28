<?php

session_start();
$_SESSION['logged_in']= false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "ids academy";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE Username = '$username'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["Password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["firstName"] = $row["FirstName"];
            $_SESSION["lastName"] = $row["LastName"];
            $_SESSION["adminAccess"] = $row["AdminAccess"];
            $_SESSION['logged_in']=true;
            $_SESSION['user_type'] = 'employee';
    
            if($_SESSION["adminAccess"]==1){
                echo"Welcome Admin!";
                header('location: AdminHome.php');
                exit();
            }else{
            echo"Welcome!";
            header('location: HomePage.php');
            exit();}
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
    <title>Employee Login</title>
    <link rel="stylesheet" href="../CSS/MyForm.css">
    <link rel="stylesheet" href="../CSS/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .login-form {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
        }

        .login-form label,
        .login-form input[type="text"],
        .login-form input[type="password"],
        .login-form input[type="submit"],
        .login-form input[type="reset"] {
            display: block;
            margin-bottom: 10px;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form input[type="submit"],
        .login-form input[type="reset"] {
            background-color: #116181;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .login-form input[type="submit"]:hover,
        .login-form input[type="reset"]:hover {
            background-color: #116181;
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
    <div class="container">
        <h1 style="text-align: center; border-bottom: 1px solid #ccc; padding-bottom: 20px;">Employee Login</h1>
        <div class="login-form">
            <form action="login.php" method="POST" name="login-form">
                <?php if (isset($error)) { ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php } ?>
                <label for="username">Username</label>
                <input type="text" name="username" required>
                <label for="password">Password</label>
                <input type="password" name="password" required>
                <input type="submit" value="Login">
                <input type="reset" value="Cancel">
            </form>
            <div style="margin-top: 10px;">
                Don't have an account? You must ask an Admin to create one for you!
            </div>
        </div>
    </div>
</body>
</html>
