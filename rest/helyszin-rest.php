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
            getHelyszin($_GET['id'], $conn);
        } else {
            listHelyszinek($conn);
        }
        break;
    case 'POST':
        createHelyszin($input, $conn);
        break;
    case 'PUT':
        modifyHelyszin($input, $conn);
        break;
    case 'DELETE':
        deleteHelyszin($input, $conn);
        break;
    default:
        echo json_encode(["message" => "Hibás kérés metódus"]);
        break;
}

function getHelyszin($id, $conn) {
    $result = $conn->query("SELECT * FROM helyszin WHERE id = $id");
    $data = $result->fetch_assoc();
    echo json_encode($data);
}


function listHelyszinek($conn) {
    $result = $conn->query("SELECT h.*, m.nev as megyenev FROM helyszin h join megye m on h.megyeid = m.id");
    $helyszinek = [];
    while ($row = $result->fetch_assoc()) {
        $helyszinek[] = $row;
    }
    echo json_encode($helyszinek);
}

function createHelyszin($input, $conn) {
    $nev = $input['nev'];
    $megyeid = $input['megyeid'];
    $conn->query("INSERT INTO helyszin (nev, megyeid) VALUES ('$nev', '$megyeid')");
    echo json_encode(["message" => "Helyszín sikeresen hozzáadva"]);
}

function modifyHelyszin($input, $conn) {
    $id = $input['id'];
    $nev = $input['nev'];
    $megyeid = $input['megyeid'];
    $conn->query("UPDATE helyszin SET nev='$nev',
                     megyeid='$megyeid' WHERE id=$id");
    echo json_encode(["message" => "Helyszín sikeresen módosítva"]);
}

function deleteHelyszin($input, $conn) {
    $id = $input['id'];
    $conn->query("DELETE FROM helyszin WHERE id=$id");
    echo json_encode(["message" => "Helyszín sikeresen törölve"]);
}

$conn->close();
