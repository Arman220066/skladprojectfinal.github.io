<?php
session_start();

if (empty($_SESSION['authenticated'])) {
    header('Location: login.php');
    exit;
}

require_once 'db.php'; // Подключение к базе данных

// Получение имени пользователя
$userName = $_SESSION['username'] ?? 'admin';

// Список доступных таблиц
$tables = ["suppliers", "products", "customers", "sales", "saledetails", "payments", "suppliers_products"];

// Текущая таблица
$currentTable = $_GET['table'] ?? $tables[0];
$sortColumn   = $_GET['sort']  ?? null;
$searchKeyword= $_GET['search']?? '';
$idSearch     = $_GET['id_search'] ?? null;

// Данные текущей таблицы
$data = [];
$columns = [];

// Функция для получения данных таблицы
function getTableData($pdo, $currentTable, $columns, $searchKeyword, $sortColumn, $idSearch) {
    $data = [];
    $params = [];

    try {
        // Запрос для получения всех колонок таблицы
        $stmt = $pdo->prepare("SELECT column_name FROM information_schema.columns WHERE table_name = LOWER(?)");
        $stmt->execute([strtolower($currentTable)]);
        $columnsInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $columns = array_column($columnsInfo, 'column_name');

        // Формирование основного запроса
        $query = "SELECT * FROM \"$currentTable\"";

        // Добавление фильтрации по ключевому слову
        if (!empty($searchKeyword)) {
            $searchConditions = [];
            foreach ($columns as $column) {
                $searchConditions[] = "\"$column\"::TEXT ILIKE ?";
                $params[] = "%$searchKeyword%";
            }
            $query .= " WHERE " . implode(" OR ", $searchConditions);
        }

        // Фильтрация по ID
        if (!empty($idSearch)) {
            $idColumn = $columns[0];
            $query .= !empty($searchKeyword) ? " AND \"$idColumn\" = ?" : " WHERE \"$idColumn\" = ?";
            $params[] = $idSearch;
        }

        // Сортировка
        if ($sortColumn && in_array($sortColumn, $columns)) {
            $query .= " ORDER BY \"$sortColumn\"";
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Ошибка: " . htmlspecialchars($e->getMessage()) . "</div>";
    }

    return [$data, $columns];
}

// Получение данных для отображения
list($data, $columns) = getTableData($pdo, $currentTable, $columns, $searchKeyword, $sortColumn, $idSearch);

// Aggregation queries for different tables
$aggregations = [
    'suppliers' => [
        'total_suppliers' => 'SELECT COUNT(supplierid) AS TotalSuppliers FROM suppliers;',
    ],
    'products' => [
        'total_stock_quantity' => 'SELECT SUM(StockQuantity) AS TotalStockQuantity FROM Products;',
        'average_price'        => 'SELECT AVG(Price) AS AveragePrice FROM Products;',
        'max_price'            => 'SELECT MAX(Price) AS MaxPrice FROM Products;',
        'min_price'            => 'SELECT MIN(Price) AS MinPrice FROM Products;'
    ],
    'customers' => [
        'total_customers'      => 'SELECT COUNT(CustomerID) AS TotalCustomers FROM Customers;',
        'average_name_length'  => 'SELECT AVG(LENGTH(CustomerName)) AS AverageNameLength FROM Customers;'
    ],
    'sales' => [
        'total_sales_amount'   => 'SELECT SUM(totalamount) AS TotalSalesAmount FROM Sales;',
        'average_sale_amount'  => 'SELECT AVG(totalamount) AS AverageSaleAmount FROM Sales;'
    ],
    'saledetails' => [
        'total_sale_records'   => 'SELECT COUNT(SaleID) AS TotalSaleRecords FROM SaleDetails;',
        'average_quantity'     => 'SELECT AVG(Quantity) AS AverageQuantity FROM SaleDetails;'
    ],
    'payments' => [
        'total_payments'       => 'SELECT COUNT(PaymentID) AS TotalPayments FROM Payments;',
        'total_payment_amount' => 'SELECT SUM(PaymentAmount) AS TotalPaymentAmount FROM Payments;'
    ],
    'suppliers_products' => [
        'total_records'        => 'SELECT COUNT(*) AS TotalRecords FROM Suppliers_Products;'
    ]
];
$aggregationResults = [];
if (array_key_exists($currentTable, $aggregations)) {
    foreach ($aggregations[$currentTable] as $label => $query) {
        try {
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $aggregationResults[$label] = $stmt->fetchColumn();
        } catch (PDOException $e) {
            $aggregationResults[$label] = "Ошибка: " . $e->getMessage();
        }
    }
}

// Добавить массив с переводами меток агрегации на русский
$labelsInRussian = [
    'total_suppliers'     => 'Всего поставщиков',
    'total_stock_quantity'=> 'Общее количество на складе',
    'average_price'       => 'Средняя цена',
    'max_price'           => 'Максимальная цена',
    'min_price'           => 'Минимальная цена',
    'total_customers'     => 'Всего клиентов',
    'average_name_length' => 'Средняя длина имени',
    'total_sales_amount'  => 'Общая сумма продаж',
    'average_sale_amount' => 'Средняя сумма продажи',
    'total_sale_records'  => 'Всего записей о продажах',
    'average_quantity'    => 'Среднее количество',
    'total_payments'      => 'Всего платежей',
    'total_payment_amount'=> 'Общая сумма платежей',
    'total_records'       => 'Всего записей'
];

// Обработка запросов на изменение и добавление
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        deleteRecord($pdo, $currentTable, $_POST['id'], $columns);
    } elseif (isset($_POST['add'])) {
        addRecord($pdo, $currentTable, $columns, $_POST);
    } elseif (isset($_POST['edit'])) {
        editRecord($pdo, $currentTable, $columns, $_POST, $_POST['edit_id']);
    }
}

// Добавление новой записи
function addRecord($pdo, $table, $columns, $data) {
    try {
        $columnsList = implode(", ", array_map(fn($col) => "\"$col\"", $columns));
        $placeholders = implode(", ", array_fill(0, count($columns), "?"));
        $values = array_map(fn($col) => $data[$col] ?? null, $columns);

        $stmt = $pdo->prepare("INSERT INTO \"$table\" ($columnsList) VALUES ($placeholders)");
        $stmt->execute($values);

        // Выводим сообщение и перезагружаем страницу через 2 секунды
        echo "
            <div class='alert alert-success mt-3'>Запись успешно добавлена</div>
            <script>
                setTimeout(function() {
                    window.location.href = '?table=" . urlencode($table) . "';
                }, 2000);
            </script>
        ";
    } catch (PDOException $e) {
        echo "
            <div class='alert alert-danger mt-3'>
                Ошибка добавления записи: " . htmlspecialchars($e->getMessage()) . "
            </div>
        ";
    }
}

// Редактирование записи
function editRecord($pdo, $table, $columns, $data, $id) {
    try {
        $idColumn = $columns[0];
        $setClause = implode(", ", array_map(fn($col) => "\"$col\" = ?", $columns));
        $values = array_map(fn($col) => $data[$col] ?? null, $columns);
        $values[] = $id;

        $stmt = $pdo->prepare("UPDATE \"$table\" SET $setClause WHERE \"$idColumn\" = ?");
        $stmt->execute($values);

        echo "
            <div class='alert alert-success mt-3'>Запись успешно обновлена</div>
            <script>
                setTimeout(function() {
                    window.location.href = '?table=" . urlencode($table) . "';
                }, 2000);
            </script>
        ";
    } catch (PDOException $e) {
        echo "
            <div class='alert alert-danger mt-3'>
                Ошибка обновления записи: " . htmlspecialchars($e->getMessage()) . "
            </div>
        ";
    }
}

// Удаление записи
function deleteRecord($pdo, $table, $id, $columns) {
    try {
        $idColumn = $columns[0];
        $stmt = $pdo->prepare("DELETE FROM \"$table\" WHERE \"$idColumn\" = ?");
        $stmt->execute([$id]);

        echo "
            <div class='alert alert-success mt-3'>Запись успешно удалена</div>
            <script>
                setTimeout(function() {
                    window.location.href = '?table=" . urlencode($table) . "';
                }, 2000);
            </script>
        ";
    } catch (PDOException $e) {
        echo "
            <div class='alert alert-danger mt-3'>
                Ошибка удаления записи: " . htmlspecialchars($e->getMessage()) . "
            </div>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление складом</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="p-3 bg-dark text-white text-center">
        <h1>Складская система магазина технологий</h1>
        <p>Пользователь: <?= htmlspecialchars($userName) ?></p>
    </header>
    <div class="container mt-4">
        <div class="mb-3">
            <a href="logout.php" class="btn btn-secondary">Назад</a>
            <a href="connecttables.php" class="btn btn-info">Обзор данных продаж</a>
        </div>

        <!-- Форма поиска -->
        <form method="get" class="mb-3">
            <div class="row g-3">
                <div class="col-md-4">
                    <select name="table" class="form-select" onchange="this.form.submit()">
                        <?php foreach ($tables as $table): ?>
                            <option value="<?= $table ?>" <?= $table === $currentTable ? 'selected' : '' ?>><?= $table ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Поиск (ключевые слова)"
                           value="<?= htmlspecialchars($searchKeyword) ?>">
                </div>
                <div class="col-md-4">
                    <input type="number" name="id_search" class="form-control" placeholder="Поиск по ID"
                           value="<?= htmlspecialchars($_GET['id_search'] ?? '') ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Применить</button>
            <a href="dashboard.php" class="btn btn-secondary mt-3">Сбросить</a>
        </form>

        <!-- Результаты агрегации -->
        <?php if (!empty($aggregationResults)): ?>
            <div class="mb-3">
                <h3>Результаты подсчётов <?= htmlspecialchars(ucfirst($currentTable)) ?>:</h3>
                <ul>
                    <?php foreach ($aggregationResults as $label => $result): ?>
                        <li><?= htmlspecialchars($labelsInRussian[$label] ?? ucfirst(str_replace('_', ' ', $label))) ?>
                            : <?= htmlspecialchars($result) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Таблица данных -->
        <h2>Данные таблицы: <?= htmlspecialchars($currentTable) ?></h2>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <?php foreach ($columns as $column): ?>
                    <th>
                        <a href="?table=<?= $currentTable ?>&sort=<?= $column ?>&search=<?= htmlspecialchars($searchKeyword) ?>">
                            <?= $column ?>
                        </a>
                    </th>
                <?php endforeach; ?>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <?php foreach ($row as $value): ?>
                            <td><?= htmlspecialchars($value) ?></td>
                        <?php endforeach; ?>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $row[$columns[0]] ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Удалить</button>
                                <!-- Добавляем якорь для прокрутки вниз к editForm -->
                                <a href="?table=<?= $currentTable ?>&edit_id=<?= $row[$columns[0]] ?>#editForm"
                                   class="btn btn-warning btn-sm">Изменить</a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?= count($columns) + 1 ?>" class="text-center">Ничего не найдено</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

        <!-- Форма редактирования -->
        <?php if (isset($_GET['edit_id'])): ?>
            <div id="editForm" class="card mt-5">
                <div class="card-header bg-warning">
                    <h4 class="card-title mb-0">Изменить запись</h4>
                </div>
                <div class="card-body">
                    <?php
                    // Получение данных для редактирования
                    $editId = $_GET['edit_id'];
                    $editRow = [];
                    try {
                        $stmt = $pdo->prepare("SELECT * FROM \"$currentTable\" WHERE \"{$columns[0]}\" = ?");
                        $stmt->execute([$editId]);
                        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo "<div class='alert alert-danger'>Ошибка получения данных для редактирования: " . htmlspecialchars($e->getMessage()) . "</div>";
                    }
                    ?>
                    <form method="post">
                        <input type="hidden" name="edit_id" value="<?= $editRow[$columns[0]] ?>">
                        <div class="row g-3">
                            <?php foreach ($columns as $column): ?>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold"><?= $column ?></label>
                                    <input 
                                        type="text" 
                                        name="<?= $column ?>" 
                                        class="form-control"
                                        placeholder="Введите <?= $column ?>"
                                        value="<?= isset($editRow[$column]) ? htmlspecialchars($editRow[$column]) : '' ?>"
                                    />
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="submit" name="edit" class="btn btn-primary mt-3">Сохранить</button>
                        <a href="?table=<?= $currentTable ?>#addForm" class="btn btn-secondary mt-3">Отмена</a>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Форма добавления -->
        <div id="addForm" class="card mt-5">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0">Добавить запись</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row g-3">
                        <?php foreach ($columns as $column): ?>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold"><?= $column ?></label>
                                <input 
                                    type="text" 
                                    name="<?= $column ?>" 
                                    class="form-control" 
                                    placeholder="Введите <?= $column ?>"
                                />
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit" name="add" class="btn btn-success mt-3">Добавить</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>