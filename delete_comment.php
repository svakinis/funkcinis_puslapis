<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
    $user_id = $_SESSION['user_id'];

    // Patikriname, ar komentaras priklauso prisijungusiam vartotojui
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE id = ? AND user_id = ?");
    $stmt->execute([$comment_id, $user_id]);
    $comment = $stmt->fetch();

    if ($comment) {
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->execute([$comment_id]);
        $message = "Komentaras sėkmingai ištrintas.";
    }
}

// Grąžiname į komentarų puslapį
header('Location: comments.php');
exit();
?>