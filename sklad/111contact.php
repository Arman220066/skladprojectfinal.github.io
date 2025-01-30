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
            echo "The data has been sent successfully!";
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
    <title>Contact us</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="hero" style="background-image: url('<?php echo $imageSss; ?>');">
        <div>
            <div class="custom-card">
                <form action="contact.php" method="post">
                    <div class="overlay">
                        <h2>Contact us</h2>
                        <p>Are you looking for a technology partner for your business? Fill out the form below and we will contact you as soon as possible.</p>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" id="company" name="company" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <a href="http://localhost/sklad/111.php" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- Кнопка "EN" -->
    <button id="language-button" onclick="window.location.href='http://localhost/sklad/contact.php'">RUS</button>
    <footer class="footer">
        <p>© 2024 Warehouse management system. All rights reserved.</p>
        <p>Administration: Narxoz University</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
