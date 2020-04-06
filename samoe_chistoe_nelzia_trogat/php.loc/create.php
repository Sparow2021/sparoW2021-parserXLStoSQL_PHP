<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
require_once 'connection.php'; // подключаем скрипт
 
if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['priceMany']) && isset($_POST['storageFirst']) && isset($_POST['storageSecond']) && isset($_POST['countryProd'])){
 
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 
     
    // экранирования символов для mysql
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $price = htmlentities(mysqli_real_escape_string($link, $_POST['price']));
    $priceMany = htmlentities(mysqli_real_escape_string($link, $_POST['priceMany']));
    $storageFirst = htmlentities(mysqli_real_escape_string($link, $_POST['storageFirst']));
    $storageSecond = htmlentities(mysqli_real_escape_string($link, $_POST['storageSecond']));
    $countryProd = htmlentities(mysqli_real_escape_string($link, $_POST['countryProd']));

    // создание строки запроса
    $query ="INSERT INTO details VALUES('$name','$price','$priceMany','$storageFirst','$storageSecond','$countryProd')";
     
    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }
    // закрываем подключение
    mysqli_close($link);
}
?>
<h2>Добавить новую модель</h2>
<form method="POST">
<p>Введите название:<br> 
<input type="text" name="name" /></p>
<p>Стоимость: <br> 
<input type="text" name="price" /></p>
<p>Стоимость опт: <br> 
<input type="text" name="priceMany" /></p>
<p>Склад1: <br> 
<input type="text" name="storageFirst" /></p>
<p>Склад 2: <br> 
<input type="text" name="storageSecond" /></p>
<p>Страна производитель: <br> 
<input type="text" name="countryProd" /></p>
<input type="submit" value="Добавить">
</form>
</body>
</html>
