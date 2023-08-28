<?php
session_start();
if (isset($_SESSION['username'])) {
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'ids academy';

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_SESSION['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $jobTitle = $_POST['jobTitle'];

    $sql = "UPDATE Users SET FirstName='$firstName', LastName='$lastName', PhoneNumber='$phoneNumber', Email='$email', JobTitle='$jobTitle' WHERE Username='$username'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['firstName'] = $firstName;
        echo '<script>alert("Profile Updated Successfully!");  </script>';
        echo '<meta http-equiv="refresh" content="2;url=../pages/HomePage.php">';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "You are not logged in.";
}
?>
