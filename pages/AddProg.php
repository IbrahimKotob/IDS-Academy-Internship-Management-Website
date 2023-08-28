
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../CSS/styles.css">
<link rel="stylesheet" href="../CSS/AddProgStyle.css">
<title>Add Program</title>
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
<div class="container">
  <h1>Add Program</h1>
  <form action="../BE/add_program_process.php" method="POST">
    <label for="programTitle">Program Title:</label>
    <input type="text" id="programTitle" name="programTitle" required>

    <label for="startDate">Start Date:</label>
    <input type="date" id="startDate" name="startDate" required>

    <label for="endDate">End Date:</label>
    <input type="date" id="endDate" name="endDate" required>

    <label for="capacity">Capacity:</label>
    <input type="number" id="capacity" name="capacity" required>

    <label for="aboutProgram">About Program:</label>
    <textarea id="aboutProgram" name="aboutProgram" rows="4" required></textarea>

    <label for="googleClassroomCode">Google Classroom Code:</label>
    <input type="text" id="googleClassroomCode" name="googleClassroomCode" required>

    <label for="projectType">Project Type:</label>
    <input type="text" id="projectType" name="projectType" required>

    <label for="instructorCount">Instructor Count:</label>
    <input type="number" id="instructorCount" name="instructorCount" required>

    <button type="submit">Add Program</button>
  </form>
</div>
</body>
</html>
