<?php
include 'db/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO notes (content) VALUES (?)");
    $stmt->bind_param("s", $content);
    $stmt->execute();

    header('Location: index.php');
    exit();
}
