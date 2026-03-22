<?php
// Database connection
$servername = "localhost";
$username   = "root"; // default for XAMPP/MAMP
$password   = "";     // default is empty for XAMPP, "root" for MAMP
$dbname     = "db_donation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$zip = $_POST['zip'];

// Insert into database
$sql = "INSERT INTO tbl_organization (Name, Email, Phone, Address, City, Code) VALUES ('$fullname', '$email', '$phone', '$address', '$city', '$zip')";

if ($conn->query($sql) === TRUE) {
    echo "Record saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
