<?php 
$servername = "localhost"; 
$username = "root"; // Your MySQL username 
$password = "";     

$dbname = "taskmanagement_db"; 
 
$conn = new mysqli($servername, $username, $password, $dbname); 
 
if ($conn->connect_error) { 
die("Connection failed: " . $conn->connect_error); 
} 
?>