<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/styles.css">
  <link rel="stylesheet" href="../CSS/AdminHomeStyle.css">
  <title>Admin Home Page</title>
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
  <main>
    <section class="welcome-section">
      <h1>Welcome, Admin!</h1>
      <p>You have access to all administrative features.</p>
    </section>
  </main>
  
  <footer>
    <p>&copy; 2023 IDS Academy. All rights reserved.</p>
  </footer>
</body>
</html>
