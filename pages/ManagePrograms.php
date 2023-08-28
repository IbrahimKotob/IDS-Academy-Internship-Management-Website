<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'ids academy';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM Program WHERE ProgramTitle LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM Program";
}

$result = $conn->query($sql);

$programs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $programs[] = $row;
    }
}

$conn->close();
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/MEPstyles.css">
    <title>Manage Programs</title>
    
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
    <br><br><br>
    <main>
        <section class="program-list">
            <h1>Manage Programs</h1>
            <a href="AddProg.php" class="add-program-button">Add Program</a>
            <br><br>
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search" placeholder="Enter program name">
                <button type="submit">Search</button>
            </form>
            <br>
            <table>
                <tr>
                    <th>Program Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Capacity</th>
                    <th>About Program</th>
                    <th>Google Classroom Code</th>
                    <th>Project Type</th>
                    <th>Instructor Count</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <?php
                    $index = 0;
                    while ($index < count($programs)) {
                        echo "<tr>";
                        echo "<td>{$programs[$index]['ProgramTitle']}</td>";
                        echo "<td>{$programs[$index]['StartDate']}</td>";
                        echo "<td>{$programs[$index]['EndDate']}</td>";
                        echo "<td>{$programs[$index]['Capacity']}</td>";
                        echo "<td>{$programs[$index]['AboutProgram']}</td>";
                        echo "<td>{$programs[$index]['GoogleClassroomCode']}</td>";
                        echo "<td>{$programs[$index]['ProjectType']}</td>";
                        echo "<td>{$programs[$index]['InstructorCount']}</td>";
                        echo "<td>
                                <a href='UpdateProg.php?program_id={$programs[$index]['ProgramID']}' class='update-button'>Update</a>
                            </td>";
                        echo "<td>
                                <form method='post' action='../BE/delete_program_process.php' onsubmit=\"return confirm('Are you sure you want to delete this program?');\">
                                    <input type='hidden' name='program_id' value='{$programs[$index]['ProgramID']}'>
                                    <button type='submit' class='delete-button' name='delete_program'>Delete</button>
                                </form>
                            </td>";
                        echo "</tr>";
                        $index++;
                    }
                ?>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 IDS Academy. All rights reserved.</p>
    </footer>
</body>
</html>
