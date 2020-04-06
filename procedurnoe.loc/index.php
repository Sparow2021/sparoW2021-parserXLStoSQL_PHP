<html>
<head>
</head>
<body>
<?php
// можно создавать БД кодом 
/* 
 * глобал массив
 * вывод из него в строку
 * вывод из таблицы sql на страницу 
 * мини примеры и AJAX запросы
 * потом конфиги по файлам require добавить и может быть css html отдельно 
 */
// парсинг файла
require_once "Classes/PHPExcel.php";
    $tmpfname = "pricelist.xls";
    $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    $excelObj = $excelReader->load($tmpfname);
    $worksheet = $excelObj->getSheet(0);
    $lastRow = $worksheet->getHighestRow();
                
                //массив для занесения данных с xls
                $detailsArr = array();
                
                // процесс занесения данных в массив с xs РАБОТАЕТ!!!
                for ($row = 1; $row <= $lastRow; $row++) {
                    $fullRow = array();
                    $value1 = $worksheet->getCell('A'.$row)->getValue();
                    $value2 = $worksheet->getCell('B'.$row)->getValue();
                    $value3 = $worksheet->getCell('C'.$row)->getValue();
                    $value4 = $worksheet->getCell('D'.$row)->getValue();
                    $value5 = $worksheet->getCell('E'.$row)->getValue();
                    $value6 = $worksheet->getCell('F'.$row)->getValue();
                    array_push($fullRow, "$value1", "$value2", "$value3", "$value4", "$value5", "$value6");
                    array_push($detailsArr, $fullRow);
                 }
                 
                          
// подключение к БД и создание объектно-ориентированный способ,
//  есть процедурный подход и PDO
                $servername = "localhost"; //всегда
                $username = "root";
                $password = "";
                $dbname = "details_bd";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                        
                if($conn -> connect_error){
                    die("Connection failed" . $conn->connection_error);
                }else{
                    echo "Connection successfully";
                    // создаём таблицу
                    //разобраться с id primary key
                    //задать нормальные типы
                    $sql = "CREATE TABLE details( 
                        name VARCHAR (100) NOT NULL,
                        price DOUBLE NOT NULL,
                        priceMany INT NOT NULL,
                        storageFirst INT NOT NULL,
                        storageSecond INT NOT NULL,
                        countryProd VARCHAR (30) NOT NULL
                )";
                    if($conn -> query($sql) === TRUE) {
                        echo "Table created successfully";
                       //здесь нужно реализовать добавление в базу данных в таблицу с массива НАВЕРНОЕ
                        foreach($detailsArr as $detail){
                            $str = "INSERT INTO details (name, price, priceMany, storageFirst,storageSecond, countryProd)
                            VALUES(" . "'$detail[0]'" . ", " . "'$detail[1]'" . ", " . "'$detail[2]'" . ", " . "'$detail[3]'" . ", " . "'$detail[4]'" . ", " . "'$detail[5]'" . ")";
                            $sql1 = $str;
                            if($conn->query($sql1) === TRUE){
                                echo "Record created";
                                echo "<br/>";
                            }else{
                                echo 'Error' . $conn -> error;
                                 echo "<br/>";
                            }
                        }
                    }
//                 $sql1 = $str;
//                    if($conn->query($sql1) === TRUE){
//                        echo "Record created";
//                       }
//                    }else{
//                        echo 'Error' . $conn -> error;
//                    }
                }

//                    // если таблица создалась // мб будет нужна count($detail);
////                    $sql1 = "INSERT INTO details (name, price, priceMany, storageFirst,storageSecond, countryProd)
////                    VALUES($bananas, 22, 33, 31, 32, 'Africa')";
//                       $str = "INSERT INTO details (name, price, priceMany, storageFirst,storageSecond, countryProd)
//                        VALUES('$bananas', 22, 33, 31, 32, 'Africa')";
//                       
//                }
                
//делаем генерацию строчки

//$str = "INSERT INTO details (name, price, priceMany, storageFirst,storageSecond, countryProd)
//                    VALUES(" . $bananas . ", 22, 33, 31, 32, 'Africa')";
// добавляем записи в таблицу
                
?>

</body>
</html>