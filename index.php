<?php

    $database_connect = //db connect;
    $name = $_POST['name'];
    $message = $_POST['msg'];

    mysqli($database_connect, "INSERT method SQL");
    //check name
    if($name == '' & ' ') {
        echo('Имя не верно');
    } else {
        echo('Сообщение отправлено');
    }

    //continue

?>
