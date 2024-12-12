<?php
include 'db_connect.php';

$records_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$start = ($page - 1) * $records_per_page;

// Count total records
$sql = "SELECT COUNT(id) FROM tasks"; 
$result = $conn->query($sql); 
$row = $result->fetch_row(); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / $records_per_page);

// Fetch records with limit for pagination
$sql = "SELECT * FROM tasks LIMIT $start, $records_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-5">

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-5">Task List</h1>

        <a href='create.php' class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-5 inline-block">Create Task</a>

        <table class="table-auto w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Title</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Image</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Define the status color
                        $statusColor = "";
                        switch ($row["status"]) {
                            case "Pending":
                                $statusColor = "bg-yellow-500 text-white";
                                break;
                            case "In Progress":
                                $statusColor = "bg-blue-500 text-white";
                                break;
                            case "Completed":
                                $statusColor = "bg-green-500 text-white";
                                break;
                        }
                        echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>
                          <td class='py-3 px-6 text-left whitespace-nowrap'>" . $row["id"] . "</td>
                          <td class='py-3 px-6 text-left'>" . $row["title"] . "</td>
                          <td class='py-3 px-6 text-left'>" . $row["description"] . "</td>
                          <td class='py-3 px-6 text-left'><span class='px-2 py-1 rounded-lg $statusColor'>" . $row["status"] . "</span></td>
                          <td class='py-3 px-6 text-left'><img src='" . $row["image"] . "' alt='Task Image' class='w-24 h-auto'></td>
                          <td class='py-3 px-6 text-center'>
                            <a href='edit.php?id=" . $row['id'] . "' class='text-blue-500 hover:text-blue-700'>Edit</a> |
                            <a href='delete.php?id=" . $row['id'] . "' class='text-red-500 hover:text-red-700' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                          </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='py-3 px-6 text-center'>No tasks found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="mt-5">
            <?php 
            for ($i = 1; $i <= $total_pages; $i++) { 
                echo "<a href='index.php?page=$i' class='mx-1 px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white rounded'>" . $i . "</a>"; 
            } 
            ?>
        </div>
    </div>

</body>
</html>
