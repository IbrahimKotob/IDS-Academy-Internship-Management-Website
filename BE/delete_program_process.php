<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ids academy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["program_id"])) {
    $programID = $_POST["program_id"];

    $deleteQuery = "DELETE FROM Program WHERE ProgramID = $programID";
    
    if ($conn->query($deleteQuery) === true) {
        echo "Program deleted successfully.";
        echo '<meta http-equiv="refresh" content="2;url=../pages/ManagePrograms.php">';
    } else {
        echo "Error deleting program: " . $conn->error;
    }
}

$conn->close();
?>
