<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Task List</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'config.php';

                    $sql = "SELECT task_name, due_date FROM tasks";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["task_name"] . "</td><td>" . $row["due_date"] . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No tasks found</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
