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
    <title>Helyszínek</title>
    <link rel="stylesheet" href="/assets/css/main.css" />
    <link rel="stylesheet" href="/assets/css/helyszin-szerkesztese.css" />
    <link rel="stylesheet" href="/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body class="is-preload">
<?php include __DIR__ . '/header.php';?>

<!-- Header -->
<div id="header">
    <span class="logo icon fa-paper-plane"></span>
    <h1>Helyszínek</h1>
    <p>Üdvözöljük a Helyszínek szerkesztése oldalon!</p>
</div>

<!-- Main -->
<div id="main">
    <?php
    $curl = curl_init();
    $url = $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);

    include "models.php";

    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
        $id = $query['id'];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:80/rest/helyszin-rest.php?id=' . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

        $helyszin = new Helyszin($response->id, $response->nev, $response->megyeid, null);
    } else {
      $helyszin = new Helyszin(null, "", -1, null);
    }

    $megyeCurl = curl_init();

    curl_setopt_array($megyeCurl, array(
        CURLOPT_URL => 'localhost:80/rest/megye-rest.php',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $megyeResponse = curl_exec($megyeCurl);

    curl_close($megyeCurl);
    $megyeResponse = json_decode($megyeResponse, true);

    $megyek = [];
    foreach ($megyeResponse as $m) {
        $megye = new Megye($m["id"], $m["nev"], $m["regio"]);
        array_push($megyek, $megye);
    }

    echo "<form>";
    echo "<label for='id'>Azonosító:</label>";
    echo "<input type='text' id='id' name='id' readonly value='$helyszin->id'/>";
    echo "<label for='nev'>Név:</label>";
    echo "<input type='text' id='nev' name='nev' value='$helyszin->nev'/>";
    echo "<label for='megyeid'>Megye:</label>";
    echo "<select id='megyeid' name='megyeid' value='$helyszin->megyeid'>";
    foreach ($megyek as $megye) {
        echo "<option value='$megye->id'". ( $megye->id == $helyszin->megyeid ? "selected=\"selected\"" : "") .">$megye->nev</option>";
    }
    echo "</select>";
    echo "<input type='submit' id='submitButton'/>";
    echo "</form>";
    ?>
</div>

<!-- Scripts -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/browser.min.js"></script>
<script src="/assets/js/breakpoints.min.js"></script>
<script src="/assets/js/util.js"></script>
<script src="/assets/js/main.js"></script>

<script>
    $(document).ready(() => {
        $('#submitButton').click( ev => {
            ev.preventDefault();
            const form = $('form')[0];
            const id = $(form).find("#id").val();

            if (id !== '') {
                $.ajax({
                    url: 'http://localhost:80/rest/helyszin-rest.php',
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "id": id,
                        "nev": $(form).find("#nev").val(),
                        "megyeid": $(form).find("#megyeid").val()
                    })
                });
            } else {
                $.post('http://localhost:80/rest/helyszin-rest.php',
                    JSON.stringify({
                        "id": null,
                        "nev": $(form).find("#nev").val(),
                        "megyeid": $(form).find("#megyeid").val()
                    })
                );
            }

            location.href = "helyszin.php"
        });
    });
</script>

</body>
</html>
