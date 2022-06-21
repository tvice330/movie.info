<?php
$title="Главная страница"; // название формы
require __DIR__ . '/header.php'; // подключаем шапку проекта
require "db.php"; // подключаем файл для соединения с БД
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <center>
                <h1>Добро пожаловать на наш сайт!</h1>
            </center>
        </div>
    </div>
</div>

<!-- Если авторизован выведет приветствие -->
<?php if(isset($_SESSION['logged_user'])) : ?>
    Привет, <?php echo $_SESSION['logged_user']->name; ?></br>

    <!-- Пользователь может нажать выйти для выхода из системы -->
    <a href="logout.php">Выйти</a> <!-- файл logout.php создадим ниже -->
<?php else : ?>

    <!-- Если пользователь не авторизован выведет ссылки на авторизацию и регистрацию -->
    <a href="login.php">Авторизоваться</a><br>
    <a href="signup.php">Регистрация</a>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?> <!-- Подключаем подвал проекта -->
