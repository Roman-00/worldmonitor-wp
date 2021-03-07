<?php/*
$sdd_db_host = 'srv-pleskdb52.ps.kz:3306';
$sdd_db_name = 'worldmon_wordpress_e';
$sdd_db_user = 'worldmon_wordpress_d';
$sdd_db_pass = 'GV{O~#f9ZShe';

$conn = mysql_connect($sdd_db_host,$sdd_db_user, $sdd_db_pass);

if (!$conn)
{
    throw new Exception('Не удалось подключиться к базе данных! Проверьте параметры подключения');
}
if(!mysql_select_db($sdd_db_name, $conn))
{
    throw new Exception('Не удалось выбрать базу данных {$ssd_db_name}!');
}
$result = mysql_query('SELECT * FROM `table_name`, $conn');
if(!$result)
{
    throw new Exception(sprintf('Не удалось выполнить запрос к БД, код ошибки %d, текст ошибки: %s', mysql_errno($conn), mysql_error($conn)));
}

while ($row = mysql_fetch_array($result))
{
    echo '<p>Запись id-'.$row['id'].'. Текст: '.$row['text'].'</p>';
}

*/?>