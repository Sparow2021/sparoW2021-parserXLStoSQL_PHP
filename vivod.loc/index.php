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
        
    //МАКСИМАЛЬНОЕ ЗНАЧЕНИЕ по рознице GOOD
        $query5 ="SELECT MAX(price)FROM details";
        $result5 = mysqli_query($link, $query5) or die("Ошибка " . mysqli_error($link)); 
        if($result5){
            $row5 = mysqli_fetch_row($result5);
            $maxPrice = $row5[0];
            echo "Максимальная цена по рознице: " . ($row5[0]) . "<br/>"; // не на касарь делить
        }
        
    //МИНИМАЛЬНОЕ ЗНАЧЕНИЕ по опту GOOD
        $query6 ="SELECT MIN(priceMany)FROM details";
        $result6 = mysqli_query($link, $query6) or die("Ошибка " . mysqli_error($link)); 
        if($result6){
            $row6 = mysqli_fetch_row($result6);
            $minPrice = $row6[0];
            echo "Минимальная цена по опту: " . ($row6[0]) . "<br/>"; // не на касарь делить
        }
        
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
                    if($row[3]<20 or $row[4]<20){
                        echo "<td>Осталось мало!! Срочно докупите!!</td>";
                    }else{
                        echo "<td>Товара достаточно</td>";
                    }  
                }elseif($row[2]===$minPrice){ // если третья яйчека равна минимальная по опту
                    echo "<td bgcolor='red'>$row[$j]</td>";
                }elseif($row[1]===$maxPrice){ // если вторая яйчека равна манимальная по рознице
                    echo "<td bgcolor='green'>$row[$j]</td>";
                }else{ //для остальных ячеек    
                        echo "<td>$row[$j]</td>";    
                }
            }
            echo "</tr>";
            }
        }
        echo "</table>";
        //СУММА НА ПЕРВОМ СКЛАДЕ GOOD !
        $query1 ="SELECT SUM(storageFirst) FROM details";
        $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
        if($result1){
            $row1 = mysqli_fetch_row($result1);
            echo "На первом сскладе: " . $row1[0] . "<br/>";
        }
        //СУММА НА ВТОРОМ СКЛАДЕ GOOD !
        $query2 ="SELECT SUM(storageSecond) FROM details";
        $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link)); 
        if($result2){
            $row2 = mysqli_fetch_row($result2);
            echo "На втором складе: " . $row2[0] . "<br/>";
        }
        //общее количество на складах 
        $allGoods = $row1[0] + $row2[0];
        echo "Общее количество товаров на складах: " . "$allGoods" . "</br>" ;
        
        //Средняя стоимость розничной цены товара GOOD !
        $query3 ="SELECT AVG(price) FROM details";
        $result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link)); 
        if($result3){
            $row3 = mysqli_fetch_row($result3);
            echo  "Средняя стоимость розничной цены товара: " . ($row3[0]) . "<br/>";// не на касарь делить
        }
        
        //Средняя стоимость оптовой цены товара GOOD !
        $query4 ="SELECT AVG(priceMany) FROM details";
        $result4 = mysqli_query($link, $query4) or die("Ошибка " . mysqli_error($link)); 
        if($result4){
            $row4 = mysqli_fetch_row($result4);
            echo "Средняя стоимость оптовой цены товара: " . ($row4[0]) . "<br/>"; // не на касарь делить
        }
        
        
        
        
// закрываем подключение
mysqli_close($link);
?>

    </body>
</html>

