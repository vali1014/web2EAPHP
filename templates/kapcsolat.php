<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title = "Kapcsolat";
include __DIR__ . '/../api/db.php';
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/assets/css/kapcsolat.css" />
    <link rel="stylesheet" href="/style.css">
</head>
<body class="is-preload">
    <?php include __DIR__ . '/header.php'; ?>

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>Kapcsolat</h1>
        <p>Elérhetőségeink.</p>
    </div>

    <!-- Main -->
    <div id="main" class="container">
        <header class="major medium">
            <h2>Elérhetőségeink</h2>
        </header>

        <section class="feature left">
            <div class="content">
                <h3>Dunai Valéria</h3>
                <p>NEPTUNKÓD</p>
                <p>vali1014</p>
                <p>dunai.valeria@gmail.com</p>
            </div>
            <div class="content">
                <h3>Dunai Valéria</h3>
                <p>NEPTUNKÓD</p>
                <p>valisecond</p>
                <p>valcseszka1369@gmail.com</p>
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/browser.min.js"></script>
    <script src="/assets/js/breakpoints.min.js"></script>
    <script src="/assets/js/util.js"></script>
    <script src="/assets/js/main.js"></script>
</body>
</html>
