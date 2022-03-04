<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form action="search.php">
    <p>Поиск: <input type="text" name="search" id=""> <input type="submit" value="Поиск"></p>
    <hr>
</form>
</body>
</html>
<?php
require 'vendor/autoload.php';
if(isset($_POST['Submit'])) {
    $path = "test.xls";

    $objPHPExcel = PHPExcel_IOFactory::load($path);
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
        $worksheetTitle = $worksheet->getTitle();
        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $nrColumns = ord($highestColumn) - 64;

        echo '<table border="1"><tr>';
        for ($row = 1; $row <= $highestRow; ++$row) {
            echo '<tr>';
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                echo '<td>' . $val . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    for ($row = 2; $row <= $highestRow; ++$row) {
        $val = array();
        for ($col = 0; $col < $highestColumnIndex; ++$col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val[] = $cell->getValue();
        }
    }
}
