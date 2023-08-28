
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/styles.css">
  <link rel="stylesheet" href="../CSS/MEPstyles.css">
  <title>Manage Employees</title>
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
    <section class="employee-list">
      <h1>Employee List</h1>
      <a href="registration_form.php" class="add-employee-button">Add Employee</a>
      <br>
      <br>
      <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" placeholder="Enter employee name">
        <button type="submit">Search</button>
      </form>
      <br>
      <table>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Job Title</th>
          <th>Admin Access</th>
          <th>Delete</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ids academy";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM Users";
        $search = "";
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $sql .= " WHERE FirstName LIKE '%$search%' OR LastName LIKE '%$search%'";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["FirstName"] . "</td>";
                echo "<td>" . $row["LastName"] . "</td>";
                echo "<td>" . $row["PhoneNumber"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                echo "<td>" . $row["JobTitle"] . "</td>";
                echo "<td>" . ($row["AdminAccess"] ? "Yes" : "No") . "</td>";
                echo "<td>
                          <form method='post' action='../BE/delete_employee.php' onsubmit=\"return confirm('Are you sure you want to delete this employee?');\">
                            <input type='hidden' name='employee_id' value='" . $row["Username"] . "'>
                            <button type='submit' class='delete-button' name='delete_employee'>Delete</button>
                          </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No employees found.</td></tr>";
        }

        $conn->close();
        ?>
      </table>
    </section>
  </main>
  
  <footer>
    <p>&copy; 2023 IDS Academy. All rights reserved.</p>
  </footer>
</body>
</html>
