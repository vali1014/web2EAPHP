<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $dsn = 'sqlite:' . __DIR__ . '/szeleromuvek.db';
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL szkript futtatása
    $sql = <<<SQL
    CREATE TABLE IF NOT EXISTS megye (
        id INTEGER PRIMARY KEY,
        nev TEXT NOT NULL
    );

    CREATE TABLE IF NOT EXISTS helyszin (
        id INTEGER PRIMARY KEY,
        megyeid INTEGER,
        nev TEXT NOT NULL,
        FOREIGN KEY (megyeid) REFERENCES megye(id)
    );

    CREATE TABLE IF NOT EXISTS torony (
        id INTEGER PRIMARY KEY,
        darab INTEGER NOT NULL,
        teljesitmeny INTEGER NOT NULL,
        kezdev INTEGER NOT NULL,
        helyszinid INTEGER NOT NULL,
        FOREIGN KEY (helyszinid) REFERENCES helyszin(id)
    );

    INSERT INTO megye (nev) VALUES ('Példa megye');
    INSERT INTO helyszin (megyeid, nev) VALUES (1, 'Példa helyszín');
    INSERT INTO torony (helyszinid, darab, teljesitmeny, kezdev) VALUES (1, 1, 250, 2000);

    -- További adatok beszúrása itt...
    SQL;

    $pdo->exec($sql);

    echo "Táblák és adatok sikeresen létrehozva.\n";
} catch (PDOException $e) {
    echo 'Hiba: ' . $e->getMessage();
}
?>
