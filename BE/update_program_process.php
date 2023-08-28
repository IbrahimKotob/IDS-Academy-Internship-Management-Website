<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ids academy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $programID = $_POST["programID"];
    $programTitle = $_POST["programTitle"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $capacity = $_POST["capacity"];
    $aboutProgram = $_POST["aboutProgram"];
    $googleClassroomCode = $_POST["googleClassroomCode"];
    $projectType = $_POST["projectType"];
    $instructorCount = $_POST["instructorCount"];

    if (empty($programTitle) || empty($startDate) || empty($endDate) || empty($capacity) ||
        empty($aboutProgram) || empty($googleClassroomCode) || empty($projectType) ||
        empty($instructorCount)) {
        echo "All fields are required.";
    } else {
        $sql = "UPDATE Program SET
                ProgramTitle = '$programTitle',
                StartDate = '$startDate',
                EndDate = '$endDate',
                Capacity = $capacity,
                AboutProgram = '$aboutProgram',
                GoogleClassroomCode = '$googleClassroomCode',
                ProjectType = '$projectType',
                InstructorCount = $instructorCount
                WHERE ProgramID = $programID";

        if ($conn->query($sql) === true) {
            echo "Program updated successfully.";
            echo '<meta http-equiv="refresh" content="2;url=../pages/ManagePrograms.php">';
        } else {
            echo "Error updating program: " . $conn->error;
        }
    }
}

$conn->close();
?>
