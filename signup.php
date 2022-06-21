<?php
$title="Форма регистрации"; // название формы
require __DIR__ . '/header.php'; // подключаем шапку проекта
require "db.php"; // подключаем файл для соединения с БД

// Создаем переменную для сбора данных от пользователя по методу POST
$data = $_POST;

// Пользователь нажимает на кнопку "Зарегистрировать" и код начинает выполняться
if(isset($data['do_signup'])) {

    // Регистрируем
    // Создаем массив для сбора ошибок
    $errors = array();

    // Проводим проверки
    // trim — удаляет пробелы (или другие символы) из начала и конца строки
    if(trim($data['login']) == '') {

        $errors[] = "Введите логин!";
    }

    if(trim($data['email']) == '') {

        $errors[] = "Введите Email";
    }


    if($data['password'] == '') {

        $errors[] = "Введите пароль";
    }

    if($data['password_2'] != $data['password']) {

        $errors[] = "Повторный пароль введен не верно!";
    }
    // функция mb_strlen - получает длину строки
    // Если логин будет меньше 5 символов и больше 90, то выйдет ошибка
    if(mb_strlen($data['login']) < 5 || mb_strlen($data['login']) > 90) {

        $errors[] = "Недопустимая длина логина";

    }

    if (mb_strlen($data['password']) < 2 || mb_strlen($data['password']) > 8){

        $errors[] = "Недопустимая длина пароля (от 2 до 8 символов)";

    }

    // проверка на правильность написания Email
    if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $data['email'])) {

        $errors[] = 'Неверно введен е-mail';

    }

//    // Проверка на уникальность логина
//    if(R::count('users', "login = ?", array($data['login'])) > 0) {
//
//        $errors[] = "Пользователь с таким логином существует!";
//    }
//
//    // Проверка на уникальность email
//
//    if(R::count('users', "email = ?", array($data['email'])) > 0) {
//
//        $errors[] = "Пользователь с таким Email существует!";
//    }


    if(empty($errors)) {

        // Все проверено, регистрируем

        // добавляем в таблицу записи
        $login = $data['login'];
        $email = $data['email'];

        // Хешируем пароль
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        // Сохраняем таблицу
        $sql = "INSERT INTO users (login, email, password) VALUES (?,?,?)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$login, $email, $password]);
        echo '<div style="color: green; ">Вы успешно зарегистрированы! Можно <a href="login.php">авторизоваться</a>.</div><hr>';

    } else {
        // array_shift() извлекает первое значение массива array и возвращает его, сокращая размер array на один элемент.
        echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col">
            <!-- Форма регистрации -->
            <h2>Форма регистрации</h2>
            <form action="signup.php" method="post">
                <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
                <input type="email" class="form-control" name="email" id="email" placeholder="Введите Email"><br>
                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль"><br>
                <input type="password" class="form-control" name="password_2" id="password_2" placeholder="Повторите пароль"><br>
                <button class="btn btn-success" name="do_signup" type="submit">Зарегистрировать</button>
            </form>
            <br>
            <p>Если вы зарегистрированы, тогда нажмите <a href="login.php">здесь</a>.</p>
            <p>Вернуться на <a href="index.php">главную</a>.</p>
        </div>
    </div>
</div>
<?php require __DIR__ . '/footer.php'; ?> <!-- Подключаем подвал проекта -->