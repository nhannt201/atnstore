<?php
$servername = "103.97.125.245";
$username = "ictgovnr";
$password = "J0pS9IPDXw8McO3";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully"; //s*lCRfeyn8P! nguyentrungnhan@103.27.238.234:2210
?>