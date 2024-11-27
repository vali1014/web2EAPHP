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
    <link rel="stylesheet" href="/assets/css/helyszin.css" />
    <link rel="stylesheet" href="/style.css">
</head>
<body class="is-preload">
<?php include __DIR__ . '/header.php';?>

<!-- Header -->
<div id="header">
    <span class="logo icon fa-paper-plane"></span>
    <h1>Helyszínek</h1>
    <p>Üdvözöljük a Helyszínek oldalán!</p>
</div>

<!-- Main -->
<div id="main">
    <?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'localhost:80/rest/helyszin-rest.php',
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
        $response = json_decode($response, true);

        include "models.php";
        $helyszinek = [];

        foreach ($response as $h) {
          $helyszin = new Helyszin($h["id"], $h["nev"], $h["megyeid"], $h["megyenev"]);
          array_push($helyszinek, $helyszin);
        }

        echo "<button id='addNew' class='button'>Új hozzáadása</button>";

        // helyszínek megjelenítése
        echo "<table class='table default' border='1'>";
        echo "<thead><tr><th>Id</th><th>Név</th><th>Megyenév</th><th>Akciók</th></tr></thead>";
        echo "<tbody>";
        foreach ($helyszinek as $h) {
            echo "<tr>
                    <td>".$h->id."</td>
                    <td>".$h->nev."</td>
                    <td>".$h->megyenev."</td>
                    <td>
                        <button class='icon solid fa-edit edit' h-id='".$h->id."'></button>
                        <button class='icon solid fa-times delete' h-id='".$h->id."'></button>
                    </td>
                </tr>";
        }
        echo "</tbody></table>";
    ?>
</div>

<!-- Scripts -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/browser.min.js"></script>
<script src="/assets/js/breakpoints.min.js"></script>
<script src="/assets/js/util.js"></script>
<script src="/assets/js/main.js"></script>
<script>
    (function() {
        const addNewButton = document.getElementById("addNew");
        addNewButton.addEventListener('click', redirectInit, false);

        const editButtons = document.getElementsByClassName('edit');
        for (let i = 0; i < editButtons.length; i++) {
            editButtons[i].addEventListener('click', redirect, false);
        }

        const deleteButtons = document.getElementsByClassName('delete');
        for (let i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].addEventListener('click', deleteAndRefresh, false);
        }

        function redirectInit() {
            window.location.href = "helyszin-szerkesztes.php";
        }

        function deleteAndRefresh(ev) {
            let id = ev.target.attributes['h-id'].value;
            $.ajax({
                url: 'http://localhost:80/rest/helyszin-rest.php',
                type: 'DELETE',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    "id": id
                })
            });
            window.location.href = "helyszin.php";
        }

        function redirect(ev) {
            let id = ev.target.attributes['h-id'].value;
            window.location.href = "helyszin-szerkesztes.php?id=" + id;
        }
  })();
</script>

</body>
</html>
