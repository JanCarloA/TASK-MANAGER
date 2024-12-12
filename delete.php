<?php
include 'db_connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM tasks WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: /");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
