<?php
$options = [
    'uri' => 'http://localhost/web2EAPHP/soap/soap_server.php',
    'location' => 'http://localhost/web2EAPHP/soap/soap_server.php'
];

$client = new SoapClient(null, $options);

try {
    // Megyék lekérdezése
    $megyek = $client->getMegyek();
    echo "Megyék:<br/>";
    print_r($megyek);
    echo "<br/>";

    // Helyszínek lekérdezése az 1-es megyében
    $helyszinek = $client->getHelyszinek(1); // Példa megye ID
    echo "Helyszínek az 1-es megyében:<br/>";
    print_r($helyszinek);
    echo "<br/>";

    // Tornyok lekérdezése az 1-es helyszínen
    $tornyok = $client->getTornyok(1); // Példa helyszín ID
    echo "Tornyok az 1-es helyszínen:<br/>";
    print_r($tornyok);
    echo "<br/>";
} catch (SoapFault $e) {
    echo 'Hiba: ' . $e->getMessage();
}
?>
