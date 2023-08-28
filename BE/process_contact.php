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

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $company = isset($_POST['company']) ? $_POST['company'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;

    $sql = "INSERT INTO ContactForm (Name, Email, PhoneNumber, CompanyName, Message, Newsletter)
            VALUES ('$name', '$email', '$phone', '$company', '$message', '$newsletter')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Message Sent Successfully!");  </script>';
    echo '<meta http-equiv="refresh" content="2;url=../pages/HomePage.php">';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
