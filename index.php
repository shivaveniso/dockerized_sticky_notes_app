<?php
include 'db/db_connect.php';

$sql = "SELECT * FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);

$notes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Notes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Sticky Notes</h1>
        <form action="add_note.php" method="POST">
            <textarea name="content" placeholder="Write your note here..." required></textarea>
            <button type="submit">Add Note</button>
        </form>

        <div class="notes">
            <?php foreach ($notes as $note): ?>
                <div class="note">
                    <p><?= htmlspecialchars($note['content']) ?></p>
                    <a href="delete_note.php?id=<?= $note['id'] ?>" class="delete">&times;</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

