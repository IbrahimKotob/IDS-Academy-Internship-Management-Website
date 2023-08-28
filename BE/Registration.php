<?php

class User
{
    public $username;
    public $password;
    public $firstName;
    public $lastName;
    public $phoneNumber;
    public $email;
    public $jobTitle;
    public $adminAccess;

    public function __construct($username, $password, $firstName, $lastName, $phoneNumber, $email, $jobTitle, $adminAccess)
    {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->jobTitle = $jobTitle;
        $this->adminAccess = $adminAccess;
    }

    public function validate()
    {
        $errors = array();

        if (empty($this->username) || empty($this->password) || empty($this->firstName) || empty($this->lastName) || empty($this->phoneNumber) || empty($this->email) || empty($this->jobTitle)) {
            $errors[] = "Please fill out all required fields.";
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }

        return $errors;
    }

    public function register()
{
    $errors = $this->validate();

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>Error: $error</p>";
        }
    } else {
        $creationDate = date("Y-m-d"); 

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ids academy";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $emailExists = false;
        $checkEmailSql = "SELECT * FROM users WHERE Email = '$this->email'";
        $result = $conn->query($checkEmailSql);
        if ($result && $result->num_rows > 0) {
            $emailExists = true;
        }

        if ($emailExists) {
            echo "<p style='color: red;'>Error: Email already exists in the database.</p>";
        } else {
            $sql = "INSERT INTO users (Username, Password, FirstName,LastName, PhoneNumber, Email, CreationDate,LastLoginDate ,JobTitle, ProgramID,AdminAccess)
                    VALUES ('$this->username', '$this->password', '$this->firstName', '$this->lastName', '$this->phoneNumber', '$this->email', '$creationDate','', '$this->jobTitle', '','$this->adminAccess')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Registration successful! Welcome {$this->firstName} {$this->lastName}.</p>";
                echo '<meta http-equiv="refresh" content="2;url=../pages/HomePage.php">';
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        }

        $conn->close();
    }
}

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $phoneNumber = trim($_POST["phoneNumber"]);
    $email = trim($_POST["email"]);
    $jobTitle = trim($_POST["jobTitle"]);
    $adminAccess = ($_POST["adminAccess"] === '1') ? 1 : 0;

    $user = new User($username, password_hash($password,PASSWORD_DEFAULT), $firstName, $lastName, $phoneNumber, $email, $jobTitle, $adminAccess);
    $user->register();
}

?>
