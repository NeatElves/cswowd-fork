<?php
 //==============================================================
 // Скрипт выхода пользователя
 //==============================================================
 unset($_SESSION['account_id']);
 unset($_SESSION['username']);
 echo '<a href="index.php">'.$lang['user_logout_succes'].'</a>';
 echo "<script language=javascript>setTimeout(\"location.href='index.php'\", 10);</script>";
?>
