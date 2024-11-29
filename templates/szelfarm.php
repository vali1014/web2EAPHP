<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$title = "Szélfarm";
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
    <?php include __DIR__ . '/header.php'; ?>

    <!-- Header -->
    <div id="header">
        <span class="logo icon fa-paper-plane"></span>
        <h1>Szélfarm</h1>
        <p>Információk a szélfarmokról.</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Ismerd meg a szélfarmok működését és előnyeit!</h2>
        </header>

        <div class=" container box">
            <section class="feature right">
                <a href="#" class="image icon solid fa-info"><img src="/web2EAPHP/images/pic01.jpg" alt="" /></a>
                <div class="content">
                    <h3>Szélfarmok</h3>
                    <p>A szélfarmok olyan területek, ahol több szélturbina együttesen termel elektromos áramot.</p>
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

</body>
</html>
