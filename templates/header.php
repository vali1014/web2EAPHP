<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>

<?php
    $requestUrlPath = $_SERVER['REQUEST_URI'];
    $isHome = $requestUrlPath == '' || $requestUrlPath == '/' || str_contains($requestUrlPath, 'index');
    require_once ( $isHome ? '' : '../' ) . 'config/config.php';
?>
<?php include __DIR__ . '/menu.php'; ?>
