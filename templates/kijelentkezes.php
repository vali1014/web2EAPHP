<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/config.php";

// Kapcsolódás az adatbázishoz
$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['nev'])) {
    $nev = $_SESSION['nev'];

    // Bejelentkezési állapot frissítése
    $update_sql = "UPDATE felhasznalok SET bejelentkezve = FALSE WHERE nev = '$nev'";
    $conn->query($update_sql);

    session_destroy();
}

header("Location: /index.php");
exit;
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>Kijelentkezés</title>
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="style.css">
</head>
<body class="is-preload">

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>Kijelentkezés</h1>
        <p>Üdvözöljük a kijelentkezési oldalon!</p>
    </div>

    <!-- Main -->
    <div id="main">
        <div class="form-container">
            <h2>Kijelentkezés</h2>
            <form method="post" action="kijelentkezes.php">
                <input type="submit" value="Kijelentkezés">
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
