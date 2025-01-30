<?php
session_start();


if (empty($_SESSION['authenticated'])) {
    header('Location: login.php');
    exit;
}

require_once 'db.php'; 


$userName = $_SESSION['username'] ?? 'arman';

// Функция для удаления записи
function deleteRecord($pdo, $table, $id, $columns) {
    try {
        $idColumn = $columns[0];
        $stmt = $pdo->prepare("DELETE FROM \"$table\" WHERE \"$idColumn\" = ?");
        $stmt->execute([$id]);

        echo "<div class='alert alert-success'>Запись успешно удалена.</div>";
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Ошибка удаления записи: " . htmlspecialchars($e->getMessage()) . "</div>";
    }
}

// Обработка удаления записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];
    deleteRecord($pdo, 'contactform', $deleteId, ['id']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}


$sql = 'SELECT * FROM "contactform"'; 
$stmt = $pdo->query($sql);
$contactForms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица сообщений</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="mb-3">
            <a href="logout.php" class="btn btn-secondary">Назад</a>
        </div>


        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info">
                <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']); 
                ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Таблица сообщений</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Имя</th>
                    <th>Компания</th>
                    <th>E-mail</th>
                    <th>Сообщение</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactForms as $form): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($form['name']); ?></td>
                        <td><?php echo htmlspecialchars($form['company']); ?></td>
                        <td><?php echo htmlspecialchars($form['email']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($form['message'])); ?></td>
                        <td>
                            <!-- удаление записи -->
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $form['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
