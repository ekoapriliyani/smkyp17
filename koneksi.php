<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbsmkyp17";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM gallery ORDER BY uploaded_on DESC";
$result = $conn->query($sql);
