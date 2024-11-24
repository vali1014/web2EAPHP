<?php
$title = "Kapcsolat";
include __DIR__ . '/header.php';
include __DIR__ . '/../api/db.php';
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
        <h1>Kapcsolat</h1>
        <p>Elérhetőségeink és kapcsolatfelvételi űrlap.</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Keresési és lekérdezési lehetőségek</h2>
        </header>

        <div class="box alt container">
            <section class="feature left">
                <div class="content">
                    <h3>Keresés megyék szerint</h3>
                    <form id="megyeForm">
                        <label for="megye">Megye:</label>
                        <select name="megye" id="megye">
                            <?php
                            $sql = "SELECT id, nev FROM megye";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nev'] . "</option>";
                            }
                            ?>
                        </select>
                        <button type="submit">Keresés</button>
                    </form>
                </div>
            </section>

            <section class="feature right">
                <div class="content">
                    <h3>Keresés helyszínek szerint</h3>
                    <form id="helyszinForm">
                        <label for="helyszin">Helyszín:</label>
                        <select name="helyszin" id="helyszin">
                            <?php
                            $sql = "SELECT id, nev FROM helyszin";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nev'] . "</option>";
                            }
                            ?>
                        </select>
                        <button type="submit">Keresés</button>
                    </form>
                </div>
            </section>

            <section class="feature left">
                <div class="content">
                    <h3>Keresés tornyok szerint</h3>
                    <form id="toronyForm">
                        <label for="torony">Torony:</label>
                        <select name="torony" id="torony">
                            <?php
                            $sql = "SELECT id, darab FROM torony";
                            $result = $pdo->query($sql);
                            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['darab'] . "</option>";
                            }
                            ?>
                        </select>
                        <button type="submit">Keresés</button>
                    </form>
                </div>
            </section>
        </div>

        <div class="box alt container">
            <section class="feature left">
                <div class="content">
                    <div id="results"></div>
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
    <script>
        document.getElementById('megyeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const megyeId = document.getElementById('megye').value;
            fetch(`../api/api.php?endpoint=helyszinek&megyeid=${megyeId}`)
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('results');
                    resultsDiv.innerHTML = '<h3>Helyszínek a kiválasztott megyében:</h3>' + JSON.stringify(data, null, 2);
                });
        });

        document.getElementById('helyszinForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const helyszinId = document.getElementById('helyszin').value;
            fetch(`../api/api.php?endpoint=tornyok&helyszinid=${helyszinId}`)
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('results');
                    resultsDiv.innerHTML = '<h3>Tornyok a kiválasztott helyszínen:</h3>' + JSON.stringify(data, null, 2);
                });
        });

        document.getElementById('toronyForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const toronyId = document.getElementById('torony').value;
            fetch(`../api/api.php?endpoint=torony&id=${toronyId}`)
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('results');
                    resultsDiv.innerHTML = '<h3>Kiválasztott torony részletei:</h3>' + JSON.stringify(data, null, 2);
                });
        });
    </script>
</body>
</html>

<?php include __DIR__ . '/footer.php'; ?>
