<?php
$host='localhost';          //Хост
$db='srv74202_image';               //Имя БД
$user_mysql='srv74202_ht71381';       //Имя пользователя БД
$pass_mysql='dfghjc13';

$link = mysqli_connect($host, $user_mysql, $pass_mysql,$db) or die("<center><h1>Don't connect with database!!!</h1></center>"); 
 mysqli_set_charset($link,'utf8');
 @mysqli_real_escape_string($link);
?>