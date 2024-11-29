<?php

require_once '../config/config.php';

$conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            getMegye($_GET['id'], $conn);
        } else {
            listMegyek($conn);
        }
        break;
    default:
        echo json_encode(["message" => "Hibás kérés metódus"]);
        break;
}

function getMegye($id, $conn) {
    $result = $conn->query("SELECT * FROM megye WHERE id = $id");
    $data = $result->fetch_assoc();
    echo json_encode($data);
}


function listMegyek($conn) {
    $result = $conn->query("SELECT * FROM megye");
    $helyszinek = [];
    while ($row = $result->fetch_assoc()) {
        $helyszinek[] = $row;
    }
    echo json_encode($helyszinek);
}

$conn->close();
