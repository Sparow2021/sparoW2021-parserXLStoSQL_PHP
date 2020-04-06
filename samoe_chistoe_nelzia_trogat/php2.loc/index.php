<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'connection.php'; // подключаем скрипт
        $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link));
        
    
    $query ="SELECT * FROM details";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result){
        $rows = mysqli_num_rows($result); // количество полученных строк
        echo "<table border='1px'><tr><th>Название</th><th>Стоимость</th><th>СтоимостьОпт</th><th>Склад1</th><th>Склад2</th><th>Производитель</th><th>Примечание</th></tr>";
        for ($i = 0 ; $i < $rows ; ++$i){
            $row = mysqli_fetch_row($result);
            echo "<tr>";
            for ($j = 0 ; $j <= 6 ; ++$j){

                
                
                //для примечания
                if($j==6){
                    echo "<td>1</td>";
                }else{
                    echo "<td>$row[$j]</td>";   
                }
            }
            echo "</tr>";
            }
        }
        echo "</table>";
        //СУММА НА ПЕРВОМ СКЛАДЕ GOOD
        $query1 ="SELECT SUM(storageFirst) FROM details";
        $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
        if($result1){
            $row1 = mysqli_fetch_row($result1);
            echo $row1[0] . "<br/>";
        }
        //СУММА НА ВТОРОМ СКЛАДЕ GOOD
        $query2 ="SELECT SUM(storageSecond) FROM details";
        $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link)); 
        if($result2){
            $row2 = mysqli_fetch_row($result2);
            echo $row2[0] . "<br/>";
        }
        //Средняя стоимость розничной цены товара
        $query3 ="SELECT AVG(price) FROM details";
        $result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link)); 
        if($result3){
            $row3 = mysqli_fetch_row($result3);
            echo  "Средняя стоимость розничной цены товара" . ($row3[0]) . "<br/>";// не на касарь делить
        }
        
        //Средняя стоимость оптовой цены товара
        $query4 ="SELECT AVG(priceMany) FROM details";
        $result4 = mysqli_query($link, $query4) or die("Ошибка " . mysqli_error($link)); 
        if($result4){
            $row4 = mysqli_fetch_row($result4);
            echo "Средняя стоимость оптовой цены товара" . ($row4[0]) . "<br/>"; // не на касарь делить
        }
        
        //МАКСИМАЛЬНОЕ ЗНАЧЕНИЕ
        $query4 ="SELECT AVG(priceMany) FROM details";
        $result4 = mysqli_query($link, $query4) or die("Ошибка " . mysqli_error($link)); 
        if($result4){
            $row4 = mysqli_fetch_row($result4);
            echo "Средняя стоимость оптовой цены товара" . ($row4[0]) . "<br/>"; // не на касарь делить
        }
    
// закрываем подключение
mysqli_close($link);
?>

    </body>
</html>

