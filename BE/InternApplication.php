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

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $major = $_POST["major"];
    $university = $_POST["university"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $city = $_POST["city"];
    $position = $_POST["position"];
    $expected_salary = $_POST["expected_salary"];
    $start_date = $_POST["start_date"];
    $website = !empty($_POST["website"]) ? $_POST["website"] : null;
    $experience = $_POST["experience"];
    $expected_graduation = $_POST["expected_graduation"];
    $password = $_POST["password"];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($major) || empty($university) || empty($phone) || empty($age) || empty($city) || empty($position) || empty($expected_salary) || empty($start_date) || empty($experience) || empty($expected_graduation) || empty($password)) {
        echo '<p>Please fill in all the required details.</p>';
    } else {
        
        $email_exists_query = "SELECT * FROM Intern WHERE Email = '$email'";
        $email_exists_result = $conn->query($email_exists_query);

        if ($email_exists_result->num_rows > 0) {
            echo '<p>Sorry, the provided email is already registered. Please use a different email address.</p>';
            echo '<meta http-equiv="refresh" content="2;url=../pages/InternshipForm.php">';
        } else {
            $application_status = "Pending";
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO Intern (FirstName, LastName, Email, Major, University, PhoneNumber, Age, City, Position, ExpectedSalary, StartDate, Website, Experience, ExpectedGraduationDate, CreationDate, ApplicationStatus, ProgramID, Password) 
                    VALUES ('$first_name', '$last_name', '$email', '$major', '$university', '$phone', $age, '$city', '$position', $expected_salary, '$start_date', '$website', '$experience', '$expected_graduation', NOW(), '$application_status', NULL, '$hashed_password')";

            if ($conn->query($sql) === true) {
                echo '<p>Thank you for your application. Your application is pending review.</p>';
                echo '<meta http-equiv="refresh" content="2;url=../pages/HomePage.php">';

            } else {
                echo 'Error: ' . $sql . '<br>' . $conn->error;
            }
        }
    }

    $conn->close();
}
?>
