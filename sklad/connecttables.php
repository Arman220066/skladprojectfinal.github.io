<?php
session_start();
require_once 'db.php'; // Подключение к базе данных

$userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : 'Администратор';

// Проверка подключения к базе данных
if (!isset($pdo) || !$pdo) {
    die('Ошибка подключения к базе данных. Проверьте файл db.php.');
}

// Функция для получения данных с помощью параметризованных запросов
function getJoinedData($pdo, $query, $params = []) {
    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Ошибка выполнения запроса: ' . $e->getMessage());
    }
}

// Запросы JOIN для таблиц
$innerJoinQuery = "SELECT Sales.SaleID, Sales.SaleDate, Customers.CustomerName, Products.ProductName, SaleDetails.Quantity, SaleDetails.Price
                    FROM Sales
                    INNER JOIN SaleDetails ON Sales.SaleID = SaleDetails.SaleID
                    INNER JOIN Products ON SaleDetails.ProductID = Products.ProductID
                    INNER JOIN Customers ON Sales.CustomerID = Customers.CustomerID;";

$leftJoinQuery = "SELECT Customers.CustomerID, Customers.CustomerName, Sales.SaleID, Sales.SaleDate
                   FROM Customers
                   LEFT JOIN Sales ON Customers.CustomerID = Sales.CustomerID;";

$rightJoinQuery = "SELECT Products.ProductID, Products.ProductName, SaleDetails.Quantity
                    FROM Products
                    RIGHT JOIN SaleDetails ON Products.ProductID = SaleDetails.ProductID;";

// Выполнение запросов
$innerJoinData = getJoinedData($pdo, $innerJoinQuery);
$leftJoinData = getJoinedData($pdo, $leftJoinQuery);
$rightJoinData = getJoinedData($pdo, $rightJoinQuery);

// Определение текущего вида отображения данных
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['showInnerJoin'])) {
        $currentView = 'showInnerJoin';
    } elseif (isset($_POST['showLeftJoin'])) {
        $currentView = 'showLeftJoin';
    } elseif (isset($_POST['showRightJoin'])) {
        $currentView = 'showRightJoin';
    }
} else {
    // Установка вида по умолчанию
    $currentView = 'showInnerJoin';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обзор данных продаж</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<header class="p-3 bg-dark text-white text-center">
    <h1>Складская система магазина технологий</h1>
    <p>Пользователь: <?= htmlspecialchars($userName) ?></p>
</header>
<div class="container mt-4">
    <h2>Обзор данных продаж</h2>
    <form method="post" class="mb-3">
        <button name="showInnerJoin" type="submit" class="btn btn-primary me-2">Все продажи</button>
        <button name="showLeftJoin" type="submit" class="btn btn-secondary me-2">Клиенты и их заказы</button>
        <button name="showRightJoin" type="submit" class="btn btn-success me-2">Все товары</button>
        <a href="dashboard.php" class="btn btn-info me-2">Управление складом</a>
    </form>

    <div>
        <?php
        if ($currentView === 'showInnerJoin') {
            echo '<h3>Список всех продаж, включая данные о клиенте и продуктах</h3>';
            echo '<table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID продажи</th>
                            <th>Дата продажи</th>
                            <th>Имя клиента</th>
                            <th>Название продукта</th>
                            <th>Количество</th>
                            <th>Цена</th>
                        </tr>
                    </thead>
                    <tbody>';
            foreach ($innerJoinData as $row) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . htmlspecialchars($value) . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
        }

        if ($currentView === 'showLeftJoin') {
            echo '<h3>Список всех клиентов, включая тех, кто еще не сделал покупку</h3>';
            echo '<table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID клиента</th>
                            <th>Имя клиента</th>
                            <th>ID продажи</th>
                            <th>Дата продажи</th>
                        </tr>
                    </thead>
                    <tbody>';
            foreach ($leftJoinData as $row) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . htmlspecialchars($value) . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
        }

        if ($currentView === 'showRightJoin') {
            echo '<h3>Список всех товаров, даже если они не были проданы</h3>';
            echo '<table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID товара</th>
                            <th>Название товара</th>
                            <th>Количество</th>
                        </tr>
                    </thead>
                    <tbody>';
            foreach ($rightJoinData as $row) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . htmlspecialchars($value) . '</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table>';
        }
        ?>
    </div>
</div>
</body>
</html>