<?php
$host = 'localhost';
$dbname = 'todo_db';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//new task add:>
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = trim($_POST['task']);
    if (!empty($task)) {
        $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
        $stmt->bind_param("s", $task);
        $stmt->execute();
        $stmt->close();
    }
}
// deleting a task:>
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetching all tasks:>
$result = $conn->query("SELECT * FROM tasks");
$tasks = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="todo-container">
        <h2>To-Do List</h2>
        <form method="POST">
            <input type="text" id="taskInput" name="task" placeholder="Add a new task">
            <button type="submit" id="addTaskBtn">Add Task</button>
        </form>
        <ul id="taskList">
            <?php foreach ($tasks as $task): ?>
                <li class="task">
                    <?php echo $task['task']; ?>
                    <a href="?delete=<?php echo $task['id']; ?>" class="removeBtn">Remove</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
   
</body>
</html>
