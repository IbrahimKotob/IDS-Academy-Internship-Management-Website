<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'ids academy';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $programTitle = $_POST["programTitle"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $capacity = $_POST["capacity"];
    $aboutProgram = $_POST["aboutProgram"];
    $googleClassroomCode = $_POST["googleClassroomCode"];
    $projectType = $_POST["projectType"];
    $instructorCount = $_POST["instructorCount"];

    if (empty($programTitle) || empty($startDate) || empty($endDate) || empty($capacity) || empty($aboutProgram) || empty($googleClassroomCode) || empty($projectType) || empty($instructorCount)) {
        echo "All fields are required.";
    } else if (!is_numeric($capacity) || !is_numeric($instructorCount)) {
        echo "Capacity and Instructor Count must be numeric values.";
    } else {
        $sql = "INSERT INTO Program (ProgramTitle, StartDate, EndDate, Capacity, AboutProgram, GoogleClassroomCode, ProjectType, InstructorCount)
                VALUES ('$programTitle', '$startDate', '$endDate', $capacity, '$aboutProgram', '$googleClassroomCode', '$projectType', $instructorCount)";

        if ($conn->query($sql) === true) {
            echo "<script>alert('Program added successfully!');</script>";
            echo '<meta http-equiv="refresh" content="2;url=../pages/ManagePrograms.php">';
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>
