<?php
// Модуль в разработке - файл языков пока локальный
include_once("user_lang.php");

$user = @$_REQUEST['user'];
// Not logged user modules
if (empty($_SESSION['account_id']))
{
   $user_list = array(
   'login'  =>'user_login.php',
   'default'=>'user_login.php'
   );
}
// Logged user modules
else
{
   $user_list = array(
   'logout' =>'user_logout.php',
   'default'=>'user_kabinet.php'
   );
}
// Подключаем нужный скрипт кабинета
$user_module = @$user_list[$user] ? @$user_list[$user] : @$user_list['default'];
if ($user_module)
   include($user_module);
?>


