<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $phoneNumber = trim($_POST["phoneNumber"]);
    $email = trim($_POST["email"]);
    $jobTitle = trim($_POST["jobTitle"]);
    $adminAccess = $_POST["adminAccess"];

    if (empty($username) || empty($password) || empty($firstName) || empty($lastName) || empty($phoneNumber) || empty($email) || empty($jobTitle) || empty($adminAccess)) {
        $errors[] = "Please fill out all required fields.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>Error: $error</p>";
        }
    } else {
        echo "<p>Registration successful! Welcome $firstName $lastName.</p>";
    }
}
?>

<html>
<head>
    <title>Employee Sign Up</title>
    <link rel="stylesheet" href="../CSS/MyForm.css">
    <link rel="stylesheet" href="../CSS/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .signup-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .signup-container h1 {
            text-align: center;
            color: #116181;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }

        .signup-container label,
        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"],
        .signup-container input[type="tel"],
        .signup-container select,
        .signup-container input[type="submit"],
        .signup-container input[type="reset"] {
            display: block;
            margin-bottom: 10px;
        }

        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"],
        .signup-container input[type="tel"],
        .signup-container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .signup-container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            color: #000;
        }

        .signup-container input[type="submit"],
        .signup-container input[type="reset"] {
            background-color: #116181;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .signup-container input[type="submit"]:hover,
        .signup-container input[type="reset"]:hover {
            background-color: #0b4e66;
        }
    </style>
</head>
<body>
<nav>
    <ul>
    <img src="../Images/IDS Academy logo.png" width="10%;">
      <li><a href="AdminHome.php">Admin Home</a></li>
      <li><a href="HomePage.php">User Home</a></li>
      <li><a href="ManageEmployees.php">Manage Employees</a></li>
      <li><a href="ManagePrograms.php">Manage Programs</a></li>
      <li><a href="ManageApplicants.php">Manage Applicants</a></li>
      <li><a href="ContactMessages.php">Contact Messages</a></li>
      <li>
          <?php
          session_start();
          $name=$_SESSION["firstName"];
              echo "<a>Welcome, Admin:  $name!</a>";
          ?>
        </li>
    </ul>
  </nav>
<br>
<br>
<br>
<br>
<div class="signup-container">
    <h1>Employee Sign Up</h1>
    <form action="../BE/Registration.php" method="POST" name="signup-form">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div id="password-strength"></div>

        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" name="phoneNumber" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="jobTitle">Job Title:</label>
        <input type="text" name="jobTitle" required>

        <label for="adminAccess">Admin Access:</label>
        <select name="adminAccess" required>
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>

        <input type="submit" value="Sign Up">
        <input type="reset" value="Cancel">
    </form>
</div>
<script>
        const passwordInput = document.getElementById("password");
        const passwordStrengthIndicator = document.getElementById("password-strength");

        passwordInput.addEventListener("input", () => {
            const password = passwordInput.value;
            const strength = calculatePasswordStrength(password);
            updatePasswordStrengthIndicator(strength);
        });

        function calculatePasswordStrength(password) {
            if (password.length < 6) {
                return "Weak";
            } else if (password.length < 10) {
                return "Moderate";
            } else {
                return "Strong";
            }
        }

        function updatePasswordStrengthIndicator(strength) {
            passwordStrengthIndicator.textContent = `Password Strength: ${strength}`;
            if (strength === "Weak") {
                passwordStrengthIndicator.style.color = "red";
            } else if (strength === "Moderate") {
                passwordStrengthIndicator.style.color = "orange";
            } else {
                passwordStrengthIndicator.style.color = "green";
            }
        }
    </script>
</body>
</html>
