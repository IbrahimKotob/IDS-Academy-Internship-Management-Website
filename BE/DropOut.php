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
    $query = "SELECT ProgramID FROM Intern WHERE InternID = $userID";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $registeredProgramID = $row['ProgramID'];
        $registeredProgramID = (int)trim($row['ProgramID']);
        $programID = (int)trim($programID);

        if ($registeredProgramID === $programID) {
            $query = "UPDATE Intern SET ProgramID = NULL WHERE InternID = $userID";

            if ($conn->query($query) === true) {
                $query = "UPDATE Program SET CurrentRegistered = CurrentRegistered - 1 WHERE ProgramID = $programID";
                $conn->query($query);

                echo "You have successfully dropped out of the program.";
                echo '<meta http-equiv="refresh" content="2;url=../pages/ProgramList.php">';
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo $programID;
            echo $registeredProgramID;
            echo "You are not registered for this program.";
            echo '<meta http-equiv="refresh" content="2;url=../pages/ProgramList.php">';

        }
    } else {
        echo "You are not registered for any program.";
        echo '<meta http-equiv="refresh" content="2;url=../pages/ProgramList.php">';

    }

    $conn->close();
}
?>
