<?php
$title = "Rólunk";
include __DIR__ . '/header.php';
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

        <div class="box alt container">
            <section class="feature left">
                <div class="content">
                    <h3>Készítették:</h3>
                    <p class="text-muted">Nevek</p>
                    <p class="text-muted">Neumann János Egyetem, Kecskemét</p>
                </div>
            </section>
            <section class="feature right">
                <div class="content">
                    <h3>Választott adatbázis:</h3>
                    <p class="text-muted">Szélerőművek</p>
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

<?php include __DIR__ . '/footer.php'; ?>
