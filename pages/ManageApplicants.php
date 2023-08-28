<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ids academy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM Intern WHERE ApplicationStatus = 'Pending' AND (FirstName LIKE '%$search%' OR LastName LIKE '%$search%')";
} else {
    $sql = "SELECT * FROM Intern WHERE ApplicationStatus = 'Pending'";
}

$result = $conn->query($sql);

$interns = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $interns[] = $row;
    }
}

$conn->close();
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/intern-list-styles.css">
    <title>Interns List</title>
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
    <section class="intern-list">
        <h1>Pending Interns List</h1>
        <div class="list-buttons">
            <a href="AcceptedApplicants.php" class="list-button">Accepted Applicants</a>
            <a href="RejectedApplicants.php" class="list-button">Rejected Applicants</a>
        </div>
        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter intern name">
            <button type="submit">Search</button>
        </form>
        <br>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Major</th>
                <th>University</th>
                <th>Phone Number</th>
                <th>Position</th>
                <th>Application Status</th>
                <th>Actions</th>
            </tr>
            <?php
                foreach ($interns as $row) {
                    echo "<tr>";
                    echo "<td>{$row['FirstName']}</td>";
                    echo "<td>{$row['LastName']}</td>";
                    echo "<td>{$row['Email']}</td>";
                    echo "<td>{$row['Major']}</td>";
                    echo "<td>{$row['University']}</td>";
                    echo "<td>{$row['PhoneNumber']}</td>";
                    echo "<td>{$row['Position']}</td>";
                    echo "<td>{$row['ApplicationStatus']}</td>";
                    echo "<td>";
                    echo "<form method='post' action='../BE/update_application_status.php' 
            onsubmit=\"return confirm('Are you sure you want to accept this intern?');\">";
        echo "<input type='hidden' name='internID' value='{$row["InternID"]}'>";
        echo "<input type='hidden' name='status' value='Accepted'>"; 
        echo "<button type='submit' class='accept-button' name='update_status'>Accept</button>";
        echo "</form>";

        echo "<form method='post' action='../BE/update_application_status.php' 
            onsubmit=\"return confirm('Are you sure you want to reject this intern?');\">";
        echo "<input type='hidden' name='internID' value='{$row["InternID"]}'>";
        echo "<input type='hidden' name='status' value='Rejected'>"; 
        echo "<button type='submit' class='reject-button' name='update_status'>Reject</button>";
        echo "</form>";
                    echo "</td>";
                    echo "</tr>";
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
