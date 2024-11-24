<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $dsn = 'sqlite:' . __DIR__ . '/szeleromuvek.db';
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Adatbázis kapcsolat sikeres.\n";

    // Teszt lekérdezés
    $stmt = $pdo->query('SELECT * FROM megye');
    $megyek = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Megyék:\n";
    print_r($megyek);
} catch (PDOException $e) {
    echo 'Hiba: ' . $e->getMessage();
}
?>
