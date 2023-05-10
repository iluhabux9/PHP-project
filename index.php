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
<header>

</header>

<!-- Основной контент -->
<main> 

</main>

<!-- Подвал -->
<footer> 

</footer>


</body>

<?php
require_once ("config.php");

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
}
echo '</ul>';



$mysqli->close();

?>

</html>