<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ids academy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["internID"]) && isset($_POST["status"])) {
    $internID = $_POST["internID"];
    $status = $_POST["status"];

    $updateQuery = "UPDATE Intern SET ApplicationStatus = '$status' WHERE InternID = $internID";
    
    if ($conn->query($updateQuery) === TRUE) {
        
        header("Location: ../pages/ManageApplicants.php");
        exit();
    } else {
        echo "Error updating application status: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
