<?php
    $requestUrlPath = $_SERVER['REQUEST_URI'];
    $isHome = $requestUrlPath == 'web2EAPHP' || $requestUrlPath == '/web2EAPHP/' || str_contains($requestUrlPath, 'index');
    require_once ( $isHome ? '' : '../' ) . 'config/config.php';
?>
<?php include __DIR__ . '/menu.php'; ?>
