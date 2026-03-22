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
$item_name = $_POST['item_name'];
$description = $_POST['description'];
$photo = $_POST['photo'];

// Insert into database
$sql = "INSERT INTO tbl_donors (Name, Description, Photo) VALUES ('$item_name', '$description', '$photo')";

if ($conn->query($sql) === TRUE) {
    echo "Record saved successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
