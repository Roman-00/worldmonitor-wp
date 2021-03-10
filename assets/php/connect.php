<?php
    mysql_connect('srv-pleskdb52.ps.kz:3306', 'worldmon_users', 'kp%58cM4')
    or die("<p>Ошибка подключения к базе данных! " . mysql_error() . "</p>");

    mysql_select_db("worldmon_users")
    or die("<p>Ошибка выбора базы данных! ". mysql_error() . "</p>");

?>