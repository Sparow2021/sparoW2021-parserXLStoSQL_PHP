
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<!--    $sql = "CREATE TABLE details( 
                        name VARCHAR (30) NOT NULL PRIMARY KEY,
                        price FLOAT NOT NULL,
                        priceMany INT NOT NULL,
                        storageFirst INT NOT NULL,
                        storageSecond INT NOT NULL,
                        countryProd VARCHAR (30) NOT NULL
                )";-->
<?php
require_once 'connection.php'; // подключаем скрипт
require_once "Classes/PHPExcel.php";


    $tmpfname = "pricelist.xls";
    $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
    $excelObj = $excelReader->load($tmpfname);
    $worksheet = $excelObj->getSheet(0);
    $lastRow = $worksheet->getHighestRow();
                
    //массив для занесения данных с xls
    $detailsArr = array();           
    // процесс занесения данных в массив с xls РАБОТАЕТ!!!
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
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
    
     foreach($detailsArr as $detail){
            $str = "INSERT INTO details
            VALUES(" . "'$detail[0]'" . ", " . "'$detail[1]'" . ", " . "'$detail[2]'" . ", " . "'$detail[3]'" . ", " . "'$detail[4]'" . ", " . "'$detail[5]'" . ")";
            $sql1 = $str;
            $result = mysqli_query($link, $sql1) or die("Ошибка " . mysqli_error($link)); 
        }
?>
    <h1>Файл спаршен</h1>  
</body>
</html>

             
                



