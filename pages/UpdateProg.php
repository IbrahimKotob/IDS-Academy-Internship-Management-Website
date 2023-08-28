
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/update-program-styles.css">

    <title>Update Program</title>
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

    <div class="update-program">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ids academy";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["program_id"])) {
            $programID = $_GET["program_id"];
            $query = "SELECT * FROM Program WHERE ProgramID = $programID";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<h1>Update Program</h1>";
                echo "<form action='../BE/update_program_process.php' method='post'>";
                echo "<input type='hidden' name='programID' value='" . $row["ProgramID"] . "'>";

                echo "<div class='form-field'>";
                echo "<label for='programTitle'>Program Title:</label>";
                echo "<input type='text' id='programTitle' name='programTitle' value='" . $row["ProgramTitle"] . "' required>";
                echo "</div>";

                echo "<div class='form-field'>";
                echo "<label for='startDate'>Start Date:</label>";
                echo "<input type='date' id='startDate' name='startDate' value='" . $row["StartDate"] . "' required>";
                echo "</div>";

                echo "<div class='form-field'>";
                echo "<label for='endDate'>End Date:</label>";
                echo "<input type='date' id='endDate' name='endDate' value='" . $row["EndDate"] . "' required>";
                echo "</div>";

                echo "<div class='form-field'>";
                echo "<label for='capacity'>Capacity:</label>";
                echo "<input type='number' id='capacity' name='capacity' value='" . $row["Capacity"] . "' required>";
                echo "</div>";


                echo "<div class='form-field'>";
                echo "<label for='aboutProgram'>About Program:</label>";
                echo "<textarea id='aboutProgram' name='aboutProgram' required>" . $row["AboutProgram"] . "</textarea>";
                echo "</div>";

                echo "<div class='form-field'>";
                echo "<label for='googleClassroomCode'>Google Classroom Code:</label>";
                echo "<input type='text' id='googleClassroomCode' name='googleClassroomCode' value='" . $row["GoogleClassroomCode"] . "' required>";
                echo "</div>";

                echo "<div class='form-field'>";
                echo "<label for='projectType'>Project Type:</label>";
                echo "<input type='text' id='projectType' name='projectType' value='" . $row["ProjectType"] . "' required>";
                echo "</div>";

                echo "<div class='form-field'>";
                echo "<label for='instructorCount'>Instructor Count:</label>";
                echo "<input type='number' id='instructorCount' name='instructorCount' value='" . $row["InstructorCount"] . "' required>";
                echo "</div>";

                echo "<div class='form-field'>";
                echo "<input type='submit' value='Update Program'>";
                echo "</div>";

                echo "</form>";
            } else {
                echo "Program not found.";
            }
        } else {
            echo "Invalid program ID.";
        }

        $conn->close();
        ?>
    </div>

    <footer>
        <p>&copy; 2023 IDS Academy. All rights reserved.</p>
    </footer>
</body>
</html>

