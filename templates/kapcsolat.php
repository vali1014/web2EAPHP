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
        <p>Elérhetőségeink.</p>
    </div>

    <!-- Main -->
    <div id="main">
        <header class="major container medium">
            <h2>Elérhetőségeink</h2>
        </header>

        <div class="box alt container">
            <section class="feature left">
                <div class="content">
                    <h3>EgyikNév</h3>
                    <p>NEPTUNKÓD</p>
                    <p>EMAILCÍM</p>
                </div>
            </section>
            <section class="feature left">
                <div class="content">
                    <h3>MásikNév</h3>
                    <p>NEPTUNKÓD</p>
                    <p>EMAILCÍM</p>
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
