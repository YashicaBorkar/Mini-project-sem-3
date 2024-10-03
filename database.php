<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bussiness_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data
$sql = "SELECT Protiens, Fats, Carbs FROM nutrients LIMIT 1";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch the result
$data = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'Protiens' => $row['Protiens'],
        'Fats' => $row['Fats'],
        'Carbs' => $row['Carbs']
    );
}

// Close connection
$conn->close();

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
