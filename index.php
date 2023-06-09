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
   <!-- Шапка включая название, лого и панель авторизации -->
<header class="header">
  <div class="header-top"> <!-- панель авторизации и фраза добро пожаловать -->
    <?php
      session_start();
      if(isset($_SESSION['username'])) {
        echo "<div class='welcome'>Добро пожаловать ".$_SESSION['username']."</div>";
        echo "<a href='logout.php' class='logout'>Выйти из аккаунта</a>";
      } else { 
    ?>
    <form method="POST" action="login.php" class="login-form">
      <input type="email" placeholder="Введите Email" name="email">
      <input type="password" placeholder="Введите Password" name="password">
      <button type="submit">Войти</button>
    </form>
    <?php } ?>
  </div>
  <div class="header-bottom"> <!-- Название -->
    <div class="name_theme">
      <h2 class="titleProject">Фотогалерея - Животный Мир</h2>
    </div>
    <div class="logo"> <!-- Логотип -->
      <img src="img/logo.jpg" alt="логотип">
    </div>
  </div>
</header>

<!-- Основной контект -->
<main> 
<!-- Сортировка и загрузка -->
<div class="sort_all">
    <!-- Сортировка по дате -->
    <div class="sort_by_date">

<form action="index.php" method="get">
<label for="sort">Сортировать по дате добавления:</label>
<select name="sort" id="sort">
  <option value="asc">Сначала старые</option>
  <option value="desc">Сначала новые</option>
</select>
<button type="submit">Сортировать</button>
</form>

    </div>

  <!-- Загрузка фото -->
  <div class="upload">

  <form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Название">
    <textarea name="description" placeholder="Описание"></textarea>
    <select name="category">
        <option value="1">Wild animals</option>
        <option value="2">Pets</option>
        <option value="3">Rare and exotic animals</option>
    </select>
    <input type="file" name="photo">
    <input type="datetime-local" name="upload_date" placeholder="Дата и время">
    <button type="submit" name="submit">Upload</button>
  </form>

      </div>

</div>

</main>

<!-- Подвал -->
<footer> 

</footer>


</body>



<!--  Соединяем с базой данных -->
<?php
       require_once ("config.php");
       require_once ("image.php");

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