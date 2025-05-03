<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $error = "Visi laukai privalomi.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);

        if ($stmt->rowCount() > 0) {
            $error = "Toks vartotojas arba el. paštas jau egzistuoja.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, first_name, last_name, email, password_hash) 
                                   VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$username, $first_name, $last_name, $email, $hashed_password]);
            $success = "Registracija sėkminga! <a href='login.php'>Prisijungti</a>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Registracija</h2>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <?php if (!empty($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Vartotojo vardas:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Vardas:</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Pavardė:</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>El. paštas:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Slaptažodis:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Registruotis</button>
    </form>
</body>
</html>