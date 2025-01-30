<?php

$imageSss = 'images/conn.jpg';

session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Проверка логина и пароля
    if ($username === 'admin' && $password === '1256') { 
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } elseif ($username === 'arman' && $password === '2006') {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = $username;
        header('Location: mass.php');
        exit;
    } else {
        $error = 'Incorrect username or password';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>


    <div class="hero" style="background-image: url('<?php echo $imageSss; ?>');">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="custom-card shadow p-4" style="width: 350px; border-radius: 10px;">
                <h2 class="text-center mb-4">Login</h2>
                <p class="text-center mb-4">Enter your personal username and password to log in to your account</p>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Login</label>
                          <input type="text" id="username" name="username" class="form-control" required>
                      </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" id="password" name="password" class="form-control" required>
                   </div>
                    <div class="d-grid">
                       <button type="submit" class="btn btn-primary">Enter</button>
                       <a href="http://localhost/sklad/111.php" class="btn btn-secondary" >Back</a>
                   </div>

                </form>
            </div>
        </div>

    </div>
    <!-- Кнопка "EN" -->
    <button id="language-button" onclick="window.location.href='http://localhost/sklad/login.php'">RUS</button>
    <footer class="footer">
        <p>© 2024 Warehouse management system. All rights reserved.</p>
        <p>Administration: Narxoz University</p>
    </footer>
</body>
</html>