<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pašalinti visus sesijos kintamuosius
session_unset();

// Sunaikinti sesiją
session_destroy();

// Naikinti sesijos slapuką (PHPSESSID)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Nukreipti į prisijungimo puslapį
header('Location: login.php');
exit();
?>