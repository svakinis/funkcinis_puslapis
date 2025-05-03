<?php
require_once 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $comment_text = $_POST['comment_text'];
    $location = $_POST['location'];
    $user_id = $_SESSION['user_id'];

    if (empty($title) || empty($comment_text) || empty($location)) {
        $message = "Užpildykite visus laukus.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO comments (user_id, title, comment_text, location, ip_address) 
                                   VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $title, $comment_text, $location, $_SERVER['REMOTE_ADDR']]);
            $message = "Komentaras įrašytas sėkmingai!";
        } catch (PDOException $e) {
            $message = "Klaida: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Komentarai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Rašykite komentarą</h2>
    <?php if (!empty($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label>Pavadinimas:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Komentaras:</label>
            <textarea name="comment_text" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Vieta:</label>
            <input type="text" name="location" class="form-control" required>
        </div>
        <button class="btn btn-success">Pateikti</button>
    </form>

    <h3>Visi komentarai:</h3>
    <?php
    try {
        $stmt = $pdo->query("SELECT c.*, u.username FROM comments c 
                             JOIN users u ON c.user_id = u.id 
                             ORDER BY c.created_at DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='border p-3 mb-3'>";
            echo "<h5>" . htmlspecialchars($row['title']) . "</h5>";
            echo "<p>" . nl2br(htmlspecialchars($row['comment_text'])) . "</p>";
            echo "<p><strong>Vieta:</strong> " . htmlspecialchars($row['location']) . "</p>";
            echo "<p><small>Rašė: " . htmlspecialchars($row['username']) . " | " . $row['created_at'] . "</small></p>";
            if ($row['user_id'] == $_SESSION['user_id']) {
                echo "<a href='delete_comment.php?comment_id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Ar tikrai norite ištrinti komentarą?\")'>Ištrinti</a>";
            }
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Klaida: " . $e->getMessage() . "</div>";
    }
    ?>
</body>
</html>