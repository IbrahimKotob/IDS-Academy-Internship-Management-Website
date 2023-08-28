<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'intern') {
    echo '<script>alert("please login from an intern account");  </script>';
    echo '<meta http-equiv="refresh" content="2;url=../pages/InternLogin.php">';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'ids academy';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $programID = $_POST["program_id"];
    $programID = filter_var($programID, FILTER_VALIDATE_INT);

    if ($programID === false) {
        echo "Invalid program ID.";
        exit();
    }

    $userID = $_SESSION['intern_id'];
    $query = "SELECT ProgramID, ApplicationStatus FROM Intern WHERE InternID = $userID";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $registeredProgramID = $row['ProgramID'];
        $applicationStatus = $row['ApplicationStatus'];

        if ($registeredProgramID !== null) {
            echo "You are already registered for another program. You can only register for one program at a time.";
            exit();
        }

        if ($applicationStatus === "Pending") {
            echo "Your application is still pending. You cannot register for a program until your application is approved.";
            exit();
        } elseif ($applicationStatus === "Rejected") {
            echo "Your application status has been rejected. Please contact the administrator.";
            exit();
        }
    }

    $query = "SELECT StartDate, Capacity, CurrentRegistered FROM Program WHERE ProgramID = $programID";
    $result = $conn->query($query);

    if ($result->num_rows === 0) {
        echo "Program not found.";
        exit();
    }

    $row = $result->fetch_assoc();
    $capacity = $row['Capacity'];
    $currentRegistered = $row['CurrentRegistered'];
    $startDate = $row['StartDate'];
    $today = date("Y-m-d");

    if ($currentRegistered >= $capacity) {
        echo "The program is already full. Registration is closed.";
        exit();
    }

    if ($today >= $startDate) {
        echo "The program has already started and registration is closed.";
        exit();
    }

    $query = "UPDATE Intern SET ProgramID = $programID WHERE InternID = $userID";

    if ($conn->query($query) === true) {
        $currentRegistered++;
        $query = "UPDATE Program SET CurrentRegistered = $currentRegistered WHERE ProgramID = $programID";
        $conn->query($query);

        echo "Registration successful! You are now registered for the program.";
        echo '<meta http-equiv="refresh" content="2;url=../pages/ProgramList.php">';
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
