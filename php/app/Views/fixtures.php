<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сгенерированные фикстуры</title>
</head>
<body>
    <h1>Сгенерированные фикстуры</h1>
    <a href="/public/generate_chart">Сгенерировать график</a>
    <?php if (!empty($fixtures)): ?>
        <ul>
            <?php foreach ($fixtures as $fixture): ?>
                <li>
                    <strong>Название:</strong> <?= htmlspecialchars($fixture['product_name']) ?><br>
                    <strong>Цена:</strong> <?= htmlspecialchars($fixture['price']) ?> руб.<br>
                    <strong>Категория:</strong> <?= htmlspecialchars($fixture['category']) ?><br>
                    <strong>На складе:</strong> <?= htmlspecialchars($fixture['stock']) ?><br>
                    <strong>Описание:</strong> <?= htmlspecialchars($fixture['description']) ?><br>
                    <hr>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Фикстуры не найдены.</p>
    <?php endif; ?>
</body>
</html>