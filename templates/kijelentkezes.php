<?php
$title = "Bejelentkezés";
include __DIR__ . '/header.php';
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "szeleromuvek";

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

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

header("Location: /web2EAPHP/index.php");
exit;
?>

<?php include __DIR__ . '/footer.php'; ?>
