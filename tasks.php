<!DOCTYPE HTML>
<html>
<head>
    <title>To do list</title>
</head>
<body>

<h1>To do:</h1>

<form method="POST">
    Name:<br>
    <input type="text" name="name">
    Time:
    <input type="text" name="time">
    <input type="submit" value="Submit">
</form>

</body>
</html>

<?php

include 'config.php';

$listId = $_GET['listId'];
$status = "not done";

$stmt = $conn->prepare("SELECT * FROM tasks WHERE listId = $listId");
$stmt->execute();

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
    echo "<div style='border-style: dashed;'>";
    echo "<p style='display: inline-block;'>";
    echo $row["name"];
    echo "</p>";
    echo "<p>status: " . $row["status"] . "</p>";
    echo "<p>time: " . $row["time"] . "</p>";
    echo "<a href='edit.php?id=" . $row["id"] . "&listId=" . $listId . "'>edit</a>";
    echo "<a href='delete.php?id=" . $row["id"] . "&listId=" . $listId . "'>delete</a>";
    echo "<div>";
}

if (isset($_POST["name"])) {
    $stmt = $conn->prepare("INSERT INTO tasks(listId, name, status, time) VALUES (:listId, :listname, :status, :time)");
    $stmt->bindParam(':listId', $listId);
    $stmt->bindParam(':listname', $_POST["name"]);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':time', $_POST["time"]);
    $stmt->execute();

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;

    return true;
}

?>