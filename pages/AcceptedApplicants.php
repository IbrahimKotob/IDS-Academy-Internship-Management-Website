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
    $sql = "SELECT * FROM Intern WHERE ApplicationStatus = 'Accepted' AND (FirstName LIKE '%$search%' OR LastName LIKE '%$search%')";
} else {
    $sql = "SELECT * FROM Intern WHERE ApplicationStatus = 'Accepted'";
}

$result = $conn->query($sql);

$acceptedInterns = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $acceptedInterns[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/intern-list-styles.css">
    <title>Accepted Interns List</title>
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
        <h1>Accepted Interns List</h1>
        <div class="list-buttons">
            <a href="ManageApplicants.php" class="list-button">Pending Applicants</a>
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
            </tr>
            <?php
                foreach ($acceptedInterns as $row) {
                    echo "<tr>";
                    echo "<td>{$row['FirstName']}</td>";
                    echo "<td>{$row['LastName']}</td>";
                    echo "<td>{$row['Email']}</td>";
                    echo "<td>{$row['Major']}</td>";
                    echo "<td>{$row['University']}</td>";
                    echo "<td>{$row['PhoneNumber']}</td>";
                    echo "<td>{$row['Position']}</td>";
                    echo "<td>{$row['ApplicationStatus']}</td>";
                    echo "</tr>";
                }
                if (empty($acceptedInterns)) {
                    echo "<tr><td colspan='8'>No accepted interns found.</td></tr>";
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
