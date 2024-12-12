<?php
include 'db_connect.php';

$title = $_POST['title'];
$description = $_POST['description'];
$status = $_POST['status'];

// Check if a file was uploaded
// Handle file upload 
$imagePath = null; 
if (!empty($_FILES['image']['name'])) { 
    $targetDir = "uploads/"; 
    $imagePath = $targetDir . basename($_FILES['image']['name']); 
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath); 
} 
 
// Insert data 
$sql = "INSERT INTO tasks (title, description, status, image) 
        VALUES ('$title', '$description', '$status', '$imagePath')";

if ($conn->query($sql) === TRUE) {
    header("Location: /");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
