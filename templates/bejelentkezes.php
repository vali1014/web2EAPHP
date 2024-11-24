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

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nev = $_POST['nev'];
    $jelszo = $_POST['jelszo'];

    // Felhasználó ellenőrzése az adatbázisban
    $sql = "SELECT id, jelszo, admin FROM felhasznalok WHERE nev = '$nev'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($jelszo, $row['jelszo'])) {
            $_SESSION['nev'] = $nev;
            $_SESSION['admin'] = $row['admin'];
            $message = "Sikeresen bejelentkeztél";

            // Bejelentkezési állapot frissítése
            $update_sql = "UPDATE felhasznalok SET bejelentkezve = TRUE WHERE id = " . $row['id'];
            $conn->query($update_sql);

            header("Location: /web2EAPHP/index.php"); // Irányítás a főoldalra
            exit;
        } else {
            $message = "Hibás jelszó";
        }
    } else {
        $message = "Nincs ilyen felhasználó";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="/web2EAPHP/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Bejelentkezés</h2>
        <form method="post" action="bejelentkezes.php">
            Felhasználónév: <input type="text" name="nev" required><br>
            Jelszó: <input type="password" name="jelszo" required><br>
            <input type="submit" value="Bejelentkezek">
        </form>
        <p><?php echo $message; ?></p>
    </div>
</body>
</html>


<?php include __DIR__ . '/footer.php'; ?>
