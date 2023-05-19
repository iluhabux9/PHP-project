<?php

$host = 'localhost';
$database = 'photogallery';
$user = 'root';
$password = 'root';

$link = mysqli_connect($host, $user, $password, $database) 
or die("Ошибка " . mysqli_error($link));

// получаем данные из формы
$email = $_POST['email'];
$password = $_POST['password'];

// запрос на выборку пользователя 
$query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

// проверка наличия пользователя в базе данных
if (mysqli_num_rows($result) == 1) {
    // если пользователь найден, сохраняем его данные
    session_start();
    $user = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $user['name'];
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['registration_date'] = $user['registration_date'];
    // переходим на основную страницу
    session_write_close();
    header("Location: index.php");
    exit();
} else {
    // если пользователь не найден, выводим ошибку
    header("Location: index.php?error=1");
}

// закрываем подключение
mysqli_close($link);
?>