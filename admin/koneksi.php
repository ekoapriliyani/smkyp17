<?php
$servername = "localhost";
$username = "alfr7592_eko";
$password = "Programmersukses123$";
$dbname = "alfr7592_smk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM gallery ORDER BY uploaded_on DESC";
$result = $conn->query($sql);
