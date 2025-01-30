<?php
$imageSss = 'images/conn.jpg';


require_once 'db.php'; 

// Обработка данных формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Данные из формы
    $name = $_POST['name'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {
        // SQL-запрос
        $stmt = $pdo->prepare("INSERT INTO ContactForm (name, company, email, message) VALUES (:name, :company, :email, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Выполняем запрос
        if ($stmt->execute()) {
            echo "Данные были успешно отправлены!";
        } else {
            echo "Ошибка при добавлении данных.";
        }
    } catch (PDOException $e) {
        echo "Ошибка выполнения запроса: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Связаться с нами</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="hero" style="background-image: url('<?php echo $imageSss; ?>');">
        <div>
            <div class="custom-card">
                <form action="contact.php" method="post">
                    <div class="overlay">
                        <h2>Связаться с нами</h2>
                        <p>Ищете технологического партнера для своего бизнеса? Заполните форму ниже, и мы свяжемся с вами в кратчайшие сроки.</p>
                    </div>
                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="company">Компания</label>
                        <input type="text" id="company" name="company" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Ваше сообщение</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="btn btn-primary">Отправить</button>
                        <a href="http://localhost/sklad/" class="btn btn-secondary">Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Кнопка "EN" -->
    <button id="language-button" onclick="window.location.href='http://localhost/sklad/111contact.php'">EN</button>
    <footer class="footer">
        <p>© 2024 Складская система управления. Все права защищены.</p>
        <p>Администрация: Narxoz University</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
