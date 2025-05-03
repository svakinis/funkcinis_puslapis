<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Pagrindinis puslapis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Mano Projektas</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Atsijungti</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="alert alert-success" role="alert">
        Sveiki, <strong><?php echo htmlspecialchars($username); ?></strong>! Jūs sėkmingai prisijungėte.
    </div>

    <p class="lead">Šis puslapis pasiekiamas tik prisijungusiems vartotojams.</p>
</div>

</body>
</html>