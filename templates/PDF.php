<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/config.php";

error_reporting(0);
ob_start();
require_once '../TCPDF/tcpdf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_regio = $_POST['regio'];
    $selected_helyszin = $_POST['helyszin'];
    $selected_toronyszam = $_POST['toronyszam'];

    // Kapcsolódás az adatbázishoz
    $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Régiók lekérése
    $regio_query = "SELECT id, nev, regio FROM megye WHERE regio = '$selected_regio'";
    $regio_result = $conn->query($regio_query);

    // Helyszínek lekérése
    $helyszin_query = "SELECT id, nev, megyeid FROM helyszin WHERE nev = '$selected_helyszin'";
    $helyszin_result = $conn->query($helyszin_query);

    // Toronyszámok lekérése
    $torony_query = "SELECT darab, teljesitmeny, kezdev, helyszinid FROM torony WHERE darab = '$selected_toronyszam'";
    $torony_result = $conn->query($torony_query);

    // PDF generálása
    $pdf = new TCPDF();
    $pdf->AddPage();

    // Fejléc
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'PDF generáló eredmények', 0, 1, 'C');

    // Régió adatok hozzáadása
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Régió: ' . $selected_regio, 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    while ($row = $regio_result->fetch_assoc()) {
        $pdf->MultiCell(0, 10, "ID: " . $row['id'] . ", Név: " . $row['nev'] . ", Régió: " . $row['regio']);
    }

    // Helyszín adatok hozzáadása
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Helyszín: ' . $selected_helyszin, 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    while ($row = $helyszin_result->fetch_assoc()) {
        $pdf->MultiCell(0, 10, "ID: " . $row['id'] . ", Név: " . $row['nev'] . ", Megye ID: " . $row['megyeid']);
    }

    // Toronyszám adatok hozzáadása
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Toronyszám: ' . $selected_toronyszam, 0, 1, 'L');
    $pdf->SetFont('helvetica', '', 12);
    while ($row = $torony_result->fetch_assoc()) {
        $pdf->MultiCell(0, 10, "Darab: " . $row['darab'] . ", Teljesítmény: " . $row['teljesitmeny'] . ", Kezdés éve: " . $row['kezdev'] . ", Helyszín ID: " . $row['helyszinid']);
    }

    // PDF mentése és letöltése
    ob_end_clean();
    $pdf->Output('generated_pdf.pdf', 'D');

    $conn->close();
    exit;
}

$title = "PDF";
include __DIR__ . '/header.php';

// Kapcsolódás az adatbázishoz
$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Régiók lekérése
$regio_query = "SELECT DISTINCT regio FROM megye";
$regio_result = $conn->query($regio_query);

// Helyszínek lekérése
$helyszin_query = "SELECT nev FROM helyszin";
$helyszin_result = $conn->query($helyszin_query);

// Toronyszámok lekérése
$torony_query = "SELECT DISTINCT darab FROM torony";
$torony_result = $conn->query($torony_query);
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/style.css">
    <style>
        .container-box {
            max-width: 800px;
            margin: 40px auto;
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9); /* Átlátszó háttér */
            padding-left: 20px; /* Belső margó bal oldalon */
            padding-right: 20px; /* Belső margó jobb oldalon */
        }

        form {
            padding: 20px; /* Belső margó a form elemekhez */
        }

        form label, form select, form input[type="submit"] {
            display: block;
            margin-bottom: 10px;
            width: calc(100% - 40px); /* Szélesség csökkentése, hogy ne érjen a széléig */
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body class="is-preload">

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>PDF</h1>
        <p>Üdvözöljük a PDF oldalán!</p>
    </div>

    <!-- Main -->
    <div id="main" class="container-box">
        <header class="major container medium">
            <h2>PDF generáló</h2>
        </header>

        <!-- Lenyíló listák -->
        <form method="post" action="">
            <label for="regio">Régió:</label>
            <select name="regio" id="regio">
                <?php while($row = $regio_result->fetch_assoc()): ?>
                    <option value="<?php echo $row['regio']; ?>"><?php echo $row['regio']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="helyszin">Helyszín:</label>
            <select name="helyszin" id="helyszin">
                <?php while($row = $helyszin_result->fetch_assoc()): ?>
                    <option value="<?php echo $row['nev']; ?>"><?php echo $row['nev']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="toronyszam">Toronyszám:</label>
            <select name="toronyszam" id="toronyszam">
                <?php while($row = $torony_result->fetch_assoc()): ?>
                    <option value="<?php echo $row['darab']; ?>"><?php echo $row['darab']; ?></option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Generálás">
        </form>
    </div>

    <!-- Scripts -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/browser.min.js"></script>
    <script src="/assets/js/breakpoints.min.js"></script>
    <script src="/assets/js/util.js"></script>
    <script src="/assets/js/main.js"></script>

</body>
</html>
