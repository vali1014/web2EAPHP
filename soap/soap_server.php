<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: text/xml');

class SzeleromuvekService {
    private $pdo;

    public function __construct() {
        $dsn = 'sqlite:' . __DIR__ . '/szeleromuvek.db';
        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getMegyek() {
        $stmt = $this->pdo->query('SELECT * FROM megye');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHelyszinek($megyeid) {
        $stmt = $this->pdo->prepare('SELECT * FROM helyszin WHERE megyeid = ?');
        $stmt->execute([$megyeid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTornyok($helyszinid) {
        $stmt = $this->pdo->prepare('SELECT * FROM torony WHERE helyszinid = ?');
        $stmt->execute([$helyszinid]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$options = [
    'uri' => 'http://localhost/soap_server.php',
    'location' => 'http://localhost/soap_server.php'
];

$server = new SoapServer(null, $options);
$server->setClass('SzeleromuvekService');
$server->handle();
?>
