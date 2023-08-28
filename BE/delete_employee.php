<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_employee"])) {
    $employee_id = $_POST["employee_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ids academy";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $delete_sql = "DELETE FROM Users WHERE Username = '$employee_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo "Employee record deleted successfully.";
        header("Location: ../pages/ManageEmployees.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
