
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>
<h2>Произошла Ошибка</h2>
<p><b>Код ошибки: </b><?= $errno ?></p>
<p><b>Текст ошибки: </b><?= $errstr ?></p>
<p><b>Файл, в котором произошла ошибка: </b><?= $errfile ?></p>
<p><b>Строка, в которой произошла ошибка: </b><?= $errline ?></p>
</body>
</html>