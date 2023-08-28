<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/intern-list-styles.css">
    <title>Contact Form Messages</title>
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
        <section class="message-list">
            <h1>Contact Form Messages</h1>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Company Name</th>
                    <th>Message</th>
                    <th>Newsletter</th>
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

                $sql = "SELECT * FROM ContactForm";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Email"] . "</td>";
                        echo "<td>" . $row["PhoneNumber"] . "</td>";
                        echo "<td>" . $row["CompanyName"] . "</td>";
                        echo "<td>" . $row["Message"] . "</td>";
                        echo "<td>" . ($row["Newsletter"] ? "Yes" : "No") . "</td>";
                        echo "<td>
                                  <form method='post' action='../BE/delete_message.php' onsubmit=\"return confirm('Are you sure you want to delete this message?');\">
                                    <input type='hidden' name='message_id' value='" . $row["MessageID"] . "'>
                                    <button type='submit' class='delete-button' name='delete_message'>Delete</button>
                                  </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No messages found.</td></tr>";
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
