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

// Menüpontok lekérése
$sql = "SELECT id, nev, link, parent_id, megjelenik FROM menunevek";
$result = $conn->query($sql);

$menu = [];
while ($row = $result->fetch_assoc()) {
    if ($row['parent_id'] == NULL) {
        $menu[$row['id']] = $row;
        $menu[$row['id']]['children'] = [];
    } else {
        if (isset($menu[$row['parent_id']])) {
            $menu[$row['parent_id']]['children'][] = $row;
        }
    }
}

if (!function_exists('renderMenu')) {
    function renderMenu($menu) {
        echo '<nav class="menu"><ul>';
        foreach ($menu as $item) {
            $show_item = false;
            if ($item['megjelenik'] == 'mindig') {
                $show_item = true;
            } elseif ($item['megjelenik'] == 'bejelentkezve' && isset($_SESSION['nev'])) {
                $show_item = true;
            } elseif ($item['megjelenik'] == 'kijelentkezes' && !isset($_SESSION['nev'])) {
                $show_item = true;
            }

            if ($show_item) {
                echo '<li>';
                echo '<a href="/web2EAPHP/templates/' . $item['link'] . '">' . $item['nev'] . '</a>';
                if (!empty($item['children'])) {
                    echo '<ul>';
                    foreach ($item['children'] as $child) {
                        echo '<li><a href="/web2EAPHP/templates/' . $child['link'] . '">' . $child['nev'] . '</a></li>';
                    }
                    echo '</ul>';
                }
                echo '</li>';
            }
        }
        echo '</ul></nav>';
    }
}

renderMenu($menu);

$conn->close();
?>
