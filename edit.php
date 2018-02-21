<div style='border-style: solid;'>
    Edit:
    <form method="POST">
        Name:<br>
        <input type="text" name="name">
        Time:
        <input type="text" name="time">
        <input type="submit" value="Submit">
    </form>
</div>

<?php

include "config.php";

if (isset($_GET['listId'])) {
    if (isset($_POST["name"])) {
        $name = $_POST["name"];
        $time = $_POST["time"];
        $id = $_GET['id'];

        $stmt = $conn->prepare("UPDATE tasks SET name = :name, time = :time WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ./tasks.php?listId=" . $_GET['listId']);

        return true;
    }
} else {
    if (isset($_POST["name"])) {
        echo isset($_POST["name"]) ? 1 : 0;
        echo "gey";
        $name = $_POST["name"];
        $id = $_GET['id'];

        $stmt = $conn->prepare("UPDATE list SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: ./");

        return true;
    }
}