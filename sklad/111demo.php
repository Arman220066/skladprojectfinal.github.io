<?php
require_once 'db.php'; 


$userName = 'Guest (Demo-version)';

// Список таблиц
$tables = ["suppliers", "products", "customers", "sales", "saledetails", "payments", "suppliers_products"];

// Текущая таблица
$currentTable = $_GET['table'] ?? $tables[0];
$sortColumn = $_GET['sort'] ?? null;
$searchKeyword = $_GET['search'] ?? '';

// Данные текущей таблицы
$data = [];
$columns = [];

if (in_array($currentTable, $tables)) {
    try {
        // Запрос для получения колон
        $stmt = $pdo->prepare("SELECT column_name FROM information_schema.columns WHERE table_name = LOWER(?)");
        $stmt->execute([strtolower($currentTable)]);
        $columnsInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $columns = array_column($columnsInfo, 'column_name');

        //  Основной запрос
        $query = "SELECT * FROM \"$currentTable\"";
        $params = [];

        // Добавление фильтрации у
        if (!empty($searchKeyword)) {
            $searchConditions = [];
            foreach ($columns as $column) {
                $searchConditions[] = "\"$column\"::TEXT ILIKE ?";
                $params[] = "%$searchKeyword%";
            }
            $query .= " WHERE " . implode(" OR ", $searchConditions);
        }

        // Сортировка по столбцу
        if ($sortColumn && in_array($sortColumn, $columns)) {
            $query .= " ORDER BY \"$sortColumn\"";
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Ошибка: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}


$aggregations = [

    'suppliers' => [
        'total_suppliers' => 'SELECT COUNT(supplierid) AS TotalSuppliers FROM Suppliers;',
        
    ],
    'products' => [
        'total_stock_quantity' => 'SELECT SUM(StockQuantity) AS TotalStockQuantity FROM Products;',
        'average_price' => 'SELECT AVG(Price) AS AveragePrice FROM Products;',
        'max_price' => 'SELECT MAX(Price) AS MaxPrice FROM Products;',
        'min_price' => 'SELECT MIN(Price) AS MinPrice FROM Products;'
    ],
    'customers' => [
        'total_customers' => 'SELECT COUNT(CustomerID) AS TotalCustomers FROM Customers;',
        'average_name_length' => 'SELECT AVG(LENGTH(CustomerName)) AS AverageNameLength FROM Customers;'
    ],
    'sales' => [
        'total_sales_amount' => 'SELECT SUM(totalamount) AS TotalSalesAmount FROM Sales;',
        'average_sale_amount' => 'SELECT AVG(totalamount) AS AverageSaleAmount FROM Sales;'
    ],
    'saledetails' => [
        'total_sale_records' => 'SELECT COUNT(SaleID) AS TotalSaleRecords FROM SaleDetails;',
        'average_quantity' => 'SELECT AVG(Quantity) AS AverageQuantity FROM SaleDetails;'
    ],
    'payments' => [
        'total_payments' => 'SELECT COUNT(PaymentID) AS TotalPayments FROM Payments;',
        'total_payment_amount' => 'SELECT SUM(PaymentAmount) AS TotalPaymentAmount FROM Payments;'
    ],
    'suppliers_products' => [
        'total_records' => 'SELECT COUNT(*) AS TotalRecords FROM Suppliers_Products;'
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


$labelsInRussian = [
    'total_suppliers' => 'Total suppliers',
    'total_stock_quantity' => 'Total quantity in stock',
    'average_price' => 'Average price',
    'max_price' => 'Maximum price',
    'min_price' => 'Minimum price',
    'total_customers' => 'Total clients',
    'average_name_length' => 'The average length of the name',
    'total_sales_amount' => 'Total sales amount',
    'average_sale_amount' => 'Average sale amount',
    'total_sale_records' => 'Total sales records',
    'average_quantity' => 'Average number',
    'total_payments' => 'Total payments',
    'total_payment_amount' => 'Total amount of payments',
    'total_records' => 'Total entries'
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo-version: Warehouse Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="p-3 bg-primary text-white text-center">
        <h1>Demo-version: The Technology store's warehouse system</h1>
        <p>User: <?= htmlspecialchars($userName) ?></p>
    </header>
    <div class="container mt-4">
        <div class="mb-3">
            <a href="111.php" class="btn btn-secondary">Back</a>
            <a href="democonnect.php" class="btn btn-info">Overview of sales data</a>
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
                    <input type="text" name="search" class="form-control" placeholder="Поиск (ключевые слова)" value="<?= htmlspecialchars($searchKeyword) ?>">
                </div>
                <div class="col-md-4">
                    <input type="number" name="id_search" class="form-control" placeholder="Поиск по ID" value="<?= htmlspecialchars($_GET['id_search'] ?? '') ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Apply</button>
            <a href="demo.php" class="btn btn-secondary mt-3">reset</a>
        </form>


        <!-- Результаты агрегации -->
        <?php if (!empty($aggregationResults)): ?>
            <div class="mb-3">
                <h3>Calculation results <?= htmlspecialchars(ucfirst($currentTable)) ?>:</h3>
                <ul>
                    <?php foreach ($aggregationResults as $label => $result): ?>
                        <li><?= htmlspecialchars($labelsInRussian[$label] ?? ucfirst(str_replace('_', ' ', $label))) ?>: <?= htmlspecialchars($result) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>


        <!-- Таблица данных -->
        <h2>Table data: <?= htmlspecialchars($currentTable) ?></h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <?php foreach ($columns as $column): ?>
                        <th><a href="?table=<?= $currentTable ?>&sort=<?= $column ?>&search=<?= htmlspecialchars($searchKeyword) ?>"><?= $column ?></a></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <td><?= htmlspecialchars($value) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="<?= count($columns) ?>" class="text-center">Ничего не найдено</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
    <!-- Кнопка "EN" -->
    <button id="language-button" onclick="window.location.href='http://localhost/sklad/demo.php'">RUS</button>
</body>
</html>
