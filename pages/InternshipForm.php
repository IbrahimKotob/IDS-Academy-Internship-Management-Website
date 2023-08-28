<html>
<head>
    <title>IDS Academy - Intern Application</title>
    <link rel="stylesheet" href="../CSS/MyForm.css">
    <link rel="stylesheet" href="../CSS/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }


        .application-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .application-container h1 {
            text-align: center;
            color: #116181;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }

        .application-container label,
        .application-container input[type="text"],
        .application-container input[type="email"],
        .application-container input[type="password"],
        .application-container input[type="tel"],
        .application-container input[type="number"],
        .application-container input[type="date"],
        .application-container input[type="url"],
        .application-container textarea,
        .application-container button[type="submit"] {
            display: block;
            margin-bottom: 10px;
        }

        .application-container input[type="text"],
        .application-container input[type="email"],
        .application-container input[type="password"],
        .application-container input[type="tel"],
        .application-container input[type="number"],
        .application-container input[type="date"],
        .application-container input[type="url"],
        .application-container textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .application-container button[type="submit"] {
            background-color: #116181;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        .application-container button[type="submit"]:hover {
            background-color: #0b4e66;
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
<br>
<div class="application-container">
    <h1>IDS Academy - Intern Application</h1>
    <form method="post" action="../BE/InternApplication.php">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div id="password-strength"></div>

        <label for="major">Major:</label>
        <input type="text" id="major" name="major" required>

        <label for="university">University:</label>
        <input type="text" id="university" name="university" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required>

        <label for="expected_salary">Expected Salary:</label>
        <input type="number" id="expected_salary" name="expected_salary" step="0.01" required>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="website">Website (if any):</label>
        <input type="url" id="website" name="website">

        <label for="experience">Experience:</label>
        <textarea id="experience" name="experience" rows="4" required></textarea>

        <label for="expected_graduation">Expected Graduation Date:</label>
        <input type="date" id="expected_graduation" name="expected_graduation" required>

        <button type="submit" name="submit_application">Submit Application</button>
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
