<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete_message"])) {
        $messageID = $_POST["message_id"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ids academy";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM ContactForm WHERE MessageID = $messageID";

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: ../pages/ContactMessages.php"); 
            exit();
        } else {
            echo "Error deleting message: " . $conn->error;
        }

        $conn->close();
    }
}
?>
