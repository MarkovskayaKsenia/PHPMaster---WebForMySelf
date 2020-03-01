<!doctype html>
<html lang='ru'>
<head>
    <meta charset="UTF-8">
    <?= $meta ?>
</head>
<body>
<h1>Подложка DEFAULT</h1>
<?= $content ?>
<?php
$logs = \R::getDatabaseAdapter()
    ->getDatabase()
    ->getLogger();

debug( $logs->grep( 'SELECT' ) );
?>
</body>
</html>
