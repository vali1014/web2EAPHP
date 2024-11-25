<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Rólunk";
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/style.css">
</head>
<body class="is-preload">
    <?php include __DIR__ . '/header.php'; ?>

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>Rólunk</h1>
        <p>Üdvözöljük a projektünk oldalán!</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Webalkalmazásunkat a Web-Programozás II. kurzus sikeres teljesítéséhez készítettük.
            <br />
            Projektünk a magyarországi szélerőművekkel foglalkozik.</h2>
        </header>

        <div class="container box">
            <section class="feature right">
                <a href="#" class="image icon solid fa-user-friends"><img src="/images/pic01.jpg" alt="" /></a>
                <div class="content">
                    <h3>Készítették:</h3>
                    <p class="text-muted">Dunai Valéria</p>
                    <p class="text-muted">Neumann János Egyetem, Kecskemét</p>
                </div>
            </section>
            <section class="feature left">
                <a href="#" class="image icon solid fa-database"><img src="/images/pic02.jpg" alt="" /></a>
                <div class="content">
                    <h3>Választott adatbázis:</h3>
                    <p class="text-muted">Szélerőművek</p>
                </div>
            </section>
        </div>

    </div>

    <!-- Scripts -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/browser.min.js"></script>
    <script src="/assets/js/breakpoints.min.js"></script>
    <script src="/assets/js/util.js"></script>
    <script src="/assets/js/main.js"></script>

</body>
</html>
