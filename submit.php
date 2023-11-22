<?php
// Connect to your MySQL database
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data and insert into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    
    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);

    move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);

    // Insert data into the database
    $sql = "INSERT INTO photos (name, email, photo_path) VALUES ('$name', '$email', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo "Submission successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
