<?php
require_once 'config.php';
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $ip_address = $_SERVER['REMOTE_ADDR'];

        if (empty($username) || empty($password)) {
            $error = "Prašome užpildyti visus laukus.";
        } else {
            try {
                $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password_hash'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    $pdo->prepare("INSERT INTO login_logs (user_id, success, ip_address) VALUES (?, ?, ?)")
                        ->execute([$user['id'], true, $ip_address]);

                    header('Location: index.php');
                    exit();
                } else {
                    $error = "Neteisingas vartotojo vardas arba slaptažodis.";
                    $pdo->prepare("INSERT INTO login_logs (user_id, success, ip_address) VALUES (?, ?, ?)")
                        ->execute([null, false, $ip_address]);
                }
            } catch (PDOException $e) {
                $error = 'Klaida: ' . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Prisijungimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Prisijungti</h2>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST" class="mb-3">
        <div class="mb-3">
            <label class="form-label">Vartotojo vardas:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Slaptažodis:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Prisijungti</button>
        <a href="register.php" class="btn btn-link">Registruotis</a>
    </form>
</body>
</html>