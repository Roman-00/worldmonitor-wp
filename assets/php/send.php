<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <title>Untitled Document</title>
</head>
<body>
    <?php
        require 'connect.php';

        $user_name = trim($_REQUEST['user_name']);
        $user_surname = trim($_REQUEST['user_surname']);
        $user_company = trim($_REQUEST['user_company']);
        $user_place = trim($_REQUEST['user_place']);
        $user_phone = trim($_REQUEST['user_phone']);
        $user_email = trim($_REQUEST['user_email']);



    $insert_sql = "INSERT INTO users (user_name, user_surname, user_company, user_place, user_phone, user_email)" .
        "VALUES('{$user_name}', '{$user_surname}', '{$user_company}', '{$user_place}'), '{$user_phone}'), '{$user_email}');";
    mysql_query($insert_sql);
    echo "<p>Новая запись вставлена в базу!</p>";
    ?>
</body>
</html>
