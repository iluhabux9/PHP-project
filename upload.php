<?php

$host = 'localhost';
$database = 'photogallery';
$user = 'root';
$password = 'root';

$link = mysqli_connect($host, $user, $password, $database) 
or die("Ошибка " . mysqli_error($link));


if(isset($_POST['title'])) {
    $title = mysqli_real_escape_string($link, $_POST['title']);
} else {
    $title = '';
}

if(isset($_POST['description'])) {
    $description = mysqli_real_escape_string($link, $_POST['description']);
} else {
    $description = '';
}

if(isset($_POST['category']) && is_numeric($_POST['category'])) {
    $category = mysqli_real_escape_string($link, $_POST['category']);
} else {
    $category = '';
}

if(isset($_SESSION['id_user'])) {
    $id_user = mysqli_real_escape_string($link, $_SESSION['id_user']);
} else {
    $id_user = '1';
}

// Загрузили ли мы файл?
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    // Получаем расширение файла
    $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    // Делаем уникальное имя 
    $filename = uniqid() . '.' . $extension;

// Проверяем, существует ли папка img
if (!file_exists('../img')) {
    mkdir('../img');
  }

// Сохраняем файл в папку img
move_uploaded_file($_FILES['photo']['tmp_name'], '../PHP project/img/' . $filename);

// Получаем дату загрузки фото
if (isset($_POST['upload_date']) && strtotime($_POST['upload_date']) !== false) {
    $upload_date = date('Y-m-d H:i:s', strtotime($_POST['upload_date']));
  } else {
    $upload_date = date('Y-m-d H:i:s');
  }

 // Экранируем значения переменных и выполняем запрос к базе данных
 $title = mysqli_real_escape_string($link, $_POST['title']);
 $description = mysqli_real_escape_string($link, $_POST['description']);
 $category = mysqli_real_escape_string($link, $category);
 $id_user = mysqli_real_escape_string($link, $id_user);
 $upload_date = mysqli_real_escape_string($link, $upload_date);

// Заполняем информацию в базе данных
$query = "INSERT INTO photo (title, `description`, id_category, img_url, id_user, upload_date) VALUES ('$title', '$description', '$category', 'img/$filename', $id_user, '$upload_date')";
$result = mysqli_query($link, $query);
if (!$result) {
  die('Ошибка выполнения запроса: ' . mysqli_error($link));
}
}

mysqli_close($link);

// Отправляемся на главную страницу
header("Location: index.php");
exit();

?>