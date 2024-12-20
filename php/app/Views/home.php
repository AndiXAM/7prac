

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
</head>
<body>
    <h1>Добро пожаловать в строительный магазин!</h1>

    <h2>Список загруженных файлов</h2>
    <?php
        
        $uploadDir = '/var/www/html/app/views/uploads/';
        if (is_dir($uploadDir)) {
            if ($files = scandir($uploadDir)) {
                foreach ($files as $file) {
                    if ($file !== '.' && $file !== '..') {
                        echo '<a href="' . '/app/views/uploads/' . urlencode($file) . '">' . htmlspecialchars($file) . '</a><br>';
                    }
                }
            }
        } else {
            echo "Не нашел uploads.";
        }
    ?>
<a href="../public/generate_fixtures">Сгенерировать фикстуры</a>

</body>
</html>