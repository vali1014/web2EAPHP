<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE HTML>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>Szélerőművek</title>
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="style.css">
</head>
<body class="is-preload">
    <?php include __DIR__ . '/templates/header.php';?>

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>Szélerőművek</h1>
        <p>Üdvözöljük a Szélerőművek oldalán!</p>
    </div>

    <!-- Main -->
    <div id="main">
        <!-- Include the menu and szeleromuvek.php content -->
        <?php include __DIR__ . '/templates/szeleromuvek-tartalom.php';?>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
