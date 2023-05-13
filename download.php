<?php
// Получение URL фото
$img_url = $_GET['img_url'];

// Получение имени фото
$file_name = basename($img_url);

// Отправка файла на скачивание
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $file_name . '"');
readfile($img_url);
?>