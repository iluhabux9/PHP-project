<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/main.js"></script>


</head>


<body>
   
<!-- Шапка -->
<header class="header">
<div class="header-panel">
    <form>
        <input type="email" placeholder="Введите Email">
        <input type="password" placeholder="Введите Password">
        <button type="submit">Войти</button>
    </form>
        <div class="name_theme">
         <h2 class="titleProject">Фотогалерея - Мой Хлам</h2>
      </div>
            <div class="logo">
                <img src="#" alt="логотип">
            </div>
</div>
</header>

<!-- Основной контект -->
<main> 
<!-- Все сортировки -->
<div class="sort_all">
    <!-- Сортировка по дате -->
    <div class="sort_by_date">

<form action="index.php" method="get">
<label for="sort">Сортировать по дате добавления:</label>
<select name="sort" id="sort">
  <option value="asc">По возрастанию</option>
  <option value="desc">По убыванию</option>
</select>
<button type="submit">Сортировать</button>
</form>

    </div>

</div>

</main>

<!-- Подвал -->
<footer> 

</footer>


</body>

<?php
require_once ("config.php");
require_once ("image.php");

// Соединяем с базой данных
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if($mysqli->connect_error) {
    exit("Ошибка подключения к базе данных:".$mysqli->connect_error);
}

// Устанавливаем кодировку UTF-8
$mysqli->set_charset("utf8");

// Получаем список категорий
$query = "SELECT id_category, name_category FROM `category`";
$result = $mysqli->query($query);

if(!$result){
    exit("Ошибка в запросе:".$mysqli->error);
}

// Выводим список категорий
echo '<ul class="header-menu">';
while ($row = $result->fetch_assoc()) {
    echo '<li><span class="category-item" data-category-id="' . $row['id_category'] . '">' . $row['name_category'] . '</span></li>';
} echo '</ul>';


// Закрываем соединение с базой данных
$mysqli->close();

?>

</html>