<?php
require_once 'config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];

    $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if ($user && password_verify($old, $user['password_hash'])) {
        $new_hash = password_hash($new, PASSWORD_DEFAULT);
        $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?")
            ->execute([$new_hash, $_SESSION['user_id']]);
        $message = "Slaptažodis pakeistas sėkmingai.";
    } else {
        $message = "Neteisingas senas slaptažodis.";
    }
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Keisti slaptažodį</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Keisti slaptažodį</h2>
    <?php if (!empty($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Senas slaptažodis:</label>
            <input type="password" name="old_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Naujas slaptažodis:</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Keisti</button>
    </form>
</body>
</html>