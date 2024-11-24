<?php
$options = [
    'uri' => 'http://localhost/web2EAPHP/soap/soap_server.php',
    'location' => 'http://localhost/web2EAPHP/soap/soap_server.php'
];

$client = new SoapClient(null, $options);

try {
    // Megyék lekérdezése
    $megyek = $client->getMegyek();
    echo "Megyék:\n";
    print_r($megyek);

    // Helyszínek lekérdezése az 1-es megyében
    $helyszinek = $client->getHelyszinek(1); // Példa megye ID
    echo "Helyszínek az 1-es megyében:\n";
    print_r($helyszinek);

    // Tornyok lekérdezése az 1-es helyszínen
    $tornyok = $client->getTornyok(1); // Példa helyszín ID
    echo "Tornyok az 1-es helyszínen:\n";
    print_r($tornyok);
} catch (SoapFault $e) {
    echo 'Hiba: ' . $e->getMessage();
}
?>
