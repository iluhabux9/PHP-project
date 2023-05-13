<?php
// Подключение к базе данных
$connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

// Получение параметров сортировки (GET)
$sort_order = $_GET['sort']??'asc';

// Выбор всех картинок из таблицы 'photo' c учетом сортировки
$query = "SELECT * FROM photo ORDER BY upload_date $sort_order";
$result = mysqli_query($connection, $query);
if (!$result) {
    die('Ошибка выполнения запроса: ' . mysqli_error($connection));  /* Проверка - работает ли запрос, если нет то вывести ошибку */
}
?>

<!-- Вывод фотографий и кнопки скачать фото -->
<div class="photoGallery">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="photo-item">
            <a href="download.php?img_url=<?php echo $row['img_url']; ?>" download="photo.jpg">Скачать</a> <!-- a есть ссылка на скачивание фото -->
            <img src="<?php echo $row['img_url']; ?>" alt="<?php echo $row['title']; ?>">
            <p class="photo-title"><?php echo $row['title']; ?></p> <!-- p есть название фото -->
        </div>
    <?php } ?>
</div>

<?php
// Закрытие соединения с базой данных
mysqli_close($connection);
?>