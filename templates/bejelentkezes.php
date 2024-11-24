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
        echo "<script>alert('Nincs ilyen felhasználó');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/web2EAPHP/assets/css/main.css" />
    <link rel="stylesheet" href="/web2EAPHP/style.css">
</head>
<body class="is-preload">

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>Bejelentkezés</h1>
        <p>Üdvözöljük a bejelentkezési oldalon!</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Jelentkezz be, hogy hozzáférj a szélerőművekkel kapcsolatos információkhoz!</h2>
        </header>

        <div class="box alt container">
            <section class="feature left">
                <div class="content">
                    <form method="post" action="bejelentkezes.php">
                        <label for="nev">Felhasználónév:</label>
                        <input type="text" name="nev" id="nev" required><br>
                        <label for="jelszo">Jelszó:</label>
                        <input type="password" name="jelszo" id="jelszo" required><br>
                        <input type="submit" value="Bejelentkezek">
                    </form>
                    <p><?php echo $message; ?></p>
                </div>
            </section>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/web2EAPHP/assets/js/jquery.min.js"></script>
    <script src="/web2EAPHP/assets/js/browser.min.js"></script>
    <script src="/web2EAPHP/assets/js/breakpoints.min.js"></script>
    <script src="/web2EAPHP/assets/js/util.js"></script>
    <script src="/web2EAPHP/assets/js/main.js"></script>

</body>
</html>

<?php include __DIR__ . '/footer.php'; ?>
