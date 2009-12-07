<?php
if (@$config == NULL) die ("");

//==============================================================
// Скрипт входа пользователя
//==============================================================
if (empty($_SESSION['account_id']))
{
 $show = true;
 if(@$_POST['script'] == 'result')
 {
   $name = @$_POST['account_name'];
   $username = strtoupper(@$_POST['account_name']);
   $password = strtoupper(@$_POST['account_pass']);

   if (empty($username) OR empty($password))
     echo $lang['login_err_empty'];
   else
   {
     $list = $rDB->selectRow("SELECT * FROM `account` WHERE `username` = ? AND `sha_pass_hash` = SHA1(?)", $username, $username.":".$password);
     // Ожидаем 3 секунды - чтоб предотвратить подбор пароля
     sleep(3);
     if (empty($list))
       echo $lang['user_login_err_name_pass'];
     else
     {
       $_SESSION['account_id'] = $list['id'];
       $_SESSION['username']   = $list['username'];
       echo '<a href="?user">'.$lang['user_login_succes'].'</a>';
       echo "<script language=javascript>setTimeout(\"location.href='?user'\", 5);</script>";
       $show = false;
     }
   }
 }
 if ($show == true)
 {
  echo '<br>';
  echo '<form method="post" action="?user=login" name="acc">';
  echo '<input type="hidden" name="script" value="result">';
  echo '<table class=find>';
  echo '<tr><td class=top colspan=2>';
  echo '<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['user_login'].'</td><td class=topright>&nbsp;</td></tr></table>';
  echo '</td></tr>';
  echo '<tr><td>'.$lang['user_login_name'].'</td><td><input type="text" name="account_name" maxlength="16" size="30" value="'.@$name.'"></td></tr>';
  echo '<tr><td>'.$lang['user_login_pass'].'</td><td><input type="password" name="account_pass" maxlength="16" size="30"></td></tr>';
  echo '<tr><td class=bottom colspan=2><input type=submit value="'.$lang['user_login_ok'].'"></td></tr>';
  echo '</table>';
  echo '</form>';
  echo "<br>";
 }
}
?>