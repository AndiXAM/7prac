<?php
$conn = new mysqli('db', 'user', 'password', 'shop_db');

if ($conn->connect_error) {
    die('Ошибка подключения: ' . $conn->connect_error);
}

// Определяем количество товаров на странице
$itemsPerPage = 3;

// Получаем текущую страницу из параметров URL (по умолчанию 1)
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Получаем общее количество товаров
$totalResult = $conn->query('SELECT COUNT(*) as count FROM products');
$totalRow = $totalResult->fetch_assoc();
$totalItems = $totalRow['count'];
$totalPages = ceil($totalItems / $itemsPerPage);

// Получаем товары для текущей страницы
$sql = "SELECT product_name, price FROM products LIMIT $itemsPerPage OFFSET $offset";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["postman"])) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo '<!DOCTYPE html>';
    echo '<html lang="ru">';
    echo '<head>';
    echo '    <meta charset="UTF-8">';
    echo '    <title>Товары</title>';
    echo '    <style>';
    echo '        body {';
    echo '            font-family: Arial, sans-serif;';
    echo '            background-color: #f4f4f4;';
    echo '            margin: 0;';
    echo '            padding: 20px;';
    echo '        }';
    
    echo '        h1 {';
    echo '            color: #333;';
    echo '            text-align: center;';
    echo '        }';
    
    echo '        .container {';
    echo '            max-width: 800px;';
    echo '            margin: auto;';
    echo '            background: white;';
    echo '            padding: 20px;';
    echo '            border-radius: 8px;';
    echo '            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);';
    echo '        }';
    
    echo '        ul {';
    echo '            list-style-type: none;';
    echo '            padding: 0;';
    echo '        }';
    
    echo '        li {';
    echo '            padding: 10px;';
    echo '            border-bottom: 1px solid #ccc;';
    echo '            display: flex;'; // Используем flexbox для выравнивания
    echo '            align-items: center;'; // Выравнивание по центру по вертикали
    echo '        }';
    
   // Стили для изображения
   echo '        .product-image {';
   echo '            width: 100px;'; // Ширина изображения
   echo '            height: auto;'; // Автоматическая высота
   echo '            margin-right: 15px;'; // Отступ справа от изображения
   echo '        }';
    
   // Пагинация
   echo '        .pagination {';
   echo '            text-align: center;';
   echo '            margin-top: 20px;';
   echo '        }';
    
   // Стили для ссылок пагинации
   echo '        .pagination a {';
   echo '            margin: 0 5px;';
   echo '            text-decoration: none;';
   echo '            color: #007bff;';
   echo '        }';
    
   // Эффект при наведении на ссылки пагинации
   echo '        .pagination a:hover {';
   echo '            text-decoration: underline;';
   echo '        }';

   // Текущая страница выделена
   echo '        .pagination strong {';
   echo '            margin: 0 5px;';
   echo '            color: #333;';
   echo '        }';

   // Сообщение о том, что нет доступных товаров
   echo '        .no-products {';
   echo '            text-align: center;';
   echo '            font-size: 18px;';
   echo '            color: #999;';
   echo '        }';

   // Закрываем теги стилей
   echo '</style>';
    
   // Закрываем теги head и открываем body
   echo '</head>';
    
   // Начинаем тело документа
   echo '<body>';
    
   // Контейнер для содержимого
   echo '<div class="container">';
    
   // Заголовок страницы
   if ($result->num_rows > 0) {
       // Список товаров
       while($row = $result->fetch_assoc()) {
           // Название и цена товара
           $productName = htmlspecialchars($row['product_name']); // Название товара
           $price = htmlspecialchars($row['price']); // Цена товара

           // Определяем путь к изображению в зависимости от названия товара
            if (stripos($productName, "Cement") !== false) {
                $imagePath = "productimage2.jpg"; // Путь к изображению для "Cement"
            } elseif (stripos($productName, "brick") !== false) {
                $imagePath = "productimage1.jpg"; // Путь к изображению для "brick"
            } else {
                $imagePath = "productimage0.jpg"; // Путь к изображению по умолчанию
            }

           printf('<li><img src="%s" alt="%s" class="product-image">%s - <strong>%s</strong> руб.</li>', 
               htmlspecialchars($imagePath), 
               $productName, 
               $productName, 
               $price);
       }
        
       // Пагинация
       if ($totalPages > 1) {
           // Блок пагинации
           echo '<div class="pagination">';
           for ($i = 1; $i <= $totalPages; $i++) {
               if ($i == $currentPage) {
                   // Текущая страница выделена
                   printf("<strong>%d</strong> ", $i);
               } else {
                   // Ссылки на другие страницы
                   printf('<a href="?page=%d">%d</a> ', $i, $i);
               }
           }
           // Закрываем блок пагинации
           echo '</div>';
       }
        
       // Закрываем список товаров
       printf('</ul>'); 
        
   } else {
       // Если нет доступных товаров
       printf('<div class="no-products">Нет доступных товаров.</div>');
   }
   
   // Закрываем контейнер
   printf('</div>'); 

   // Закрываем соединение с базой данных
   $conn->close();
   
   // Закрываем тело документа и HTML
   printf('</body></html>');
}
?>