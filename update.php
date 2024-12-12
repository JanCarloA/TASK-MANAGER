<!DOCTYPE html>
<html>
<head>
    <title>Update Task</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-5">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-5">Update Task</h1>
        
        <?php
        include 'db_connect.php';

        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        if (!empty($_FILES['image']['name'])) {
            // Handle file upload
            $targetDir = "uploads/";
            $imagePath = $targetDir . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

            // Update with new image
            $sql = "UPDATE tasks SET title='$title', description='$description', status='$status', image='$imagePath' WHERE id=$id";
        } else {
            // Update without changing the image
            $sql = "UPDATE tasks SET title='$title', description='$description', status='$status' WHERE id=$id";
        }

        if ($conn->query($sql) === TRUE) {
            header("Location:/");
            exit();
        } else {
            echo "<div class='bg-red-100 text-red-700 p-4 rounded-lg'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
