<?php
//подключаем конфигурационный файл бд
include_once("config.php");

//проверяем $_POST["phone"] на пустое значение
if(isset($_POST["phone"]) && strlen($_POST["phone"])>0) {

    // очищаем значения переменных, PHP фильтры FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH
    // (Удаляют тэги, при необходимости удаляет или кодирует специальные символы)

    $user_phone = filter_var($_POST["phone"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $user_day = filter_var($_POST["day"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $rez_date = $_POST["date"];

    $result = $mysqli->query("INSERT INTO user_date (user_phone,user_day,reserved_day) VALUES('$user_phone','$user_day','$rez_date')");

    if ($result == true){
        echo "Информация занесена в базу данных";
    }else{
        echo "Информация не занесена в базу данных";
    }
    mysqli_close($mysqli);
}
else {
    //Output error
    header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}

?>