
<?php
session_start();


?>
<html>
<head>
    <title>Program List</title>
    <link rel="stylesheet" href="..\CSS\MyForm.css">
    <link rel="stylesheet" href="..\CSS\styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #116181;
        }

        .program-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            max-width: 300px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            transition: background-color 0.2s ease;
            cursor: pointer;
        }

        .program-card:hover {
            background-color: #f5f5f5;
        }

        .program-details {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .program-details p {
            margin-bottom: 5px;
        }

        .program-details strong {
            font-weight: bold;
        }

        .program-card button,
        .program-details button {
            background-color: #116181;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.2s ease;
        }

        .program-card button:hover,
        .program-details button:hover {
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
<h1>
List Of Available Programs (Click on a program card to view more details):
</h1>
    <?php
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'ids academy';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Program";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $programID = $row['ProgramID'];
            $programTitle = $row['ProgramTitle'];
            $startDate = $row['StartDate'];
            $endDate = $row['EndDate'];
            $aboutProgram = $row['AboutProgram'];
            $instructor = $row['Instructor'];
            $capacity = $row['Capacity'];
            $currentRegistered = $row['CurrentRegistered'];
            $googleClassroomCode = $row['GoogleClassroomCode'];
            $projectType = $row['ProjectType'];
            $instructorCount = $row['InstructorCount'];
            $assessmentExamLinks = $row['AssessmentExamLinks'];
            ?>
            <div class="program-card" onclick="showDetails('<?php echo $programID; ?>')">
                <h2><?php echo $programTitle; ?></h2>
                <p><strong>Start Date:</strong> <?php echo $startDate; ?></p>
                <p><strong>End Date:</strong> <?php echo $endDate; ?></p>
                <p><strong>Capacity:</strong> <?php echo $capacity; ?></p>
                    <form action="../BE/RegProg.php" method="POST">
                        <input type="hidden" name="program_id" value="<?php echo $programID; ?>">
                        <button type="submit">Register</button>
                    </form>
                    <form action="../BE/DropOut.php" method="POST">
                        <input type="hidden" name="program_id" value="<?php echo $programID; ?>">
                        <button type="submit">Dropout</button>
                    </form>
            </div>
            <div class="program-details" id="<?php echo $programID; ?>">
                <p><strong>About Program:</strong> <?php echo $aboutProgram; ?></p>
                <p><strong>Instructor:</strong> <?php echo $instructor; ?></p>
                <p><strong>Current Registered:</strong> <?php echo $currentRegistered; ?></p>
                <p><strong>Google Classroom Code:</strong> <?php echo $googleClassroomCode; ?></p>
                <p><strong>Project Type:</strong> <?php echo $projectType; ?></p>
                <p><strong>Instructor Count:</strong> <?php echo $instructorCount; ?></p>
                <p><strong>Assessment/Exam Links:</strong> <?php echo $assessmentExamLinks; ?></p>

            </div>
            <?php
        }
    } else {
        echo "<p>No programs found.</p>";
    }

    $conn->close();
    ?>

    <script>
        function showDetails(programID) {
            var detailsDiv = document.getElementById(programID);
            if (detailsDiv.style.display === "none") {
                detailsDiv.style.display = "block";
            } else {
                detailsDiv.style.display = "none";
            }
        }
    </script>
</body>
</html>
