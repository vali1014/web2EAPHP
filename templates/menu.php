<?php
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
$sql = "SELECT id, nev, link, parent_id FROM menunevek";
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

function renderMenu($menu) {
    echo '<nav class="menu"><ul>';
    foreach ($menu as $item) {
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
    echo '</ul></nav>';
}

renderMenu($menu);

$conn->close();
?>
