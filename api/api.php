<?php
require 'db.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'] ?? '';

try {
    switch ($method) {
        case 'GET':
            handleGetRequest($endpoint, $pdo);
            break;
        case 'POST':
            handlePostRequest($endpoint, $pdo);
            break;
        case 'PUT':
            handlePutRequest($endpoint, $pdo);
            break;
        case 'DELETE':
            handleDeleteRequest($endpoint, $pdo);
            break;
        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Server Error', 'error' => $e->getMessage()]);
}

function handleGetRequest($endpoint, $pdo) {
    if ($endpoint === 'megyek') {
        $stmt = $pdo->query('SELECT * FROM megye');
        $megyek = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($megyek);
    } elseif ($endpoint === 'helyszinek') {
        $megyeid = $_GET['megyeid'] ?? null;
        if ($megyeid) {
            $stmt = $pdo->prepare('SELECT * FROM helyszin WHERE megyeid = ?');
            $stmt->execute([$megyeid]);
        } else {
            $stmt = $pdo->query('SELECT * FROM helyszin');
        }
        $helyszinek = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($helyszinek);
    } elseif ($endpoint === 'tornyok') {
        $helyszinid = $_GET['helyszinid'] ?? null;
        if ($helyszinid) {
            $stmt = $pdo->prepare('SELECT * FROM torony WHERE helyszinid = ?');
            $stmt->execute([$helyszinid]);
        } else {
            $stmt = $pdo->query('SELECT * FROM torony');
        }
        $tornyok = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tornyok);
    }
}

function handlePostRequest($endpoint, $pdo) {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($endpoint === 'megyek') {
        $stmt = $pdo->prepare('INSERT INTO megye (nev, regio) VALUES (?, ?)');
        $stmt->execute([$data['nev'], $data['regio']]);
        echo json_encode(['message' => 'Megye létrehozva']);
    } elseif ($endpoint === 'helyszinek') {
        $stmt = $pdo->prepare('INSERT INTO helyszin (nev, megyeid) VALUES (?, ?)');
        $stmt->execute([$data['nev'], $data['megyeid']]);
        echo json_encode(['message' => 'Helyszín létrehozva']);
    } elseif ($endpoint === 'tornyok') {
        $stmt = $pdo->prepare('INSERT INTO torony (darab, teljesitmeny, kezdev, helyszinid) VALUES (?, ?, ?, ?)');
        $stmt->execute([$data['darab'], $data['teljesitmeny'], $data['kezdev'], $data['helyszinid']]);
        echo json_encode(['message' => 'Torony létrehozva']);
    }
}

function handlePutRequest($endpoint, $pdo) {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($endpoint === 'megyek') {
        $stmt = $pdo->prepare('UPDATE megye SET nev = ?, regio = ? WHERE id = ?');
        $stmt->execute([$data['nev'], $data['regio'], $data['id']]);
        echo json_encode(['message' => 'Megye frissítve']);
    } elseif ($endpoint === 'helyszinek') {
        $stmt = $pdo->prepare('UPDATE helyszin SET nev = ?, megyeid = ? WHERE id = ?');
        $stmt->execute([$data['nev'], $data['megyeid'], $data['id']]);
        echo json_encode(['message' => 'Helyszín frissítve']);
    } elseif ($endpoint === 'tornyok') {
        $stmt = $pdo->prepare('UPDATE torony SET darab = ?, teljesitmeny = ?, kezdev = ?, helyszinid = ? WHERE id = ?');
        $stmt->execute([$data['darab'], $data['teljesitmeny'], $data['kezdev'], $data['helyszinid'], $data['id']]);
        echo json_encode(['message' => 'Torony frissítve']);
    }
}

function handleDeleteRequest($endpoint, $pdo) {
    $id = $_GET['id'] ?? null;
    if ($endpoint === 'megyek' && $id) {
        $stmt = $pdo->prepare('DELETE FROM megye WHERE id = ?');
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Megye törölve']);
    } elseif ($endpoint === 'helyszinek' && $id) {
        $stmt = $pdo->prepare('DELETE FROM helyszin WHERE id = ?');
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Helyszín törölve']);
    } elseif ($endpoint === 'tornyok' && $id) {
        $stmt = $pdo->prepare('DELETE FROM torony WHERE id = ?');
        $stmt->execute([$id]);
        echo json_encode(['message' => 'Torony törölve']);
    }
}
?>
