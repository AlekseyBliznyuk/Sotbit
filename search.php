<?php

$mysqli = new mysqli("localhost","root","","sotbit");

if ($mysqli->connect_error) {
    printf("Соединение не удалось: %s\n", $mysqli->connect_error);
    exit();
}

$inputSearch = $_REQUEST['search'];
//поиск по артикулу(вводим полный артикул)
$sql = "SELECT * FROM `test` WHERE `article` = '$inputSearch'";

$result = $mysqli->query($sql);

function doesItExist(array $arr) {
    // Создаём новый массив
    $data = array(
        'article' => $arr['article'] != false ? $arr['article'] : 'Нет данных',
        'name' => $arr['name'] != false ? $arr['name'] : 'Нет данных',
        'price' => $arr['price'] != false ? $arr['price'] : 'Нет данных',
        'remains' => $arr['remains'] != false ? $arr['remains'] : 'Нет данных'
    );
    return $data; // Возвращаем этот массив
}

function countPeople($result) {
    // Проверка на то, что строк больше нуля
    if ($result -> num_rows > 0) {
        // Цикл для вывода данных
        while ($row = $result -> fetch_assoc()) {
            // Получаем массив с строками которые нужно выводить
            $arr = doesItExist($row);
            // Вывод данных
            echo "Артикул: ". $row['article'] ."<br>
                  Наименование товара: ". $row['name'] ."<br>
                  Цена: ". $row['price'] ."<br>
                  Остатки: ". $arr['remains'] ."<hr>";
        }
        // Если данных нет
    } else {
        echo "Не найдено";
    }
}
countPeople($result); // Функция вывода результата
